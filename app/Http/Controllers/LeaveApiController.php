<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Approval;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LeaveApiController extends Controller
{
    /**
     * API 1: Get all leaves for a specific date range
     */
    public function getLeavesInDateRange(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date'
        ]);

        $leaves = Approval::whereBetween('startdate', [$request->start_date, $request->end_date])
            ->select('staffID', 'startdate', 'enddate', 'leave_type', 'status')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $leaves
        ]);
    }

    /**
     * API 2: Get leave summary by department/type
     */
    public function getLeaveSummary()
    {
        $summary = Approval::select('leave_type')
            ->selectRaw('COUNT(*) as total')
            ->selectRaw('COUNT(CASE WHEN status = "Approved" THEN 1 END) as approved')
            ->selectRaw('COUNT(CASE WHEN status = "Pending" THEN 1 END) as pending')
            ->groupBy('leave_type')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $summary
        ]);
    }

    /**
     * API 3: Get staff on leave today
     */
    public function getStaffOnLeave()
    {
        $today = Carbon::today();

        $onLeave = Approval::where('status', 'Approved')
            ->whereDate('startdate', '<=', $today)
            ->whereDate('enddate', '>=', $today)
            ->select('staffID', 'startdate', 'enddate', 'leave_type')
            ->get();

        return response()->json([
            'success' => true,
            'date' => $today->format('Y-m-d'),
            'staff_on_leave' => $onLeave
        ]);
    }
}
