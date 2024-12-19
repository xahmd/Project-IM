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
        $totalAdmins = User::where('role', 'Admin')->count();
        $totalStaff = User::where('role', 'Staff')->count();
        $totalLeaves = Leave::count();

        $approvedLeaves = Leave::where('status', 'Approved')->count();
        $pendingLeaves = Leave::where('status', 'Pending')->count();
        $rejectedLeaves = Leave::where('status', 'Rejected')->count();

        // Example monthly data for chart
        $monthlyLeaveLabels = ['January', 'February', 'March', 'April', 'May', 'June']; // Example labels
        $monthlyLeaveData = [5, 10, 15, 7, 12, 8]; // Example data

        // Pass data to the view
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
}
