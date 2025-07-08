<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Growplan</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-5xl">
        <h1 class="text-4xl font-bold text-green-600 mb-8 text-center">Edit Growplan</h1>
        <div class="flex flex-col lg:flex-row justify-between">
            <!-- Form Section -->
            <div class="w-full lg:w-1/2 pr-4">
                <!-- Error Messages -->
                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form for Editing Growplan -->
                <form action="{{ route('growplan.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="customer_id" class="block text-green-600 font-semibold mb-2">Pilih Customer</label>
                        <select id="customer_id" name="customer_id" class="block w-full bg-gray-100 border border-gray-300 rounded py-2 px-3">
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="title" class="block text-green-600 font-semibold mb-2">Nama Growplan</label>
                        <input type="text" id="title" name="title" class="block w-full bg-gray-100 border border-gray-300 rounded py-2 px-3" value="" required>
                    </div>
                    <div class="mb-4">
                        <label for="seed" class="block text-green-600 font-semibold mb-2">Banyaknya Benih</label>
                        <input type="text" id="seed" name="seed" class="block w-full bg-gray-100 border border-gray-300 rounded py-2 px-3" value="" required>
                    </div>
                    <div class="mb-4">
                        <label for="land" class="block text-green-600 font-semibold mb-2">Luas Lahan (m2)</label>
                        <input type="text" id="land" name="land" class="block w-full bg-gray-100 border border-gray-300 rounded py-2 px-3" value="" required>
                    </div>
                    <div class="mb-4">
                        <label for="soil" class="block text-green-600 font-semibold mb-2">Jenis Tanah</label>
                        <input type="text" id="soil" name="soil" class="block w-full bg-gray-100 border border-gray-300 rounded py-2 px-3" value="" required>
                    </div>
                    <div class="mb-4">
                        <label for="tanggal" class="block text-green-600 font-semibold mb-2">Tanggal Mulai</label>
                        <input type="date" id="tanggal" name="tanggal" class="block w-full bg-gray-100 border border-gray-300 rounded py-2 px-3" value="" required>
                    </div>
                    <button type="submit" class="w-full bg-green-600 text-white font-bold py-2 px-4 rounded hover:bg-green-700">Simpan Perubahan</button>
                </form>
            </div>

            <!-- Image Section -->
            <div class="w-full lg:w-1/2 mt-8 lg:mt-0 flex justify-center">
                <img src="{{ asset('image/urbanfarm-logo.png') }}" alt="Foto Produk" style="width: 1000px; height: 580px">
            </div>
        </div>
    </div>
</body>
</html>
