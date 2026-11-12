<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invitation->title }}</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { 
                        navy: '#132A46', 
                        gold: '#C4A47C', 
                        goldHover: '#B38E62',
                        offWhite: '#F8F9FA'
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>
    
    <style>
        body { background-color: #F8F9FA; color: #333; overflow-x: hidden; }
        .font-arabic { font-family: 'Traditional Arabic', 'Scheherazade', serif; font-size: 2.5rem; line-height: 1.5; text-align: center; color: #132A46; margin-bottom: 1rem; }
        
        .fade-in { animation: fadeIn 1.2s ease-in-out forwards; opacity: 0; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

        #main-content { display: none; }
    </style>
</head>
<body class="font-sans antialiased">

@php
    $bgImg = isset($invitation->config['background_image']) ? asset('storage/' . $invitation->config['background_image']) : '';
    $mainPhoto = isset($invitation->config['groom_photo']) ? asset('storage/' . $invitation->config['groom_photo']) : '';
    $fullName = $invitation->config['full_name'] ?? $invitation->title;
    $nickname = $invitation->config['nickname'] ?? '';
    $age = $invitation->config['age'] ?? '';
@endphp

    <!-- WELCOME SCREEN -->
    <div id="welcome-screen" class="fixed inset-0 z-50 flex flex-col items-center justify-center transition-opacity duration-1000 overflow-hidden"
         style="background-image: url('{{ $bgImg }}'); background-size: cover; background-position: center;">
         
        <div class="absolute inset-0 bg-navy/85 backdrop-blur-sm"></div>

        <div class="relative z-10 text-center px-6 max-w-md w-full fade-in">
            <p class="text-gold tracking-[0.3em] uppercase text-xs mb-4">The Celebration Of</p>
            <h1 class="text-4xl md:text-5xl font-serif text-white mb-6 leading-tight">{{ $invitation->title }}</h1>
            
            @if($mainPhoto)
                <img src="{{ $mainPhoto }}" class="w-36 h-36 object-cover rounded-full mx-auto border-4 border-gold shadow-2xl mb-8">
            @endif

            <p class="text-gray-300 text-sm mb-1">Kepada Yth,</p>
            <h2 class="text-xl font-serif text-white mb-8 border-b border-gold/50 pb-4 inline-block px-8">
                @if($guest) {{ $guest->name }} @else Bapak/Ibu/Saudara/i @endif
            </h2>

            <button onclick="openInvitation()" class="px-8 py-3 bg-gold text-navy font-bold rounded-full hover:bg-goldHover transition shadow-[0_0_15px_rgba(196,164,124,0.4)] flex items-center justify-center gap-2 mx-auto w-full md:w-auto">
                <i class="fa-solid fa-envelope-open-text"></i> Buka Undangan
            </button>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div id="main-content" class="w-full min-h-screen relative pb-16">
        
        <!-- HERO SECTION -->
        <section class="relative h-[60vh] flex flex-col items-center justify-center text-center px-6 overflow-hidden" 
                 style="background-image: url('{{ $bgImg }}'); background-size: cover; background-position: center;">
            <div class="absolute inset-0 bg-navy/70"></div>
            
            <div class="relative z-10">
                <h1 class="text-3xl md:text-5xl font-serif text-white drop-shadow-lg mb-4">{{ $invitation->title }}</h1>
                <div class="w-16 h-1 bg-gold mx-auto mb-4"></div>
                <p class="text-xl font-serif text-gold italic">
                    {{ \Carbon\Carbon::parse($invitation->event_date)->translatedFormat('d F Y') }}
                </p>
            </div>
        </section>

        <!-- Konten Utama -->
        <div class="max-w-xl mx-auto px-5 space-y-10 -mt-12 relative z-20">
            
            <!-- COUNTDOWN -->
            <section class="bg-white rounded-2xl p-6 shadow-xl border border-gold/30 text-center">
                <h3 class="font-serif text-2xl text-navy mb-4">Menuju Hari Bahagia</h3>
                <div class="flex justify-center gap-2 md:gap-4">
                    <div class="bg-offWhite p-2 md:p-3 rounded-lg border border-gray-100 w-16 md:w-20">
                        <span id="days" class="block text-xl md:text-2xl font-bold text-navy">00</span>
                        <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Hari</span>
                    </div>
                    <div class="bg-offWhite p-2 md:p-3 rounded-lg border border-gray-100 w-16 md:w-20">
                        <span id="hours" class="block text-xl md:text-2xl font-bold text-navy">00</span>
                        <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Jam</span>
                    </div>
                    <div class="bg-offWhite p-2 md:p-3 rounded-lg border border-gray-100 w-16 md:w-20">
                        <span id="minutes" class="block text-xl md:text-2xl font-bold text-navy">00</span>
                        <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Menit</span>
                    </div>
                    <div class="bg-offWhite p-2 md:p-3 rounded-lg border border-gray-100 w-16 md:w-20">
                        <span id="seconds" class="block text-xl md:text-2xl font-bold text-navy">00</span>
                        <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Detik</span>
                    </div>
                </div>
            </section>

            <!-- KATA PENGANTAR / AYAT -->
            @if(!empty($invitation->config['opening_greeting']) || !empty($invitation->config['quran_verse']))
            <section class="text-center bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                @if(!empty($invitation->config['opening_greeting']))
                    <div class="mb-6">
                        <p class="font-arabic">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ</p>
                        <p class="font-serif text-lg text-gray-700 leading-relaxed whitespace-pre-line">{{ $invitation->config['opening_greeting'] }}</p>
                    </div>
                @endif
                @if(!empty($invitation->config['quran_verse']))
                    <div class="bg-offWhite p-5 rounded-xl border-l-4 border-gold italic text-gray-600 text-sm whitespace-pre-line text-left">
                        "{{ $invitation->config['quran_verse'] }}"
                    </div>
                @endif
            </section>
            @endif

            <!-- CERITA / KISAH -->
            @if(!empty($invitation->config['love_story']))
            <section class="text-center bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <h2 class="font-serif text-2xl text-navy mb-4">Tentang Acara Ini</h2>
                <div class="w-10 h-[2px] bg-gold mx-auto mb-4"></div>
                <p class="text-sm leading-relaxed text-gray-600 whitespace-pre-line">{{ $invitation->config['love_story'] }}</p>
            </section>
            @endif

            <!-- DETAIL ACARA -->
            @if(!empty($invitation->config['event_1_name']) || !empty($invitation->config['event_2_name']))
            <section class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 text-center">
                <h2 class="font-serif text-2xl text-navy mb-6">Detail Acara</h2>
                <div class="w-10 h-[2px] bg-gold mx-auto mb-8"></div>
                
                <div class="space-y-6 mb-8">
                    @if(!empty($invitation->config['event_1_name']))
                    <div>
                        <h3 class="font-serif text-xl text-navy mb-1">{{ $invitation->config['event_1_name'] }}</h3>
                        <p class="text-sm font-semibold text-gray-500 tracking-wide">{{ $invitation->config['event_1_time'] }}</p>
                    </div>
                    @endif

                    @if(!empty($invitation->config['event_2_name']))
                    <div class="pt-6 border-t border-gray-100">
                        <h3 class="font-serif text-xl text-navy mb-1">{{ $invitation->config['event_2_name'] }}</h3>
                        <p class="text-sm font-semibold text-gray-500 tracking-wide">{{ $invitation->config['event_2_time'] }}</p>
                    </div>
                    @endif
                </div>

                <!-- Dress Code -->
                @if(!empty($invitation->config['dress_code']))
                <div class="mb-8 bg-offWhite p-5 rounded-xl border border-gray-100">
                    <p class="text-xs text-gray-500 mb-3 uppercase tracking-widest">Dress Code</p>
                    @if(isset($invitation->config['dress_code_colors']) && count($invitation->config['dress_code_colors']) > 0)
                    <div class="flex justify-center gap-2 mb-3">
                        @foreach($invitation->config['dress_code_colors'] as $index => $color)
                            <div class="w-8 h-8 rounded-full border border-gray-300 shadow-sm" style="background-color: {{ $color }}; margin-left: {{ $index > 0 ? '-8px' : '0' }};"></div>
                        @endforeach
                    </div>
                    @endif
                    <p class="text-sm font-bold text-navy">{{ $invitation->config['dress_code'] }}</p>
                </div>
                @endif

                <!-- Maps -->
                @if(!empty($invitation->config['maps_link']))
                <div class="mt-4">
                    <a href="{{ $invitation->config['maps_link'] }}" target="_blank" class="inline-flex items-center gap-2 bg-navy text-white px-6 py-3 rounded-full font-semibold text-sm hover:bg-gray-900 transition shadow-md">
                        <i class="fa-solid fa-location-dot text-gold"></i> Lihat Lokasi
                    </a>
                    @if(!empty($invitation->config['maps_address']))
                        <p class="text-xs text-gray-500 mt-3 leading-relaxed">{{ $invitation->config['maps_address'] }}</p>
                    @endif
                </div>
                @endif
            </section>
            @endif

            <!-- GALERI -->
            @if(isset($invitation->config['gallery_images']) && count($invitation->config['gallery_images']) > 0)
            <section class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="font-serif text-2xl text-navy text-center mb-6">Momen Berharga</h3>
                <div class="w-10 h-[2px] bg-gold mx-auto mb-6"></div>
                <div class="grid grid-cols-2 gap-3">
                    @foreach($invitation->config['gallery_images'] as $index => $img)
                        @php
                            $desc = isset($invitation->config['gallery_descriptions'][$index]) && !empty($invitation->config['gallery_descriptions'][$index]) 
                                    ? $invitation->config['gallery_descriptions'][$index] 
                                    : 'Momen ' . sprintf('%02d', $index + 1);
                        @endphp
                        <div class="group relative overflow-hidden rounded-lg aspect-square shadow-sm cursor-pointer">
                            <img src="{{ asset('storage/' . $img) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            <div class="absolute inset-x-0 bottom-0 bg-navy/80 p-2 text-center opacity-0 group-hover:opacity-100 transition duration-300">
                                <p class="text-[10px] text-white font-serif italic">{{ $desc }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            @endif

            <!-- RSVP & UCAPAN -->
            <section class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="font-serif text-2xl text-navy text-center mb-6">Buku Tamu</h3>
                <div class="w-10 h-[2px] bg-gold mx-auto mb-6"></div>
                
                @if(session('message_success'))
                    <div class="bg-green-50 text-green-700 border border-green-200 p-3 rounded-lg mb-4 text-center text-xs font-bold">{{ session('message_success') }}</div>
                @endif
                @if(session('rsvp_success'))
                    <div class="bg-green-50 text-green-700 border border-green-200 p-3 rounded-lg mb-4 text-center text-xs font-bold">{{ session('rsvp_success') }}</div>
                @endif

                <!-- RSVP Buttons -->
                @if($guest)
                <form action="{{ route('guests.rsvp', $invitation->id) }}" method="POST" class="flex gap-2 mb-6">
                    @csrf
                    <input type="hidden" name="guest_code" value="{{ $guest->unique_code }}">
                    <button type="submit" name="status" value="hadir" class="flex-1 py-2.5 bg-navy text-white rounded-lg font-semibold text-sm hover:bg-gray-900 transition">Hadir</button>
                    <button type="submit" name="status" value="tidak_hadir" class="flex-1 py-2.5 bg-gray-200 text-gray-700 rounded-lg font-semibold text-sm hover:bg-gray-300 transition">Tidak Hadir</button>
                </form>
                @endif

                <form action="{{ route('messages.store', $invitation->id) }}" method="POST" class="space-y-4 mb-8">
                    @csrf
                    <input type="text" name="name" class="w-full bg-offWhite border border-gray-200 p-3 rounded-lg focus:border-gold focus:outline-none text-sm" placeholder="Nama Anda" value="{{ $guest->name ?? '' }}" required>
                    <textarea name="message" rows="3" class="w-full bg-offWhite border border-gray-200 p-3 rounded-lg focus:border-gold focus:outline-none text-sm" placeholder="Tuliskan doa & ucapan..." required></textarea>
                    <button type="submit" class="w-full bg-gold text-navy font-bold py-3 rounded-lg hover:bg-goldHover transition">Kirim Ucapan</button>
                </form>

                <div class="space-y-3 max-h-60 overflow-y-auto pr-2">
                    @forelse($messages as $msg)
                        <div class="bg-offWhite p-4 rounded-lg border border-gray-100">
                            <div class="flex justify-between items-center mb-1">
                                <h4 class="font-bold text-navy text-sm">{{ $msg->name }}</h4>
                                <span class="text-[10px] text-gray-400">{{ $msg->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-600 text-sm">{{ $msg->message }}</p>
                        </div>
                    @empty
                        <p class="text-center text-gray-400 text-sm italic py-4">Belum ada ucapan.</p>
                    @endforelse
                </div>
            </section>

            <!-- FOOTER -->
            <div class="text-center pt-8 pb-4">
                <p class="text-xs text-gray-500 uppercase tracking-widest mb-1">Warm Regards,</p>
                <p class="font-serif text-2xl text-navy">{{ $fullName }}</p>
                @if($nickname)
                    <p class="text-sm text-gray-500">({{ $nickname }})</p>
                @endif
            </div>

        </div>
    </div>

    <!-- TOMBOL MUSIK MELAYANG -->
    <button id="music-btn" class="fixed bottom-6 right-6 w-12 h-12 bg-navy text-gold border border-gold/50 rounded-full flex items-center justify-center shadow-lg z-[100] hover:scale-110 transition hidden">
        <svg id="music-icon-play" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
        <svg id="music-icon-pause" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
    </button>

    <!-- AUDIO SOURCE -->
    <audio id="bg-music" loop>
        @if(isset($invitation->config['music_file']))
            <source src="{{ asset('storage/' . $invitation->config['music_file']) }}" type="audio/mpeg">
        @else
            <source src="https://cdn.pixabay.com/download/audio/2022/01/18/audio_d0c6ff1bab.mp3?filename=happy-birthday-114363.mp3" type="audio/mpeg">
        @endif
    </audio>

    <script>
        const music = document.getElementById('bg-music');
        const musicBtn = document.getElementById('music-btn');
        const pauseIcon = document.getElementById('music-icon-pause');
        const playIcon = document.getElementById('music-icon-play');

        function openInvitation() {
            const welcome = document.getElementById('welcome-screen');
            const main = document.getElementById('main-content');
            
            welcome.style.opacity = '0';
            setTimeout(() => {
                welcome.style.display = 'none';
                main.style.display = 'block';
                main.classList.add('fade-in');
                
                musicBtn.classList.remove('hidden');
                music.play().then(() => {
                    pauseIcon.classList.remove('hidden');
                }).catch(() => {
                    playIcon.classList.remove('hidden');
                });
            }, 800);
        }

        musicBtn.addEventListener('click', () => {
            if (music.paused) {
                music.play();
                pauseIcon.classList.remove('hidden');
                playIcon.classList.add('hidden');
            } else {
                music.pause();
                pauseIcon.classList.add('hidden');
                playIcon.classList.remove('hidden');
            }
        });

        // Countdown Timer
        const targetDate = new Date("{{ \Carbon\Carbon::parse($invitation->event_date)->toIso8601String() }}").getTime();
        setInterval(function() {
            const now = new Date().getTime();
            const distance = targetDate - now;
            
            if (distance < 0) {
                document.getElementById("days").innerText = '00';
                document.getElementById("hours").innerText = '00';
                document.getElementById("minutes").innerText = '00';
                document.getElementById("seconds").innerText = '00';
                return;
            }
            
            document.getElementById("days").innerText = String(Math.floor(distance / (1000 * 60 * 60 * 24))).padStart(2, '0');
            document.getElementById("hours").innerText = String(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
            document.getElementById("minutes").innerText = String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
            document.getElementById("seconds").innerText = String(Math.floor((distance % (1000 * 60)) / 1000)).padStart(2, '0');
        }, 1000);
    </script>
</body>
</html>