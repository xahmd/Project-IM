<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\User;
use App\Leave;
use App\LeaveType;
use App\Approval;
use Auth;
use DateTime;
use App\Notifications\LeaveMessage;
use App\Notifications\ApproveMessage;

class LeaveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //function to apply for leave
    public function createLeave()
    {
        $leave = LeaveType::all();

        return view('staff.createleave', compact('leave'));
    }

    // function to pull the leave history of an individual user
    public function approval()
    {
        $staffId = Auth::user()->staffID;

        $approvals = Approval::where ('staffID', $staffId)
                        ->paginate(5);

        return view('staff/approval', compact('approvals'));
    }

    // function to get the leave history of all the staffs for the admin user
    public function adminLeaveHistory()
    {
        $approvals = Approval::paginate(5);

        return view('staff/approval', compact('approvals'));
    }

    //function to get the leave history available to the linemanager

    public function managerLeaveHistory()
    {
        $approvals = Approval::latest()->paginate(5);

        return view('staff/approval', compact('approvals'));
    }

    // function to save the leave applied into the db
    public function store()
    {
        $staffId = Auth::user()->staffID;

        $check = Approval::where('staffID', $staffId)->first();
        $bal = Approval::where('staffID', $staffId)
                ->orderBy('id', 'desc')
                ->first();

        $staff = new Approval();
        $staff->name = Auth::user()->firstName;
        $staff->staffID =  Auth::user()->staffID;
        $staff->leave_type = request('leave_type');
        $staff->requested_at = date('H:i:s');
        $staff->startdate = request('startdate');
        $staff->enddate = request('enddate');
        $staff->resumdate = request('resumdate');
        $staff->totalleave = request('totalleave');

        if($check){
            $staff->initial_leave_bal = $bal->final_leave_bal;
            $staff->final_leave_bal = $bal->final_leave_bal;
        }

        $staff->save();

        $message = 'You have received a new Leave request which your approval is needed!';

        $manager = User::where('staffID', Auth::user()->managerID)->first();

        if ($manager) {
            $manager->notify(new LeaveMessage($message));
        } else {
            // Handle the case where no manager is found
            return redirect('/home')
                ->with('error', 'Leave Applied Successfully! However, no manager was found to notify.');
        }
        
    }

    // function to approve leave for a user
public function approve(Request $request, $id)
    {
        $user = Approval::findOrFail($id);

        // function to calculate the no of days of leave left
        $datetime1 = new DateTime($user->startdate);
        $datetime2 = new DateTime($user->enddate);
        $totalleave = $datetime1->diff($datetime2);
        $days = $totalleave->format('%a');

        $lBalance = $user->initial_leave_bal - $days;

        $user->update([
            'status' => $request->status,
            'final_leave_bal' => $lBalance
        ]);

        // message to be displayed when the leave is approved
        $message = [
            'subject'=> 'Approval Notification',
            'body' => 'Your Requested Leave has just been granted!'
        ];

        Auth::user()->notify(new ApproveMessage($message));

        return redirect('/staff/managerLeaveHistory')
            ->with('success','Leave Approved successfully');
    }

    // function to reject leave
    public function reject(Request $request, $id)
    {
        $user = Approval::findOrFail($id);

        $user->update([
            'status' => $request->status,
            'Reason' => $request->Reason
        ]);

        // message to be displayed when the leave is rejected
        $message = [
            'subject'=> 'Rejection Notification',
            'body' => 'Your Requested Leave has just been denied because '. strtolower($user->Reason)
        ];

        Auth::user()->notify(new ApproveMessage($message));

        return redirect('/staff/managerLeaveHistory')
            ->with('danger','Leave Rejected');
    }
}
