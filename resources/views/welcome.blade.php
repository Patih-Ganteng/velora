<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Velora - Digital Invitation</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Cinzel:wght@600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-luxury { font-family: 'Cinzel', serif; }
        
        /* Background Navy Gelap */
        .bg-navy { background-color: #132A46; }
        
        /* Efek Kaca Mewah */
        .glass-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(196, 164, 124, 0.3);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .btn-gold {
            background: linear-gradient(135deg, #C4A47C, #D4B692);
            color: #132A46;
        }
        .btn-gold:hover {
            background: linear-gradient(135deg, #B38E62, #C4A47C);
        }
    </style>
</head>
<body class="bg-navy min-h-screen flex items-center justify-center p-6 relative overflow-hidden">

    <!-- Ornamen Emas di Background -->
    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-[#C4A47C]/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-[#C4A47C]/10 rounded-full blur-3xl"></div>

    <div class="glass-card w-full max-w-md rounded-3xl p-8 md:p-10 relative z-10 text-center">
        
        <!-- LOGO VELORA -->
        <img src="{{ asset('images/logo.png') }}" alt="Velora Logo" class="w-48 mx-auto mb-6">

        @auth
            <div class="mb-8 mt-4">
                <div class="w-20 h-20 bg-[#132A46] text-[#C4A47C] text-2xl font-luxury font-bold rounded-full flex items-center justify-center mx-auto mb-4 border-2 border-[#C4A47C] shadow-lg uppercase">
                    {{ substr(auth()->user()->name, 0, 2) }}
                </div>
                <h2 class="text-xl text-gray-500">Selamat Datang,</h2>
                <h3 class="text-2xl text-[#132A46] font-semibold">{{ auth()->user()->name }}!</h3>
            </div>
            
            <a href="{{ route('dashboard') }}" class="flex items-center justify-center w-full py-3.5 btn-gold font-semibold rounded-xl transition-all shadow-lg transform hover:-translate-y-1">
                Masuk ke Dashboard
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
            </a>

            <form action="{{ route('logout') }}" method="POST" class="mt-5">
                @csrf
                <button type="submit" class="text-sm text-gray-400 hover:text-red-500 transition">
                    Keluar / Ganti Akun
                </button>
            </form>

        @else
            <div class="mb-8 mt-4">
                <h2 class="text-2xl font-luxury text-[#132A46] mb-2">Welcome</h2>
                <p class="text-gray-500 text-sm">Silakan masuk untuk mulai membuat undangan digital impianmu.</p>
            </div>

            <a href="{{ route('google.redirect') }}" class="flex items-center justify-center gap-3 w-full py-3.5 bg-[#132A46] hover:bg-[#0d1d30] text-white font-semibold rounded-xl transition-all shadow-lg transform hover:-translate-y-1 border border-[#C4A47C]/50">
                <svg class="w-6 h-6 bg-white rounded-full p-1" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                Masuk dengan Google
            </a>
        @endauth

        <p class="mt-10 text-xs text-gray-400">
            &copy; {{ date('Y') }} Velora. All rights reserved.
        </p>
    </div>
</body>
</html>