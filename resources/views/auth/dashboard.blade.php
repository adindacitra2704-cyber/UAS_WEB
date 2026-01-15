@extends('auth.layouts.admin') 

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* === STYLE TAMBAHAN KHUSUS HALAMAN INI === */
        
        /* Navbar Atas (Header) */
        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            color: var(--text-main);
        }
        .brand-section {
            font-size: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .top-search {
            background: var(--bg-card);
            padding: 8px 15px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            width: 300px;
            color: var(--text-dim);
        }
        .top-search input {
            background: transparent;
            border: none;
            color: white;
            margin-left: 10px;
            outline: none;
            width: 100%;
        }

        /* Icon Helper */
        .icon-stat-container {
            width: 50px; height: 50px; 
            border-radius: 50%; 
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
            margin-right: 15px;
        }
        .sub-text { font-size: 11px; color: var(--text-dim); display: block; margin-top: 2px; }
    </style>

    <div class="top-header">
        <div class="brand-section">
            <img src="images//panda.png" alt="Panda Logo" style="width: 35px; height: 35px;">
            Sleepy Panda
        </div>
        <div style="display: flex; align-items: center; gap: 20px;">
            <div class="top-search">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search">
            </div>
            <div class="user-profile">
                <div class="avatar"></div>
                <span>Halo, adin</span>
            </div>
        </div>
    </div>

    <div class="grid-reports">
        <div class="card">
            <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                <h3 style="margin: 0; font-size: 14px; font-weight: 400;">Daily Report</h3>
                <div style="font-size: 10px;">
                    <span style="color: var(--pink);">● Actual</span> &nbsp; <span style="color: var(--blue);">● Target</span>
                </div>
            </div>
            <div class="bar-container">
                <div class="bar pink" style="height: 40%;"></div><div class="bar blue" style="height: 60%;"></div>
                <div class="bar pink" style="height: 50%;"></div><div class="bar blue" style="height: 70%;"></div>
                <div class="bar pink" style="height: 30%;"></div><div class="bar blue" style="height: 45%;"></div>
                <div class="bar pink" style="height: 80%;"></div><div class="bar blue" style="height: 55%;"></div>
            </div>
            <div class="label-row"><span>Sun</span><span>Mon</span><span>Tue</span><span>Wed</span></div>
        </div>
        <div class="card">
            <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                <h3 style="margin: 0; font-size: 14px; font-weight: 400;">Weekly Report</h3>
                <div style="font-size: 10px;">
                    <span style="color: var(--pink);">● Actual</span> &nbsp; <span style="color: var(--blue);">● Target</span>
                </div>
            </div>
            <div class="bar-container">
                <div class="bar pink" style="height: 60%;"></div><div class="bar blue" style="height: 40%;"></div>
                <div class="bar pink" style="height: 55%;"></div><div class="bar blue" style="height: 65%;"></div>
                <div class="bar pink" style="height: 45%;"></div><div class="bar blue" style="height: 50%;"></div>
                <div class="bar pink" style="height: 70%;"></div><div class="bar blue" style="height: 75%;"></div>
            </div>
            <div class="label-row"><span>W1</span><span>W2</span><span>W3</span><span>W4</span></div>
        </div>
        <div class="card">
            <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                <h3 style="margin: 0; font-size: 14px; font-weight: 400;">Monthly Report</h3>
                <div style="font-size: 10px;">
                    <span style="color: var(--pink);">● Actual</span> &nbsp; <span style="color: var(--blue);">● Target</span>
                </div>
            </div>
            <div class="bar-container">
                <div class="bar pink" style="height: 50%;"></div><div class="bar blue" style="height: 40%;"></div>
                <div class="bar pink" style="height: 70%;"></div><div class="bar blue" style="height: 60%;"></div>
                <div class="bar pink" style="height: 40%;"></div><div class="bar blue" style="height: 80%;"></div>
                <div class="bar pink" style="height: 60%;"></div><div class="bar blue" style="height: 55%;"></div>
            </div>
            <div class="label-row"><span>Jan</span><span>Feb</span><span>Mar</span><span>Apr</span></div>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="icon-stat-container" style="background: rgba(255,255,255,0.1);">👤</div>
            <div>
                <div class="sub-text">Total Users</div>
                <div style="font-size: 20px; font-weight: 600;">4,500</div> 
            </div>
        </div>
        <div class="stat-card">
            <div class="icon-stat-container" style="background: rgba(255, 77, 141, 0.1);">👩</div>
            <div>
                <div class="sub-text">Female Users</div>
                <div style="font-size: 20px; font-weight: 600;">2,000</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="icon-stat-container" style="background: rgba(77, 124, 255, 0.1);">👨</div>
            <div>
                <div class="sub-text">Male Users</div>
                <div style="font-size: 20px; font-weight: 600;">2,500</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="icon-stat-container" style="background: rgba(255,255,255,0.1);">🕒</div>
            <div>
                <div class="sub-text">Average Time</div>
                <div style="font-size: 20px; font-weight: 600;">154.25</div>
            </div>
        </div>
    </div>

    <div class="line-chart-container">
        <h3 style="margin: 0 0 20px 0; font-size: 16px;">Average Users Sleep Time</h3>
        <div style="width: 100%; height: 200px;">
            <svg viewBox="0 0 500 100" preserveAspectRatio="none" style="width: 100%; height: 100%;">
                <path d="M0,80 Q50,70 100,40 T200,60 T300,50 T400,30 T500,60" fill="none" stroke="var(--pink)" stroke-width="2"/>
                <path d="M0,60 Q50,65 100,80 T200,40 T300,70 T400,40 T500,20" fill="none" stroke="var(--blue)" stroke-width="2"/>
            </svg>
        </div>
    </div>
@endsection