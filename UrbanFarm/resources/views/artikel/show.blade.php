<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Artikel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-white text-gray-800">
<div class="max-w-4xl mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-3xl font-bold text-green-600">Detail Artikel</h1>
        <a href="{{ route('artikel.index') }}" class="text-white bg-green-500 hover:bg-green-600 font-medium px-4 py-2 rounded">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Artikel
        </a>
    </div>

    <!-- Article Detail -->
    <div class="bg-green-50 shadow rounded-lg overflow-hidden">
        <div class="p-4 text-center">
            <!-- Image Section -->
            <img src="{{ asset('storage/' . $artikel->photo) }}" alt="Foto Artikel" class="w-full max-w-md mx-auto rounded-lg mb-4">
            <!-- Title -->
            <h2 class="text-2xl font-bold text-green-600 mb-2">{{ $artikel->tittle }}</h2>
            <!-- Publication Date -->
            <p class="text-gray-500 mb-4"><i class="fas fa-calendar-alt"></i> Dipublikasikan pada: {{ $artikel->created_at->format('d M Y') }}</p>
            <hr class="my-4">
            <!-- Content -->
            <p class="text-base leading-relaxed text-gray-700 text-left">{{ $artikel->text }}</p>
        </div>
    </div>
</div>
</body>
</html>
