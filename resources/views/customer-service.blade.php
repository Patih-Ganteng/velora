<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Service - Velora</title>
    
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
            <!-- LINK TRANSAKSI UDAH DIPERBAIKI 👇 -->
            <a href="{{ route('transactions.index') }}" class="nav-item flex items-center gap-4 px-4 py-3 rounded-xl text-gray-300 transition">
                <i class="fa-solid fa-receipt text-lg w-6 text-center"></i>
                <span class="font-medium">Transaksi</span>
            </a>
            <a href="{{ route('customer-service') }}" class="nav-active flex items-center gap-4 px-4 py-3 rounded-xl transition">
                <i class="fa-solid fa-headset text-lg w-6 text-center"></i>
                <span class="font-medium">Customer Service</span>
            </a>
        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col h-full overflow-hidden">
        <!-- Header -->
        <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-8 flex-shrink-0">
            <h2 class="text-2xl font-bold text-[#751246]">Customer Service</h2>
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-[#751246] text-white flex items-center justify-center font-bold text-lg uppercase cursor-pointer">
                    {{ substr(auth()->user()->name, 0, 2) }}
                </div>
            </div>
        </header>

        <!-- Scrollable Content -->
        <div class="flex-1 overflow-y-auto p-8">
            <div class="max-w-5xl mx-auto space-y-6">
                
                <!-- Header Text -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 text-center">
                    <h2 class="text-3xl font-bold text-[#751246] mb-2">Hubungi Kami</h2>
                    <p class="text-gray-500">Segera konsultasikan kepada kami kebutuhan anda. Tim kami akan membantu anda.</p>
                </div>

                <!-- AI Assistant (Placeholder) -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-xl font-bold text-gray-800">Velora Assistant</h3>
                            <span class="bg-green-100 text-green-700 text-xs font-bold px-2 py-1 rounded-full flex items-center gap-1">
                                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> Online
                            </span>
                        </div>
                        <p class="text-gray-500 text-sm">Asisten AI untuk pertanyaan seputar pengelolaan undangan digital Anda.</p>
                    </div>
                    <button class="bg-[#A2005D] text-white font-bold px-6 py-2.5 rounded-full hover:bg-[#80004A] transition whitespace-nowrap">
                        Buka Velora Assistant
                    </button>
                </div>

                <!-- Layanan CS -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-10">
                    <h3 class="text-2xl font-bold text-center text-gray-800 mb-10">Layanan Customer Service</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-center mb-10">
                        <!-- WhatsApp -->
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-green-50 text-green-500 rounded-full flex items-center justify-center text-3xl mb-4">
                                <i class="fa-brands fa-whatsapp"></i>
                            </div>
                            <h4 class="font-bold text-lg text-gray-700 mb-1">WhatsApp</h4>
                            <a href="https://wa.me/627772934456" target="_blank" class="text-[#A2005D] hover:underline font-medium">+62 777 2934 456</a>
                        </div>
                        
                        <!-- Email -->
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-pink-50 text-pink-500 rounded-full flex items-center justify-center text-3xl mb-4">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <h4 class="font-bold text-lg text-gray-700 mb-1">Email</h4>
                            <a href="mailto:support@velora.com" class="text-[#A2005D] hover:underline font-medium">support@velora.com</a>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 pt-8 text-center">
                        <div class="inline-flex items-center gap-2 text-gray-600 mb-2">
                            <i class="fa-regular fa-clock text-lg"></i>
                            <h4 class="font-bold">Jam Operasional</h4>
                        </div>
                        <p class="text-[#A2005D] font-medium text-lg">Setiap Hari</p>
                        <p class="text-gray-500">08.00 - 20.00 WIB</p>
                    </div>
                </div>

                <!-- Footer Version -->
                <div class="flex justify-between items-center text-xs text-gray-400 px-2 mt-4">
                    <p>Made with <i class="fa-solid fa-heart text-red-400"></i> for your Moment | Powered by Velora</p>
                    <p>Version: 1.0</p>
                </div>

            </div>
        </div>
    </main>
</body>
</html>