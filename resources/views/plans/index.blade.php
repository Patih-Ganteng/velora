<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upgrade Paket - Velora</title>
    
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
        <div class="h-20 flex items-center justify-center border-b border-white/10">
            <h1 class="text-2xl font-bold tracking-widest text-white">Velora<span class="text-pink-400">.</span></h1>
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
        <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-8 flex-shrink-0">
            <h2 class="text-2xl font-bold text-[#751246]">Upgrade Paket</h2>
            <div class="w-10 h-10 rounded-lg bg-[#751246] text-white flex items-center justify-center font-bold text-lg uppercase cursor-pointer">
                {{ substr(auth()->user()->name, 0, 2) }}
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8 bg-[#F8F9FA]">
            <div class="max-w-7xl mx-auto">
                
                @if(session('error'))
                    <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6 text-center font-bold border border-red-300 shadow-sm">
                        <i class="fa-solid fa-circle-exclamation me-2"></i> {{ session('error') }}
                    </div>
                @endif
                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6 text-center font-bold border border-green-300 shadow-sm">
                        <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                    </div>
                @endif

                <!-- LOOPING PAKET DARI DATABASE -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 items-end">
                    
                    @foreach($plans as $plan)
                    
                    @php
                        $isFree = ($plan->price == 0);
                        $isPopular = ($plan->name === 'Business'); // Cuma Business yang dapet label
                        $cardClass = $isPopular ? 'border-[#A2005D] shadow-md transform lg:-translate-y-4' : 'border-gray-200';
                        $buttonClass = $isFree ? 'bg-gray-500 hover:bg-gray-600' : 'bg-[#A2005D] hover:bg-[#80004A]';
                    @endphp

                    <div class="bg-white rounded-xl shadow-sm border-2 {{ $cardClass }} p-6 flex flex-col relative overflow-hidden h-full">
                        
                        @if($isPopular)
                            <div class="absolute top-0 left-0 right-0 bg-[#A2005D] text-white text-center text-[10px] font-bold py-1 uppercase tracking-widest">Paling Laris</div>
                        @endif

                        <div class="text-center mb-6 mt-2">
                            <h3 class="text-2xl font-bold text-gray-800">{{ $plan->name }}</h3>
                            <p class="text-xs text-gray-500 mt-1">
                                @if($isFree) Cocok untuk coba-coba
                                @elseif($plan->name == 'Premium') Cocok untuk pasangan individu
                                @elseif($plan->name == 'Business') Cocok untuk bisnis kecil
                                @else Cocok untuk bisnis menengah
                                @endif
                            </p>
                            
                            <div class="mt-4">
                                @if(!$isFree)
                                    <span class="text-gray-400 line-through text-xs">IDR {{ number_format($plan->price * 2, 0, ',', '.') }}</span>
                                    <span class="bg-[#A2005D] text-white text-[10px] font-bold px-2 py-0.5 rounded ml-1">50% OFF</span>
                                @endif
                                <div class="text-3xl font-bold text-[#A2005D] mt-2">
                                    @if($isFree) 
                                        GRATIS
                                    @else
                                        <span class="text-sm font-normal">IDR</span> {{ number_format($plan->price, 0, ',', '.') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <ul class="space-y-3 text-xs text-gray-600 flex-1 mb-6">
                            @foreach($plan->features as $feature)
                                <li class="flex items-start gap-2">
                                    <i class="fa-solid fa-circle-check text-green-500 mt-0.5"></i> 
                                    <span>{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Form Pilih Paket -->
                        <form action="{{ route('plans.store', $plan->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full {{ $buttonClass }} text-white font-bold py-3 rounded-lg transition text-sm">
                                @if(auth()->user()->plan_id == $plan->id)
                                    Paket Saat Ini
                                @elseif($isFree)
                                    Pakai Gratis
                                @else
                                    Pilih {{ $plan->name }}
                                @endif
                            </button>
                        </form>
                    </div>

                    @endforeach

                </div>
            </div>
        </div>
    </main>
</body>
</html>