<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrowPlan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-white">
    <div class="container mx-auto p-4">
        <header class="flex justify-between items-center p-4 border-b">
            <h1 class="text-4xl font-bold text-green-600">
                <a href="/dashboard" class="hover:underline">UrbanFarm</a>
            </h1>
            <nav class="flex space-x-4">
                <a href="{{ route('product.index') }}" class="text-green-600 hover:underline">E-Commerce</a>
                <a href="{{ route('growplan.index') }}" class="text-green-600 hover:underline">Growplan</a>
                <a href="{{ route('chat.index') }}" class="text-green-600 hover:underline">Chat Komunitas</a>
                <a href="{{ route('review.index') }}" class="text-green-600 hover:underline">Review Produk</a>
            </nav>
        </header>
        <main>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-green-700">Kelola Growplan Anda di sini:</h2>
                <a href="{{ route('growplan.create') }}" class="bg-green-700 text-white p-2 rounded-full">
                    <i class="fas fa-plus-circle"></i> Tambah Growplan
                </a>
            </div>

            <!-- Tampilkan pesan sukses -->
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabel Growplan -->
            <div class="overflow-x-auto bg-gray-100 p-4 rounded-lg shadow-md">
                <table class="min-w-full bg-white rounded-lg shadow-md">
                    <thead>
                        <tr class="bg-green-200 text-left">
                            <th class="py-2 px-4">No</th>
                            <th class="py-2 px-4">Nama Growplan</th>
                            <th class="py-2 px-4">Banyak Benih</th>
                            <th class="py-2 px-4">Tanggal Mulai</th>
                            <th class="py-2 px-4">Customer</th>
                            <th class="py-2 px-4">Status</th>
                            <th class="py-2 px-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($growplan as $plan)
                            <tr class="border-t {{ $plan->status == 'active' ? 'bg-green-50' : 'bg-red-50' }}">
                                <td class="py-2 px-4">{{ $loop->iteration }}</td>
                                <td class="py-2 px-4">{{ $plan->title }}</td>
                                <td class="py-2 px-4">{{ $plan->seed }}</td>
                                <td class="py-2 px-4">{{ $plan->tanggal }}</td>
                                <td class="py-2 px-4">{{ $plan->customer->name }}</td>
                                <td class="py-2 px-4">
                                    <span class="inline-block px-3 py-1 rounded-full {{ $plan->status == 'active' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                        {{ ucfirst($plan->status) }}
                                    </span>
                                </td>
                                <td class="py-2 px-4">
                                    <!-- Tombol Aksi -->
                                    <button onclick="openModal({{ $plan->id }})" class="bg-blue-500 text-white px-4 py-2 rounded-md">
                                        <i class="fas fa-cogs"></i> Aksi
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Modal Aksi -->
    <div id="actionModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h3 class="text-xl font-semibold mb-4">Pilih Aksi</h3>
            <div class="space-y-4">
                <a href="#" id="editLink" class="block text-blue-600 hover:underline">Edit Growplan</a>
                <a href="#" id="detailLink" class="block text-green-600 hover:underline">Lihat Detail</a>
                <!-- Tombol Hapus -->
                <button onclick="confirmDelete()" class="block text-red-600 hover:underline">Hapus Growplan</button>
            </div>
            <button onclick="closeModal()" class="mt-4 bg-gray-300 text-gray-700 px-4 py-2 rounded-md">Tutup</button>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteConfirmModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h3 class="text-xl font-semibold text-red-600 mb-4">Konfirmasi Hapus</h3>
            <p class="mb-4">Apakah Anda yakin ingin menghapus growplan ini? Tindakan ini tidak dapat dibatalkan.</p>
            <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeDeleteModal()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md">Batal</button>
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md">Hapus</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let deleteActionUrl = '';

        // Fungsi untuk membuka modal utama
        function openModal(planId) {
            document.getElementById('editLink').href = '/growplan/' + planId + '/edit';
            document.getElementById('detailLink').href = '/growplan/' + planId;
            deleteActionUrl = '/growplan/' + planId;
            document.getElementById('actionModal').classList.remove('hidden');
        }

        // Fungsi untuk menutup modal utama
        function closeModal() {
            document.getElementById('actionModal').classList.add('hidden');
        }

        // Fungsi untuk membuka modal konfirmasi hapus
        function confirmDelete() {
            document.getElementById('deleteForm').action = deleteActionUrl;
            document.getElementById('actionModal').classList.add('hidden');
            document.getElementById('deleteConfirmModal').classList.remove('hidden');
        }

        // Fungsi untuk menutup modal konfirmasi hapus
        function closeDeleteModal() {
            document.getElementById('deleteConfirmModal').classList.add('hidden');
        }
    </script>
</body>
</html>
