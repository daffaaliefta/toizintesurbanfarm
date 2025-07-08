<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Review</title>
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
        .stars {
            color: gold;
            font-size: 1.5em;
        }
        .stars span {
            margin-right: 5px;
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
        <h1 class="text-center mb-4">Daftar Review Produk</h1>

        <!-- Flash Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tombol Tambah Review -->
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('review.create') }}" class="btn btn-success">Tambah Review</a>
        </div>

        <!-- Tabel Review -->
        <div class="card p-4">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Rating</th>
                        <th>Komentar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $review)
                        <tr>
                            <td>{{ $review->product->nama }}</td>
                            <td><span class="stars" data-rating="{{ $review->rating }}"></span></td>
                            <td>{{ $review->comment ?? 'Tidak ada komentar' }}</td>
                            <td>
                                <a href="{{ route('review.edit', $review->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('review.destroy', $review->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus review ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada review yang tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Floating Button for Adding Review -->
    <div class="floating-btn" onclick="location.href='{{ route('review.create') }}'">
        <i class="fa-solid fa-plus"></i>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.stars').forEach(star => {
            const rating = parseInt(star.getAttribute('data-rating'));
            let starHtml = '';
            
            // Membuat bintang penuh sesuai dengan rating
            for (let i = 0; i < 5; i++) {
                if (i < rating) {
                    starHtml += '★'; // Bintang penuh
                } else {
                    starHtml += '☆'; // Bintang kosong
                }
            }
            star.innerHTML = starHtml;
        });
    </script>
</body>
</html>
