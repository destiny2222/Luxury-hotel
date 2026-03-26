@extends('layouts.master')
@section('content')
    <div class="card w-100 position-relative overflow-hidden">
        <div class="px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
            <h4 class="card-title mb-0">Orders Management</h4>
        </div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card-body p-4">
            <div class="table-responsive mb-4 border rounded-1">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4 bg-light">
                        <tr>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Order ID</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Customer</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Product</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Status</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Date</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Action</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td>
                                    <span class="fw-bold">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h6 class="fs-4 fw-semibold mb-0">{{ $order->shippingAddress->name ?? 'N/A' }}
                                            </h6>
                                            <span
                                                class="fs-3 text-muted">{{ $order->shippingAddress->email ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h6 class="fs-4 fw-normal mb-0">{{ $order->product->name ?? 'Unknown item' }}</h6>
                                    <span class="fs-3 text-muted">₦{{ number_format($order->total, 2) }}</span>
                                </td>
                                <td>
                                    @if ($order->payment_status === 'successful')
                                        <span class="badge bg-success-subtle text-success fw-semibold fs-2">Paid</span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning fw-semibold fs-2">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <p class="mb-0 fw-normal fs-3">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                                </td>
                                <td class="d-flex gap-2">
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                        class="btn btn-sm btn-outline-info">
                                        <i class="ti ti-eye"></i> View
                                    </a>
                                    <form action="{{ route('admin.orders.delete', $order->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="ti ti-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">No orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
