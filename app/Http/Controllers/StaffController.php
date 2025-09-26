<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class StaffController extends Controller
{
    // Tools page
    public function tools()
    {
        return view('staff.tools');
    }

    // Tasks page
    public function tasks()
    {
        $tasks = auth()->user()->tasks()->latest()->get();
        return view('staff.tasks', compact("tasks"));
    }

        // New: Dashboard page
    public function dashboard()
    {
        $user = auth()->user();

        // Task statistics
        $totalTasks = $user->tasks()->count();
        $pendingTasks = $user->tasks()->where('status', 'pending')->count();
        $completedTasks = $user->tasks()->where('status', 'completed')->count();

        // Recent tasks (last 5)
        $recentTasks = $user->tasks()->latest()->take(5)->get();

        return view('staff.dashboard', compact(
            'totalTasks',
            'pendingTasks',
            'completedTasks',
            'recentTasks'
        ));
    }


}


