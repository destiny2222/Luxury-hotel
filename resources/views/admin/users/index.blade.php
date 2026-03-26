@extends('layouts.admin')
@section('title', 'Users')

@section('content')
<h2 style="font-size: 1.5rem; margin-bottom: 1.5rem;">User Management</h2>

<div class="admin-table-card">
    <table class="admin-table">
        <thead>
            <tr><th>Name</th><th>Email</th><th>Phone</th><th>Role</th><th>Joined</th><th>Action</th></tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td><strong>{{ $user->name }}</strong></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone ?? '—' }}</td>
                <td><span class="badge-status badge-{{ $user->role === 'user' ? 'checked_out' : 'confirmed' }}">{{ str_replace('_', ' ', $user->role) }}</span></td>
                <td>{{ $user->created_at->format('M d, Y') }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.users.update-role', $user) }}" style="display: flex; gap: 0.25rem;">
                        @csrf @method('PATCH')
                        <select name="role" style="padding: 0.3rem; background: var(--admin-bg); border: 1px solid var(--admin-border); border-radius: 4px; color: var(--admin-text); font-size: 0.8rem;">
                            @foreach(['user','front_desk','supervisor','super_admin'] as $r)
                                <option value="{{ $r }}" {{ $user->role === $r ? 'selected' : '' }}>{{ str_replace('_', ' ', ucfirst($r)) }}</option>
                            @endforeach
                        </select>
                        <button class="btn-admin btn-admin-primary btn-admin-sm" type="submit"><i class="fas fa-check"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="admin-pagination">{{ $users->links('pagination::simple-bootstrap-5') }}</div>
</div>
@endsection
