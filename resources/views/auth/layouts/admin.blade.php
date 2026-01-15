<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Site</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-dark: #1a1c2e;
            --bg-card: #252841;
            --sidebar-color: #2e325a;
            --text-main: #ffffff;
            --text-dim: #a0a0c0;
            --pink: #ff4d8d;
            --blue: #4d7cff;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: var(--bg-dark);
            color: white;
            display: flex;
            min-height: 100vh;
            width: 100vw;
            overflow-x: hidden;
        }

        /* ========== SIDEBAR ========== */
        #sidebar {
            width: 260px;
            background: var(--sidebar-color);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            transition: width 0.3s ease;
            overflow: hidden;
        }

        #sidebar.collapsed {
            width: 0;
            opacity: 0;
        }

        .sidebar-content {
            width: 260px;
            padding: 15px;
            box-sizing: border-box;
        }

        /* === ADMIN SITE TITLE === */
        .sidebar-title {
            background: linear-gradient(90deg, #2f335c, #3a3f70);
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 30px;
            color: white;
        }

        .nav-item {
            display: block;
            padding: 12px;
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 8px;
            margin-bottom: 15px;
            text-decoration: none;
            color: white;
            text-align: center;
            font-size: 0.9rem;
            transition: 0.3s;
        }

        .nav-item:hover,
        .nav-item.active {
            background: rgba(255,255,255,0.1);
            border-color: white;
        }

        /* ========== MAIN CONTENT ========== */
        .main-content {
            flex-grow: 1;
            padding: 30px;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .hamburger {
            font-size: 24px;
            cursor: pointer;
            user-select: none;
        }

        .search-bar-container {
            position: relative;
        }

        .search-bar {
            background: #252841;
            border: 1px solid #3e4266;
            padding: 8px 35px 8px 15px;
            border-radius: 20px;
            color: white;
            width: 220px;
            outline: none;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            background: #d9d9d9;
            border-radius: 50%;
        }

        /* === GLOBAL CHART SUPPORT === */
        .grid-reports {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .card {
            background: var(--bg-card);
            border-radius: 12px;
            padding: 20px;
        }

        .bar-container {
            display: flex;
            align-items: flex-end;
            justify-content: space-around;
            height: 120px;
            margin-top: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .bar {
            width: 10px;
            border-radius: 5px;
        }

        .bar.pink {
            background: var(--pink);
            box-shadow: 0 0 10px rgba(255,77,141,0.3);
        }

        .bar.blue {
            background: var(--blue);
            box-shadow: 0 0 10px rgba(77,124,255,0.3);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: var(--bg-card);
            padding: 20px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .line-chart-container {
            background: var(--bg-card);
            padding: 25px;
            border-radius: 15px;
            flex-grow: 1;
        }

        .label-row {
            display: flex;
            justify-content: space-between;
            font-size: 10px;
            color: var(--text-dim);
            margin-top: 10px;
        }

        @media (max-width: 1024px) {
            .grid-reports { grid-template-columns: 1fr; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
</head>
<body>

<div id="sidebar">
    <div class="sidebar-content">
        <div class="sidebar-title">
            Admin Site
        </div>

        <a href="/dashboard" class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">Dashboard</a>
        
        <a href="/jurnal" class="nav-item {{ Request::is('jurnal') ? 'active' : '' }}">Jurnal</a>
        
        <a href="/report" class="nav-item {{ Request::is('report') ? 'active' : '' }}">Report</a>
        
        <a href="/database-user" class="nav-item {{ Request::is('database-user') ? 'active' : '' }}">Database User</a>
        
        <a href="{{ route('update-data') }}" class="nav-item {{ Request::is('update-data') ? 'active' : '' }}">Update Data</a>
        <a href="{{ route('reset-password') }}" class="nav-item {{ Request::is('reset-password') ? 'active' : '' }}">Reset Password</a>
    </div>
</div>

<div class="main-content">
    @yield('content')
</div>
<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('collapsed');
    }
</script>

</body>
</html>
