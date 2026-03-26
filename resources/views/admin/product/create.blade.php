@extends('layouts.master')
@section('content')
    <div class="card w-100 position-relative overflow-hidden">
        <div class="px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
            <h4 class="card-title mb-0">Add New Product</h4>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                <i class="ti ti-arrow-left me-1"></i> Back
            </a>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="name" class="form-label fw-semibold">Product Name <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="price" class="form-label fw-semibold">Price (NGN) <span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">₦</span>
                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror"
                                id="price" name="price" value="{{ old('price') }}" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12 mb-4">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                            rows="4">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="colors" class="form-label fw-semibold">Available Colors (Comma Separated)</label>
                        <input type="text" class="form-control @error('colors') is-invalid @enderror" id="colors"
                            name="colors" value="{{ old('colors') }}" placeholder="e.g. white, terracotta, black">
                        <small class="text-muted">Users can select from these colors during checkout</small>
                        @error('colors')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="image" class="form-label fw-semibold">Product Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                            name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-check me-1"></i> Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
