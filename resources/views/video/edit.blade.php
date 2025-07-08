<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Video</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding-top: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #4caf50;
            border-color: #4caf50;
        }
        .btn-primary:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="text-center mb-4">Edit Video</h2>
            <form action="{{ route('video.update', $video->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Method spoofing untuk PUT request -->

                <!-- Judul Video -->
                <div class="mb-3">
                    <label for="title" class="form-label">Judul Video</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $video->title) }}" >
                </div>

                <!-- Foto Thumbnail -->
                <div class="mb-3">
                    <label for="photo" class="form-label">Foto Thumbnail</label>
                    <input type="file" name="photo" id="photo" class="form-control">
                    @if($video->photo)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $video->photo) }}" alt="Thumbnail" width="100" class="rounded">
                        </div>
                    @endif
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $video->description) }}</textarea>
                </div>

                <!-- Tombol -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('video.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
