<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Undangan - Velora</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@7.1.0/css/all.min.css">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #F8F9FA; }
        .sidebar { background-color: #132A46; }
        .nav-active { background-color: #C4A47C; color: #132A46; font-weight: 700; }
        .nav-item:hover { background-color: rgba(196, 164, 124, 0.2); color: #C4A47C; }
    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">

    <!-- SIDEBAR -->
    <aside class="sidebar w-64 flex-shrink-0 flex flex-col text-white hidden md:flex">
        <div class="h-24 flex items-center justify-center border-b border-[#C4A47C]/20 p-4">
            <img src="{{ asset('images/logo.png') }}" alt="Velora Logo" class="h-16 object-contain brightness-0 invert">
        </div>
        <nav class="flex-1 py-6 px-4 space-y-2 overflow-y-auto">
            <a href="{{ route('dashboard') }}" class="nav-item flex items-center gap-4 px-4 py-3 rounded-xl text-gray-300 transition">
                <i class="fa-solid fa-house text-lg w-6 text-center"></i>
                <span class="font-medium">Home</span>
            </a>
            <a href="{{ route('invitations.index') }}" class="nav-active flex items-center gap-4 px-4 py-3 rounded-xl transition">
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
            <h2 class="text-2xl font-bold text-[#132A46]">Daftar Undangan</h2>
            <div class="w-10 h-10 rounded-lg bg-[#132A46] text-[#C4A47C] border border-[#C4A47C]/50 flex items-center justify-center font-bold text-lg uppercase cursor-pointer">
                {{ substr(auth()->user()->name, 0, 2) }}
            </div>
        </header>

        <!-- Scrollable Content -->
        <div class="flex-1 overflow-y-auto p-8">
            <div class="max-w-5xl mx-auto space-y-6">
                
                <!-- Alert Email -->
                <div class="bg-[#FFF8E1] border border-[#FFE082] rounded-xl p-5 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h3 class="font-bold text-[#8D6E63]">Email belum diverifikasi</h3>
                        <p class="text-sm text-[#8D6E63]/80 mt-1">Silakan verifikasi email ({{ auth()->user()->email }}) agar akun Anda tetap aman.</p>
                    </div>
                    <button class="bg-[#FFC107] text-[#8D6E63] font-bold px-4 py-2 rounded-lg text-sm whitespace-nowrap hover:bg-yellow-500 transition">
                        Kirim Ulang Verifikasi
                    </button>
                </div>

                <!-- Search Bar -->
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Search Invitation..." class="w-full bg-white border border-gray-200 rounded-xl py-3 px-4 outline-none focus:ring-2 focus:ring-[#C4A47C] transition shadow-sm text-sm">
                </div>

                <!-- Alert Upgrade -->
                <div class="bg-gray-100 border border-gray-300 rounded-xl p-5 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="flex items-center gap-4">
                        <div>
                            <h3 class="font-bold text-[#132A46]">Kamu masih pakai akun gratisan!</h3>
                        </div>
                    </div>
                    <a href="{{ route('plans.index') }}" class="bg-[#132A46] text-white font-bold px-5 py-2.5 rounded-lg text-sm whitespace-nowrap hover:bg-[#0d1d30] transition shadow-md">
                        <i class="fa-solid fa-gem me-2 text-[#C4A47C]"></i> Upgrade Akun
                    </a>
                </div>

                <!-- LIST UNDANGAN -->
                <div id="invitationList" class="space-y-4">
                    @forelse($invitations as $inv)
                    <div class="invitation-card bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex flex-col md:flex-row items-center justify-between gap-4 transition hover:shadow-md">
                        
                        <!-- Kiri: Icon, Judul, Tanggal, Statistik -->
                        <div class="flex items-start gap-5 w-full md:w-auto">
                            <div class="w-16 h-16 bg-[#132A46]/10 rounded-xl flex items-center justify-center flex-shrink-0 text-[#C4A47C] text-2xl mt-1">
                                <i class="fa-solid fa-heart"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg text-[#132A46] search-title">{{ $inv->title }}</h3>
                                <p class="text-sm text-gray-500 mb-3">{{ \Carbon\Carbon::parse($inv->event_date)->translatedFormat('d F Y') }}</p>
                                
                                <!-- STATISTIK BARU -->
                                <div class="flex flex-wrap gap-2 text-[11px] font-semibold">
                                    <span class="bg-blue-50 text-blue-600 px-2.5 py-1 rounded-md border border-blue-100">
                                        <i class="fa-solid fa-eye me-1"></i> {{ $inv->views }} Dilihat
                                    </span>
                                    <span class="bg-green-50 text-green-600 px-2.5 py-1 rounded-md border border-green-100">
                                        <i class="fa-solid fa-check me-1"></i> {{ $inv->hadir_count }} Hadir
                                    </span>
                                    <span class="bg-red-50 text-red-600 px-2.5 py-1 rounded-md border border-red-100">
                                        <i class="fa-solid fa-xmark me-1"></i> {{ $inv->tidak_hadir_count }} Tidak Hadir
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Kanan: Tombol Aksi -->
                        <div class="flex flex-wrap gap-2 w-full md:w-auto justify-end mt-4 md:mt-0">
                            <!-- Tombol Tamu -->
                            <a href="{{ route('invitations.guests', $inv->id) }}" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-200 transition flex items-center gap-2">
                                <i class="fa-solid fa-users"></i> Tamu
                            </a>
                            
                            <!-- Tombol Bagikan -->
                            <button onclick="copyLink('{{ route('invitations.show', $inv->id) }}', this)" class="bg-[#C4A47C] text-[#132A46] px-4 py-2 rounded-lg text-sm font-semibold hover:bg-[#B38E62] transition flex items-center gap-2">
                                <i class="fa-solid fa-share-nodes"></i> Bagikan
                            </button>
                            
                            <!-- Tombol Lihat -->
                            <a href="{{ route('invitations.show', $inv->id) }}" target="_blank" class="bg-[#132A46] text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-[#0d1d30] transition flex items-center gap-2">
                                <i class="fa-solid fa-globe"></i> Lihat
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="bg-white rounded-xl border border-dashed border-gray-300 p-10 text-center">
                        <div class="text-4xl text-gray-300 mb-3"><i class="fa-regular fa-folder-open"></i></div>
                        <h3 class="text-lg font-bold text-gray-600">Belum Ada Undangan</h3>
                        <p class="text-sm text-gray-400 mt-1 mb-4">Kamu belum membuat undangan satupun.</p>
                        <a href="{{ route('invitations.create') }}" class="bg-[#132A46] text-white px-6 py-2 rounded-lg font-semibold hover:bg-[#0d1d30] transition inline-block">
                            Buat Undangan Baru
                        </a>
                    </div>
                    @endforelse
                </div>

                <div class="flex justify-between items-center text-xs text-gray-400 px-2 mt-8 pt-4 border-t border-gray-200">
                    <p>Made with <i class="fa-solid fa-heart text-[#C4A47C]"></i> for your Moment | Powered by Velora</p>
                    <p>Version: 1.0</p>
                </div>

            </div>
        </div>
    </main>

    <!-- SCRIPT SEARCH & COPY LINK -->
    <script>
        // Fitur Pencarian
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let cards = document.querySelectorAll('.invitation-card');

            cards.forEach(function(card) {
                let title = card.querySelector('.search-title').textContent.toLowerCase();
                if (title.includes(filter)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Fitur Bagikan (Copy Link)
        function copyLink(text, btn) {
            navigator.clipboard.writeText(text).then(() => {
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="fa-solid fa-check"></i> Tersalin!';
                
                // Ubah warna jadi hijau sementara
                btn.classList.replace('bg-[#C4A47C]', 'bg-green-500');
                btn.classList.replace('text-[#132A46]', 'text-white');
                
                setTimeout(() => {
                    // Balikin ke warna asli
                    btn.innerHTML = originalText;
                    btn.classList.replace('bg-green-500', 'bg-[#C4A47C]');
                    btn.classList.replace('text-white', 'text-[#132A46]');
                }, 2000);
            }).catch(err => {
                alert('Gagal menyalin link. Pastikan browser mendukung fitur clipboard.');
            });
        }
    </script>
</body>
</html>