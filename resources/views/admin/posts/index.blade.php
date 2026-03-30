@extends('layouts.admin')
@section('title', 'Posts')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <h2 style="font-size: 1.5rem;">All Posts</h2>
    <a href="{{ route('admin.posts.create') }}" class="btn-admin btn-admin-primary"><i class="fas fa-plus"></i> Add Post</a>
</div>

<div class="admin-table-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Author</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
            <tr>
                <td><strong>{{ $post->title }}</strong></td>
                <td><span class="badge-status badge-{{ $post->status == 'published' ? 'available' : 'maintenance' }}">{{ ucfirst($post->status) }}</span></td>
                <td>{{ $post->user ? $post->user->name : 'N/A' }}</td>
                <td>{{ $post->created_at->format('M d, Y') }}</td>
                <td style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                    <a href="{{ route('admin.posts.edit', $post) }}" class="btn-admin btn-admin-outline btn-admin-sm"><i class="fas fa-edit"></i></a>
                    @if(auth()->user() && auth()->user()->canDelete())
                    <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" style="display: inline;" onsubmit="return confirm('Delete this post?')">
                        @csrf @method('DELETE')
                        <button class="btn-admin btn-admin-danger btn-admin-sm"><i class="fas fa-trash"></i></button>
                    </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align: center; padding: 2rem; color: var(--admin-muted);">No posts found.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="admin-pagination">{{ $posts->links('pagination::simple-bootstrap-5') }}</div>
</div>
@endsection
