@extends('layouts.app')

@section('title', 'Manager Dashboard')

@section('content')
<div class="container mx-auto mt-4">

    <h1 class="text-2xl font-bold mb-4">Manager Dashboard</h1>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    {{-- Quick Stats --}}
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Staff</h5>
                    <p class="card-text fs-4 fw-bold">{{ $totalStaff ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Active Tasks</h5>
                    <p class="card-text fs-4 fw-bold">{{ $activeTasks ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-warning shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Pending Approvals</h5>
                    <p class="card-text fs-4 fw-bold">{{ $pendingApprovals ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Staff Table --}}
    <div class="mb-4">
        <h2 class="h5 mb-2">Team Members</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($staff ?? [] as $index => $member)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->email }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ ucfirst($member->role) }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No staff members found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Create Task Form --}}
    <div class="mb-4">
        <h2 class="h5 mb-2">Assign New Task</h2>
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="row g-2">
                <div class="col-md-3">
                    <select name="user_id" class="form-select" required>
                        <option value="">Select Staff</option>
                        @foreach($staff as $member)
                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="text" name="title" class="form-control" placeholder="Task Title" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="description" class="form-control" placeholder="Description">
                </div>
                <div class="col-md-2">
                    <input type="date" name="deadline" class="form-control">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-100">Add</button>
                </div>
            </div>
        </form>
    </div>

    {{-- Tasks Table --}}
    <div class="mb-4">
        <h2 class="h5 mb-2">Tasks List</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Assigned To</th>
                        <th>Deadline</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks ?? [] as $index => $task)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description ?? '-' }}</td>
                            <td>{{ $task->user->name ?? '-' }}</td>
                            <td>{{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('d M Y') : '-' }}</td>
                            <td>
                                <span class="badge bg-{{ $task->status == 'pending' ? 'warning' : 'success' }}">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No tasks found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
