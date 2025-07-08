<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #083c2f; /* Latar belakang hijau gelap */
            font-family: 'Arial', sans-serif;
            color: #ffffff;
        }
        .form-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            background-color: #0f5132; /* Hijau yang lebih terang untuk kontras */
            border-radius: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
        }
        h3 {
            font-weight: bold;
            color: #ffcc00; /* Warna emas untuk judul */
        }
        .description {
            color: #c1e1c1;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: bold;
            color: #c1e1c1;
        }
        .form-control {
            background-color: #c4c4c4;
            border: none;
            border-radius: 20px;
            padding: 10px 15px;
            color: #083c2f;
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
        .btn-secondary {
            background-color: #ffffff;
            color: #083c2f;
            border: none;
            font-weight: bold;
            border-radius: 20px;
        }
        .btn-secondary:hover {
            background-color: #f2f2f2;
        }
        a {
            color: #ffcc00;
            font-weight: bold;
        }
        a:hover {
            color: #ffa700;
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h3 class="text-center">Register</h3>
            <p class="text-center description">
                Discover the joy of urban gardening! Whether you're a seasoned gardener or just getting started, UrbanFarm is here to help you grow fresh produce, beautiful flowers, and sustainable greenery right in your city space.
            </p>
            <form method="POST" action="{{ route('customers.store') }}">
                @csrf

                <!-- Username -->
                <div class="mb-3">
                    <label for="name" class="form-label">Enter Username</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="name" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Enter Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Enter Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>

                <!-- Input Alamat -->
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Enter your address" required>{{ old('alamat') }}</textarea>
                </div>

                <!-- Input No. Telepon -->
                <div class="mb-3">
                    <label for="telp" class="form-label">No. Telepon</label>
                    <input type="text" class="form-control" id="telp" name="telp" value="{{ old('telp') }}" placeholder="Enter your phone number" required>
                </div>

                <!-- Register Button -->
                <button type="submit" class="btn btn-primary w-100 mb-3">Register</button>

            <!-- Login Link -->
            <div class="text-center mt-3">
                <p>Have an account? <a href="{{ route('login') }}">Sign In</a></p>
            </div>
        </div>
    </div>
</body>
</html>