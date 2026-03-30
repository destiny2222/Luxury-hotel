@extends('layouts.admin')
@section('title', 'Edit Room')

@section('content')
<div style="margin-bottom: 1.5rem;">
    <a href="{{ route('admin.rooms.index') }}" class="btn-admin btn-admin-outline btn-admin-sm"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<div class="admin-form-card" style="max-width: 800px;">
    <h3 style="margin-bottom: 1.5rem;">Edit: {{ $room->name }}</h3>

    @if($errors->any())
        <div class="admin-alert admin-alert-danger">
            <ul style="margin: 0; padding-left: 1.5rem;">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.rooms.update', $room) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="admin-form-row">
            <div class="admin-form-group">
                <label>Room Name</label>
                <input type="text" name="name" value="{{ old('name', $room->name) }}" required>
            </div>
            <div class="admin-form-group">
                <label>Category</label>
                <select name="room_category_id" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $room->room_category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="admin-form-row">
            <div class="admin-form-group">
                <label>Price Per Night (₦)</label>
                <input type="number" name="price" value="{{ old('price', $room->price) }}" step="0.01" min="0" required>
            </div>
            <div class="admin-form-group">
                <label>Capacity</label>
                <input type="number" name="capacity" value="{{ old('capacity', $room->capacity) }}" min="1" required>
            </div>
        </div>
        <div class="admin-form-group">
            <label>Description</label>
            <textarea name="description" rows="4">{{ old('description', $room->description) }}</textarea>
        </div>
        <div class="admin-form-group">
            <label>Amenities (comma-separated)</label>
            <input type="text" name="amenities" value="{{ old('amenities', is_array($room->amenities) ? implode(', ', $room->amenities) : '') }}">
        </div>
        <div class="admin-form-group">
            <label>Replace Images (optional)</label>
            <input type="file" name="images[]" multiple accept="image/*" style="padding: 0.5rem;">
            @if($room->images && count($room->images) > 0)
                <div style="display: flex; gap: 0.5rem; margin-top: 0.5rem; flex-wrap: wrap;">
                    @foreach($room->images as $img)
                        <img src="{{ asset('uploads/rooms/' . $img) }}" style="width: 80px; height: 60px; object-fit: cover; border-radius: 4px; border: 1px solid var(--admin-border);">
                    @endforeach
                </div>
            @endif
        </div>
        <div class="admin-form-group">
            <label>Status</label>
            <select name="status" required>
                <option value="available" {{ $room->status === 'available' ? 'selected' : '' }}>Available</option>
                <option value="maintenance" {{ $room->status === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                <option value="cleaning" {{ $room->status === 'cleaning' ? 'selected' : '' }}>Cleaning</option>
            </select>
        </div>
        <button type="submit" class="btn-admin btn-admin-primary"><i class="fas fa-save"></i> Update Room</button>
    </form>
</div>
@endsection
