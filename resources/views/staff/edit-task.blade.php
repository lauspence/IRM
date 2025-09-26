@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
<div class="container mt-4">
    <h1>Edit Task</h1>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" 
                   value="{{ old('title', $task->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ old('description', $task->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="deadline" class="form-label">Deadline</label>
            <input type="date" name="deadline" class="form-control" 
                   value="{{ old('deadline', $task->deadline ? $task->deadline->format('Y-m-d') : '') }}">
        </div>

        <button type="submit" class="btn btn-success">Update Task</button>
        <a href="{{ route('staff.tasks') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
