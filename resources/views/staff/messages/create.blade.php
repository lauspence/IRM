@extends('layouts.app')

@section('title', 'Compose Message')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">✉️ Messaging Center</h1>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-4" id="messageTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ request()->routeIs('staff.messages.inbox') ? 'active' : '' }}" 
               href="{{ route('staff.messages.inbox') }}">Inbox</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ request()->routeIs('staff.messages.outbox') ? 'active' : '' }}" 
               href="{{ route('staff.messages.outbox') }}">Sent</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link active" href="{{ route('staff.messages.create') }}">Compose</a>
        </li>
    </ul>

    <div class="row">
        <!-- Compose Form -->
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="card-title mb-3">Compose New Message</h4>

                    <form action="{{ route('staff.messages.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="receiver_id" class="form-label">To</label>
                            <select name="receiver_id" id="receiver_id" class="form-control" required>
                                <option value="">-- Select Recipient --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="body" class="form-label">Message</label>
                            <textarea name="body" id="body" rows="5" class="form-control" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">Send</button>
                        <a href="{{ route('staff.messages.inbox') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>

        <!-- Recent Messages (Right Sidebar) -->
        <div class="col-md-6">
            <h5>Recent Messages</h5>
            <div class="list-group">
                @foreach($recentMessages as $msg)
                    <a href="{{ route('staff.messages.show', $msg->id) }}" 
                       class="list-group-item list-group-item-action {{ !$msg->is_read ? 'list-group-item-warning' : '' }}">
                        <div class="d-flex justify-content-between">
                            <strong>{{ $msg->sender->name ?? 'Unknown' }}</strong>
                            <small>{{ $msg->created_at->diffForHumans() }}</small>
                        </div>
                        <div>{{ $msg->subject }}</div>
                    </a>
                @endforeach

                @if($recentMessages->isEmpty())
                    <p class="text-muted mt-2">No recent messages.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
