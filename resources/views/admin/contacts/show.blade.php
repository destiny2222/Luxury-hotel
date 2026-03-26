@extends('layouts.admin')
@section('title', 'Message Details')

@section('content')
<div style="margin-bottom: 1.5rem;">
    <a href="{{ route('admin.contacts.index') }}" class="btn-admin btn-admin-outline btn-admin-sm"><i class="fas fa-arrow-left"></i> Back</a>
</div>
<div class="admin-form-card" style="max-width: 700px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h3>{{ $contact->subject }}</h3>
        <span class="badge-status badge-{{ $contact->status }}">{{ $contact->status }}</span>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 2rem;">
        <div>
            <label style="color: var(--admin-muted); font-size: 0.8rem;">NAME</label>
            <p style="font-weight: 600;">{{ $contact->name }}</p>
        </div>
        <div>
            <label style="color: var(--admin-muted); font-size: 0.8rem;">EMAIL</label>
            <p><a href="mailto:{{ $contact->email }}" style="color: var(--admin-primary);">{{ $contact->email }}</a></p>
        </div>
        <div>
            <label style="color: var(--admin-muted); font-size: 0.8rem;">PHONE</label>
            <p>{{ $contact->phone ?? 'Not provided' }}</p>
        </div>
        <div>
            <label style="color: var(--admin-muted); font-size: 0.8rem;">DATE</label>
            <p>{{ $contact->created_at->format('M d, Y h:i A') }}</p>
        </div>
    </div>

    <div style="background: var(--admin-bg); padding: 1.5rem; border-radius: 8px;">
        <label style="color: var(--admin-muted); font-size: 0.8rem; margin-bottom: 0.5rem; display: block;">MESSAGE</label>
        <p style="line-height: 1.8; white-space: pre-line;">{{ $contact->message }}</p>
    </div>
</div>
@endsection
