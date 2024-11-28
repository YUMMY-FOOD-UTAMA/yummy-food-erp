<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Yummy Food Utama CRM</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Arial:wght@300;400;700&family=Poppins:wght@300;400;700&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif; /* Menggunakan font Arial untuk teks lainnya */
        }

        body {
            background: linear-gradient(135deg, #ff4e50, #b81d24); /* Warna merah dominan */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px; /* Tambahan padding untuk tampilan di perangkat kecil */
        }

        .login-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            padding: 40px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .login-container img {
            width: 120px; /* Ukuran logo */
            margin-bottom: 10px;
        }

        .login-container h1 {
            margin-bottom: 20px;
            font-size: 22px; /* Ukuran font lebih kecil */
            font-family: 'Poppins', sans-serif; /* Font lebih soft */
            color: #b81d24; /* Warna merah gelap */
        }

        .login-container input {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px; /* Ukuran font untuk input */
        }

        .login-container button {
            background: #b81d24; /* Warna merah */
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background 0.3s;
        }

        .login-container button:hover {
            background: #ff4e50; /* Warna merah yang lebih terang */
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #888;
        }

        /* Media Queries untuk Responsif */
        @media (max-width: 480px) {
            .login-container {
                padding: 20px; /* Mengurangi padding di perangkat lebih kecil */
            }

            .login-container h1 {
                font-size: 18px; /* Mengurangi ukuran font judul */
            }

            .login-container input {
                padding: 10px; /* Mengurangi padding input */
                font-size: 12px; /* Mengurangi ukuran font input */
            }

            .login-container button {
                font-size: 14px; /* Mengurangi ukuran font tombol */
                padding: 10px; /* Mengurangi padding tombol */
            }
        }
    </style>
</head>
<body>
<div class="login-container">
    <img src="{{asset('assets/images/logo-new.png')}}" alt="Yummy Food Utama Logo">
    <h1>Yummy Food Utama</h1>
    <form action="{{route('login')}}" method="post">
        @csrf
        <input type="text" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <div class="footer">
        &copy; 2024 Yummy Food Utama. All rights reserved.
    </div>
</div>
</body>
</html>
