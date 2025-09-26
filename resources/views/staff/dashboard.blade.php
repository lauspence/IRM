@extends('layouts.app')

@section('title', 'Staff Dashboard')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Welcome, {{ auth()->user()->name }}</h2>

    {{-- Quick Actions --}}
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('staff.tasks') }}" class="btn btn-primary me-2">View All Tasks</a>
        <a href="{{ route('tasks.create') }}" class="btn btn-success">Create Task</a>
    </div>

    {{-- Task Statistics --}}
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3 shadow">
                <div class="card-body text-center">
                    <h4 class="card-title">{{ $totalTasks }}</h4>
                    <p class="card-text">Total Tasks</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3 shadow">
                <div class="card-body text-center">
                    <h4 class="card-title">{{ $pendingTasks }}</h4>
                    <p class="card-text">Pending Tasks</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success mb-3 shadow">
                <div class="card-body text-center">
                    <h4 class="card-title">{{ $completedTasks }}</h4>
                    <p class="card-text">Completed Tasks</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Tasks --}}
    <div class="card mt-4 shadow">
        <div class="card-header">
            <h5>Recent Tasks</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <!-- <th>Created</th> -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentTasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>
                                @if($task->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($task->status == 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($task->status) }}</span>
                                @endif
                            </td>
                            <td>{{ $task->created_at->diffForHumans() }}</td>
                            <td>
                                @if($task->status != 'completed')
                                    <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-success">
                                            Mark Completed
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted">Done</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No recent tasks</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>
@endsection
