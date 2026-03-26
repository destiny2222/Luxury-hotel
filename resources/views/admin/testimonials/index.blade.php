@extends('layouts.admin')
@section('title', 'Testimonials')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <h2 style="font-size: 1.5rem;">Testimonials</h2>
    <a href="{{ route('admin.testimonials.create') }}" class="btn-admin btn-admin-primary"><i class="fas fa-plus"></i> Add Testimonial</a>
</div>

<div class="admin-table-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Guest</th>
                <th>Location</th>
                <th>Content</th>
                <th>Rating</th>
                <th>Featured</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($testimonials as $t)
            <tr>
                <td><strong>{{ $t->guest_name }}</strong></td>
                <td>{{ $t->guest_location ?? 'N/A' }}</td>
                <td style="max-width: 300px;">{{ Str::limit($t->content, 80) }}</td>
                <td>
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star" style="color: {{ $i <= $t->rating ? '#f59e0b' : '#334155' }}; font-size: 0.75rem;"></i>
                    @endfor
                </td>
                <td>{{ $t->is_featured ? '⭐' : '—' }}</td>
                <td><span class="badge-status badge-{{ $t->status }}">{{ $t->status }}</span></td>
                <td style="display: flex; gap: 0.5rem;">
                    <form method="POST" action="{{ route('admin.testimonials.update', $t) }}" style="display: flex; gap: 0.25rem;">
                        @csrf @method('PUT')
                        <select name="status" style="padding: 0.3rem; background: var(--admin-bg); border: 1px solid var(--admin-border); border-radius: 4px; color: var(--admin-text); font-size: 0.75rem;">
                            @foreach(['pending','approved','rejected'] as $s)
                                <option value="{{ $s }}" {{ $t->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                        <label style="display: flex; align-items: center; gap: 0.25rem; font-size: 0.75rem; cursor: pointer;">
                            <input type="checkbox" name="is_featured" value="1" {{ $t->is_featured ? 'checked' : '' }}> ⭐
                        </label>
                        <button class="btn-admin btn-admin-primary btn-admin-sm" type="submit"><i class="fas fa-check"></i></button>
                    </form>
                    @if(auth()->user()->canDelete())
                    <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button class="btn-admin btn-admin-danger btn-admin-sm"><i class="fas fa-trash"></i></button>
                    </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align: center; padding: 2rem; color: var(--admin-muted);">No testimonials.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="admin-pagination">{{ $testimonials->links('pagination::simple-bootstrap-5') }}</div>
</div>
@endsection
