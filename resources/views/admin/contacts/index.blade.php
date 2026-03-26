@extends('layouts.admin')
@section('title', 'Contact Messages')

@section('content')
<h2 style="font-size: 1.5rem; margin-bottom: 1.5rem;">Contact Messages</h2>

<div class="admin-table-card">
    <table class="admin-table">
        <thead>
            <tr><th>Name</th><th>Email</th><th>Subject</th><th>Date</th><th>Status</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @forelse($messages as $msg)
            <tr>
                <td><strong>{{ $msg->name }}</strong></td>
                <td>{{ $msg->email }}</td>
                <td>{{ Str::limit($msg->subject, 40) }}</td>
                <td>{{ $msg->created_at->format('M d, Y') }}</td>
                <td><span class="badge-status badge-{{ $msg->status }}">{{ $msg->status }}</span></td>
                <td style="display: flex; gap: 0.5rem;">
                    <a href="{{ route('admin.contacts.show', $msg) }}" class="btn-admin btn-admin-outline btn-admin-sm"><i class="fas fa-eye"></i></a>
                    @if(auth()->user()->canDelete())
                    <form method="POST" action="{{ route('admin.contacts.destroy', $msg) }}" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button class="btn-admin btn-admin-danger btn-admin-sm"><i class="fas fa-trash"></i></button>
                    </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align: center; padding: 2rem; color: var(--admin-muted);">No messages.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="admin-pagination">{{ $messages->links('pagination::simple-bootstrap-5') }}</div>
</div>
@endsection
