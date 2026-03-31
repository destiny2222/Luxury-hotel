<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - Kings woods Hotel and Suites</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --admin-bg: #0f172a;
            --admin-sidebar: #1e293b;
            --admin-card: #1e293b;
            --admin-border: #334155;
            --admin-text: #e2e8f0;
            --admin-muted: #94a3b8;
            --admin-primary: #A3815D;
            --admin-success: #22c55e;
            --admin-warning: #f59e0b;
            --admin-danger: #ef4444;
            --admin-info: #3b82f6;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--admin-bg);
            color: var(--admin-text);
            display: flex;
            min-height: 100vh;
        }
        /* Sidebar */
        .admin-sidebar {
            width: 280px;
            background: var(--admin-sidebar);
            border-right: 1px solid var(--admin-border);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 100;
            transition: transform 0.3s;
        }
        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--admin-border);
            text-align: center;
        }
        .sidebar-header h2 {
            font-size: 1.3rem;
            color: var(--admin-primary);
            letter-spacing: 2px;
        }
        .sidebar-header small {
            color: var(--admin-muted);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .sidebar-nav { padding: 1rem 0; }
        .nav-section {
            padding: 0.5rem 1.5rem;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--admin-muted);
            margin-top: 1rem;
        }
        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1.5rem;
            color: var(--admin-muted);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }
        .nav-link:hover, .nav-link.active {
            color: #fff;
            background: rgba(163, 129, 93, 0.1);
            border-left-color: var(--admin-primary);
        }
        .nav-link i { width: 20px; text-align: center; }
        .nav-link .badge {
            margin-left: auto;
            background: var(--admin-danger);
            color: #fff;
            font-size: 0.7rem;
            padding: 0.15rem 0.5rem;
            border-radius: 10px;
            font-weight: 600;
        }
        /* Main */
        .admin-main {
            margin-left: 280px;
            flex: 1;
            min-height: 100vh;
        }
        .admin-topbar {
            background: var(--admin-sidebar);
            border-bottom: 1px solid var(--admin-border);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .topbar-left h1 {
            font-size: 1.3rem;
            font-weight: 600;
        }
        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .topbar-right .user-info {
            text-align: right;
        }
        .topbar-right .user-info .name {
            font-weight: 600;
            font-size: 0.9rem;
        }
        .topbar-right .user-info .role {
            font-size: 0.75rem;
            color: var(--admin-primary);
            text-transform: uppercase;
        }
        .admin-content { padding: 2rem; }

        /* Cards */
        .stat-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            background: var(--admin-card);
            border: 1px solid var(--admin-border);
            border-radius: 12px;
            padding: 1.5rem;
            transition: transform 0.2s;
        }
        .stat-card:hover { transform: translateY(-2px); }
        .stat-card .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }
        .stat-card .stat-value {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }
        .stat-card .stat-label {
            color: var(--admin-muted);
            font-size: 0.85rem;
        }
        /* Tables */
        .admin-table-card {
            background: var(--admin-card);
            border: 1px solid var(--admin-border);
            border-radius: 12px;
            overflow: hidden;
        }
        .admin-table-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--admin-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .admin-table-header h3 {
            font-size: 1.1rem;
            font-weight: 600;
        }
        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }
        .admin-table th {
            text-align: left;
            padding: 0.75rem 1.5rem;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--admin-muted);
            border-bottom: 1px solid var(--admin-border);
            font-weight: 600;
        }
        .admin-table td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--admin-border);
            font-size: 0.9rem;
        }
        .admin-table tr:last-child td { border-bottom: none; }
        .admin-table tr:hover { background: rgba(255,255,255,0.02); }
        /* Badges */
        .badge-status {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: capitalize;
        }
        .badge-pending { background: rgba(245,158,11,0.15); color: var(--admin-warning); }
        .badge-confirmed, .badge-approved, .badge-paid { background: rgba(34,197,94,0.15); color: var(--admin-success); }
        .badge-cancelled, .badge-rejected { background: rgba(239,68,68,0.15); color: var(--admin-danger); }
        .badge-checked_in, .badge-partial { background: rgba(59,130,246,0.15); color: var(--admin-info); }
        .badge-checked_out { background: rgba(148,163,184,0.15); color: var(--admin-muted); }
        .badge-available { background: rgba(34,197,94,0.15); color: var(--admin-success); }
        .badge-maintenance { background: rgba(245,158,11,0.15); color: var(--admin-warning); }
        .badge-unread { background: rgba(59,130,246,0.15); color: var(--admin-info); }
        .badge-read { background: rgba(148,163,184,0.15); color: var(--admin-muted); }

        /* Buttons */
        .btn-admin {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-admin-primary { background: var(--admin-primary); color: #fff; }
        .btn-admin-primary:hover { background: #8c6e4d; }
        .btn-admin-success { background: var(--admin-success); color: #fff; }
        .btn-admin-danger { background: var(--admin-danger); color: #fff; }
        .btn-admin-danger:hover { background: #dc2626; }
        .btn-admin-sm {
            padding: 0.35rem 0.75rem;
            font-size: 0.8rem;
        }
        .btn-admin-outline {
            background: transparent;
            border: 1px solid var(--admin-border);
            color: var(--admin-text);
        }
        .btn-admin-outline:hover {
            border-color: var(--admin-primary);
            color: var(--admin-primary);
        }
        /* Forms */
        .admin-form-card {
            background: var(--admin-card);
            border: 1px solid var(--admin-border);
            border-radius: 12px;
            padding: 2rem;
        }
        .admin-form-group { margin-bottom: 1.5rem; }
        .admin-form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--admin-muted);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .admin-form-group input,
        .admin-form-group select,
        .admin-form-group textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            background: var(--admin-bg);
            border: 1px solid var(--admin-border);
            border-radius: 8px;
            color: var(--admin-text);
            font-family: inherit;
            font-size: 0.9rem;
            transition: border-color 0.2s;
        }
        .admin-form-group input:focus,
        .admin-form-group select:focus,
        .admin-form-group textarea:focus {
            outline: none;
            border-color: var(--admin-primary);
        }
        .admin-form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }
        /* Alert */
        .admin-alert {
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .admin-alert-success { background: rgba(34,197,94,0.1); color: var(--admin-success); border: 1px solid rgba(34,197,94,0.2); }
        .admin-alert-info { background: rgba(59,130,246,0.1); color: var(--admin-info); border: 1px solid rgba(59,130,246,0.2); }
        .admin-alert-danger { background: rgba(239,68,68,0.1); color: var(--admin-danger); border: 1px solid rgba(239,68,68,0.2); }
        /* Pagination */
        .admin-pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            padding: 1.5rem;
        }
        .admin-pagination a, .admin-pagination span {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.2s;
        }
        .admin-pagination a { background: var(--admin-bg); color: var(--admin-text); border: 1px solid var(--admin-border); }
        .admin-pagination a:hover { border-color: var(--admin-primary); color: var(--admin-primary); }
        .admin-pagination .active span { background: var(--admin-primary); color: #fff; }

        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--admin-text);
            font-size: 1.5rem;
            cursor: pointer;
        }
        @media (max-width: 1024px) {
            .admin-sidebar { transform: translateX(-100%); }
            .admin-sidebar.open { transform: translateX(0); }
            .admin-main { margin-left: 0; }
            .mobile-toggle { display: block; }
            .admin-form-row { grid-template-columns: 1fr; }
            .stat-cards { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 640px) {
            .stat-cards { grid-template-columns: 1fr; }
            .admin-content { padding: 1rem; }
            .admin-table { font-size: 0.8rem; }
            .admin-table th, .admin-table td { padding: 0.6rem 1rem; }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="admin-sidebar" id="sidebar">
        <div class="sidebar-header">
            <h2>KINGS WOODS</h2>
            <small>Admin Dashboard</small>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-section">Main</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i> Dashboard
            </a>

            <div class="nav-section">Management</div>
            <a href="{{ route('admin.rooms.index') }}" class="nav-link {{ request()->routeIs('admin.rooms.*') ? 'active' : '' }}">
                <i class="fas fa-bed"></i> Rooms
            </a>
            <a href="{{ route('admin.bookings.index') }}" class="nav-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i> Bookings
            </a>
            <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                <i class="fas fa-star"></i> Testimonials
            </a>
            <a href="{{ route('admin.posts.index') }}" class="nav-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                <i class="fas fa-blog"></i> Posts
            </a>
            <a href="{{ route('admin.contacts.index') }}" class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                <i class="fas fa-envelope"></i> Messages
                @php $unreadCount = \App\Models\ContactMessage::where('status', 'unread')->count(); @endphp
                @if($unreadCount > 0)
                    <span class="badge">{{ $unreadCount }}</span>
                @endif
            </a>

            @if(auth()->user()->canApproveEdits())
            <div class="nav-section">Approvals</div>
            <a href="{{ route('admin.edit-requests.index') }}" class="nav-link {{ request()->routeIs('admin.edit-requests.*') ? 'active' : '' }}">
                <i class="fas fa-clipboard-check"></i> Edit Requests
                @php $pendingEdits = \App\Models\BookingEditRequest::where('status', 'pending')->count(); @endphp
                @if($pendingEdits > 0)
                    <span class="badge">{{ $pendingEdits }}</span>
                @endif
            </a>
            @endif

            @if(auth()->user()->isSuperAdmin())
            <div class="nav-section">System</div>
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="fas fa-users-cog"></i> Users
            </a>
            @endif

            <div class="nav-section">Account</div>
            <a href="{{ route('home') }}" class="nav-link">
                <i class="fas fa-globe"></i> View Site
            </a>
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="nav-link" style="width: 100%; text-align: left; background: none; border: none; cursor: pointer; font-family: inherit; font-size: inherit; color: inherit;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="admin-main">
        <div class="admin-topbar">
            <div class="topbar-left" style="display: flex; align-items: center; gap: 1rem;">
                <button class="mobile-toggle" onclick="document.getElementById('sidebar').classList.toggle('open')">
                    <i class="fas fa-bars"></i>
                </button>
                <h1>@yield('title', 'Dashboard')</h1>
            </div>
            <div class="topbar-right">
                <div class="user-info">
                    <div class="name">{{ auth()->user()->name }}</div>
                    <div class="role">{{ str_replace('_', ' ', auth()->user()->role) }}</div>
                </div>
            </div>
        </div>

        <div class="admin-content">
            @if(session('success'))
                <div class="admin-alert admin-alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif
            @if(session('info'))
                <div class="admin-alert admin-alert-info">
                    <i class="fas fa-info-circle"></i> {{ session('info') }}
                </div>
            @endif
            @if(session('error'))
                <div class="admin-alert admin-alert-danger">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    @yield('scripts')
</body>
</html>
