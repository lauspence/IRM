@extends('layouts.app')

@section('title', 'Sent Messages')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">📤 Messaging Center</h1>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('staff.messages.inbox') }}">Inbox</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('staff.messages.outbox') }}">Sent</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('staff.messages.create') }}">Compose</a>
        </li>
    </ul>

    <div class="row">
        <!-- Sent Messages Table -->
        <div class="col-md-12">
            @if($messages->isEmpty())
                <p class="text-muted">You have not sent any messages yet.</p>
            @else
                <div class="list-group">
                    @foreach($messages as $message)
                        <a href="{{ route('staff.messages.show', $message->id) }}" 
                           class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between">
                                <strong>To: {{ $message->receiver->name ?? 'Unknown' }}</strong>
                                <small>{{ $message->created_at ? $message->created_at->diffForHumans() : '' }}</small>
                            </div>
                            <div>
                                <span class="fw-bold">{{ $message->subject }}</span>
                                @if(!$message->is_read)
                                    <span class="badge bg-warning text-dark ms-2">Unread</span>
                                @else
                                    <span class="badge bg-success ms-2">Read</span>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
