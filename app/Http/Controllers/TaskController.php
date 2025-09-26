<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
        ]);

        Task::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Task created successfully!');
    }

    public function create()
    {
        return view('tasks.create');
    }


    public function markCompleted(Task $task)
    {
        // Ensure only the owner of the task can complete it
        if ($task->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $task->status = 'completed';
        $task->save();

        return redirect()->back()->with('success', 'Task marked as completed!');
    }

    public function edit(Task $task)
    {
        // Ensure only task owner can edit
        if ($task->user_id !== auth()->id() ) {
            abort(403);
        }
        return view('staff.edit-task', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'nullable|date',
        ]);

        $task->update($request->only('title', 'description', 'deadline'));

        return redirect()->route('staff.tasks')->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $task->delete();
        return redirect()->route('staff.tasks')->with('success', 'Task deleted successfully!');
    }


}
