@extends('auth.layouts.admin') 

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* === STYLE TAMBAHAN === */
        
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

        /* Database Section Wrapper */
        .database-section {
            /* Margin top dihapus agar langsung naik ke atas karena dashboard sudah hilang */
            margin-top: 10px; 
            padding-bottom: 50px;
        }
        
        /* Grid untuk Stats Database (4 kotak atas) */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--bg-card);
            padding: 20px;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Custom Table Style */
        .table-container {
            background: var(--bg-card);
            border-radius: 12px;
            padding: 20px;
            overflow-x: auto;
        }

        .table-controls {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .table-search {
            background: #1a1c2e;
            padding: 10px 15px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            width: 350px; /* Lebar search bar diperbesar sedikit */
            color: var(--text-dim);
        }
        .table-search input {
            background: transparent;
            border: none;
            color: white;
            margin-left: 10px;
            width: 100%;
            outline: none;
        }

        .btn-filter {
            background: #36394f;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            cursor: pointer;
            margin-left: 5px;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-filter:hover { background: #4d7cff; }

        table {
            width: 100%;
            border-collapse: collapse;
            color: white;
        }
        
        th {
            text-align: left;
            padding: 15px;
            color: white;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            font-weight: 500;
        }
        
        td {
            padding: 15px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            vertical-align: middle;
            font-size: 14px;
        }

        /* User Info di Tabel */
        .user-flex { display: flex; align-items: center; gap: 10px; }
        .user-icon { 
            width: 35px; height: 35px; 
            border-radius: 50%; border: 1px solid white; 
            display: flex; align-items: center; justify-content: center;
        }
        .sub-text { font-size: 11px; color: var(--text-dim); display: block; margin-top: 2px; }

        /* Badge Status */
        .badge { padding: 5px 15px; border-radius: 20px; font-size: 11px; font-weight: 600; display: inline-block; text-align: center; width: 80px;}
        .badge-active { background: #4350ce; color: white; }
        .badge-inactive { background: linear-gradient(45deg, #fd5d93, #ec250d); color: white; }

        /* Responsif */
        @media (max-width: 1024px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }
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
                <span>Halo, Anthony</span>
            </div>
        </div>
    </div>

    <div class="database-section">
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="sub-text">Total Users</div>
                <div style="font-size: 24px; font-weight: 600; display:flex; align-items:center; gap:10px; margin-top:5px;">
                    <i class="far fa-user"></i> 4500
                </div>
            </div>
            <div class="stat-card">
                <div class="sub-text">Active Users</div>
                <div style="font-size: 24px; font-weight: 600; display:flex; align-items:center; gap:10px; margin-top:5px;">
                    <i class="far fa-user"></i> 3500
                </div>
            </div>
            <div class="stat-card">
                <div class="sub-text">New Users</div>
                <div style="font-size: 24px; font-weight: 600; display:flex; align-items:center; gap:10px; margin-top:5px;">
                    <i class="fas fa-plus"></i> + 500
                </div>
            </div>
            <div class="stat-card">
                <div class="sub-text">Inactive Users</div>
                <div style="font-size: 24px; font-weight: 600; display:flex; align-items:center; gap:10px; margin-top:5px;">
                    <i class="fas fa-user-slash" style="opacity:0.5;"></i> 500
                </div>
            </div>
        </div>

        <div class="table-container">
            <div class="table-controls">
                <div class="table-search">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search by name, email, or ID">
                </div>
                <div>
                    <button class="btn-filter"><i class="fas fa-filter"></i> Sort by</button>
                    <button class="btn-filter"><i class="fas fa-sync-alt"></i> Refresh</button>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Contact</th>
                        <th>Sleep Status</th>
                        <th>Status</th>
                        <th>Last Active</th>
                        <th>History</th> </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="user-flex">
                                <div class="user-icon"><i class="far fa-user"></i></div>
                                <div>
                                    <div style="font-weight:600;">Alfonso de</div>
                                    <span class="sub-text">ID #418230</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="user-flex">
                                <i class="far fa-envelope" style="color:var(--text-dim)"></i> 
                                <span>Alfonso.de@gmail.com</span>
                            </div>
                            <span class="sub-text" style="margin-left:25px;">+62123456789</span>
                        </td>
                        <td>
                            <div>Avg. Sleep: 7.2h</div>
                            <span class="sub-text">Quality: 85%</span>
                        </td>
                        <td><span class="badge badge-active">Active</span></td>
                        <td>
                            <div>2024-02-01</div>
                            <span class="sub-text">14:30</span>
                        </td>
                        <td>
                            <i class="fas fa-window-restore" style="color: white; cursor: pointer;"></i>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <div class="user-flex">
                                <div class="user-icon"><i class="far fa-user"></i></div>
                                <div>
                                    <div style="font-weight:600;">Alfonso de</div>
                                    <span class="sub-text">ID #418230</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="user-flex">
                                <i class="far fa-envelope" style="color:var(--text-dim)"></i> 
                                <span>Alfonso.de@gmail.com</span>
                            </div>
                            <span class="sub-text" style="margin-left:25px;">+62123456789</span>
                        </td>
                        <td>
                            <div>Avg. Sleep: 1.2h</div>
                            <span class="sub-text">Quality: 20%</span>
                        </td>
                        <td><span class="badge badge-inactive">Not Active</span></td>
                        <td>
                            <div>2024-02-01</div>
                            <span class="sub-text">14:30</span>
                        </td>
                        <td>
                            <i class="fas fa-window-restore" style="color: white; cursor: pointer;"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection