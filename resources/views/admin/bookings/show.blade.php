@extends('layouts.admin')
@section('title', 'Booking Details')

@section('content')
<div style="margin-bottom: 1.5rem;">
    <a href="{{ route('admin.bookings.index') }}" class="btn-admin btn-admin-outline btn-admin-sm"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">
    <!-- Booking Info -->
    <div class="admin-form-card">
        <h3 style="margin-bottom: 1.5rem;">Booking #{{ $booking->booking_reference }}</h3>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
            <div>
                <label style="color: var(--admin-muted); font-size: 0.8rem; text-transform: uppercase;">Guest Name</label>
                <p style="font-weight: 600;">{{ $booking->guest_info['name'] ?? 'N/A' }}</p>
            </div>
            <div>
                <label style="color: var(--admin-muted); font-size: 0.8rem; text-transform: uppercase;">Email</label>
                <p>{{ $booking->guest_info['email'] ?? 'N/A' }}</p>
            </div>
            <div>
                <label style="color: var(--admin-muted); font-size: 0.8rem; text-transform: uppercase;">Phone</label>
                <p>{{ $booking->guest_info['phone'] ?? 'N/A' }}</p>
            </div>
            <div>
                <label style="color: var(--admin-muted); font-size: 0.8rem; text-transform: uppercase;">Room</label>
                <p style="font-weight: 600;">{{ $booking->room->name ?? 'N/A' }}</p>
            </div>
            <div>
                <label style="color: var(--admin-muted); font-size: 0.8rem; text-transform: uppercase;">Check In</label>
                <p>{{ $booking->check_in->format('M d, Y') }}</p>
            </div>
            <div>
                <label style="color: var(--admin-muted); font-size: 0.8rem; text-transform: uppercase;">Check Out</label>
                <p>{{ $booking->check_out->format('M d, Y') }}</p>
            </div>
            <div>
                <label style="color: var(--admin-muted); font-size: 0.8rem; text-transform: uppercase;">Rooms × Nights</label>
                <p>{{ $booking->rooms_count }} × {{ $booking->nights }} = {{ $booking->room_days }} room-days</p>
            </div>
            <div>
                <label style="color: var(--admin-muted); font-size: 0.8rem; text-transform: uppercase;">Payment Method</label>
                <p style="text-transform: capitalize;">{{ str_replace('_', ' ', $booking->payment_method) }}</p>
            </div>
        </div>

        <!-- Pricing -->
        <div style="background: var(--admin-bg); padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                <span style="color: var(--admin-muted);">Subtotal</span>
                <span>₦{{ number_format($booking->subtotal, 2) }}</span>
            </div>
            @if($booking->discount_percent > 0)
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; color: var(--admin-success);">
                <span>Discount ({{ $booking->discount_percent }}%)</span>
                <span>-₦{{ number_format($booking->discount_amount, 2) }}</span>
            </div>
            @endif
            <div style="display: flex; justify-content: space-between; font-weight: 700; font-size: 1.1rem; border-top: 1px solid var(--admin-border); padding-top: 0.75rem; margin-top: 0.5rem;">
                <span>Total</span>
                <span>₦{{ number_format($booking->total_price, 2) }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-top: 0.5rem;">
                <span style="color: var(--admin-muted);">Paid</span>
                <span style="color: var(--admin-success);">₦{{ number_format($booking->paid_amount, 2) }}</span>
            </div>
        </div>

        <!-- Edit Requests History -->
        @if($booking->editRequests->count() > 0)
        <h4 style="margin-bottom: 1rem;">Edit Request History</h4>
        <div class="admin-table-card" style="margin-bottom: 0;">
            <table class="admin-table">
                <thead>
                    <tr><th>Field</th><th>Old</th><th>New</th><th>By</th><th>Status</th></tr>
                </thead>
                <tbody>
                    @foreach($booking->editRequests as $er)
                    <tr>
                        <td>{{ $er->field_name }}</td>
                        <td>{{ $er->old_value }}</td>
                        <td>{{ $er->new_value }}</td>
                        <td>{{ $er->requestedBy->name ?? 'N/A' }}</td>
                        <td><span class="badge-status badge-{{ $er->status }}">{{ $er->status }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    <!-- Update Form -->
    <div>
        <div class="admin-form-card">
            <h3 style="margin-bottom: 1.5rem;">Update Booking</h3>
            <form method="POST" action="{{ route('admin.bookings.update', $booking) }}">
                @csrf @method('PATCH')
                <div class="admin-form-group">
                    <label>Status</label>
                    <select name="status">
                        @foreach(['pending','confirmed','checked_in','checked_out','cancelled'] as $s)
                            <option value="{{ $s }}" {{ $booking->status === $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $s)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="admin-form-group">
                    <label>Payment Status</label>
                    <select name="payment_status">
                        @foreach(['pending','partial','paid'] as $ps)
                            <option value="{{ $ps }}" {{ $booking->payment_status === $ps ? 'selected' : '' }}>{{ ucfirst($ps) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="admin-form-group">
                    <label>Paid Amount (₦)</label>
                    <input type="number" name="paid_amount" value="{{ $booking->paid_amount }}" step="0.01" min="0">
                </div>
                <div class="admin-form-group">
                    <label>Check In</label>
                    <input type="date" name="check_in" value="{{ $booking->check_in->format('Y-m-d') }}">
                </div>
                <div class="admin-form-group">
                    <label>Check Out</label>
                    <input type="date" name="check_out" value="{{ $booking->check_out->format('Y-m-d') }}">
                </div>
                @if(auth()->user()->isFrontDesk())
                <div class="admin-form-group">
                    <label>Reason for Edit</label>
                    <textarea name="reason" rows="2" placeholder="Why are you making this change?"></textarea>
                </div>
                <p style="font-size: 0.8rem; color: var(--admin-warning); margin-bottom: 1rem;">
                    <i class="fas fa-exclamation-triangle"></i> Sensitive field changes will require supervisor approval.
                </p>
                @endif
                <button type="submit" class="btn-admin btn-admin-primary" style="width: 100%;"><i class="fas fa-save"></i> Update</button>
            </form>
        </div>

        @if(auth()->user()->canDelete())
        <form method="POST" action="{{ route('admin.bookings.destroy', $booking) }}" style="margin-top: 1rem;" onsubmit="return confirm('Delete this booking permanently?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn-admin btn-admin-danger" style="width: 100%;"><i class="fas fa-trash"></i> Delete Booking</button>
        </form>
        @endif
    </div>
</div>
@endsection
