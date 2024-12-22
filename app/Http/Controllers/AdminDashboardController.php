<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Leave; // Ensure you have a Leave model

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     *
return \Illuminate\Http\Response
     */
    public function index()
    {
        // Analytics Data
        $totalUsers = User::count();  // Count all users (both admins and staff)
        $totalLeaves = Leave::count();  // Count all leave requests
    
        // Leave statuses
        $approvedLeaves = Leave::where('status', 'Approved')->count();
        $pendingLeaves = Leave::where('status', 'Pending')->count();
        $rejectedLeaves = Leave::where('status', 'Rejected')->count();
    
        // Example monthly data for chart (this is just an example, adjust according to your data)
        $monthlyLeaveLabels = ['January', 'February', 'March', 'April', 'May', 'June'];
        $monthlyLeaveData = [5, 10, 15, 7, 12, 8];  // Replace this with actual data logic if needed
    
        // Pass data to the correct view (home)
        return view('home', compact(
            'totalUsers',  // Make sure this matches the variable you're using in the Blade file
            'totalLeaves',
            'approvedLeaves',
            'pendingLeaves',
            'rejectedLeaves',
            'monthlyLeaveLabels',
            'monthlyLeaveData'
        ));
    }
}    