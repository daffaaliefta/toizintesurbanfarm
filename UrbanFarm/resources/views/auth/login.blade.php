<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #002b1a; /* Hijau tua sesuai gambar */
            color: #fff; /* Warna teks putih */
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 10%;
            max-width: 400px;
        }

        .card {
            background-color: #004529; /* Hijau medium */
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            font-size: 32px;
            font-weight: bold;
            color: #fdbf00; /* Warna kuning untuk judul */
        }

        p {
            font-size: 14px;
            color: #d3d3d3; /* Abu-abu terang untuk deskripsi */
        }

        label {
            font-size: 14px;
            color: #fff; /* Putih untuk label input */
        }

        input[type="email"],
        input[type="password"] {
            background-color: #d3d3d3; /* Abu-abu terang */
            border: none;
            border-radius: 20px;
            padding: 10px 15px;
            font-size: 14px;
            color: #004529; /* Hijau tua untuk teks input */
        }

        input::placeholder {
            color: #8a8a8a; /* Placeholder abu-abu */
        }

        .btn-primary {
            background-color: #ffcc00;
            border: none;
            font-weight: bold;
            border-radius: 20px;
        }
        .btn-primary:hover {
            background-color: #ffa700;
        }

        a {
            color: #ffcc00;
            font-weight: bold;
        }
        a:hover {
            color: #ffa700;
            text-decoration: underline;
        }

        .sign-up {
            margin-top: 15px;
            text-align: center;
            font-size: 14px;
        }

        .logo {
            width: 150px; /* Sesuaikan ukuran logo */
            margin: 0 auto 20px; /* Margin bawah dan tengah */
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card text-center">
            <h1>Login</h1>
            <p>Discover the joy of urban gardening! Whether you're a seasoned gardener or just getting started, UrbanFarm is here to help you grow fresh produce, beautiful flowers, and sustainable greenery right in your city space.</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3 text-start">
                    <label for="email">Enter Email</label>
                    <input type="email" id="email" name="email" placeholder="Email" class="form-control" required>
                </div>
                <div class="mb-3 text-start">
                    <label for="password">Enter Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>
            </form>
            <div class="sign-up">
                <p>Don't have an account? <a href="{{ route('customers.create') }}">Sign Up</a></p>
            </div>
        </div>
    </div>
</body>
</html>
