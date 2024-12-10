<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class StaffController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    
        public function createStaff() 
        {
        $managers = User::where("role", "LineManager")->get();

        return view('admin.createstaff',compact('managers'));


        }
        public function store() 
        {
        $staff = new User();

        $staff->firstName = request('firstName'); 
        $staff->lastName = request('lastName'); 
        $staff->password = bcrypt(request('password')); 
        $staff->staffID = request('staffID'); 
        $staff->managerID = request('managerID'); 
        $staff->role = request('role'); 

        $staff->save();

        return redirect('/allstaffs') ->with('success','Staff Created Sccessfully!!!');
        }

        public function allStaff()
        {

        $allStaffs = User::paginate(5);

        return view('admin/allstaffs', compact('allStaffs'));

        }   

        public function destroy($id) 
        {
        $allStaffs = User::findorFail($id);

        $allStaffs->delete();

        return redirect('/allstaffs')
                        ->with('danger','Staff Deleted successfully');;
        }

        public function editStaff($id) 
        {

        $user = User::findOrFail($id);
        $managers = User::where("role", "LineManager")->get();

        return view('admin/editstaff', compact('user', 'managers'));
        }

        public function updateStaff(Request $request, $id) 
        {

        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
        ]);

        $user = User::findOrFail($id);
        
        $user->update($request->all());
  
        return redirect('/allstaffs')
                        ->with('success','Staff updated successfully');

        }

}
