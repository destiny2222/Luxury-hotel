@extends('layouts.master')
@section('content')
    <div class="card w-100 position-relative overflow-hidden">
        <div class="px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
            <h4 class="card-title mb-0">Edit Product: {{ $product->name }}</h4>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                <i class="ti ti-arrow-left me-1"></i> Back
            </a>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="name" class="form-label fw-semibold">Product Name <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $product->name) }}" required>
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
                                id="price" name="price" value="{{ old('price', $product->price) }}" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12 mb-4">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                            rows="4">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="colors" class="form-label fw-semibold">Available Colors (Comma Separated)</label>
                        <input type="text" class="form-control @error('colors') is-invalid @enderror" id="colors"
                            name="colors"
                            value="{{ old('colors', $product->colors ? implode(', ', $product->colors) : '') }}"
                            placeholder="e.g. white, terracotta, black">
                        <small class="text-muted">Users can select from these colors during checkout</small>
                        @error('colors')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="image" class="form-label fw-semibold">Product Image (Leave empty to keep
                            current)</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                            name="image" accept="image/*">
                        @if ($product->image)
                            <div class="mt-2">
                                <span class="d-block text-muted text-sm mb-1">Current Image:</span>
                                <img src="{{ asset('products/'.$product->image) }}" class="rounded shadow-sm" width="100"
                                    alt="Current image">
                            </div>
                        @endif
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-check me-1"></i> Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
