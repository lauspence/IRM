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
                    <td>
                        {{-- Mark as Completed --}}
                        @if($task->status !== 'completed')
                            <form action="{{ route('tasks.complete', $task->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-success">✔ Complete</button>
                            </form>
                        @endif

                        {{-- Edit --}}
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-primary">✏ Edit</a>

                        {{-- Delete --}}
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" 
                                    onclick="return confirm('Are you sure you want to delete this task?');">
                                🗑 Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    @endif
</div>
@endsection
