<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel</title>
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
            <a class="navbar-brand" href="/dashboard">UrbanFarm</a>
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
        <!-- Daftar Artikel Section -->
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="section-title">Daftar Artikel</h3>
                    <a href="{{ route('artikel.create') }}" class="btn btn-success">+ Tambah Artikel</a>
                </div>
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Articles Grid -->
        <div class="row">
            @forelse ($artikels as $artikel)
                <div class="col-md-4 mb-4">
                    <div class="card p-4">
                        <div class="w-100 h-40 bg-gray-200 rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $artikel->photo) }}" alt="Foto Artikel" class="w-100 h-100 object-cover">
                        </div>
                        <h5 class="mt-3">{{ $artikel->title }}</h5>
                        <p class="text-muted">Ditulis oleh: <strong>{{ $artikel->customer->name }}</strong></p>
                        <p>{{ Str::limit($artikel->text, 100) }}</p>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('artikel.show', $artikel->id) }}" class="btn btn-success btn-sm">Baca</a>
                            <a href="{{ route('artikel.edit', $artikel->id) }}" class="btn btn-success btn-sm">Edit</a>
                            <form action="{{ route('artikel.destroy', $artikel->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-success btn-sm">Hapus</button>
                            </form>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <!-- Share Buttons -->
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('artikel.show', $artikel->id)) }}" target="_blank" class="btn btn-success btn-sm">
                                <i class="fab fa-facebook"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('artikel.show', $artikel->id)) }}&text={{ urlencode($artikel->title) }}" target="_blank" class="btn btn-success btn-sm">
                                <i class="fab fa-twitter"></i> Twitter
                            </a>
                            <a href="https://wa.me/?text={{ urlencode(route('artikel.show', $artikel->id)) }}" target="_blank" class="btn btn-success btn-sm">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">
                    Tidak ada artikel ditemukan.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Floating Button for Adding Artikel -->
    <div class="floating-btn" onclick="location.href='{{ route('artikel.create') }}'">
        <i class="fa-solid fa-plus"></i>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
