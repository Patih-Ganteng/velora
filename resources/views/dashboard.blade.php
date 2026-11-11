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
        /* Warna Sidebar Navy */
        .sidebar { background-color: #132A46; }
        /* Menu Aktif Warna Gold */
        .nav-active { background-color: #C4A47C; color: #132A46; font-weight: 700; }
        .nav-item:hover { background-color: rgba(196, 164, 124, 0.2); color: #C4A47C; }
    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">

    <!-- SIDEBAR -->
    <aside class="sidebar w-64 flex-shrink-0 flex flex-col text-white hidden md:flex">
        <!-- Logo di Sidebar -->
        <div class="h-24 flex items-center justify-center border-b border-[#C4A47C]/20 p-4">
            <img src="{{ asset('images/logo.png') }}" alt="Velora Logo" class="h-16 object-contain brightness-0 invert">
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
            <h2 class="text-2xl font-bold text-[#132A46]">Dashboard</h2>
            
            <div class="flex items-center gap-4">
                <button class="w-10 h-10 rounded-full bg-[#C4A47C]/20 text-[#C4A47C] flex items-center justify-center hover:bg-[#C4A47C]/30 transition">
                    <i class="fa-solid fa-comment-dots"></i>
                </button>
                <div class="w-10 h-10 rounded-lg bg-[#132A46] text-[#C4A47C] flex items-center justify-center font-bold text-lg uppercase cursor-pointer border border-[#C4A47C]/50">
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
                <div class="bg-gray-100 border border-gray-300 rounded-xl p-5 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="flex items-start gap-4">
                        <div class="text-3xl text-[#132A46] mt-1"><i class="fa-solid fa-crown"></i></div>
                        <div>
                            <h3 class="font-bold text-[#132A46]">Kamu masih pakai akun gratisan!</h3>
                            <p class="text-sm text-gray-600 mt-1">Segera upgrade ke premium supaya Anda tetap bisa mengakses undangan digital Anda!</p>
                        </div>
                    </div>
                    <a href="{{ route('plans.index') }}" class="bg-[#132A46] text-white font-bold px-5 py-2.5 rounded-lg text-sm whitespace-nowrap hover:bg-[#0d1d30] transition shadow-md">
                        <i class="fa-solid fa-gem me-2 text-[#C4A47C]"></i> Upgrade Akun
                    </a>
                </div>

                <!-- Kartu Statistik -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 relative">
                    <div class="absolute -top-3 right-6 bg-[#132A46] text-[#C4A47C] text-xs font-bold px-3 py-1 rounded-full border border-[#C4A47C]/30">
                        {{ auth()->user()->plan->name ?? 'Akun Gratisan' }}
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-[#F8F9FA] rounded-lg p-5 border border-[#C4A47C]/30">
                            <p class="text-sm font-semibold text-gray-500">Kuota Undangan</p>
                            <h3 class="text-3xl font-bold text-[#132A46] mt-2">{{ auth()->user()->plan_id == 1 ? '1' : '∞' }}</h3>
                        </div>
                        <div class="bg-[#F8F9FA] rounded-lg p-5 border border-[#C4A47C]/30">
                            <p class="text-sm font-semibold text-gray-500">Total Undangan Dibuat</p>
                            <h3 class="text-3xl font-bold text-[#132A46] mt-2">{{ $invitations->count() }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi Besar -->
                <div class="grid grid-cols-1 gap-4">
                    <a href="{{ route('invitations.create') }}" class="bg-gradient-to-r from-[#C4A47C] to-[#D4B692] hover:opacity-90 transition rounded-xl p-6 flex items-center gap-6 text-[#132A46] shadow-md">
                        <div class="bg-white/30 p-4 rounded-lg text-2xl">
                            <i class="fa-solid fa-envelope-open-text"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold">Buat Undangan Baru</h3>
                            <p class="text-sm font-medium mt-1">Buat lagi undangan untuk nikahmu atau temanmu</p>
                        </div>
                    </a>

                    <a href="#" onclick="alert('Fitur Scanner QR akan segera hadir!')" class="bg-[#132A46] hover:bg-[#0d1d30] transition rounded-xl p-6 flex items-center gap-6 text-white shadow-md">
                        <div class="bg-white/10 p-4 rounded-lg text-2xl text-[#C4A47C]">
                            <i class="fa-solid fa-address-card"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold">Guest Reception</h3>
                            <p class="text-sm text-gray-300 mt-1">Layanan penerima tamu dengan buku tamu digital saat hari-H</p>
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
                                <h4 class="font-bold text-[#132A46]">{{ $inv->title }}</h4>
                                <p class="text-xs text-gray-500 mb-4">{{ ucfirst($inv->category) }} - {{ $inv->sub_theme }}</p>
                            </div>
                            <div class="flex gap-2 mt-2">
                                <a href="{{ route('invitations.guests', $inv->id) }}" class="flex-1 text-center bg-gray-100 text-gray-700 text-sm font-semibold py-2 rounded-lg hover:bg-gray-200 transition">Tamu</a>
                                <a href="{{ route('invitations.edit', $inv->id) }}" class="flex-1 text-center bg-[#C4A47C]/20 text-[#132A46] text-sm font-semibold py-2 rounded-lg hover:bg-[#C4A47C]/40 transition">Edit</a>
                                <a href="{{ route('invitations.show', $inv->id) }}" target="_blank" class="flex-1 text-center bg-[#132A46] text-white text-sm font-semibold py-2 rounded-lg hover:bg-[#0d1d30] transition">Lihat</a>
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