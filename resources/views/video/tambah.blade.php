<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Video</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container py-4">
        <div class="card shadow border-0">
            <div class="card-header text-center">
                <h1 class="my-2"><i class="fas fa-video"></i> Tambah Video</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('video.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Pilih Customer -->
                    <div class="mb-3">
                        <label for="customer_id" class="form-label">Pilih Customer</label>
                        <select name="customer_id" id="customer_id" class="form-control" required>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Judul Video -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Video</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>

                    <!-- Deskripsi Video -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi Video</label>
                        <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
                    </div>

                    <!-- Upload Foto -->
                    <div class="mb-3">
                        <label for="photo" class="form-label">Foto Thumbnail</label>
                        <input type="file" name="photo" id="photo" class="form-control" required>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-success">Simpan Video</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>