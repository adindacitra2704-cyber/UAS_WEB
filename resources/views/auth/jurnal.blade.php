@extends('auth.layouts.admin')

@section('content')

<style>
    /* === 1. RESET & GLOBAL STYLE === */
    nav, .navbar, .header, .main-header, .app-header { display: none !important; }

    .custom-container {
        font-family: 'Poppins', sans-serif;
        color: #fff;
        padding-top: 10px;
    }

    /* === 2. HEADER CUSTOM === */
    .top-header {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 30px;
    }
    .brand-section { display: flex; align-items: center; gap: 12px; }
    .hamburger-custom { font-size: 26px; color: #fff; cursor: pointer; margin-right: 10px; }
    .brand-logo { width: 40px; height: auto; }
    .brand-text { font-size: 22px; font-weight: 700; color: #fff; letter-spacing: 0.5px; }

    /* Search Bar */
    .search-wrapper { position: relative; width: 350px; }
    .search-input {
        width: 100%; 
        background: #252a48; 
        border: 1px solid rgba(255,255,255,0.05); 
        border-radius: 12px; 
        padding: 12px 20px 12px 45px; 
        color: #a0aec0; 
        font-size: 14px; outline: none; transition: 0.3s;
    }
    .search-input:focus { border-color: #4d7cff; color: #fff; }
    .search-icon { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #6c7293; font-size: 16px; }

    /* Profile */
    .profile-section { display: flex; align-items: center; gap: 12px; }
    .profile-pic { width: 40px; height: 40px; background: #d9d9d9; border-radius: 50%; }
    .profile-text { font-size: 14px; color: #a0aec0; }
    .profile-name { color: #fff; font-weight: 600; }

    .page-title-center { text-align: center; font-size: 20px; font-weight: 600; margin-bottom: 25px; }

    /* === 3. FILTER & LAYOUT === */
    .filter-wrapper { display: flex; justify-content: flex-end; margin-bottom: 15px; }
    .custom-select {
        background: #252a48; color: #fff; border: none;
        padding: 10px 20px; border-radius: 8px; font-size: 14px; cursor: pointer; outline: none;
    }

    .main-grid {
        display: grid; grid-template-columns: 35% 63%; gap: 20px; min-height: 480px;
    }

    /* === 4. KARTU INFORMASI (KIRI) === */
    .daily-card-container { display: flex; flex-direction: column; gap: 15px; }
    
    .info-card {
        background: #2c3150; border-radius: 15px; padding: 15px 20px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.2); position: relative;
        display: flex; flex-direction: column; justify-content: center;
    }
    
    .card-date { text-align: center; font-size: 11px; color: #a0aec0; margin-bottom: 15px; }
    .card-row { display: flex; justify-content: space-between; align-items: center; width: 100%; }
    
    .stat-item { display: flex; align-items: center; gap: 8px; }
    .stat-icon { font-size: 20px; }
    .stat-text { display: flex; flex-direction: column; }
    .stat-label { font-size: 9px; color: #a0aec0; margin-bottom: 2px; }
    .stat-value { font-size: 11px; font-weight: 700; color: #fff; }

    /* === 5. CHART AREA (KANAN) === */
    .chart-box {
        background: #2c3150; border-radius: 15px; padding: 25px;
        position: relative; display: flex; flex-direction: column;
        min-height: 400px; /* Pastikan ada tinggi minimal */
    }
    
    .chart-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .chart-title { font-size: 18px; color: #a0aec0; font-weight: 400; }
    .chart-date-select { background: transparent; color: #fff; border: none; font-size: 12px; cursor: pointer; }

    /* Area Pembungkus Grafik */
    .chart-area-wrapper { flex-grow: 1; position: relative; display: flex; width: 100%; }
    
    /* Y-Axis (Angka Kiri) */
    .y-axis {
        display: flex; flex-direction: column; justify-content: space-between;
        color: #fff; font-size: 12px; margin-right: 15px; padding-bottom: 25px; height: 100%; width: 30px;
    }
    
    /* Grid Lines (Background Garis) */
    .grid-lines {
        position: absolute; left: 45px; right: 0; top: 0; bottom: 25px;
        display: flex; flex-direction: column; justify-content: space-between; 
        pointer-events: none; z-index: 1; /* Layer bawah */
    }
    .grid-line { width: 100%; height: 1px; background: rgba(255,255,255,0.05); }

    /* X-Axis (Label Bawah) */
    .x-axis {
        position: absolute; bottom: 0; left: 45px; right: 0;
        display: flex; justify-content: space-between; color: #a0aec0; font-size: 11px;
        z-index: 2;
    }

    /* --- CHART SPESIFIK --- */
    
    /* 1. SVG Container (Line Chart Daily) */
    .svg-container { position: absolute; left: 45px; right: 0; top: 0; bottom: 25px; z-index: 10; }

    /* 2. Bar Container (Weekly/Monthly) - Updated */
    .bar-chart-overlay {
        position: absolute; left: 45px; right: 0; top: 0; bottom: 25px;
        display: flex; align-items: flex-end; justify-content: space-around;
        padding-bottom: 2px;
        z-index: 10; /* Pastikan di atas grid lines */
    }

    .bar-col {
        display: flex; flex-direction: column; align-items: center; justify-content: flex-end;
        height: 100%; width: 100%; 
    }
    
    /* GANTI NAMA CLASS 'BAR' JADI 'SP-BAR' AGAR TIDAK BENTROK */
    .sp-bar {
        width: 30px; 
        background: #b04e5d !important; /* Pakai !important agar warna keluar */
        border-radius: 4px 4px 0 0;
        transition: height 0.5s ease;
        position: relative;
    }
    .sp-bar.active { background: #ff5b5b !important; box-shadow: 0 0 10px rgba(255, 91, 91, 0.4); }

    .hidden { display: none !important; }
</style>

<div class="custom-container">

    {{-- HEADER --}}
    <div class="top-header">
        <div class="brand-section">
            <div class="hamburger-custom" onclick="toggleSidebar()">☰</div>
            <img src="{{ asset('images/panda.png') }}" class="brand-logo" alt="Panda">
            <span class="brand-text">Sleepy Panda</span>
        </div>
        <div class="search-wrapper">
            <span class="search-icon">🔍</span>
            <input type="text" class="search-input" placeholder="Search">
        </div>
        <div class="profile-section">
            <div class="profile-pic"></div>
            <div class="profile-text">Halo, <span class="profile-name">adin</span></div>
        </div>
    </div>

    <h2 class="page-title-center">Jurnal Tidur Report</h2>
    <div class="filter-wrapper">
        <select id="viewSelector" class="custom-select" onchange="changeView()">
            <option value="daily">Daily</option>
            <option value="weekly">Weekly</option>
            <option value="monthly">Monthly</option>
        </select>
    </div>

    {{-- ======================= VIEW 1: DAILY ======================= --}}
    <div id="view-daily" class="main-grid">
        <div class="daily-card-container">
            @for($i=0; $i<3; $i++)
            <div class="info-card">
                <div class="card-date">12 Agustus 2023</div>
                <div class="card-row">
                    <div class="stat-item">
                        <span class="stat-icon">😐</span> 
                        <div class="stat-text"><span class="stat-label">User</span><span class="stat-value">1000</span></div>
                    </div>
                    <div class="stat-item">
                        <span class="stat-icon">⏰</span>
                        <div class="stat-text"><span class="stat-label">Avg Durasi</span><span class="stat-value">7j 2m</span></div>
                    </div>
                    <div class="stat-item">
                        <span class="stat-icon">🌟</span>
                        <div class="stat-text"><span class="stat-label">Avg Waktu</span><span class="stat-value">21:30 - 06:10</span></div>
                    </div>
                </div>
            </div>
            @endfor
        </div>

        <div class="chart-box">
            <div class="chart-header">
                <span class="chart-title">Users</span>
                <select class="chart-date-select"><option>12 Agst 2023</option></select>
            </div>
            <div class="chart-area-wrapper">
                <div class="y-axis"><span>2.5k</span><span>2k</span><span>1k</span><span>100</span><span>10</span><span>0</span></div>
                <div class="grid-lines">
                    <div class="grid-line"></div><div class="grid-line"></div><div class="grid-line"></div>
                    <div class="grid-line"></div><div class="grid-line"></div><div class="grid-line"></div>
                </div>
                <svg class="svg-container" viewBox="0 0 500 250" preserveAspectRatio="none">
                    <polyline points="0,250 100,80 200,150 300,150 400,200 500,60" fill="none" stroke="#f2c94c" stroke-width="2" />
                    <circle cx="0" cy="250" r="4" fill="#2c3150" stroke="#fff" stroke-width="2"/>
                    <circle cx="100" cy="80" r="4" fill="#2c3150" stroke="#fff" stroke-width="2"/>
                    <circle cx="200" cy="150" r="4" fill="#2c3150" stroke="#fff" stroke-width="2"/>
                    <circle cx="300" cy="150" r="4" fill="#2c3150" stroke="#fff" stroke-width="2"/>
                    <circle cx="400" cy="200" r="4" fill="#2c3150" stroke="#fff" stroke-width="2"/>
                    <circle cx="500" cy="60" r="4" fill="#2c3150" stroke="#fff" stroke-width="2"/>
                </svg>
                <div class="x-axis"><span>0j</span><span>2j</span><span>4j</span><span>6j</span><span>8j</span></div>
            </div>
        </div>
    </div>


    {{-- ======================= VIEW 2: WEEKLY ======================= --}}
    <div id="view-weekly" class="main-grid hidden">
        {{-- Kiri: Big Card --}}
        <div class="info-card" style="display:flex; flex-direction:column; justify-content:center;">
            <div class="card-date" style="font-size:12px; margin-bottom:30px;">1 Juni - 7 Juni 2023</div>
            <div style="display:flex; justify-content:space-around; align-items:center;">
                <div style="text-align:center;">
                    <div style="font-size:40px; margin-bottom:10px;">😀</div>
                    <div class="stat-label">User</div><div class="stat-value" style="font-size:20px;">4000</div>
                </div>
                <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div><div class="stat-label">Avg Durasi</div><div class="stat-value">8j 2m</div></div>
                    <div><div class="stat-label">Total</div><div class="stat-value">60j 51m</div></div>
                    <div><div class="stat-label">Avg Mulai</div><div class="stat-value">21:08</div></div>
                    <div><div class="stat-label">Avg Bangun</div><div class="stat-value">06:30</div></div>
                </div>
            </div>
        </div>

        {{-- Kanan: Bar Chart --}}
        <div class="chart-box">
             <div class="chart-header">
                <span class="chart-title">Weekly Stats</span>
                <select class="chart-date-select"><option>1-7 Juni</option></select>
            </div>
            
            <div class="chart-area-wrapper">
                <div class="y-axis"><span>10j</span><span>8j</span><span>6j</span><span>4j</span><span>2j</span><span>0j</span></div>
                
                {{-- Grid Lines Background --}}
                <div class="grid-lines">
                    <div class="grid-line"></div><div class="grid-line"></div><div class="grid-line"></div>
                    <div class="grid-line"></div><div class="grid-line"></div><div class="grid-line"></div>
                </div>

                {{-- Bar Chart Overlay --}}
                <div class="bar-chart-overlay">
    <div class="bar-col"><div class="sp-bar" style="height:50%;"></div></div>
    <div class="bar-col"><div class="sp-bar" style="height:70%;"></div></div>
    <div class="bar-col"><div class="sp-bar" style="height:40%;"></div></div>
    <div class="bar-col"><div class="sp-bar active" style="height:85%;"></div></div>
    <div class="bar-col"><div class="sp-bar" style="height:70%;"></div></div>
    <div class="bar-col"><div class="sp-bar" style="height:70%;"></div></div>
    <div class="bar-col"><div class="sp-bar" style="height:40%;"></div></div>
</div>

                <div class="x-axis">
                    <span>Sun</span><span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span>
                </div>
            </div>
        </div>
    </div>


    {{-- ======================= VIEW 3: MONTHLY ======================= --}}
    <div id="view-monthly" class="main-grid hidden">
        {{-- Kiri: 2 Stacked Cards --}}
        <div class="daily-card-container">
            <div class="info-card" style="flex:1; display:flex; flex-direction:column; justify-content:center;">
                <div class="card-date">Juni 2023</div>
                <div class="card-row">
                    <div class="stat-item"><span class="stat-icon">😐</span><div class="stat-text"><span class="stat-label">User</span><span class="stat-value">5000</span></div></div>
                    <div class="stat-item"><div class="stat-text"><span class="stat-label">Avg Durasi</span><span class="stat-value">8j 2m</span></div></div>
                    <div class="stat-item"><div class="stat-text"><span class="stat-label">Total</span><span class="stat-value">60j 51m</span></div></div>
                </div>
            </div>
            <div class="info-card" style="flex:1; display:flex; flex-direction:column; justify-content:center;">
                <div class="card-date">Mei 2023</div>
                <div class="card-row">
                    <div class="stat-item"><span class="stat-icon">😫</span><div class="stat-text"><span class="stat-label">User</span><span class="stat-value">8000</span></div></div>
                    <div class="stat-item"><div class="stat-text"><span class="stat-label">Avg Durasi</span><span class="stat-value">7j 38m</span></div></div>
                    <div class="stat-item"><div class="stat-text"><span class="stat-label">Total</span><span class="stat-value">63j 18m</span></div></div>
                </div>
            </div>
        </div>

        {{-- Kanan: Bar Chart --}}
        <div class="chart-box">
             <div class="chart-header">
                <span class="chart-title">Monthly Stats</span>
                <select class="chart-date-select"><option>Juni 2023</option></select>
            </div>
            
            <div class="chart-area-wrapper">
                <div class="y-axis"><span>10j</span><span>8j</span><span>6j</span><span>4j</span><span>2j</span><span>0j</span></div>
                
                {{-- Grid Lines Background --}}
                <div class="grid-lines">
                    <div class="grid-line"></div><div class="grid-line"></div><div class="grid-line"></div>
                    <div class="grid-line"></div><div class="grid-line"></div><div class="grid-line"></div>
                </div>

                {{-- Bar Chart Overlay --}}
                <div class="bar-chart-overlay">
    <div class="bar-col"><div class="sp-bar" style="height:55%; width:40px;"></div></div>
    <div class="bar-col"><div class="sp-bar" style="height:45%; width:40px;"></div></div>
    <div class="bar-col"><div class="sp-bar" style="height:65%; width:40px;"></div></div>
    <div class="bar-col"><div class="sp-bar active" style="height:65%; width:40px;"></div></div>
</div>

                <div class="x-axis">
                    <span>Week 1</span><span>Week 2</span><span>Week 3</span><span>Week 4</span>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function changeView() {
        var selected = document.getElementById('viewSelector').value;
        document.getElementById('view-daily').classList.add('hidden');
        document.getElementById('view-weekly').classList.add('hidden');
        document.getElementById('view-monthly').classList.add('hidden');
        document.getElementById('view-' + selected).classList.remove('hidden');
    }
</script>

@endsection