@extends('auth.layouts.admin') 

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* === STYLE UMUM === */
        .top-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; color: white; }
        .brand-section { font-size: 20px; font-weight: 600; display: flex; align-items: center; gap: 10px; }
        .top-search { background: #252841; padding: 8px 15px; border-radius: 20px; display: flex; align-items: center; width: 300px; color: #a0a0c0; }
        .top-search input { background: transparent; border: none; color: white; margin-left: 10px; outline: none; width: 100%; }

        /* === STYLE KHUSUS FORM === */
        .form-card {
            background: #252841;
            border-radius: 12px;
            padding: 30px;
            max-width: 600px; /* Lebih kecil sedikit dari update data */
            margin-top: 20px;
        }

        .section-title { font-size: 18px; font-weight: 500; margin-bottom: 25px; color: white; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 15px; }

        .form-group { margin-bottom: 20px; position: relative; }
        
        .form-label { display: block; color: #a0a0c0; margin-bottom: 8px; font-size: 14px; }

        .form-input {
            width: 100%;
            background: #1a1c2e;
            border: 1px solid rgba(255,255,255,0.1);
            color: white;
            padding: 12px 15px;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: 0.3s;
        }
        .form-input:focus { border-color: #ff4d8d; /* Warna Pink untuk Reset Password agar beda dikit */ }

        .btn-reset {
            background: linear-gradient(45deg, #fd5d93, #ec250d); /* Gradient Pink/Merah */
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            margin-top: 10px;
            width: 100%;
        }
        .btn-reset:hover { opacity: 0.9; }

        .icon-eye {
            position: absolute;
            right: 15px;
            top: 42px;
            color: #a0a0c0;
            cursor: pointer;
        }
    </style>

    <div class="top-header">
        <div class="brand-section">
            <img src="https://cdn-icons-png.flaticon.com/512/3069/3069186.png" alt="Panda Logo" style="width: 35px; height: 35px;">
            Sleepy Panda
        </div>
        <div style="display: flex; align-items: center; gap: 20px;">
            <div class="top-search">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search">
            </div>
            <div class="user-profile">
                <div class="avatar" style="width:40px;height:40px;background:#ddd;border-radius:50%"></div>
                <span style="margin-left:10px">Halo, Anthony</span>
            </div>
        </div>
    </div>

    <div class="form-card">
        <h2 class="section-title">Reset Password</h2>
        <p style="color: #a0a0c0; font-size: 13px; margin-bottom: 20px;">
            Pastikan password baru Anda kuat dan belum pernah digunakan sebelumnya.
        </p>

        <form>
            <div class="form-group">
                <label class="form-label">Password Lama</label>
                <input type="password" class="form-input" placeholder="••••••••">
                <i class="fas fa-eye icon-eye"></i>
            </div>

            <div class="form-group">
                <label class="form-label">Password Baru</label>
                <input type="password" class="form-input" placeholder="••••••••">
                <i class="fas fa-eye icon-eye"></i>
            </div>

            <div class="form-group">
                <label class="form-label">Konfirmasi Password Baru</label>
                <input type="password" class="form-input" placeholder="••••••••">
                <i class="fas fa-eye icon-eye"></i>
            </div>

            <button type="submit" class="btn-reset">Ganti Password</button>
        </form>
    </div>
@endsection