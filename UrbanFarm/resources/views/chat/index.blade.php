<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* General Styling */
        body {
            background-color: #f9fff7;
            color: #212529;
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
        .table th {
            background-color: #4caf50;
            color: white;
        }
        .table tr:nth-child(even) {
            background-color: #e8f5e9;
        }
        .btn-dark {
            background-color: #388e3c;
        }

        /* Dark Mode */
        body.dark-mode {
            background-color: #121212;
            color: white;
        }
        .navbar.dark-mode {
            background-color: #333;
            box-shadow: 0px 4px 6px rgba(255, 255, 255, 0.1);
        }
        .navbar-dark-mode .navbar-brand,
        .navbar-dark-mode .nav-link {
            color: white !important;
        }
        .navbar-dark-mode .nav-link:hover {
            background-color: #555;
        }
        .table-dark-mode {
            background-color: #444;
        }
        .table-dark-mode th,
        .table-dark-mode td {
            color: black;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg" id="navbar">
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

    <div class="container mt-5">
        <h1 class="text-center mb-4">Daftar Chat</h1>

        <!-- Flash Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Toggle Dark Mode -->
        <div class="d-flex justify-content-end mb-3">
            <button id="darkModeToggle" class="btn btn-secondary">Aktifkan Dark Mode</button>
        </div>

        <!-- Add Chat Button -->
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('chat.create') }}" class="btn btn-success">Tambah Chat</a>
        </div>

        <!-- Chat Table -->
        <table class="table table-striped table-bordered table-dark-mode">
            <thead class="table-dark">
                <tr>
                    <th>Nama Group</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($chat as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>
                            <a href="{{ route('chat.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('chat.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus chat ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data chat.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Check if dark mode is enabled in localStorage
        const isDarkMode = localStorage.getItem('darkMode') === 'true';
        if (isDarkMode) {
            document.getElementById('darkModeToggle').textContent = 'Nonaktifkan Dark Mode';
        }

        // Toggle dark mode on button click
        document.getElementById('darkModeToggle').addEventListener('click', function() {
            const isCurrentlyDark = document.body.classList.contains('dark-mode');
            if (isCurrentlyDark) {
                document.body.classList.remove('dark-mode');
                document.getElementById('navbar').classList.remove('navbar-dark-mode');
                localStorage.setItem('darkMode', 'false');
                this.textContent = 'Aktifkan Dark Mode';
            } else {
                document.body.classList.add('dark-mode');
                document.querySelector('.table').classList.add('table-dark-mode');
                localStorage.setItem('darkMode', 'true');
                this.textContent = 'Nonaktifkan Dark Mode';
            }
        });
    </script>
</body>
</html>
