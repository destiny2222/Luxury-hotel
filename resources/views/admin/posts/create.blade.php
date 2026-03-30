@extends('layouts.admin')
@section('title', 'Add Post')

@section('content')
<div style="margin-bottom: 1.5rem;">
    <a href="{{ route('admin.posts.index') }}" class="btn-admin btn-admin-outline btn-admin-sm"><i class="fas fa-arrow-left"></i> Back to Posts</a>
</div>

<div class="admin-form-card" style="max-width: 800px;">
    <h3 style="margin-bottom: 1.5rem;">Create New Post</h3>

    @if($errors->any())
        <div class="admin-alert admin-alert-danger">
            <ul style="margin: 0; padding-left: 1.5rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="admin-form-group">
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title') }}" required>
        </div>
        <div class="admin-form-group">
            <label>Content</label>
            <textarea name="content" rows="10" required style="width: 100%; border: 1px solid var(--admin-border); border-radius: 8px; padding: 0.75rem;">{{ old('content') }}</textarea>
        </div>
        <div class="admin-form-group">
            <label>Featured Image</label>
            <input type="file" name="image" accept="image/*" style="padding: 0.5rem;" required>
        </div>
        <div class="admin-form-group">
            <label>Status</label>
            <select name="status" required>
                <option value="published">Published</option>
                <option value="draft">Draft</option>
            </select>
        </div>
        <button type="submit" class="btn-admin btn-admin-primary"><i class="fas fa-save"></i> Create Post</button>
    </form>
</div>
@endsection
