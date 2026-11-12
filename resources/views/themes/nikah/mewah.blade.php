<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invitation->title }}</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Sacramento&family=Josefin+Sans:wght@300;400&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { gold: '#d4af37', dark: '#0f0f0f', light: '#fdfbf7' },
                    fontFamily: {
                        serif: ['Playfair Display', 'serif'],
                        script: ['Sacramento', 'cursive'],
                        sans: ['Josefin Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <style>
        body { background-color: #0f0f0f; color: #d4af37; overflow-x: hidden; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0f0f0f; }
        ::-webkit-scrollbar-thumb { background: #d4af37; border-radius: 4px; }

        .fade-in { animation: fadeIn 1.5s ease-in-out forwards; opacity: 0; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

        #main-content { display: none; }
        .font-arabic { font-family: 'Traditional Arabic', 'Scheherazade', serif; font-size: 2.5rem; line-height: 1.5; text-align: center; color: #d4af37; margin-bottom: 1rem; }
    </style>
</head>
<body class="font-sans antialiased">

@php
    $bgImg = isset($invitation->config['background_image']) ? asset('storage/' . $invitation->config['background_image']) : '';
@endphp

    <!-- ================= LOADING SCREEN ================= -->
    <div id="loading-screen" class="fixed inset-0 z-[100] flex flex-col items-center justify-center bg-dark transition-opacity duration-1000">
        <div class="w-12 h-12 border-4 border-gold border-t-transparent rounded-full animate-spin mb-4"></div>
        <p class="font-serif text-gold tracking-widest text-sm uppercase">Menyiapkan Undangan...</p>
    </div>

    <!-- ================= WELCOME SCREEN ================= -->
    <div id="welcome-screen" class="fixed inset-0 z-[90] flex-col items-center justify-center bg-dark transition-opacity duration-1000 hidden" 
         style="background-image: url('{{ $bgImg }}'); background-size: cover; background-position: center;">
        <div class="absolute inset-0 bg-black/70"></div>
        
        <div class="relative z-10 text-center px-6 fade-in flex flex-col items-center">
            <p class="text-gold uppercase tracking-[0.3em] text-sm mb-6">The Wedding Of</p>
            
            <div class="flex items-center justify-center gap-4 mb-6">
                @if(isset($invitation->config['groom_photo']))
                    <img src="{{ asset('storage/' . $invitation->config['groom_photo']) }}" class="w-24 h-24 md:w-32 md:h-32 object-cover rounded-full border-2 border-gold shadow-[0_0_15px_rgba(212,175,55,0.4)]">
                @endif
                <span class="text-4xl font-script text-gold">&</span>
                @if(isset($invitation->config['bride_photo']))
                    <img src="{{ asset('storage/' . $invitation->config['bride_photo']) }}" class="w-24 h-24 md:w-32 md:h-32 object-cover rounded-full border-2 border-gold shadow-[0_0_15px_rgba(212,175,55,0.4)]">
                @endif
            </div>

            <h1 class="text-5xl md:text-6xl font-script text-white mb-8">{{ $invitation->title }}</h1>

            <p class="text-gray-300 mb-2">Kepada Yth,</p>
            <h2 class="text-2xl font-serif text-white mb-8">
                @if($guest) {{ $guest->name }} @else Bapak/Ibu/Saudara/i @endif
            </h2>

            <button onclick="openInvitation()" class="px-8 py-3 bg-gold text-dark font-bold rounded-full hover:bg-yellow-600 transition shadow-lg flex items-center gap-2">
                Buka Undangan
            </button>
        </div>
    </div>

    <!-- ================= MAIN CONTENT ================= -->
    <div id="main-content" class="w-full min-h-screen flex flex-col md:flex-row">
        
        <!-- KIRI: Desktop Fixed Background -->
        <div class="hidden md:flex md:w-1/2 h-screen sticky top-0 flex-col items-center justify-center border-r border-gold/30 relative"
             style="background-image: url('{{ $bgImg }}'); background-size: cover; background-position: center;">
            <div class="absolute inset-0 bg-black/60"></div>
            <div class="relative z-10 text-center fade-in">
                <h2 class="text-4xl font-script text-gold mb-4">{{ $invitation->title }}</h2>
                <p class="text-white text-lg tracking-wider">{{ \Carbon\Carbon::parse($invitation->event_date)->translatedFormat('d F Y') }}</p>
            </div>
        </div>

        <!-- KANAN: Konten Utama -->
        <div class="w-full md:w-1/2 bg-light text-gray-800 relative pb-20 md:pb-0">
            
            <!-- Hero Section (Mobile Only) -->
            <div class="md:hidden h-screen flex flex-col items-center justify-center text-center p-8 relative"
                 style="background-image: url('{{ $bgImg }}'); background-size: cover; background-position: center;">
                <div class="absolute inset-0 bg-black/60"></div>
                <div class="relative z-10 flex flex-col items-center">
                    <p class="text-gold uppercase tracking-[0.3em] text-xs mb-2">The Wedding Of</p>
                    
                    <div class="flex items-center justify-center gap-3 mb-4 mt-4">
                        @if(isset($invitation->config['groom_photo']))
                            <img src="{{ asset('storage/' . $invitation->config['groom_photo']) }}" class="w-20 h-20 object-cover rounded-full border-2 border-gold">
                        @endif
                        <span class="text-3xl font-script text-gold">&</span>
                        @if(isset($invitation->config['bride_photo']))
                            <img src="{{ asset('storage/' . $invitation->config['bride_photo']) }}" class="w-20 h-20 object-cover rounded-full border-2 border-gold">
                        @endif
                    </div>

                    <h1 class="text-4xl font-script text-white mb-4">{{ $invitation->title }}</h1>
                    <p class="text-white text-sm">{{ \Carbon\Carbon::parse($invitation->event_date)->translatedFormat('d F Y') }}</p>
                </div>
            </div>

            <!-- Konten Undangan -->
            <div class="p-6 md:p-12 space-y-16">
                
                <!-- SECTION KATA PENGANTAR & AYAT -->
                @if(!empty($invitation->config['opening_greeting']) || !empty($invitation->config['quran_verse']))
                <section class="text-center border-b border-gold/20 pb-12">
                    @if(!empty($invitation->config['opening_greeting']))
                        <div class="mb-8">
                            <p class="font-arabic">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ</p>
                            <p class="font-serif text-xl md:text-2xl text-dark leading-relaxed whitespace-pre-line">{{ $invitation->config['opening_greeting'] }}</p>
                        </div>
                    @endif

                    @if(!empty($invitation->config['quran_verse']))
                        <div class="bg-white/50 border border-gold/30 p-6 rounded-lg shadow-sm">
                            <p class="text-gray-600 text-sm leading-relaxed whitespace-pre-line italic">{{ $invitation->config['quran_verse'] }}</p>
                        </div>
                    @endif
                </section>
                @endif

                <!-- SECTION KISAH CINTA -->
                @if(!empty($invitation->config['love_story']))
                <section class="text-center border-b border-gold/20 pb-12">
                    <h2 class="text-3xl font-serif text-dark mb-6">Kisah Cinta</h2>
                    <div class="w-12 h-[1px] bg-gold mx-auto mb-6"></div>
                    <p class="text-sm leading-relaxed text-gray-600 whitespace-pre-line">{{ $invitation->config['love_story'] }}</p>
                </section>
                @endif

                <!-- 1. Save The Date (Countdown) -->
                <section id="save-date" class="text-center border-b border-gold/20 pb-12">
                    <h2 class="text-3xl font-serif text-dark mb-6">Save The Date</h2>
                    <p class="text-gray-600 mb-8 leading-relaxed text-sm md:text-base">
                        Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir untuk memberikan doa restu.
                    </p>

                    <div class="flex justify-center gap-2 md:gap-4 mb-8">
                        <div class="bg-white p-2 md:p-3 rounded-lg shadow-sm border border-gold/30 w-16">
                            <span id="days" class="block text-lg md:text-xl font-bold text-gold">00</span>
                            <span class="text-[10px] uppercase text-gray-500">Hari</span>
                        </div>
                        <div class="bg-white p-2 md:p-3 rounded-lg shadow-sm border border-gold/30 w-16">
                            <span id="hours" class="block text-lg md:text-xl font-bold text-gold">00</span>
                            <span class="text-[10px] uppercase text-gray-500">Jam</span>
                        </div>
                        <div class="bg-white p-2 md:p-3 rounded-lg shadow-sm border border-gold/30 w-16">
                            <span id="minutes" class="block text-lg md:text-xl font-bold text-gold">00</span>
                            <span class="text-[10px] uppercase text-gray-500">Menit</span>
                        </div>
                        <div class="bg-white p-2 md:p-3 rounded-lg shadow-sm border border-gold/30 w-16">
                            <span id="seconds" class="block text-lg md:text-xl font-bold text-gold">00</span>
                            <span class="text-[10px] uppercase text-gray-500">Detik</span>
                        </div>
                    </div>
                </section>

                <!-- SECTION JADWAL ACARA & MAPS -->
                @if(!empty($invitation->config['event_1_name']) || !empty($invitation->config['event_2_name']))
                <section class="text-center border-b border-gold/20 pb-12">
                    <p class="text-sm mb-8 text-gray-600">InsyaAllah kami akan menyelenggarakan acara:</p>
                    
                    <div class="space-y-8 mb-10">
                        @if(!empty($invitation->config['event_1_name']))
                        <div>
                            <h3 class="font-serif text-3xl text-dark mb-2">{{ $invitation->config['event_1_name'] }}</h3>
                            <p class="text-sm font-bold text-gray-500">{{ $invitation->config['event_1_time'] }}</p>
                        </div>
                        @endif

                        @if(!empty($invitation->config['event_2_name']))
                        <div>
                            <h3 class="font-serif text-3xl text-dark mb-2">{{ $invitation->config['event_2_name'] }}</h3>
                            <p class="text-sm font-bold text-gray-500">{{ $invitation->config['event_2_time'] }}</p>
                        </div>
                        @endif
                    </div>

                    <!-- DRESS CODE DINAMIS -->
                    @if(!empty($invitation->config['dress_code']))
                    <div class="mb-10 bg-white/50 p-6 rounded-lg border border-gold/20">
                        <p class="text-sm text-gray-600 mb-4">Demi kehangatan bersama, kami memohon kesediaan Anda untuk mengenakan dress code berikut:</p>
                        
                        @if(isset($invitation->config['dress_code_colors']) && count($invitation->config['dress_code_colors']) > 0)
                        <div class="flex justify-center gap-2 mb-4">
                            @foreach($invitation->config['dress_code_colors'] as $index => $color)
                                <div class="w-8 h-8 rounded-full border border-gray-300 shadow-sm" style="background-color: {{ $color }}; margin-left: {{ $index > 0 ? '-8px' : '0' }};"></div>
                            @endforeach
                        </div>
                        @endif
                        
                        <p class="text-sm font-bold text-dark">{{ $invitation->config['dress_code'] }}</p>
                    </div>
                    @endif

                    @if(!empty($invitation->config['maps_link']))
                    <div>
                        <a href="{{ $invitation->config['maps_link'] }}" target="_blank" class="inline-flex items-center gap-2 bg-dark text-gold px-6 py-3 rounded-full font-bold text-sm hover:bg-gray-800 transition shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Lihat Google Maps
                        </a>
                        @if(!empty($invitation->config['maps_address']))
                            <p class="text-xs text-gray-500 mt-4 leading-relaxed max-w-sm mx-auto">{{ $invitation->config['maps_address'] }}</p>
                        @endif
                    </div>
                    @endif
                </section>
                @endif

                <!-- 2. GALERI MOMEN BAHAGIA -->
                @if(isset($invitation->config['gallery_images']) && count($invitation->config['gallery_images']) > 0)
                <section id="gallery" class="border-b border-gold/20 pb-12">
                    <h2 class="text-3xl font-serif text-dark text-center mb-6">Momen Bahagia</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach($invitation->config['gallery_images'] as $index => $img)
                            @php
                                $desc = isset($invitation->config['gallery_descriptions'][$index]) && !empty($invitation->config['gallery_descriptions'][$index]) 
                                        ? $invitation->config['gallery_descriptions'][$index] 
                                        : 'Momen ' . sprintf('%02d', $index + 1);
                            @endphp
                            <div class="aspect-square rounded-lg overflow-hidden shadow-sm hover:shadow-md transition duration-300 group cursor-pointer relative">
                                <img src="{{ asset('storage/' . $img) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                <div class="absolute inset-x-0 bottom-0 bg-black/60 p-2 text-center opacity-0 group-hover:opacity-100 transition duration-300">
                                    <p class="text-[10px] text-white font-serif italic">{{ $desc }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
                @endif

                <!-- 3. RSVP Section (ELEGAN) -->
                <section id="rsvp" class="bg-dark p-6 md:p-8 rounded-2xl shadow-[0_0_20px_rgba(212,175,55,0.2)] border border-gold/50 text-center">
                    <h2 class="text-2xl font-serif text-gold mb-2">Konfirmasi Kehadiran</h2>
                    <div class="w-10 h-[1px] bg-gold/50 mx-auto mb-6"></div>
                    
                    @if(session('rsvp_success'))
                        <div class="bg-gold/20 text-gold border border-gold p-3 rounded-lg mb-4 text-sm">{{ session('rsvp_success') }}</div>
                    @endif

                    @if($guest)
                        <p class="text-gray-300 text-sm mb-6">Halo <b>{{ $guest->name }}</b>, berkenan hadir?</p>
                        <form action="{{ route('guests.rsvp', $invitation->id) }}" method="POST" class="flex flex-col md:flex-row justify-center gap-3">
                            @csrf
                            <input type="hidden" name="guest_code" value="{{ $guest->unique_code }}">
                            <button type="submit" name="status" value="hadir" class="px-8 py-3 bg-gold text-dark rounded-full hover:bg-yellow-600 transition w-full md:w-auto font-bold text-sm tracking-wider uppercase shadow-lg">Hadir</button>
                            <button type="submit" name="status" value="tidak_hadir" class="px-8 py-3 bg-gray-800 text-gray-300 border border-gray-600 rounded-full hover:bg-gray-700 transition w-full md:w-auto font-bold text-sm tracking-wider uppercase shadow-lg">Tidak Hadir</button>
                        </form>
                    @else
                        <p class="text-center text-gray-400 text-sm italic">Silakan buka link undangan khusus dari penyelenggara untuk konfirmasi.</p>
                    @endif
                </section>

                <!-- 4. Guestbook Section -->
                <section id="guestbook">
                    <h2 class="text-3xl font-serif text-dark text-center mb-6">Buku Ucapan</h2>

                    @if(session('message_success'))
                        <div class="bg-green-100 text-green-800 p-3 rounded mb-4 text-center text-sm">{{ session('message_success') }}</div>
                    @endif

                    <form action="{{ route('messages.store', $invitation->id) }}" method="POST" class="mb-8 bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                        @csrf
                        <input type="text" name="name" class="w-full border border-gray-300 p-3 rounded-lg mb-3 focus:outline-none focus:border-gold text-sm" placeholder="Nama Anda" required>
                        <textarea name="message" rows="3" class="w-full border border-gray-300 p-3 rounded-lg mb-3 focus:outline-none focus:border-gold text-sm" placeholder="Tuliskan doa dan ucapan..." required></textarea>
                        <button type="submit" class="w-full bg-gold text-dark font-bold py-3 rounded-lg hover:bg-yellow-600 transition text-sm">Kirim Ucapan</button>
                    </form>

                    <div class="space-y-3 max-h-80 overflow-y-auto pr-2">
                        @forelse($messages as $msg)
                            <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                <div class="flex justify-between items-center mb-1">
                                    <h4 class="font-bold text-dark text-sm">{{ $msg->name }}</h4>
                                    <span class="text-[10px] text-gray-400">{{ $msg->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-gray-600 text-sm leading-relaxed">{{ $msg->message }}</p>
                            </div>
                        @empty
                            <p class="text-center text-gray-400 text-sm italic">Belum ada ucapan.</p>
                        @endforelse
                    </div>
                </section>
            </div>

            <!-- Bottom Navbar (Mobile Only) -->
            <div class="md:hidden fixed bottom-0 left-0 w-full bg-dark/95 backdrop-blur-md border-t border-gold/30 text-gold z-40">
                <div class="flex justify-around items-center py-2">
                    <a href="#" onclick="scrollToSection('save-date')" class="flex flex-col items-center p-2 text-xs hover:text-white transition">
                        <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Tanggal
                    </a>
                    @if(isset($invitation->config['gallery_images']) && count($invitation->config['gallery_images']) > 0)
                    <a href="#" onclick="scrollToSection('gallery')" class="flex flex-col items-center p-2 text-xs hover:text-white transition">
                        <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Galeri
                    </a>
                    @endif
                    <a href="#" onclick="scrollToSection('rsvp')" class="flex flex-col items-center p-2 text-xs hover:text-white transition">
                        <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        RSVP
                    </a>
                    <a href="#" onclick="scrollToSection('guestbook')" class="flex flex-col items-center p-2 text-xs hover:text-white transition">
                        <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        Ucapan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- TOMBOL MUSIK MELAYANG -->
    <button id="music-btn" class="fixed bottom-24 md:bottom-8 right-6 w-12 h-12 bg-gold text-dark rounded-full flex items-center justify-center shadow-[0_4px_15px_rgba(212,175,55,0.5)] z-[100] hover:scale-110 transition hidden">
        <svg id="music-icon-play" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
        <svg id="music-icon-pause" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
    </button>

    <!-- AUDIO SOURCE DINAMIS -->
    <audio id="bg-music" loop>
        @if(isset($invitation->config['music_file']))
            <source src="{{ asset('storage/' . $invitation->config['music_file']) }}" type="audio/mpeg">
        @else
            <source src="https://cdn.pixabay.com/download/audio/2022/03/15/audio_c8c8a73467.mp3?filename=wedding-116846.mp3" type="audio/mpeg">
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
                main.style.display = 'flex';
                main.classList.add('fade-in');
                
                // Tampilkan tombol musik dan putar lagu
                musicBtn.classList.remove('hidden');
                music.play().then(() => {
                    pauseIcon.classList.remove('hidden');
                }).catch(() => {
                    playIcon.classList.remove('hidden');
                });
            }, 1000);
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

        function scrollToSection(id) {
            document.getElementById(id).scrollIntoView({ behavior: 'smooth' });
        }

        const targetDate = new Date("{{ \Carbon\Carbon::parse($invitation->event_date)->toIso8601String() }}").getTime();
        const countdown = setInterval(function() {
            const now = new Date().getTime();
            const distance = targetDate - now;

            if (distance < 0) {
                clearInterval(countdown);
                return;
            }

            const d = Math.floor(distance / (1000 * 60 * 60 * 24));
            const h = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const s = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("days").innerText = d < 10 ? "0" + d : d;
            document.getElementById("hours").innerText = h < 10 ? "0" + h : h;
            document.getElementById("minutes").innerText = m < 10 ? "0" + m : m;
            document.getElementById("seconds").innerText = s < 10 ? "0" + s : s;
        }, 1000);

        window.addEventListener('load', () => {
            setTimeout(() => {
                const loader = document.getElementById('loading-screen');
                loader.style.opacity = '0';
                setTimeout(() => {
                    loader.style.display = 'none';
                    document.getElementById('welcome-screen').classList.remove('hidden');
                    document.getElementById('welcome-screen').classList.add('flex');
                }, 1000);
            }, 1000); 
        });
    </script>
</body>
</html>