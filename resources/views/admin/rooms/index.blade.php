@extends('layouts.admin')
@section('title', 'Rooms')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <h2 style="font-size: 1.5rem;">All Rooms</h2>
    <a href="{{ route('admin.rooms.create') }}" class="btn-admin btn-admin-primary"><i class="fas fa-plus"></i> Add Room</a>
</div>

<div class="admin-table-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Price/Night</th>
                <th>Capacity</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rooms as $room)
            <tr>
                <td><strong>{{ $room->name }}</strong></td>
                <td>{{ $room->category->name ?? 'N/A' }}</td>
                <td>₦{{ number_format($room->price, 0) }}</td>
                <td>{{ $room->capacity }} guests</td>
                <td><span class="badge-status badge-{{ $room->status }}">{{ $room->status }}</span></td>
                <td style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                    <a href="{{ route('admin.rooms.edit', $room) }}" class="btn-admin btn-admin-outline btn-admin-sm"><i class="fas fa-edit"></i></a>
                    <form method="POST" action="{{ route('admin.rooms.toggle-status', $room) }}" style="display: inline;">
                        @csrf @method('PATCH')
                        <button class="btn-admin btn-admin-sm" style="background: rgba(59,130,246,0.15); color: var(--admin-info); border: none;">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </form>
                    @if(auth()->user()->canDelete())
                    <form method="POST" action="{{ route('admin.rooms.destroy', $room) }}" style="display: inline;" onsubmit="return confirm('Delete this room?')">
                        @csrf @method('DELETE')
                        <button class="btn-admin btn-admin-danger btn-admin-sm"><i class="fas fa-trash"></i></button>
                    </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align: center; padding: 2rem; color: var(--admin-muted);">No rooms found.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="admin-pagination">{{ $rooms->links('pagination::simple-bootstrap-5') }}</div>
</div>
@endsection
