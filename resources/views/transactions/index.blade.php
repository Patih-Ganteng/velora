<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi - Velora</title>
    
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
            <a href="{{ route('invitations.index') }}" class="nav-item flex items-center gap-4 px-4 py-3 rounded-xl text-gray-300 transition">
                <i class="fa-solid fa-envelope-open-text text-lg w-6 text-center"></i>
                <span class="font-medium">Undangan</span>
            </a>
            <a href="{{ route('transactions.index') }}" class="nav-active flex items-center gap-4 px-4 py-3 rounded-xl transition">
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
        <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-8 flex-shrink-0">
            <h2 class="text-2xl font-bold text-[#132A46]">Riwayat Transaksi</h2>
            <div class="w-10 h-10 rounded-lg bg-[#132A46] text-[#C4A47C] border border-[#C4A47C]/50 flex items-center justify-center font-bold text-lg uppercase cursor-pointer">
                {{ substr(auth()->user()->name, 0, 2) }}
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8">
            <div class="max-w-5xl mx-auto">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200 text-sm text-gray-600">
                                <th class="p-4 font-semibold">Tanggal</th>
                                <th class="p-4 font-semibold">Paket</th>
                                <th class="p-4 font-semibold">Total Harga</th>
                                <th class="p-4 font-semibold">Status</th>
                                <th class="p-4 font-semibold">Metode</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $trx)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                <td class="p-4 text-sm text-gray-600">{{ $trx->created_at->format('d M Y, H:i') }}</td>
                                <td class="p-4 font-semibold text-[#132A46]">{{ $trx->plan->name ?? 'Paket Gratis' }}</td>
                                <td class="p-4 text-sm font-bold text-gray-800">Rp {{ number_format($trx->amount, 0, ',', '.') }}</td>
                                <td class="p-4">
                                    @if($trx->status === 'paid')
                                        <span class="bg-green-100 text-green-700 text-xs font-bold px-2 py-1 rounded-full">Lunas</span>
                                    @else
                                        <span class="bg-yellow-100 text-yellow-700 text-xs font-bold px-2 py-1 rounded-full">Pending</span>
                                    @endif
                                </td>
                                <td class="p-4 text-sm uppercase text-gray-600">{{ $trx->payment_method ?? 'Voucher' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-gray-500">
                                    <i class="fa-solid fa-receipt text-4xl text-gray-300 mb-3 block"></i>
                                    Belum ada riwayat transaksi. <br> Silakan pilih paket untuk memulai.
                                    <a href="{{ route('plans.index') }}" class="text-[#C4A47C] font-bold hover:underline mt-2 block">Lihat Paket</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>