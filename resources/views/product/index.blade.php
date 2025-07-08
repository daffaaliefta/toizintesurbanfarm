<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
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
        .product-card {
            border: none;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .product-title {
            font-weight: bold;
            color: #2c3e50;
        }
        .product-price {
            color: #28a745;
            font-weight: bold;
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
    <div class="container mt-5">
        <h1 class="text-center mb-4">Daftar Produk</h1>

        <!-- Flash Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Tombol Tambah Produk dan Lihat Keranjang -->
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('cart.index') }}" class="btn btn-success">
                <i class="bi bi-cart-fill"></i> Lihat Keranjang
            </a>
            <a href="{{ route('product.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle-fill"></i> Tambah Produk
            </a>
        </div>

        <!-- Grid Produk -->
        <div class="row g-4">
            @forelse($product as $product)
                <div class="col-md-6 col-lg-4">
                    <div class="product-card p-3">
                        <img src="{{ $product->photo ? asset('storage/' . $product->photo) : 'https://via.placeholder.com/300' }}" alt="Foto Produk" class="w-100 rounded mb-3">
                        <div class="card-body text-center">
                            <h5 class="product-title mb-2">{{ $product->nama }}</h5>
                            <p class="product-category mb-1"><i class="bi bi-tag"></i> Kategori: {{ $product->category }}</p>
                            <p class="product-supplier mb-1"><i class="bi bi-person"></i> Supplier: {{ $product->customer->name }}</p>
                            <p class="product-price mb-3"><i class="bi bi-cash-stack"></i> Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                            <p class="text-muted">{{ Str::limit($product->description, 50) }}</p>

                            <!-- Tombol Aksi -->
                            <div class="d-flex flex-wrap justify-content-center gap-2 mt-3">
                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-success btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#productModal{{ $product->id }}">
                                    <i class="bi bi-info-circle"></i> Detail
                                </button>
                                <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="bi bi-cart-plus"></i> Keranjang
                                    </button>
                                </form>
                                <a href="{{ route('review.index', $product->id) }}" class="btn btn-success btn-sm">
                                    <i class="bi bi-star"></i> Review
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal untuk Produk -->
                <div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1" aria-labelledby="productModalLabel{{ $product->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="productModalLabel{{ $product->id }}"><i class="bi bi-box"></i> {{ $product->nama }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ $product->photo ? asset('storage/' . $product->photo) : 'https://via.placeholder.com/300' }}" alt="Foto Produk" class="w-100 rounded mb-3">
                                <p><strong>Kategori:</strong> {{ $product->category }}</p>
                                <p><strong>Harga:</strong> Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                                <p><strong>Kuantitas:</strong> {{ $product->quantity }}</p>
                                <p><strong>Deskripsi:</strong> {{ $product->description }}</p>
                                <p><strong>Supplier:</strong> {{ $product->customer->name }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada produk yang ditambahkan.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Floating Button -->
    <div class="floating-btn" onclick="location.href='{{ route('product.create') }}'">
        <i class="fa-solid fa-plus"></i>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
