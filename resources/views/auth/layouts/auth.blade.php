<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sleepy Panda')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        /* --- GLOBAL STYLE --- */
        body {
            background-color: #1c213b;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Nunito', sans-serif;
        }

        .phone-frame {
            width: 360px;
            min-height: 640px;
            border: 2px solid rgba(255,255,255,0.4);
            border-radius: 4px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #1c213b;
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
            padding: 20px 0;
        }

        .content {
            width: 100%;
            padding: 20px 30px;
            text-align: center;
            color: #ffffff;
        }

        .logo {
            margin-top: 10px;
            margin-bottom: 15px;
        }

        .logo img {
            width: 80px;
        }

        .title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .subtitle {
            font-size: 14px;
            color: #cfd3ff;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        /* --- TOMBOL UNTUK HALAMAN WELCOME --- */
        
        /* Tombol Teal (Masuk) */
        .btn-masuk {
            background-color: #0fa7a0;
            color: #ffffff;
            border-radius: 6px;
            padding: 12px;
            font-weight: 600;
            border: none;
            width: 100%;
            display: block;
            text-decoration: none;
            margin-bottom: 15px; /* Jarak antar tombol */
            transition: background 0.3s;
        }
        .btn-masuk:hover {
            background-color: #0c8f89;
            color: white;
        }

        /* Tombol Putih (Daftar) */
        .btn-daftar {
            background-color: #ffffff;
            color: #0fa7a0;
            border-radius: 6px;
            padding: 12px;
            font-weight: 600;
            border: none;
            width: 100%;
            display: block;
            text-decoration: none;
            transition: background 0.3s;
        }
        .btn-daftar:hover {
            background-color: #f2f2f2;
            color: #0fa7a0;
        }


        /* --- STYLE UNTUK FORM (Input & Alert) --- */
        .form-input {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            border-radius: 6px;
            padding: 12px 15px;
            width: 100%;
            margin-bottom: 15px;
            outline: none;
        }
        .form-input::placeholder { color: #cfd3ff; opacity: 0.7; }
        .form-input:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: #0fa7a0;
            color: white;
        }

        .alert-danger {
            background: rgba(255, 77, 141, 0.2);
            border: 1px solid #ff4d8d;
            color: #ffb3d1;
            font-size: 13px;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 6px;
            text-align: left;
        }
        
        /* Style Text Link Bawah (Login Page) */
        .bottom-text {
            margin-top: 25px;
            font-size: 14px;
            color: #cfd3ff;
        }
        .bottom-text a {
            color: #0fa7a0;
            text-decoration: none;
            font-weight: 600;
            margin-left: 5px;
        }
        
        .forgot-link {
            font-size: 12px;
            color: #cfd3ff;
            text-decoration: none;
            float: right;
            margin-bottom: 20px;
        }
        .clearfix::after { content: ""; clear: both; display: table; }
    </style>
</head>
<body>
<div class="phone-frame">
    <div class="content">
        @yield('content')
    </div>
</div>

</body>
</html>