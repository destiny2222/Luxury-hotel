@extends('layouts.admin')
@section('title', 'Add Room')

@section('content')
<div style="margin-bottom: 1.5rem;">
    <a href="{{ route('admin.rooms.index') }}" class="btn-admin btn-admin-outline btn-admin-sm"><i class="fas fa-arrow-left"></i> Back to Rooms</a>
</div>

<div class="admin-form-card" style="max-width: 800px;">
    <h3 style="margin-bottom: 1.5rem;">Create New Room</h3>

    @if($errors->any())
        <div class="admin-alert admin-alert-danger">
            <ul style="margin: 0; padding-left: 1.5rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.rooms.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="admin-form-row">
            <div class="admin-form-group">
                <label>Room Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="admin-form-group">
                <label>Category</label>
                <select name="room_category_id" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="admin-form-row">
            <div class="admin-form-group">
                <label>Price Per Night (₦)</label>
                <input type="number" name="price" value="{{ old('price') }}" step="0.01" min="0" required>
            </div>
            <div class="admin-form-group">
                <label>Capacity</label>
                <input type="number" name="capacity" value="{{ old('capacity', 2) }}" min="1" required>
            </div>
        </div>
        <div class="admin-form-group">
            <label>Description</label>
            <textarea name="description" rows="4">{{ old('description') }}</textarea>
        </div>
        <div class="admin-form-group">
            <label>Amenities (comma-separated)</label>
            <input type="text" name="amenities" value="{{ old('amenities') }}" placeholder="WiFi, Air Conditioning, Mini Bar, TV">
        </div>
        <div class="admin-form-group">
            <label>Room Images</label>
            <input type="file" name="images[]" multiple accept="image/*" style="padding: 0.5rem;">
        </div>
        <div class="admin-form-group">
            <label>Status</label>
            <select name="status" required>
                <option value="available">Available</option>
                <option value="maintenance">Maintenance</option>
                <option value="cleaning">Cleaning</option>
            </select>
        </div>
        <button type="submit" class="btn-admin btn-admin-primary"><i class="fas fa-save"></i> Create Room</button>
    </form>
</div>
@endsection
