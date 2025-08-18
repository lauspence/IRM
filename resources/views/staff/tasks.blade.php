@extends('layouts.app')

@section('title', 'Staff Tasks')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Your Tasks</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($tasks->isEmpty())
        <p>No tasks assigned yet.</p>
    @else
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Task ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Deadline</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ Str::limit($task->description, 50) }}</td>
                    <td>{{ $task->deadline ? $task->deadline->format('M d, Y') : 'N/A' }}</td>
                    <td>
                        @if($task->status === 'completed')
                            <span class="badge bg-success">Completed</span>
                        @elseif($task->status === 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @else
                            <span class="badge bg-secondary">Unknown</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
