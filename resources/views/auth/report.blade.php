@extends('auth.layouts.admin')

@section('content')
<style>
    /* === VARIABLES === */
    :root {
        --bg-dark: #1b1e35;
        --card-bg: #252a40;
        --text-white: #ffffff;
        --text-grey: #8c90a0;
        --bar-color: #ff5b5b; /* Warna Merah/Pink sesuai gambar */
        --bar-bg-hover: #ff7676;
    }

    /* === LAYOUT UTAMA === */
    .report-container {
        padding: 0;
        color: var(--text-white);
        font-family: 'Poppins', sans-serif;
    }

    /* === HEADER HALAMAN (JUDUL) === */
    .page-header-title {
        font-size: 18px;
        color: #7d8090;
        margin-bottom: 20px;
        font-weight: 500;
    }

    /* === TOP STATS CARDS === */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: var(--card-bg);
        padding: 20px;
        border-radius: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .stat-info h6 {
        font-size: 12px;
        color: var(--text-grey);
        margin: 0 0 5px 0;
        font-weight: 400;
    }

    .stat-info h2 {
        font-size: 24px;
        margin: 0;
        font-weight: 600;
    }

    .stat-info span {
        font-size: 14px;
        font-weight: 400;
        margin-left: 2px;
    }

    .stat-icon-circle {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        border: 1px solid #4a506a;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: #fff;
    }

    /* === MAIN CONTENT (CHART + ALERT) === */
    .main-grid {
        display: grid;
        grid-template-columns: 2fr 1fr; /* Kiri lebih lebar dari kanan */
        gap: 25px;
    }

    /* 1. CHART SECTION */
    .chart-card {
        background: var(--card-bg);
        border-radius: 16px;
        padding: 25px;
        min-height: 450px; /* PENTING: Tinggi minimal agar chart muncul */
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .chart-top-bar {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 30px;
    }

    .chart-label {
        font-size: 16px;
        color: var(--text-grey);
    }

    .chart-controls {
        text-align: right;
    }

    .custom-select {
        background: #2b304a;
        color: #fff;
        border: none;
        padding: 8px 15px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        outline: none;
    }

    .date-display {
        font-size: 11px;
        color: var(--text-grey);
        margin-top: 5px;
        display: block;
    }

    /* AREA DIAGRAM BATANG */
    .chart-visual {
        flex-grow: 1;
        position: relative;
        display: flex;
        padding-left: 40px; /* Ruang untuk Y-Axis */
        padding-bottom: 30px; /* Ruang untuk X-Axis */
        height: 300px; /* Pastikan ada tinggi pasti */
    }

    /* Sumbu Y (Angka Kiri) */
    .y-axis {
        position: absolute;
        left: 0;
        top: 0;
        bottom: 30px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        color: var(--text-grey);
        font-size: 11px;
    }

    /* Container Bar (PENTING: Height 100%) */
    .bars-container {
        width: 100%;
        height: 100%; /* Mengikuti tinggi parent */
        display: flex;
        align-items: flex-end; /* Batang mulai dari bawah */
        justify-content: space-around;
        border-bottom: 1px solid rgba(255,255,255,0.05); /* Garis bawah tipis */
        padding-bottom: 5px;
    }

    .bar {
        width: 8%; /* Lebar batang */
        background-color: var(--bar-color);
        border-radius: 4px 4px 0 0;
        transition: height 0.5s ease;
        position: relative;
    }
    
    .bar:hover {
        background-color: var(--bar-bg-hover);
    }

    /* Sumbu X (Label Bawah) */
    .x-axis {
        position: absolute;
        bottom: 0;
        left: 40px;
        right: 0;
        display: flex;
        justify-content: space-around;
        color: var(--text-grey);
        font-size: 11px;
    }

    /* 2. ALERT SECTION */
    .alert-card {
        background: var(--card-bg);
        border-radius: 16px;
        padding: 20px;
        height: 100%;
    }

    .alert-title {
        text-align: center;
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 25px;
        color: #fff;
    }

    .alert-item {
        background: #2f3652;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 15px;
    }

    .alert-meta {
        display: flex;
        justify-content: space-between;
        font-size: 10px;
        color: var(--text-grey);
        margin-bottom: 10px;
    }

    .alert-content {
        display: flex;
        gap: 12px;
    }

    .bell-icon {
        color: var(--bar-color);
        font-size: 18px;
        margin-top: 3px;
    }

    .alert-details div {
        margin-bottom: 4px;
    }

    .user-id { font-size: 12px; font-weight: 600; display: flex; align-items: center; gap: 5px; }
    .duration { font-size: 11px; color: #fff; display: flex; align-items: center; gap: 5px; }
    .warning { font-size: 10px; color: #ccc; text-align: right; margin-top: 5px; display: block; width: 100%;}

    /* UTILITY */
    .hidden { display: none !important; }
</style>

<div class="page-header-title" id="page-main-title">Report Insomnia Daily</div>

<div class="stats-row">
    <div class="stat-card">
        <div class="stat-info">
            <h6>Total Users</h6>
            <h2 id="val-users">5500</h2>
        </div>
        <div class="stat-icon-circle"><img src="images//userp.png" alt="" style="height:20px; width:20px;"></div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <h6>Insomnia Cases</h6>
            <h2 id="val-cases">700</h2>
        </div>
        <div class="stat-icon-circle">
            <img src="images//user2.png" alt="" style="height:20px; width:20px;">
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <h6>Time to Sleep</h6>
            <h2><span id="val-time">110</span> <span>min</span></h2>
        </div>
        <div class="stat-icon-circle"><img src="images//jam.png" alt=" "style="height:20px; width:20px;"></div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <h6>Average Sleep Time</h6>
            <h2><span id="val-avg">5.5</span> <span>h</span></h2>
        </div>
        <div class="stat-icon-circle"><i class="far fa-moon"></i></div>
    </div>
</div>

<div class="main-grid">
    
    <div class="chart-card">
        <div class="chart-top-bar">
            <div class="chart-label">Users</div>
            <div class="chart-controls">
                <select id="timeFilter" class="custom-select" onchange="updateDashboard()">
                    <option value="daily">Daily</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                </select>
                <span class="date-display" id="date-display">13 Agustus 2023</span>
            </div>
        </div>

        <div class="chart-visual">
            <div class="y-axis">
                <span>2500</span><span>2000</span><span>1500</span><span>1000</span><span>500</span><span>0</span>
            </div>

            <div id="chart-daily" class="bars-container">
                <div class="bar" style="height: 30%;"></div>
                <div class="bar" style="height: 15%;"></div>
                <div class="bar" style="height: 45%;"></div>
                <div class="bar" style="height: 70%;"></div>
                <div class="bar" style="height: 60%;"></div>
                <div class="bar" style="height: 25%;"></div>
                <div class="bar" style="height: 30%;"></div>
            </div>

            <div id="chart-weekly" class="bars-container hidden">
                <div class="bar" style="height: 20%;"></div>
                <div class="bar" style="height: 40%;"></div>
                <div class="bar" style="height: 55%;"></div>
                <div class="bar" style="height: 90%;"></div>
                <div class="bar" style="height: 65%;"></div>
                <div class="bar" style="height: 35%;"></div>
                <div class="bar" style="height: 20%;"></div>
            </div>

            <div id="chart-monthly" class="bars-container hidden">
                <div class="bar" style="height: 50%;"></div>
                <div class="bar" style="height: 30%;"></div>
                <div class="bar" style="height: 60%;"></div>
                <div class="bar" style="height: 80%;"></div>
                <div class="bar" style="height: 75%;"></div>
                <div class="bar" style="height: 40%;"></div>
                <div class="bar" style="height: 25%;"></div>
            </div>

            <div class="x-axis" id="x-axis-labels">
                <span>22:00</span><span>23:00</span><span>00:00</span><span>01:00</span><span>02:00</span><span>03:00</span><span>04:00</span>
            </div>
        </div>
    </div>

    <div class="alert-card">
        <div class="alert-title">Alert Insomnia Terbaru</div>
        
        <div class="alert-item">
            <div class="alert-meta">
                <span>13 Agustus 2023</span>
                <span>30 menit yang lalu</span>
            </div>
            <div class="alert-content">
                <i class="fas fa-bell bell-icon"></i>
                <div class="alert-details">
                    <div class="user-id"><i class="fas fa-smile" style="color:#f1c40f;"></i> User ID #12145</div>
                    <div class="duration"><i class="fas fa-clock" style="color:#ff5b5b;"></i> Avg Durasi: 1 Jam 30 Menit</div>
                    <span class="warning">Tidak Tidur selama 29 jam terakhir</span>
                </div>
            </div>
        </div>

        <div class="alert-item">
            <div class="alert-meta">
                <span>13 Agustus 2023</span>
                <span>2 jam yang lalu</span>
            </div>
            <div class="alert-content">
                <i class="fas fa-bell bell-icon"></i>
                <div class="alert-details">
                    <div class="user-id"><i class="fas fa-smile" style="color:#f1c40f;"></i> User ID #17308</div>
                    <div class="duration"><i class="fas fa-clock" style="color:#ff5b5b;"></i> Avg Durasi: 1 Jam 15 Menit</div>
                    <span class="warning">Tidak Tidur selama 34 jam terakhir</span>
                </div>
            </div>
        </div>
        
        <div class="alert-item">
            <div class="alert-meta">
                <span>13 Agustus 2023</span>
                <span>3 jam yang lalu</span>
            </div>
            <div class="alert-content">
                <i class="fas fa-bell bell-icon"></i>
                <div class="alert-details">
                    <div class="user-id"><i class="fas fa-smile" style="color:#f1c40f;"></i> User ID #18432</div>
                    <div class="duration"><i class="fas fa-clock" style="color:#ff5b5b;"></i> Avg Durasi: 1 Jam 25 Menit</div>
                    <span class="warning">Tidak Tidur selama 32 jam terakhir</span>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function updateDashboard() {
        const filter = document.getElementById('timeFilter').value;
        
        // Elemen yang akan diupdate
        const mainTitle = document.getElementById('page-main-title');
        const dateDisplay = document.getElementById('date-display');
        const xAxis = document.getElementById('x-axis-labels');
        
        // Chart Bars
        const chartDaily = document.getElementById('chart-daily');
        const chartWeekly = document.getElementById('chart-weekly');
        const chartMonthly = document.getElementById('chart-monthly');

        // Values Stats (Simulasi Data Berubah)
        const valUsers = document.getElementById('val-users');
        const valCases = document.getElementById('val-cases');
        const valTime = document.getElementById('val-time');
        const valAvg = document.getElementById('val-avg');

        // 1. Sembunyikan semua chart dulu
        chartDaily.classList.add('hidden');
        chartWeekly.classList.add('hidden');
        chartMonthly.classList.add('hidden');

        // 2. Logic Ganti Data
        if(filter === 'daily') {
            mainTitle.innerText = "Report Insomnia Daily";
            dateDisplay.innerText = "13 Agustus 2023";
            
            // Tampilkan Chart Daily
            chartDaily.classList.remove('hidden');
            
            // Update X-Axis Labels
            xAxis.innerHTML = `<span>22:00</span><span>23:00</span><span>00:00</span><span>01:00</span><span>02:00</span><span>03:00</span><span>04:00</span>`;
            
            // Update Stats
            valUsers.innerText = "5500";
            valCases.innerText = "700";
            valTime.innerText = "110";
            valAvg.innerText = "5.5";

        } else if (filter === 'weekly') {
            mainTitle.innerText = "Report Insomnia Weekly";
            dateDisplay.innerText = "12 Agt - 18 Agt 2023";
            
            // Tampilkan Chart Weekly
            chartWeekly.classList.remove('hidden');

            // Update X-Axis Labels (Hari)
            xAxis.innerHTML = `<span>Sen</span><span>Sel</span><span>Rab</span><span>Kam</span><span>Jum</span><span>Sab</span><span>Min</span>`;
            
            // Update Stats
            valUsers.innerText = "4500";
            valCases.innerText = "900";
            valTime.innerText = "90";
            valAvg.innerText = "5.2";

        } else if (filter === 'monthly') {
            mainTitle.innerText = "Report Insomnia Monthly";
            dateDisplay.innerText = "Agustus 2023";
            
            // Tampilkan Chart Monthly
            chartMonthly.classList.remove('hidden');

            // Update X-Axis Labels (Minggu)
            xAxis.innerHTML = `<span>W1</span><span>W2</span><span>W3</span><span>W4</span><span>W5</span><span>W6</span><span>W7</span>`;
            
            // Update Stats
            valUsers.innerText = "3800";
            valCases.innerText = "800";
            valTime.innerText = "140";
            valAvg.innerText = "5.0";
        }
    }
</script>
@endsection