<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invitation->title }}</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;800&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { 
                        partyPink: '#FF8FAB', 
                        partyBlue: '#8FD3FF', 
                        partyYellow: '#FFD166', 
                        partyPurple: '#B9A8FF',
                        partyDark: '#2D2A4A'
                    },
                    fontFamily: {
                        sans: ['Nunito', 'sans-serif'],
                        party: ['Baloo 2', 'cursive'],
                    }
                }
            }
        }
    </script>
    
    <style>
        body { background-color: #FCF8FF; color: #2D2A4A; overflow-x: hidden; }
        
        .balloon { position: absolute; border-radius: 50% 50% 50% 50% / 40% 40% 60% 60%; animation: floatUp 8s linear infinite; opacity: 0.8; pointer-events: none; z-index: 0; }
        .balloon::after { content: ''; position: absolute; bottom: -10px; left: 50%; width: 2px; height: 20px; background: rgba(0,0,0,0.1); transform: translateX(-50%); }
        @keyframes floatUp { 0% { transform: translateY(100vh) rotate(0deg); } 100% { transform: translateY(-20vh) rotate(20deg); } }
        
        .confetti { position: absolute; width: 10px; height: 10px; background-color: #f00; opacity: 0; animation: confettiFall 4s linear infinite; pointer-events: none; z-index: 0; }
        @keyframes confettiFall { 0% { transform: translateY(-10vh) rotate(0deg); opacity: 1; } 100% { transform: translateY(110vh) rotate(720deg); opacity: 0; } }

        .bounce-slow { animation: bounceSlow 3s infinite; }
        @keyframes bounceSlow { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-15px); } }

        .text-shadow-pink { text-shadow: 3px 3px 0 #FFD6E0; }
        #main-content { display: none; }
    </style>
</head>
<body class="font-sans antialiased relative">

@php
    $bgImg = isset($invitation->config['background_image']) ? asset('storage/' . $invitation->config['background_image']) : '';
    $mainPhoto = isset($invitation->config['groom_photo']) ? asset('storage/' . $invitation->config['groom_photo']) : '';
    $fullName = $invitation->config['full_name'] ?? $invitation->title;
    $nickname = $invitation->config['nickname'] ?? '';
@endphp

    <!-- WELCOME SCREEN -->
    <div id="welcome-screen" class="fixed inset-0 z-50 flex flex-col items-center justify-center transition-opacity duration-1000 overflow-hidden"
         style="background-image: url('{{ $bgImg }}'); background-size: cover; background-position: center;">
         
        <div class="absolute inset-0 bg-gradient-to-br from-pink-100/90 via-blue-50/90 to-yellow-100/90"></div>

        <div class="balloon w-16 h-20 bg-partyPink top-10 left-10" style="animation-delay: 0s;"></div>
        <div class="balloon w-12 h-16 bg-partyBlue top-20 right-10" style="animation-delay: 2s;"></div>
        <div class="balloon w-20 h-24 bg-partyYellow bottom-10 left-20" style="animation-delay: 4s;"></div>
        <div class="balloon w-14 h-18 bg-partyPurple bottom-20 right-20" style="animation-delay: 1s;"></div>

        <div class="relative z-20 text-center px-6 max-w-lg w-full bg-white/80 backdrop-blur-md p-8 rounded-3xl shadow-[0_10px_30px_rgba(255,143,171,0.3)] border-4 border-partyPink">
            <p class="text-partyPink font-party font-bold text-xl mb-2 tracking-widest uppercase">You Are Invited!</p>
            <h1 class="text-5xl md:text-6xl font-party font-extrabold text-partyDark mb-6 text-shadow-pink">{{ $invitation->title }}</h1>
            
            <div class="flex justify-center mb-6">
                @if($mainPhoto)
                    <img src="{{ $mainPhoto }}" class="w-32 h-32 object-cover rounded-full border-4 border-partyYellow shadow-lg bounce-slow">
                @endif
            </div>

            <p class="text-gray-600 mb-2 font-semibold">Kepada Yth,</p>
            <h2 class="text-2xl font-party font-bold text-partyDark mb-8">
                @if($guest) {{ $guest->name }} @else Bapak/Ibu/Saudara/i @endif
            </h2>

            <button onclick="openInvitation()" class="px-10 py-4 bg-partyPink text-white font-party font-bold text-lg rounded-full shadow-[0_5px_0_#d94f78] hover:translate-y-1 hover:shadow-[0_2px_0_#d94f78] transition-all">
                Buka Undangan 🎉
            </button>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div id="main-content" class="w-full min-h-screen relative pb-20 overflow-hidden">
        <div id="confetti-container"></div>

        <!-- HERO Section -->
        <section class="relative h-[70vh] flex flex-col items-center justify-center text-center px-6 overflow-hidden" 
                 style="background-image: url('{{ $bgImg }}'); background-size: cover; background-position: center;">
            <div class="absolute inset-0 bg-gradient-to-b from-partyBlue/70 via-transparent to-[#FCF8FF]"></div>
            
            <div class="relative z-10">
                <p class="text-partyPurple font-bold tracking-[0.3em] uppercase mb-2">Let's Celebrate</p>
                <h1 class="text-5xl md:text-7xl font-party font-extrabold text-white drop-shadow-[0_4px_4px_rgba(0,0,0,0.2)] mb-4">{{ $invitation->title }}</h1>
                <p class="text-xl font-party font-bold text-partyDark bg-white/60 inline-block px-6 py-2 rounded-full backdrop-blur-sm">
                    {{ \Carbon\Carbon::parse($invitation->event_date)->translatedFormat('d F Y') }}
                </p>
            </div>
        </section>

        <!-- Konten Utama -->
        <div class="max-w-lg mx-auto px-5 space-y-12 -mt-16 relative z-20">
            
            <!-- COUNTDOWN TIMER -->
            <div class="bg-white rounded-3xl p-6 shadow-xl border-4 border-partyYellow text-center">
                <h3 class="font-party text-2xl text-partyDark mb-4">Menuju Hari Spesial 🎂</h3>
                <div class="flex justify-center gap-2 md:gap-3">
                    <div class="bg-partyPink/10 p-2 rounded-xl w-16">
                        <span id="days" class="block text-2xl font-party font-bold text-partyPink">00</span>
                        <span class="text-[10px] font-bold text-gray-500">HARI</span>
                    </div>
                    <div class="bg-partyBlue/10 p-2 rounded-xl w-16">
                        <span id="hours" class="block text-2xl font-party font-bold text-partyBlue">00</span>
                        <span class="text-[10px] font-bold text-gray-500">JAM</span>
                    </div>
                    <div class="bg-partyPurple/10 p-2 rounded-xl w-16">
                        <span id="minutes" class="block text-2xl font-party font-bold text-partyPurple">00</span>
                        <span class="text-[10px] font-bold text-gray-500">MENIT</span>
                    </div>
                    <div class="bg-partyYellow/20 p-2 rounded-xl w-16">
                        <span id="seconds" class="block text-2xl font-party font-bold text-yellow-500">00</span>
                        <span class="text-[10px] font-bold text-gray-500">DETIK</span>
                    </div>
                </div>
            </div>

            <!-- KATA PENGANTAR / QUOTE -->
            @if(!empty($invitation->config['opening_greeting']) || !empty($invitation->config['quran_verse']))
            <section class="text-center bg-white p-6 rounded-3xl shadow-md border-2 border-partyPurple/30">
                @if(!empty($invitation->config['opening_greeting']))
                    <p class="font-party text-xl text-partyDark leading-relaxed whitespace-pre-line mb-4">{{ $invitation->config['opening_greeting'] }}</p>
                @endif
                @if(!empty($invitation->config['quran_verse']))
                    <div class="bg-partyPurple/10 p-4 rounded-xl italic text-gray-600 text-sm whitespace-pre-line">
                        "{{ $invitation->config['quran_verse'] }}"
                    </div>
                @endif
            </section>
            @endif

            <!-- CERITA / KISAH -->
            @if(!empty($invitation->config['love_story']))
            <section class="text-center bg-white p-6 rounded-3xl shadow-md border-2 border-partyPink/30">
                <h2 class="font-party text-2xl text-partyDark mb-4">Cerita & Doa 💌</h2>
                <p class="text-sm leading-relaxed text-gray-600 whitespace-pre-line">{{ $invitation->config['love_story'] }}</p>
            </section>
            @endif

            <!-- JADWAL ACARA & DRESSCODE & MAPS -->
            @if(!empty($invitation->config['event_1_name']) || !empty($invitation->config['event_2_name']))
            <section class="bg-white p-6 rounded-3xl shadow-md border-2 border-partyBlue/30 text-center">
                <h2 class="font-party text-2xl text-partyDark mb-6">Detail Acara 🎈</h2>
                
                <div class="space-y-4 mb-8">
                    @if(!empty($invitation->config['event_1_name']))
                    <div class="bg-partyBlue/10 p-4 rounded-xl border border-partyBlue/30">
                        <h3 class="font-party text-xl text-partyDark mb-1">{{ $invitation->config['event_1_name'] }}</h3>
                        <p class="text-sm font-bold text-partyBlue">{{ $invitation->config['event_1_time'] }}</p>
                    </div>
                    @endif

                    @if(!empty($invitation->config['event_2_name']))
                    <div class="bg-partyPink/10 p-4 rounded-xl border border-partyPink/30">
                        <h3 class="font-party text-xl text-partyDark mb-1">{{ $invitation->config['event_2_name'] }}</h3>
                        <p class="text-sm font-bold text-partyPink">{{ $invitation->config['event_2_time'] }}</p>
                    </div>
                    @endif
                </div>

                <!-- Dress Code -->
                @if(!empty($invitation->config['dress_code']))
                <div class="mb-8 bg-gray-50 p-4 rounded-xl border border-gray-200">
                    <p class="text-xs text-gray-500 mb-3">Dress code yang disarankan:</p>
                    @if(isset($invitation->config['dress_code_colors']) && count($invitation->config['dress_code_colors']) > 0)
                    <div class="flex justify-center gap-2 mb-3">
                        @foreach($invitation->config['dress_code_colors'] as $index => $color)
                            <div class="w-10 h-10 rounded-full border-2 border-white shadow-md" style="background-color: {{ $color }}; margin-left: {{ $index > 0 ? '-10px' : '0' }};"></div>
                        @endforeach
                    </div>
                    @endif
                    <p class="text-sm font-bold text-partyDark">{{ $invitation->config['dress_code'] }}</p>
                </div>
                @endif

                <!-- Maps -->
                @if(!empty($invitation->config['maps_link']))
                <div class="mt-4">
                    <a href="{{ $invitation->config['maps_link'] }}" target="_blank" class="inline-flex items-center gap-2 bg-partyYellow text-partyDark px-6 py-3 rounded-full font-party font-bold text-sm shadow-[0_4px_0_#d9a51e] hover:translate-y-1 hover:shadow-[0_1px_0_#d9a51e] transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Lihat Lokasi
                    </a>
                    @if(!empty($invitation->config['maps_address']))
                        <p class="text-xs text-gray-500 mt-3">{{ $invitation->config['maps_address'] }}</p>
                    @endif
                </div>
                @endif
            </section>
            @endif

            <!-- GALERI (Polaroid Ceria) -->
            @if(isset($invitation->config['gallery_images']) && count($invitation->config['gallery_images']) > 0)
            <section>
                <h3 class="font-party text-2xl text-partyDark text-center mb-6">Momen Ceria 🌟</h3>
                <div class="grid grid-cols-2 gap-4">
                    @foreach($invitation->config['gallery_images'] as $index => $img)
                        @php
                            $desc = isset($invitation->config['gallery_descriptions'][$index]) && !empty($invitation->config['gallery_descriptions'][$index]) 
                                    ? $invitation->config['gallery_descriptions'][$index] 
                                    : 'Momen ' . sprintf('%02d', $index + 1);
                        @endphp
                        <div class="bg-white p-2 pb-6 rounded-lg shadow-md border border-gray-100 transform {{ $index % 2 == 0 ? 'rotate-2' : '-rotate-2' }} hover:rotate-0 transition duration-300">
                            <img src="{{ asset('storage/' . $img) }}" class="w-full h-40 object-cover rounded">
                            <p class="text-center font-party text-xs text-partyDark mt-2">{{ $desc }}</p>
                        </div>
                    @endforeach
                </div>
            </section>
            @endif

            <!-- RSVP SECTION (BARU DITAMBAHKAN) -->
            <section class="bg-white p-6 rounded-3xl shadow-xl border-4 border-partyPink text-center">
                <h3 class="font-party text-2xl text-partyDark mb-4">Konfirmasi Kehadiran 🎈</h3>
                
                @if(session('rsvp_success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded-xl mb-4 text-sm font-bold border border-green-200">{{ session('rsvp_success') }}</div>
                @endif

                @if($guest)
                    <p class="text-sm text-gray-600 mb-5">Halo <b>{{ $guest->name }}</b>, silakan konfirmasi kehadiran Anda:</p>
                    <form action="{{ route('guests.rsvp', $invitation->id) }}" method="POST" class="flex flex-col sm:flex-row justify-center gap-3">
                        @csrf
                        <input type="hidden" name="guest_code" value="{{ $guest->unique_code }}">
                        <button type="submit" name="status" value="hadir" class="px-8 py-3 bg-partyPink text-white font-party font-bold rounded-xl shadow-[0_4px_0_#d94f78] hover:translate-y-1 hover:shadow-[0_1px_0_#d94f78] transition-all w-full sm:w-auto text-sm">Hadir</button>
                        <button type="submit" name="status" value="tidak_hadir" class="px-8 py-3 bg-gray-300 text-gray-700 font-party font-bold rounded-xl shadow-[0_4px_0_#a0a0a0] hover:translate-y-1 hover:shadow-[0_1px_0_#a0a0a0] transition-all w-full sm:w-auto text-sm">Tidak Hadir</button>
                    </form>
                @else
                    <p class="text-sm text-gray-500 italic">Silakan buka link undangan dari penyelenggara untuk konfirmasi.</p>
                @endif
            </section>

            <!-- RSVP & UCAPAN -->
            <section class="bg-white p-6 rounded-3xl shadow-xl border-4 border-partyPurple">
                <h3 class="font-party text-2xl text-partyDark text-center mb-6">Buku Tamu & Ucapan 🎁</h3>
                
                @if(session('message_success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded-xl mb-4 text-center text-xs font-bold">{{ session('message_success') }}</div>
                @endif

                <form action="{{ route('messages.store', $invitation->id) }}" method="POST" class="space-y-3 mb-8">
                    @csrf
                    <input type="text" name="name" class="w-full bg-gray-50 border-2 border-gray-200 p-3 rounded-xl focus:border-partyPink focus:outline-none text-sm" placeholder="Nama Anda" required>
                    <textarea name="message" rows="3" class="w-full bg-gray-50 border-2 border-gray-200 p-3 rounded-xl focus:border-partyPink focus:outline-none text-sm" placeholder="Tuliskan doa & ucapan selamat..." required></textarea>
                    <button type="submit" class="w-full bg-partyPink text-white font-party font-bold py-3 rounded-xl shadow-[0_4px_0_#d94f78] hover:translate-y-1 hover:shadow-[0_1px_0_#d94f78] transition-all">Kirim Ucapan</button>
                </form>

                <div class="space-y-3 max-h-60 overflow-y-auto pr-2">
                    @forelse($messages as $msg)
                        <div class="bg-gray-50 p-3 rounded-xl border border-gray-100">
                            <div class="flex justify-between items-center mb-1">
                                <h4 class="font-bold text-partyDark text-sm">{{ $msg->name }}</h4>
                                <span class="text-[10px] text-gray-400">{{ $msg->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-600 text-sm">{{ $msg->message }}</p>
                        </div>
                    @empty
                        <p class="text-center text-gray-400 text-sm italic">Belum ada ucapan. Jadilah yang pertama!</p>
                    @endforelse
                </div>
            </section>

            <!-- FOOTER DENGAN NAMA PANJANG -->
            <div class="text-center pt-8 pb-4">
                <p class="text-sm text-gray-500 mb-1">Dengan penuh kasih,</p>
                <p class="font-party text-2xl text-partyDark">{{ $fullName }}</p>
                @if($nickname)
                    <p class="font-party text-md text-gray-500">({{ $nickname }})</p>
                @endif
            </div>

        </div>
    </div>

    <!-- TOMBOL MUSIK MELAYANG -->
    <button id="music-btn" class="fixed bottom-6 right-6 w-14 h-14 bg-partyPurple text-white rounded-full flex items-center justify-center shadow-lg z-[100] hover:scale-110 transition hidden">
        <svg id="music-icon-play" class="w-6 h-6 hidden" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
        <svg id="music-icon-pause" class="w-6 h-6 hidden" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
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
        // Confetti Animation
        function createConfetti() {
            const container = document.getElementById('confetti-container');
            const colors = ['#FF8FAB', '#8FD3FF', '#FFD166', '#B9A8FF'];
            for (let i = 0; i < 50; i++) {
                const confetti = document.createElement('div');
                confetti.classList.add('confetti');
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.animationDuration = (Math.random() * 3 + 2) + 's';
                confetti.style.animationDelay = (Math.random() * 5) + 's';
                container.appendChild(confetti);
            }
        }
        createConfetti();

        // Music Logic
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

        // Countdown Timer Logic
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