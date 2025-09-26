@extends('layouts.app')

@section('title', 'View Message')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">📧 Messaging Center</h1>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('staff.messages.inbox') }}">Inbox</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('staff.messages.outbox') }}">Sent</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('staff.messages.create') }}">Compose</a>
        </li>
    </ul>

    <div class="row">
        <!-- Message Content -->
        <div class="col-md-12">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title mb-0">{{ $message->subject }}</h4>
                        <small class="text-muted">{{ $message->created_at->format('d M, Y h:i A') }}</small>
                    </div>

                    <div class="mb-3">
                        <p><strong>From:</strong> {{ $message->sender->name ?? 'Unknown' }}</p>
                        <p><strong>To:</strong> {{ $message->receiver->name ?? 'Unknown' }}</p>
                        <p><strong>Status:</strong>
                            @if(!$message->is_read)
                                <span class="badge bg-warning text-dark">Unread</span>
                            @else
                                <span class="badge bg-success">Read</span>
                            @endif
                        </p>
                    </div>

                    <div class="mb-4 border-top pt-3">
                        <p class="text-gray-700 whitespace-pre-line">{{ $message->body }}</p>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('staff.messages.inbox') }}" class="btn btn-secondary">Back to Inbox</a>
                        <a href="{{ route('staff.messages.create') }}?reply_to={{ $message->sender->id }}" class="btn btn-primary">Reply</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
