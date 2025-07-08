<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            background-color: #f9fff7;
        }
        .navbar {
            background-color: #ffffff;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-size: 1.5rem;
            color: #4caf50 !important;
            font-weight: bold;
        }
        .nav-link {
            color: #4caf50 !important;
        }
        .nav-link:hover {
            text-decoration: underline;
        }
        .content-section {
            margin-top: 40px;
        }
        .card {
            border: none;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .icon {
            font-size: 48px;
            color: #4caf50;
        }
        .table th {
            background-color: #4caf50;
            color: white;
        }
        .table tr:nth-child(even) {
            background-color: #e8f5e9;
        }
        .floating-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #4caf50;
            color: white;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            font-size: 24px;
            cursor: pointer;
        }
        .floating-btn:hover {
            background-color: #388e3c;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="dashboard">UrbanFarm</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('product.index') }}">E-Commerce</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('growplan.index') }}">Growplan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('chat.index') }}">Chat Komunitas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('review.index') }}">Review Produk</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container content-section">
        <!-- Artikel dan Video Section -->
        <div class="row mb-5">
            <div class="col-md-6">
                <div class="card p-4 d-flex align-items-center">
                    <i class="fa-solid fa-newspaper icon"></i>
                    <h5 class="card-title mt-3">Artikel Urban Farming</h5>
                    <a href="{{ route('artikel.index') }}" class="btn btn-success">Lihat Artikel</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-4 d-flex align-items-center">
                    <i class="fa-solid fa-video icon"></i>
                    <h5 class="card-title mt-3">Video Tutorial</h5>
                    <a href="{{ route('video.index') }}" class="btn btn-success">Lihat Video</a>
                </div>
            </div>
        </div>

        <!-- Aktivitas Section -->
        <div class="row">
            <div class="col-12">
                <h3 class="section-title">Aktivitas (History Growplan)</h3>
            </div>
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Plan</th>
                            <th>Benih</th>
                            <th>Tanggal Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($growplans as $growplan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $growplan->title }}</td>
                            <td>{{ $growplan->seed }}</td>
                            <td>{{ $growplan->tanggal }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Floating Button for Adding Growplan -->
    <div class="floating-btn" onclick="location.href='{{ route('growplan.create') }}'">
        <i class="fa-solid fa-plus"></i>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
</body>
</html>
