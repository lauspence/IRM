@extends('layouts.app')

@section('title', 'Inbox')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">📥 Inbox</h1>

    <a href="{{ route('staff.messages.create') }}" class="btn btn-primary mb-3">Compose Message</a>

    @if($messages->isEmpty())
        <p class="text-gray-600">You have no messages yet.</p>
    @else
        <div class="overflow-x-auto">
            <table class="table table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>From</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Received</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $message)
                        <tr>
                            <td>{{ $message->sender->name ?? 'Unknown' }}</td>
                            <td>
                                <a href="{{ route('staff.messages.show', $message->id) }}" class="text-decoration-none">
                                    {{ $message->subject }}
                                </a>
                            </td>
                            <td>
                                @if(!$message->is_read)
                                    <span class="badge bg-warning text-dark">Unread</span>
                                @else
                                    <span class="badge bg-success">Read</span>
                                @endif
                            </td>
                            <td>{{ $message->created_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
