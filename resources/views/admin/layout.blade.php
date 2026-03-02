<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — ProofPerfect</title>
    <style>
        :root {
            --ink: #1a1208; --cream: #faf6ee; --gold: #c9952a;
            --rust: #b84c2a; --paper: #f2ead8; --sidebar: #181410;
            --pending: #d97706; --review: #2563eb; --done: #16a34a; --red: #dc2626;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: system-ui, -apple-system, sans-serif; background: #f5f0e8; color: var(--ink); display: flex; min-height: 100vh; }

        /* SIDEBAR */
        .sidebar { width: 240px; background: var(--sidebar); color: #d0c8b8; display: flex; flex-direction: column; position: fixed; top: 0; left: 0; bottom: 0; }
        .sidebar-logo { padding: 1.6rem 1.4rem 1.2rem; border-bottom: 1px solid rgba(255,255,255,0.08); }
        .sidebar-logo h1 { font-size: 1.25rem; font-weight: 700; color: white; }
        .sidebar-logo h1 span { color: var(--gold); }
        .sidebar-logo p { font-size: 0.7rem; color: #666; margin-top: 0.2rem; text-transform: uppercase; letter-spacing: 0.05em; }
        .sidebar nav { flex: 1; padding: 1rem 0; }
        .nav-section { padding: 0.5rem 1.2rem 0.3rem; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.12em; color: #555; margin-top: 0.5rem; }
        .nav-link { display: flex; align-items: center; gap: 0.7rem; padding: 0.65rem 1.4rem; text-decoration: none; color: #b0a898; font-size: 0.88rem; transition: all 0.15s; border-left: 3px solid transparent; }
        .nav-link:hover, .nav-link.active { color: white; background: rgba(255,255,255,0.06); border-left-color: var(--gold); }
        .nav-link .icon { font-size: 1rem; width: 18px; text-align: center; }
        .sidebar-footer { padding: 1rem 1.4rem; border-top: 1px solid rgba(255,255,255,0.08); font-size: 0.78rem; color: #666; }
        .sidebar-footer p { margin-bottom: 0.5rem; }

        /* MAIN */
        .main { margin-left: 240px; flex: 1; display: flex; flex-direction: column; }
        .topbar { background: white; border-bottom: 1px solid #e8e0d0; padding: 1rem 2rem; display: flex; align-items: center; justify-content: space-between; }
        .topbar h2 { font-size: 1.1rem; font-weight: 600; }
        .topbar-user { display: flex; align-items: center; gap: 0.8rem; font-size: 0.85rem; color: #666; }
        .avatar { width: 34px; height: 34px; border-radius: 50%; background: linear-gradient(135deg, var(--gold), var(--rust)); display: flex; align-items: center; justify-content: center; font-size: 0.85rem; font-weight: 700; color: white; }
        .content { padding: 2rem; flex: 1; }

        /* STAT CARDS */
        .stat-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 1.2rem; margin-bottom: 2rem; }
        .stat-card { background: white; border: 1px solid #e8e0d0; border-radius: 8px; padding: 1.4rem 1.6rem; position: relative; overflow: hidden; }
        .stat-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; }
        .stat-card.gold::before   { background: var(--gold); }
        .stat-card.orange::before { background: var(--pending); }
        .stat-card.blue::before   { background: var(--review); }
        .stat-card.green::before  { background: var(--done); }
        .stat-card.rust::before   { background: var(--rust); }
        .stat-label { font-size: 0.73rem; color: #999; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.5rem; }
        .stat-value { font-size: 2.4rem; font-weight: 700; color: var(--ink); line-height: 1; }
        .stat-icon  { position: absolute; top: 1rem; right: 1.2rem; font-size: 1.6rem; opacity: 0.12; }

        /* TABLE */
        .table-wrap { background: white; border: 1px solid #e8e0d0; border-radius: 8px; overflow: hidden; }
        .table-header { padding: 1rem 1.4rem; border-bottom: 1px solid #f0e8d8; display: flex; align-items: center; justify-content: space-between; }
        .table-header h3 { font-size: 0.95rem; font-weight: 600; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #faf6ee; text-align: left; padding: 0.7rem 1.2rem; font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.06em; color: #888; border-bottom: 1px solid #ede5d5; }
        td { padding: 0.85rem 1.2rem; font-size: 0.88rem; border-bottom: 1px solid #f5f0e8; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #fdfaf5; }

        /* BADGES */
        .badge { display: inline-block; padding: 0.2rem 0.65rem; border-radius: 20px; font-size: 0.72rem; font-weight: 500; }
        .badge-pending { background: #fef3c7; color: #92400e; }
        .badge-review  { background: #dbeafe; color: #1e40af; }
        .badge-done    { background: #dcfce7; color: #166534; }

        /* BUTTONS */
        .btn { display: inline-block; padding: 0.55rem 1.1rem; font-size: 0.82rem; font-weight: 500; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; transition: all 0.15s; font-family: inherit; }
        .btn-sm { padding: 0.35rem 0.8rem; font-size: 0.78rem; }
        .btn-primary { background: var(--ink); color: white; }
        .btn-primary:hover { background: var(--gold); }
        .btn-gold { background: var(--gold); color: white; }
        .btn-gold:hover { background: #a87820; }
        .btn-danger { background: var(--red); color: white; }
        .btn-danger:hover { background: #b91c1c; }
        .btn-ghost { background: transparent; color: #666; border: 1px solid #ddd; }
        .btn-ghost:hover { border-color: var(--gold); color: var(--gold); }

        /* ALERT */
        .alert-success { background: #dcfce7; color: #166534; padding: 0.8rem 1.2rem; border-radius: 6px; margin-bottom: 1.5rem; font-size: 0.88rem; border: 1px solid #bbf7d0; }

        /* FORM */
        .form-row { display: flex; gap: 1rem; flex-wrap: wrap; align-items: flex-end; margin-bottom: 1.5rem; }
        .form-group { display: flex; flex-direction: column; gap: 0.35rem; }
        .form-group label { font-size: 0.75rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; color: #666; }
        .form-group select,
        .form-group input,
        .form-group textarea { border: 1.5px solid #e0d8c8; background: white; padding: 0.6rem 0.9rem; font-size: 0.88rem; font-family: inherit; color: var(--ink); border-radius: 4px; outline: none; transition: border-color 0.15s; }
        .form-group select:focus,
        .form-group input:focus,
        .form-group textarea:focus { border-color: var(--gold); }
        .form-group textarea { min-height: 140px; resize: vertical; }

        /* DETAIL */
        .detail-card { background: white; border: 1px solid #e8e0d0; border-radius: 8px; overflow: hidden; margin-bottom: 1.5rem; }
        .detail-card-header { background: #faf6ee; padding: 0.9rem 1.4rem; border-bottom: 1px solid #e8e0d0; font-size: 0.78rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; color: #888; }
        .detail-card-body { padding: 1.4rem; }
        .detail-row { display: grid; grid-template-columns: 170px 1fr; gap: 0.5rem; padding: 0.7rem 0; border-bottom: 1px solid #f5f0e8; font-size: 0.88rem; }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { color: #999; font-weight: 500; }
        .detail-value { color: var(--ink); word-break: break-all; }
        .detail-value a { color: var(--review); }
        .detail-notes { background: #faf6ee; border-left: 3px solid var(--gold); padding: 1rem; font-size: 0.88rem; line-height: 1.7; color: #555; white-space: pre-wrap; border-radius: 0 4px 4px 0; }

        /* CHARTS */
        .charts-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem; margin-bottom: 2rem; }
        .chart-card { background: white; border: 1px solid #e8e0d0; border-radius: 8px; padding: 1.4rem; }
        .chart-card h3 { font-size: 0.9rem; font-weight: 600; margin-bottom: 1.2rem; }
        .bar-list { display: flex; flex-direction: column; gap: 1rem; }
        .bar-item {}
        .bar-item label { display: flex; justify-content: space-between; font-size: 0.8rem; color: #555; margin-bottom: 0.3rem; }
        .bar-track { height: 8px; background: #f0e8d8; border-radius: 4px; overflow: hidden; }
        .bar-fill { height: 100%; background: linear-gradient(90deg, var(--gold), var(--rust)); border-radius: 4px; }
        .month-chart { display: flex; align-items: flex-end; gap: 0.5rem; height: 100px; padding-top: 0.5rem; }
        .month-col { flex: 1; display: flex; flex-direction: column; align-items: center; gap: 0.3rem; height: 100%; justify-content: flex-end; }
        .month-bar { width: 100%; background: linear-gradient(180deg, var(--gold), var(--rust)); border-radius: 3px 3px 0 0; min-height: 3px; }
        .month-label { font-size: 0.62rem; color: #aaa; }
        .month-val { font-size: 0.7rem; color: #666; font-weight: 600; }

        /* PAGE TITLE row */
        .page-actions { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; }
        .page-actions h2 { font-size: 1.2rem; font-weight: 700; }

        @media (max-width: 900px) { .charts-row { grid-template-columns: 1fr; } }
        @media (max-width: 700px) { .sidebar { display: none; } .main { margin-left: 0; } }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-logo">
        <h1>Proof<span>Perfect</span></h1>
        <p>Admin Panel</p>
    </div>
    <nav>
        <div class="nav-section">Overview</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="icon">📊</span> Dashboard
        </a>
        <div class="nav-section">Submissions</div>
        <a href="{{ route('admin.submissions.index') }}" class="nav-link {{ request()->routeIs('admin.submissions.index') && !request('status') ? 'active' : '' }}">
            <span class="icon">📋</span> All Submissions
        </a>
        <a href="{{ route('admin.submissions.index', ['status' => 'pending']) }}" class="nav-link {{ request('status') === 'pending' ? 'active' : '' }}">
            <span class="icon">⏳</span> Pending
        </a>
        <a href="{{ route('admin.submissions.index', ['status' => 'in_review']) }}" class="nav-link {{ request('status') === 'in_review' ? 'active' : '' }}">
            <span class="icon">🔍</span> In Review
        </a>
        <a href="{{ route('admin.submissions.index', ['status' => 'completed']) }}" class="nav-link {{ request('status') === 'completed' ? 'active' : '' }}">
            <span class="icon">✅</span> Completed
        </a>
    </nav>
    <div class="sidebar-footer">
        <p>Logged in as <strong style="color:#ccc;">Ujah John</strong></p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="background:none;border:none;cursor:pointer;color:#888;font-size:0.78rem;padding:0;font-family:inherit;">→ Log out</button>
        </form>
    </div>
</aside>

<div class="main">
    <div class="topbar">
        <h2>@yield('page-title', 'Dashboard')</h2>
        <div class="topbar-user">
            <div class="avatar">U</div>
            <span>Ujah John</span>
        </div>
    </div>
    <div class="content">
        @if(session('success'))
            <div class="alert-success">✓ {{ session('success') }}</div>
        @endif
        @yield('content')
    </div>
</div>

</body>
</html>
