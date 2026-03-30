@extends('layouts.admin')
@section('title', 'Edit Post')

@section('content')
<div style="margin-bottom: 1.5rem;">
    <a href="{{ route('admin.posts.index') }}" class="btn-admin btn-admin-outline btn-admin-sm"><i class="fas fa-arrow-left"></i> Back to Posts</a>
</div>

<div class="admin-form-card" style="max-width: 800px;">
    <h3 style="margin-bottom: 1.5rem;">Edit Post</h3>

    @if($errors->any())
        <div class="admin-alert admin-alert-danger">
            <ul style="margin: 0; padding-left: 1.5rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="admin-form-group">
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" required>
        </div>
        <div class="admin-form-group">
            <label>Content</label>
            <textarea name="content" rows="10" required style="width: 100%; border: 1px solid var(--admin-border); border-radius: 8px; padding: 0.75rem;">{{ old('content', $post->content) }}</textarea>
        </div>
        <div class="admin-form-group">
            <label>Featured Image (leave blank to keep current)</label>
            <input type="file" name="image" accept="image/*" style="padding: 0.5rem;">
            @if($post->image)
                <div style="margin-top: 1rem;">
                    <img src="{{ asset('uploads/posts/' . $post->image) }}" alt="Current Image" style="max-width: 200px; border-radius: 8px;">
                </div>
            @endif
        </div>
        <div class="admin-form-group">
            <label>Status</label>
            <select name="status" required>
                <option value="published" {{ $post->status == 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ $post->status == 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
        </div>
        <button type="submit" class="btn-admin btn-admin-primary"><i class="fas fa-save"></i> Update Post</button>
    </form>
</div>
@endsection
