<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function dashboard()
    {
        // Count staff (all users with role = 'staff')
        $totalStaff = User::where('role', 'staff')->count();

        
        // Count active tasks (status = 'active')
        $activeTasks = Task::where('status', 'active')->count();

         // Count pending approvals (status = 'pending')
        $pendingApprovals = Task::where('status', 'pending')->count();

        // Get staff list
        $staff = User::where('role', 'staff')->get();

        // Get all tasks (with assigned user)
        $tasks = Task::with('user')->orderBy('deadline', 'asc')->get();

        // Return the manager dashboard view
        return view('manager.dashboard',compact(
            'totalStaff',
            'activeTasks',
            'pendingApprovals',
            'staff',
            'tasks'
        ));
    }

    public function reports()
    {
        // Return the manager reports view
        return view('manager.reports');
    }

}
