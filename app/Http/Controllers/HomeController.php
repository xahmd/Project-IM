<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Leave;

class HomeController extends Controller
{
    /**
reate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Check if the logged-in user is an admin
        if (auth()->user()->role === 'Admin') {
            // Fetch analytics data for admin dashboard
            $totalAdmins = User::where('role', 'Admin')->count();
            $totalStaff = User::where('role', 'Staff')->count();
            $totalLeaves = Leave::count();

            $approvedLeaves = Leave::where('status', 'Approved')->count();
            $pendingLeaves = Leave::where('status', 'Pending')->count();
            $rejectedLeaves = Leave::where('status', 'Rejected')->count();

            // Example data for monthly leave analytics
            $monthlyLeaveLabels = ['January', 'February', 'March', 'April', 'May', 'June'];
            $monthlyLeaveData = [5, 10, 15, 7, 12, 8]; // Replace with dynamic data if necessary

            // Return the admin dashboard view with data
return view('home', compact(
                'totalAdmins',
                'totalStaff',
                'totalLeaves',
                'approvedLeaves',
                'pendingLeaves',
                'rejectedLeaves',
                'monthlyLeaveLabels',
                'monthlyLeaveData'
            ));
        }

        // Non-admin users are directed to the default home view
        return view('home');
    }
}
