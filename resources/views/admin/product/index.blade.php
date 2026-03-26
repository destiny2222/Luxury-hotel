@extends('layouts.master')
@section('content')

    <div class="card w-100 position-relative overflow-hidden">
        <div class="px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
            <h4 class="card-title mb-0">Products Management</h4>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i> Add Product
            </a>
        </div>

        <div class="card-body p-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive mb-4 border rounded-1">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4 bg-light">
                        <tr>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Product</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Price</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Colors</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Actions</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('products/' . $product->image) }}"
                                            class="rounded me-3" width="50" height="50" alt="{{ $product->name }}">
                                        <div>
                                            <h6 class="fs-4 fw-semibold mb-0">{{ $product->name }}</h6>
                                            <span class="fs-3 text-muted">{{ Str::limit($product->description, 30) }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 fw-normal">NGN {{ number_format($product->price, 2) }}</p>
                                </td>
                                <td>
                                    @if ($product->colors && count($product->colors) > 0)
                                        <div class="d-flex gap-1">
                                            @foreach ($product->colors as $color)
                                                <span class="badge bg-secondary">{{ ucfirst($color) }}</span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-muted fs-3">No colors</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.products.edit', $product->slug) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="ti ti-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->slug) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Delete this product?')">
                                                <i class="ti ti-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">No products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
