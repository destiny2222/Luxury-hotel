@extends('layouts.admin')
@section('title', 'Edit Requests')

@section('content')
<h2 style="font-size: 1.5rem; margin-bottom: 1.5rem;">Booking Edit Requests</h2>

<div class="admin-table-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Booking</th>
                <th>Field</th>
                <th>Old Value</th>
                <th>New Value</th>
                <th>Requested By</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($editRequests as $er)
            <tr>
                <td><strong>{{ $er->booking->booking_reference ?? 'N/A' }}</strong></td>
                <td style="text-transform: capitalize;">{{ str_replace('_', ' ', $er->field_name) }}</td>
                <td>{{ $er->old_value }}</td>
                <td style="color: var(--admin-warning);">{{ $er->new_value }}</td>
                <td>{{ $er->requestedBy->name ?? 'Unknown' }}</td>
                <td>{{ $er->created_at->format('M d, H:i') }}</td>
                <td><span class="badge-status badge-{{ $er->status }}">{{ $er->status }}</span></td>
                <td>
                    @if($er->status === 'pending')
                    <div style="display: flex; gap: 0.5rem;">
                        <form method="POST" action="{{ route('admin.edit-requests.approve', $er) }}">
                            @csrf @method('PATCH')
                            <button class="btn-admin btn-admin-sm" style="background: rgba(34,197,94,0.15); color: var(--admin-success); border: none;" title="Approve">
                                <i class="fas fa-check"></i>
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.edit-requests.reject', $er) }}">
                            @csrf @method('PATCH')
                            <button class="btn-admin btn-admin-danger btn-admin-sm" title="Reject">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                    </div>
                    @else
                    <span style="font-size: 0.8rem; color: var(--admin-muted);">
                        by {{ $er->approvedBy->name ?? '—' }}
                    </span>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="8" style="text-align: center; padding: 2rem; color: var(--admin-muted);">No edit requests.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="admin-pagination">{{ $editRequests->links('pagination::simple-bootstrap-5') }}</div>
</div>
@endsection
