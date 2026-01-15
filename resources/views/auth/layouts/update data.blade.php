@extends('auth.layouts.admin') 

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* === STYLE UMUM (Sama dengan halaman lain) === */
        .top-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; color: white; }
        .brand-section { font-size: 20px; font-weight: 600; display: flex; align-items: center; gap: 10px; }
        .top-search { background: #252841; padding: 8px 15px; border-radius: 20px; display: flex; align-items: center; width: 300px; color: #a0a0c0; }
        .top-search input { background: transparent; border: none; color: white; margin-left: 10px; outline: none; width: 100%; }
        
        /* === STYLE KHUSUS FORM === */
        .form-card {
            background: #252841; /* Warna Card */
            border-radius: 12px;
            padding: 30px;
            max-width: 800px; /* Lebar maksimal form */
            margin-top: 20px;
        }

        .section-title { font-size: 18px; font-weight: 500; margin-bottom: 25px; color: white; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 15px; }

        .form-group { margin-bottom: 20px; }
        
        .form-label {
            display: block;
            color: #a0a0c0;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            background: #1a1c2e; /* Lebih gelap dari card */
            border: 1px solid rgba(255,255,255,0.1);
            color: white;
            padding: 12px 15px;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: 0.3s;
        }

        .form-input:focus { border-color: #4d7cff; }

        .btn-save {
            background: #4d7cff; /* Biru Sleepy Panda */
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            margin-top: 10px;
            transition: 0.3s;
        }

        .btn-save:hover { background: #3a63d1; }

        /* Foto Profil Upload */
        .profile-upload { display: flex; align-items: center; gap: 20px; margin-bottom: 30px; }
        .current-avatar { width: 80px; height: 80px; background: #ddd; border-radius: 50%; }
        .upload-btn {
            background: #36394f; color: white; padding: 8px 15px; border-radius: 6px; font-size: 13px; cursor: pointer; border: 1px solid rgba(255,255,255,0.1);
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
        <h2 class="section-title">Update Data Profil</h2>

        <form>
            <div class="profile-upload">
                <div class="current-avatar"></div>
                <div>
                    <div style="margin-bottom: 5px; font-weight: 500;">Foto Profil</div>
                    <label class="upload-btn">
                        <i class="fas fa-upload"></i> Upload Baru
                        <input type="file" style="display: none;">
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-input" value="Anthony" placeholder="Masukkan nama lengkap">
            </div>

            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" class="form-input" value="anthony@sleepypanda.com" placeholder="Masukkan email">
            </div>

            <div class="form-group">
                <label class="form-label">No. Handphone</label>
                <input type="text" class="form-input" value="+62 812 3456 7890" placeholder="Masukkan nomor HP">
            </div>

            <div class="form-group">
                <label class="form-label">Alamat (Opsional)</label>
                <textarea class="form-input" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
            </div>

            <button type="submit" class="btn-save">Simpan Perubahan</button>
        </form>
    </div>
@endsection