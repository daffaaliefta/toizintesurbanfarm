<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Tambah Produk Baru</h1>

        <!-- Tampilkan pesan error -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Tambah Produk -->
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="border p-4 shadow-sm rounded">
            @csrf
            <div class="mb-3">
                <label for="customer_id" class="form-label">Customer</label>
                <select name="customer_id" id="customer_id" class="form-select" required>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Produk</label>
                <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama produk" value="{{ old('nama') }}" required>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Foto Produk</label>
                <input type="file" name="photo" id="photo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Kategori</label>
                <select name="category" id="category" class="form-select" required>
                    <option value="" disabled selected>Pilih kategori</option>
                    <option value="vegetable" {{ old('category') == 'vegetable' ? 'selected' : '' }}>Vegetable</option>
                    <option value="seed" {{ old('category') == 'seed' ? 'selected' : '' }}>Seed</option>
                    <option value="tool" {{ old('category') == 'tool' ? 'selected' : '' }}>Tool</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" id="description" rows="4" class="form-control" placeholder="Masukkan deskripsi produk" required>{{ old('description') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga (Rp)</label>
                <input type="number" name="harga" id="harga" class="form-control" placeholder="Masukkan harga produk" value="{{ old('harga') }}" required>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Jumlah Stok</label>
                <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Masukkan jumlah stok" value="{{ old('quantity') }}" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success">Simpan Produk</button>
                <a href="{{ route('product.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
