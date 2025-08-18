<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffController extends Controller
{
      public function tools()
    {
        // Return the staff tools view
        return view('staff.tools');
    }

    public function tasks()
    {
        
        // Fetch tasks that belong to the currently authenticated user, ordered by newest first
        $tasks = auth()->user()->tasks()->latest()->get();
        // Return the staff tasks view
        return view('staff.tasks', compact("tasks"));
    }
}
