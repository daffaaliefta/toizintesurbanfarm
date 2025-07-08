<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail GrowPlan</title>
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
            <!-- Detail GrowPlan -->
            <div class="bg-white shadow-md p-6 rounded-lg mb-6">
                <h2 class="text-3xl font-semibold text-green-700 mb-4">{{ $growplan->title }}</h2>
                <p class="text-lg text-gray-700 mb-4"><strong>Customer:</strong> {{ $growplan->customer->name }}</p>
                <p class="text-lg text-gray-700 mb-4"><strong>Benih:</strong> {{ $growplan->seed }}</p>
                <p class="text-lg text-gray-700 mb-4"><strong>Tanggal Mulai:</strong> {{ $growplan->tanggal }}</p>

                <!-- Jadwal Penyiraman dan Pemupukan -->
                <h3 class="text-xl font-semibold text-green-600 mb-4">Jadwal Perawatan</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="bg-green-100 p-4 rounded-lg shadow-md">
                        <h4 class="font-semibold text-green-700">Penyiraman</h4>
                        <ul class="list-disc pl-5">
                            @php
                                // Tanggal mulai penyiraman
                                $startDate = \Carbon\Carbon::parse($growplan->tanggal);
                                $wateringDates = [];
                                for ($i = 0; $i < 10; $i++) {
                                    $wateringDates[] = $startDate->addDays(2 * $i)->format('d M Y');
                                }
                            @endphp
                            @foreach($wateringDates as $date)
                                <li class="text-gray-700">{{ $date }}: Penyiraman</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="bg-green-100 p-4 rounded-lg shadow-md">
                        <h4 class="font-semibold text-green-700">Pemupukan</h4>
                        <ul class="list-disc pl-5">
                            @php
                                // Tanggal mulai pemupukan
                                $startDateFertilizer = \Carbon\Carbon::parse($growplan->tanggal);
                                $fertilizingDates = [];
                                for ($i = 0; $i < 10; $i++) {
                                    $fertilizingDates[] = $startDateFertilizer->addDays(7 * $i)->format('d M Y');
                                }
                            @endphp
                            @foreach($fertilizingDates as $date)
                                <li class="text-gray-700">{{ $date }}: Pemupukan</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Kembali ke halaman Growplan -->
            <div class="flex justify-start mb-4">
                <a href="{{ route('growplan.index') }}" class="bg-green-600 text-white p-2 rounded-md">
                    <i class="fas fa-arrow-left"></i> Kembali ke Growplan
                </a>
            </div>
        </main>
    </div>
</body>
</html>
