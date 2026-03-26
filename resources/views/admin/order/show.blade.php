@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card w-100 position-relative overflow-hidden mb-4">
                <div class="px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
                    <h4 class="card-title mb-0">Order #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }} details</h4>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                        <i class="ti ti-arrow-left me-1"></i> Back to Orders
                    </a>
                </div>
                <div class="card-body p-4">

                    <div class="row">
                        <!-- Shipping Info -->
                        <div class="col-md-6 mb-4">
                            <div class="p-4 bg-light rounded shadow-sm h-100">
                                <h5 class="fw-bold mb-3 border-bottom pb-2"><i
                                        class="ti ti-map-pin me-2 text-primary"></i>Shipping Information</h5>
                                @if ($order->shippingAddress)
                                    <p class="mb-1"><span class="text-muted w-25 d-inline-block">Name:</span> <span
                                            class="fw-semibold">{{ $order->shippingAddress->name }}</span></p>
                                    <p class="mb-1"><span class="text-muted w-25 d-inline-block">Email:</span> <a
                                            href="mailto:{{ $order->shippingAddress->email }}">{{ $order->shippingAddress->email }}</a>
                                    </p>
                                    <p class="mb-1"><span class="text-muted w-25 d-inline-block">Phone:</span>
                                        {{ $order->shippingAddress->phone }}</p>
                                    <p class="mb-1"><span class="text-muted w-25 d-inline-block">Address:</span>
                                        {{ $order->shippingAddress->address }}</p>
                                    <p class="mb-1"><span class="text-muted w-25 d-inline-block">City:</span>
                                        {{ $order->shippingAddress->city }}, {{ $order->shippingAddress->state }}</p>
                                    <p class="mb-0"><span class="text-muted w-25 d-inline-block">Country:</span>
                                        {{ $order->shippingAddress->country }}
                                        {{ $order->shippingAddress->zip ? '(' . $order->shippingAddress->zip . ')' : '' }}</p>
                                @else
                                    <span class="text-muted">No shipping data attached.</span>
                                @endif
                            </div>
                        </div>

                        <!-- Payment Info -->
                        <div class="col-md-6 mb-4">
                            <div class="p-4 bg-light rounded shadow-sm h-100">
                                <h5 class="fw-bold mb-3 border-bottom pb-2"><i
                                        class="ti ti-credit-card me-2 text-success"></i>Payment Details</h5>
                                <p class="mb-1"><span class="text-muted w-25 d-inline-block">Status:</span>
                                    @if ($order->payment_status === 'successful')
                                        <span class="badge bg-success-subtle text-success">Successful</span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning">Pending</span>
                                    @endif
                                </p>
                                <p class="mb-1"><span class="text-muted w-25 d-inline-block">Transaction:</span> <code
                                        class="text-dark">{{ $order->transaction_id ?? 'N/A' }}</code></p>
                                <p class="mb-1"><span class="text-muted w-25 d-inline-block">Amount:</span> <span
                                        class="fw-bold fs-4 text-indigo">₦{{ number_format($order->total, 2) }}</span></p>
                                <p class="mb-0"><span class="text-muted w-25 d-inline-block">Date:</span>
                                    {{ $order->created_at->format('F d, Y - h:i A') }}</p>
                            </div>
                        </div>

                        <!-- Product Item Detail -->
                        <div class="col-12 mt-2">
                            <div class="table-responsive border rounded">
                                <table class="table mb-0 align-middle">
                                    <thead class="bg-primary-subtle text-primary">
                                        <tr>
                                            <th>Item Purchased</th>
                                            <th>Color/Variant</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th class="text-end">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if ($order->product && $order->product->image)
                                                        <img src="{{ asset($order->product->image) }}" width="60"
                                                            class="rounded me-3 shadow-sm" alt="Product">
                                                    @else
                                                        <div class="bg-gray-200 rounded me-3"
                                                            style="width: 60px; height: 60px;"></div>
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-0 fw-semibold">
                                                            {{ $order->product->name ?? 'Unknown item' }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($order->color)
                                                    <span class="badge bg-secondary">{{ ucfirst($order->color) }}</span>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>₦{{ number_format($order->price, 2) }}</td>
                                            <td>{{ $order->quantity }}</td>
                                            <td class="text-end fw-bold">₦{{ number_format($order->total, 2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
