<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Artikel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            background-color: #28a745;
            color: white;
        }
        .btn-custom:hover {
            background-color: #218838;
        }
        .form-label {
            font-weight: bold;
            color: #343a40;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Edit Artikel</h1>
        <a href="{{ route('artikel.index') }}" class="btn btn-custom">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Artikel
        </a>
    </div>

    <!-- Edit Article Form -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Title Input -->
                <div class="mb-3">
                    <label for="title" class="form-label">Judul Artikel</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $artikel->title }}" required>
                </div>

                <!-- Text Input -->
                <div class="mb-3">
                    <label for="text" class="form-label">Isi Artikel</label>
                    <textarea name="text" id="text" class="form-control" rows="5" required>{{ $artikel->text }}</textarea>
                </div>

                <!-- Image Upload -->
                <div class="mb-3">
                    <label for="photo" class="form-label">Foto Artikel</label>
                    <input type="file" name="photo" id="photo" class="form-control">
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $artikel->photo) }}" alt="Foto Artikel" class="img-fluid" style="max-height: 150px; border-radius: 10px;">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-custom">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
