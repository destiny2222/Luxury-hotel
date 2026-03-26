@extends('layouts.admin')
@section('title', 'Add Testimonial')

@section('content')
<div style="margin-bottom: 1.5rem;">
    <a href="{{ route('admin.testimonials.index') }}" class="btn-admin btn-admin-outline btn-admin-sm"><i class="fas fa-arrow-left"></i> Back</a>
</div>
<div class="admin-form-card" style="max-width: 600px;">
    <h3 style="margin-bottom: 1.5rem;">Add Testimonial</h3>
    <form method="POST" action="{{ route('admin.testimonials.store') }}">
        @csrf
        <div class="admin-form-row">
            <div class="admin-form-group">
                <label>Guest Name</label>
                <input type="text" name="guest_name" required>
            </div>
            <div class="admin-form-group">
                <label>Location</label>
                <input type="text" name="guest_location" placeholder="e.g. Lagos, Nigeria">
            </div>
        </div>
        <div class="admin-form-group">
            <label>Review Content</label>
            <textarea name="content" rows="4" required></textarea>
        </div>
        <div class="admin-form-row">
            <div class="admin-form-group">
                <label>Rating</label>
                <select name="rating">
                    @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                    @endfor
                </select>
            </div>
            <div class="admin-form-group">
                <label>Status</label>
                <select name="status">
                    <option value="approved">Approved</option>
                    <option value="pending">Pending</option>
                </select>
            </div>
        </div>
        <div class="admin-form-group">
            <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                <input type="checkbox" name="is_featured" value="1" style="accent-color: var(--admin-primary);">
                Featured on Homepage
            </label>
        </div>
        <button type="submit" class="btn-admin btn-admin-primary"><i class="fas fa-save"></i> Create</button>
    </form>
</div>
@endsection
