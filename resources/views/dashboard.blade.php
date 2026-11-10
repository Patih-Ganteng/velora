<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Velora</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@7.1.0/css/all.min.css">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #F8F9FA; }
        .sidebar { background-color: #2B1220; }
        .nav-active { background-color: #751246; color: white; }
        .nav-item:hover { background-color: rgba(255,255,255,0.1); }
    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">

    <!-- SIDEBAR -->
    <aside class="sidebar w-64 flex-shrink-0 flex flex-col text-white hidden md:flex">
        <!-- Logo -->
        <div class="h-20 flex items-center justify-center border-b border-white/10">
            <h1 class="text-2xl font-bold tracking-widest text-white">Velora<span class="text-pink-400">.</span></h1>
        </div>

        <!-- Menu -->
        <nav class="flex-1 py-6 px-4 space-y-2 overflow-y-auto">
            <a href="{{ route('dashboard') }}" class="nav-active flex items-center gap-4 px-4 py-3 rounded-xl transition">
                <i class="fa-solid fa-house text-lg w-6 text-center"></i>
                <span class="font-medium">Home</span>
            </a>
            <a href="{{ route('invitations.index') }}" class="nav-item flex items-center gap-4 px-4 py-3 rounded-xl text-gray-300 transition">
                <i class="fa-solid fa-envelope-open-text text-lg w-6 text-center"></i>
                <span class="font-medium">Undangan</span>
            </a>
            <!-- LINK TRANSAKSI UDAH DIPERBAIKI 👇 -->
            <a href="{{ route('transactions.index') }}" class="nav-item flex items-center gap-4 px-4 py-3 rounded-xl text-gray-300 transition">
                <i class="fa-solid fa-receipt text-lg w-6 text-center"></i>
                <span class="font-medium">Transaksi</span>
            </a>
            <a href="{{ route('customer-service') }}" class="nav-item flex items-center gap-4 px-4 py-3 rounded-xl text-gray-300 transition">
                <i class="fa-solid fa-headset text-lg w-6 text-center"></i>
                <span class="font-medium">Customer Service</span>
            </a>
        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col h-full overflow-hidden">
        <!-- Header -->
        <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-8 flex-shrink-0">
            <h2 class="text-2xl font-bold text-[#751246]">Dashboard</h2>
            
            <div class="flex items-center gap-4">
                <button class="w-10 h-10 rounded-full bg-pink-100 text-pink-600 flex items-center justify-center hover:bg-pink-200 transition">
                    <i class="fa-solid fa-comment-dots"></i>
                </button>
                <div class="w-10 h-10 rounded-lg bg-[#751246] text-white flex items-center justify-center font-bold text-lg uppercase cursor-pointer">
                    {{ substr(auth()->user()->name, 0, 2) }}
                </div>
            </div>
        </header>

        <!-- Scrollable Content -->
        <div class="flex-1 overflow-y-auto p-8">
            <div class="max-w-5xl mx-auto space-y-6">
                
                <!-- Alert Email Belum Diverifikasi -->
                <div class="bg-[#FFF8E1] border border-[#FFE082] rounded-xl p-5 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h3 class="font-bold text-[#8D6E63]">Email belum diverifikasi</h3>
                        <p class="text-sm text-[#8D6E63]/80 mt-1">Silakan verifikasi email ({{ auth()->user()->email }}) agar akun Anda tetap aman.</p>
                    </div>
                    <button class="bg-[#FFC107] text-[#8D6E63] font-bold px-4 py-2 rounded-lg text-sm whitespace-nowrap hover:bg-yellow-500 transition">
                        Kirim Ulang Verifikasi
                    </button>
                </div>

                <!-- Alert Upgrade Akun -->
                <div class="bg-[#EFEBE9] border border-[#D7CCC8] rounded-xl p-5 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="flex items-start gap-4">
                        <div class="text-3xl text-[#8D6E63] mt-1"><i class="fa-solid fa-stopwatch"></i></div>
                        <div>
                            <h3 class="font-bold text-[#5D4037]">Kamu masih pakai akun gratisan!</h3>
                            <p class="text-sm text-[#8D6E63] mt-1">Segera upgrade ke premium supaya Anda tetap bisa mengakses undangan digital Anda!</p>
                        </div>
                    </div>
                    <a href="{{ route('plans.index') }}" class="bg-[#8D6E63] text-white font-bold px-5 py-2.5 rounded-lg text-sm whitespace-nowrap hover:bg-[#6D4C41] transition">
                        <i class="fa-solid fa-gem me-2"></i> Upgrade Akun
                    </a>
                </div>

                <!-- Kartu Statistik -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 relative">
                    <div class="absolute -top-3 right-6 bg-[#751246] text-white text-xs font-bold px-3 py-1 rounded-full">
                        {{ auth()->user()->plan->name ?? 'Akun Gratisan' }}
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-[#FDF2F8] rounded-lg p-5 border border-[#FCE7F3]">
                            <p class="text-sm font-semibold text-[#BE185D]">Kuota Undangan</p>
                            <h3 class="text-3xl font-bold text-[#9D174D] mt-2">{{ auth()->user()->plan_id == 1 ? '1' : '∞' }}</h3>
                        </div>
                        <div class="bg-[#FDF2F8] rounded-lg p-5 border border-[#FCE7F3]">
                            <p class="text-sm font-semibold text-[#BE185D]">Total Undangan Dibuat</p>
                            <h3 class="text-3xl font-bold text-[#9D174D] mt-2">{{ $invitations->count() }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi Besar -->
                <div class="grid grid-cols-1 gap-4">
                    <a href="{{ route('invitations.create') }}" class="bg-[#A2005D] hover:bg-[#80004A] transition rounded-xl p-6 flex items-center gap-6 text-white shadow-md">
                        <div class="bg-white/20 p-4 rounded-lg text-2xl">
                            <i class="fa-solid fa-envelope-open-text"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold">Buat Undangan Baru</h3>
                            <p class="text-sm text-white/80 mt-1">Buat lagi undangan untuk nikahmu atau temanmu</p>
                        </div>
                    </a>

                    <a href="#" onclick="alert('Fitur Scanner QR akan segera hadir!')" class="bg-[#7B1113] hover:bg-[#5C0C0D] transition rounded-xl p-6 flex items-center gap-6 text-white shadow-md">
                        <div class="bg-white/20 p-4 rounded-lg text-2xl">
                            <i class="fa-solid fa-address-card"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold">Guest Reception</h3>
                            <p class="text-sm text-white/80 mt-1">Layanan penerima tamu dengan buku tamu digital saat hari-H</p>
                        </div>
                    </a>
                </div>

                <!-- List Undangan (Versi Kecil) -->
                <div class="mt-8">
                    <h3 class="font-bold text-lg mb-4 text-gray-700">Undangan Kamu</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @forelse($invitations as $inv)
                        <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex flex-col justify-between">
                            <div>
                                <h4 class="font-bold text-gray-800">{{ $inv->title }}</h4>
                                <p class="text-xs text-gray-500 mb-4">{{ ucfirst($inv->category) }} - {{ $inv->sub_theme }}</p>
                            </div>
                            <div class="flex gap-2 mt-2">
                                <a href="{{ route('invitations.guests', $inv->id) }}" class="flex-1 text-center bg-gray-100 text-gray-700 text-sm font-semibold py-2 rounded-lg hover:bg-gray-200 transition">Tamu</a>
                                <a href="{{ route('invitations.edit', $inv->id) }}" class="flex-1 text-center bg-pink-50 text-pink-600 text-sm font-semibold py-2 rounded-lg hover:bg-pink-100 transition">Edit</a>
                                <a href="{{ route('invitations.show', $inv->id) }}" target="_blank" class="flex-1 text-center bg-[#751246] text-white text-sm font-semibold py-2 rounded-lg hover:bg-[#5a0d35] transition">Lihat</a>
                            </div>
                        </div>
                        @empty
                        <p class="text-gray-500 text-sm">Belum ada undangan.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </main>
</body>
</html>