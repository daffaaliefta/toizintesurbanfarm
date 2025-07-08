<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #4caf50;">
        <div class="container">
            <a class="navbar-brand text-white" href="dashboard">UrbanFarm</a>
        </div>
    </nav>

    <!-- Container -->
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Produk</h1>

        <!-- Flash Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Form Edit Produk -->
        <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nama Produk -->
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Produk</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $product->nama) }}" required>
            </div>

            <!-- Foto Produk -->
            <div class="mb-3">
                <label for="photo" class="form-label">Foto Produk</label>
                <input type="file" name="photo" id="photo" class="form-control">
                @if($product->photo)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $product->photo) }}" alt="Foto Produk" class="img-thumbnail" width="150">
                    </div>
                @endif
            </div>

            <!-- Kategori Produk -->
            <div class="mb-3">
                <label for="category" class="form-label">Kategori Produk</label>
                <input type="text" name="category" id="category" class="form-control" value="{{ old('category', $product->category) }}" required>
            </div>

            <!-- Deskripsi Produk -->
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi Produk</label>
                <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $product->description) }}</textarea>
            </div>

            <!-- Harga Produk -->
            <div class="mb-3">
                <label for="harga" class="form-label">Harga Produk</label>
                <input type="number" name="harga" id="harga" class="form-control" value="{{ old('harga', $product->harga) }}" required>
            </div>

            <!-- Jumlah Stok Produk -->
            <div class="mb-3">
                <label for="quantity" class="form-label">Jumlah Stok</label>
                <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}" required>
            </div>

            <!-- Tombol -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('product.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
