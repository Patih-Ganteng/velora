<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invitation->title }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        sun: '#FFD23F',     // kuning matahari
                        sky: '#4CC9F0',     // biru langit
                        coral: '#FF6B6B',   // merah muda koral
                        mint: '#6EE7B7',    // hijau mint
                        grape: '#9B5DE5',   // ungu anggur
                        cream: '#FFF9E6',
                        ink: '#2B2D42'
                    },
                    fontFamily: { sans: ['Nunito', 'sans-serif'], heading: ['Fredoka', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        body { background-color: #FFF9E6; color: #2B2D42; overflow-x: hidden; }

        /* Pola polkadot lembut */
        .dots {
            background-image: radial-gradient(#FFD23F55 3px, transparent 3px), radial-gradient(#4CC9F044 3px, transparent 3px);
            background-size: 36px 36px; background-position: 0 0, 18px 18px;
        }

        /* Gaya stiker: border tebal + bayangan keras */
        .sticker { border: 3px solid #2B2D42; box-shadow: 5px 5px 0 #2B2D42; }
        .sticker-sm { border: 2.5px solid #2B2D42; box-shadow: 3px 3px 0 #2B2D42; }
        .btn-press { transition: transform .12s, box-shadow .12s; }
        .btn-press:active { transform: translate(3px, 3px); box-shadow: 0 0 0 #2B2D42; }

        /* Animasi masuk satu kali saat undangan dibuka */
        .pop-in { animation: popIn .7s cubic-bezier(.34, 1.56, .64, 1) forwards; opacity: 0; }
        @keyframes popIn { from { opacity: 0; transform: scale(.85) translateY(20px); } to { opacity: 1; transform: scale(1) translateY(0); } }

        /* Balon melayang */
        .balloon { animation: bob 3.5s ease-in-out infinite; }
        .balloon:nth-child(2) { animation-delay: -1.2s; }
        .balloon:nth-child(3) { animation-delay: -2.4s; }
        @keyframes bob { 0%, 100% { transform: translateY(0) rotate(-3deg); } 50% { transform: translateY(-12px) rotate(3deg); } }

        /* Confetti */
        .confetti { position: fixed; top: -20px; width: 10px; height: 14px; z-index: 60; pointer-events: none; animation: drop linear forwards; }
        @keyframes drop { to { transform: translateY(110vh) rotate(720deg); opacity: .9; } }

        /* Karakter kartun */
        .char { animation: wiggle 2.8s ease-in-out infinite; transform-origin: 50% 100%; overflow: visible; }
        @keyframes wiggle { 0%, 100% { transform: rotate(-4deg); } 50% { transform: rotate(4deg) translateY(-4px); } }
        @media (prefers-reduced-motion: reduce) { .char { animation: none; } }

        #main-content { display: none; }

        @media (prefers-reduced-motion: reduce) {
            .balloon, .pop-in { animation: none; opacity: 1; }
            .confetti { display: none; }
        }
    </style>
</head>
<body class="font-sans antialiased">

    <!-- Karakter kartun orisinal (SVG sprite) -->
    <svg width="0" height="0" style="position:absolute" aria-hidden="true" focusable="false">
        <!-- Blobby: monster mint bermata dua ukuran -->
        <symbol id="c-blob" viewBox="0 0 100 100" stroke="#2B2D42" stroke-linejoin="round" stroke-linecap="round">
            <path d="M18 82 C6 60 14 30 40 24 C66 16 92 36 86 64 C84 78 76 86 62 88 L30 88 C24 88 20 86 18 82Z" fill="#6EE7B7" stroke-width="4"/>
            <polygon points="40,26 52,4 64,24" fill="#FF6B6B" stroke-width="3.5"/>
            <circle cx="52" cy="4" r="4" fill="#FFD23F" stroke-width="3"/>
            <circle cx="40" cy="50" r="11" fill="#fff" stroke-width="3"/>
            <circle cx="65" cy="48" r="8" fill="#fff" stroke-width="3"/>
            <circle cx="43" cy="52" r="4" fill="#2B2D42" stroke="none"/>
            <circle cx="66" cy="50" r="3" fill="#2B2D42" stroke="none"/>
            <path d="M38 69 Q52 80 68 67" fill="none" stroke-width="3.5"/>
            <rect x="50" y="71" width="7" height="8" fill="#fff" stroke-width="2"/>
        </symbol>
        <!-- Bolt: robot biru dengan antena -->
        <symbol id="c-robo" viewBox="0 0 100 100" stroke="#2B2D42" stroke-linejoin="round" stroke-linecap="round">
            <line x1="50" y1="18" x2="50" y2="7" stroke-width="3.5"/>
            <circle cx="50" cy="6" r="5" fill="#FF6B6B" stroke-width="3"/>
            <rect x="32" y="82" width="11" height="12" rx="3" fill="#FFD23F" stroke-width="3"/>
            <rect x="57" y="82" width="11" height="12" rx="3" fill="#FFD23F" stroke-width="3"/>
            <rect x="11" y="42" width="9" height="18" rx="3" fill="#FF6B6B" stroke-width="3"/>
            <rect x="80" y="42" width="9" height="18" rx="3" fill="#FF6B6B" stroke-width="3"/>
            <rect x="20" y="18" width="60" height="66" rx="15" fill="#4CC9F0" stroke-width="4"/>
            <circle cx="38" cy="44" r="10" fill="#fff" stroke-width="3"/>
            <circle cx="63" cy="46" r="7" fill="#fff" stroke-width="3"/>
            <circle cx="40" cy="46" r="4" fill="#2B2D42" stroke="none"/>
            <circle cx="62" cy="47" r="3" fill="#2B2D42" stroke="none"/>
            <rect x="34" y="62" width="32" height="12" rx="6" fill="#fff" stroke-width="3"/>
            <path d="M45 62 V74 M55 62 V74" fill="none" stroke-width="2.5"/>
        </symbol>
        <!-- Mochi: kucing kuning bermata juling -->
        <symbol id="c-kitty" viewBox="0 0 100 100" stroke="#2B2D42" stroke-linejoin="round" stroke-linecap="round">
            <path d="M20 42 L22 10 L48 28Z" fill="#FFD23F" stroke-width="4"/>
            <path d="M80 42 L78 10 L52 28Z" fill="#FFD23F" stroke-width="4"/>
            <ellipse cx="50" cy="58" rx="36" ry="30" fill="#FFD23F" stroke-width="4"/>
            <path d="M44 30 V38 M50 28 V37 M56 30 V38" fill="none" stroke-width="3"/>
            <circle cx="37" cy="54" r="9" fill="#fff" stroke-width="3"/>
            <circle cx="63" cy="54" r="9" fill="#fff" stroke-width="3"/>
            <circle cx="40" cy="56" r="4" fill="#2B2D42" stroke="none"/>
            <circle cx="60" cy="56" r="4" fill="#2B2D42" stroke="none"/>
            <path d="M45 66 L55 66 L50 72Z" fill="#FF6B6B" stroke-width="2.5"/>
            <path d="M50 72 Q44 80 37 75 M50 72 Q56 80 63 75" fill="none" stroke-width="3"/>
            <path d="M12 62 L28 64 M12 73 L28 69 M88 62 L72 64 M88 73 L72 69" fill="none" stroke-width="2.5"/>
        </symbol>
    </svg>

@php
    $bgImg = isset($invitation->config['background_image']) ? asset('storage/' . $invitation->config['background_image']) : '';
    $mainPhoto = isset($invitation->config['groom_photo']) ? asset('storage/' . $invitation->config['groom_photo']) : 'https://via.placeholder.com/400x400/FFD23F/2B2D42?text=Foto+Si+Kecil';
    $fullName = $invitation->config['full_name'] ?? $invitation->title;
    $nickname = $invitation->config['nickname'] ?? '';
    $age = $invitation->config['age'] ?? '';
    $parents = $invitation->config['parent_names'] ?? '';
    $theme = $invitation->config['theme_name'] ?? '';
    $dressCode = $invitation->config['dress_code'] ?? '';
    $eventDate = \Carbon\Carbon::parse($invitation->event_date);
@endphp

    <!-- ================= WELCOME SCREEN ================= -->
    <div id="welcome-screen" class="fixed inset-0 z-50 flex flex-col items-center justify-center transition-opacity duration-700 overflow-hidden bg-sky/30"
         style="background-image: url('{{ $bgImg }}'); background-size: cover; background-position: center;">
        <div class="absolute inset-0 bg-cream/85 dots"></div>

        <div class="relative z-10 text-center px-6 max-w-sm w-[90%] bg-white p-8 rounded-[2rem] sticker pop-in">
            <div class="flex justify-center items-end gap-1 mb-3" aria-hidden="true">
                <svg class="char w-16 h-16"><use href="#c-blob"/></svg>
                <svg class="char w-20 h-20" style="animation-delay:-.9s"><use href="#c-robo"/></svg>
                <svg class="char w-16 h-16" style="animation-delay:-1.8s"><use href="#c-kitty"/></svg>
            </div>
            <h1 class="text-3xl font-heading font-bold text-coral mb-1">Yuk, Main ke Pestaku!</h1>
            <h2 class="text-lg font-heading font-medium mb-6">{{ $invitation->title }}</h2>

            <p class="text-sm text-ink/60 mb-1">Untuk Teman &amp; Keluarga,</p>
            <h3 class="text-xl font-heading font-semibold mb-8">
                @if($guest) {{ $guest->name }} @else Teman-teman &amp; Keluarga @endif
            </h3>

            <button onclick="openInvitation()" class="btn-press w-full py-3 bg-sun text-ink font-heading font-bold text-lg rounded-2xl sticker-sm">
                Buka Undangan
            </button>
        </div>
    </div>

    <!-- ================= MAIN CONTENT ================= -->
    <div id="main-content" class="w-full min-h-screen relative pb-16 dots">
        <div class="max-w-md mx-auto px-4 pt-8">

            <div class="bg-white rounded-[2rem] overflow-hidden sticker">

                <!-- Header -->
                <div class="bg-sky p-6 text-center relative">
                    <p class="font-heading font-medium text-ink/80 text-sm mb-1">Kamu diundang ke pesta ulang tahun</p>
                    <h1 class="text-4xl font-heading font-bold text-white drop-shadow-[2px_2px_0_#2B2D42] leading-tight">
                        {{ $nickname ?: $fullName }}
                    </h1>
                    @if($theme)
                        <p class="mt-2 inline-block bg-white text-ink font-heading font-semibold text-sm px-3 py-1 rounded-full sticker-sm">Tema: {{ $theme }}</p>
                    @endif
                    <div class="flex justify-center items-end gap-3 mt-3 -mb-6 relative z-10" aria-hidden="true">
                        <svg class="char w-16 h-16"><use href="#c-kitty"/></svg>
                        <svg class="char w-14 h-14" style="animation-delay:-1.4s"><use href="#c-blob"/></svg>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6 text-center">
                    <div class="relative w-44 h-44 mx-auto mb-8">
                        <img src="{{ $mainPhoto }}" alt="Foto {{ $nickname ?: $fullName }}" class="w-44 h-44 object-cover rounded-full sticker bg-sun">
                        @if($age)
                            <div class="absolute -bottom-3 -right-3 w-16 h-16 bg-coral text-white rounded-full sticker-sm flex flex-col items-center justify-center rotate-12">
                                <span class="text-2xl font-heading font-bold leading-none">{{ $age }}</span>
                                <span class="text-[10px] font-heading font-semibold leading-none">tahun</span>
                            </div>
                        @endif
                    </div>

                    <h2 class="text-2xl font-heading font-bold text-grape mb-3">Hai, Teman-Teman!</h2>
                    <p class="text-ink/75 mb-6 leading-relaxed text-sm">
                        {{ $invitation->config['opening_greeting'] ?? 'Aku bakal tambah umur nih! Datang ya ke pestaku, kita main, makan kue, dan seru-seruan bareng!' }}
                    </p>

                    <!-- Hitung mundur -->
                    <div class="mb-6">
                        <p class="font-heading font-semibold text-sm mb-2">Pestanya tinggal</p>
                        <div id="countdown" data-date="{{ $eventDate->toIso8601String() }}" class="grid grid-cols-4 gap-2">
                            @foreach(['hari' => 'cd-d', 'jam' => 'cd-h', 'menit' => 'cd-m', 'detik' => 'cd-s'] as $label => $id)
                                <div class="rounded-2xl py-2 sticker-sm {{ ['hari' => 'bg-sun', 'jam' => 'bg-mint', 'menit' => 'bg-sky', 'detik' => 'bg-coral'][$label] }}">
                                    <div id="{{ $id }}" class="text-2xl font-heading font-bold">0</div>
                                    <div class="text-[11px] font-semibold">{{ $label }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Detail Acara -->
                    <div class="bg-cream rounded-2xl p-5 text-left mb-6 text-sm space-y-4 sticker-sm">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl" aria-hidden="true">📅</span>
                            <div>
                                <p class="font-heading font-bold">Tanggal</p>
                                <p>{{ $eventDate->translatedFormat('l, d F Y') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-2xl" aria-hidden="true">⏰</span>
                            <div>
                                <p class="font-heading font-bold">Waktu</p>
                                <p>{{ $invitation->config['event_1_time'] ?? '10.30 WIB' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-2xl" aria-hidden="true">📍</span>
                            <div>
                                <p class="font-heading font-bold">Tempat</p>
                                <p>{{ $invitation->config['maps_address'] ?? 'Rumah Jl. Raya Warung Bitung' }}</p>
                            </div>
                        </div>
                        @if($dressCode)
                        <div class="flex items-center gap-3">
                            <span class="text-2xl" aria-hidden="true">👕</span>
                            <div>
                                <p class="font-heading font-bold">Pakaian</p>
                                <p>{{ $dressCode }}</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Acara seru -->
                    <div class="flex flex-wrap justify-center gap-2 mb-6 text-xs font-heading font-semibold">
                        <span class="px-3 py-1.5 bg-sun rounded-full sticker-sm">🎮 Games seru</span>
                        <span class="px-3 py-1.5 bg-mint rounded-full sticker-sm">🍰 Kue &amp; makanan</span>
                        <span class="px-3 py-1.5 bg-sky rounded-full sticker-sm">🎁 Kejutan</span>
                    </div>

                    <p class="text-ink/60 text-xs mb-6">
                        Untuk orang tua/wali: kehadiran adik-adik ditemani ya, dan mohon kabari kami lewat tombol di bawah.
                    </p>

                    <a href="#rsvp-section" class="btn-press inline-block w-full py-3 bg-coral text-white font-heading font-bold text-lg rounded-2xl sticker-sm">
                        Konfirmasi Kehadiran
                    </a>

                    @if(!empty($invitation->config['maps_link']))
                    <a href="{{ $invitation->config['maps_link'] }}" target="_blank" rel="noopener" class="btn-press inline-block w-full py-2.5 mt-3 bg-white text-ink font-heading font-semibold rounded-2xl sticker-sm">
                        Lihat Lokasi di Maps
                    </a>
                    @endif
                </div>

                <!-- Footer -->
                <div class="bg-sun p-6 text-center border-t-[3px] border-ink">
                    <div class="flex justify-center items-end gap-2 mb-3" aria-hidden="true">
                        <svg class="char w-14 h-14"><use href="#c-robo"/></svg>
                        <svg class="char w-16 h-16" style="animation-delay:-1s"><use href="#c-blob"/></svg>
                        <svg class="char w-14 h-14" style="animation-delay:-2s"><use href="#c-kitty"/></svg>
                    </div>
                    <p class="text-sm font-semibold mb-1">Sampai jumpa di pestaku,</p>
                    <p class="text-2xl font-heading font-bold">{{ $fullName }}</p>
                    @if($nickname)
                        <p class="text-sm font-semibold">({{ $nickname }})</p>
                    @endif
                    @if($parents)
                        <p class="text-xs mt-3">Bersama {{ $parents }}</p>
                    @endif
                </div>
            </div>

            <!-- FORM RSVP & BUKU UCAPAN -->
            <div id="rsvp-section" class="mt-8 bg-white rounded-[2rem] sticker p-6">
                <h3 class="text-xl font-heading font-bold text-center mb-4">Konfirmasi &amp; Ucapan</h3>

                @if(session('message_success'))
                    <div class="bg-mint text-ink p-3 rounded-xl mb-4 text-center text-xs font-bold sticker-sm">{{ session('message_success') }}</div>
                @endif

                @if($guest)
                <form action="{{ route('guests.rsvp', $invitation->id) }}" method="POST" class="flex gap-2 mb-6">
                    @csrf
                    <input type="hidden" name="guest_code" value="{{ $guest->unique_code }}">
                    <button type="submit" name="status" value="hadir" class="btn-press flex-1 py-2.5 bg-mint text-ink rounded-xl font-heading font-bold text-sm sticker-sm">Aku Datang!</button>
                    <button type="submit" name="status" value="tidak_hadir" class="btn-press flex-1 py-2.5 bg-white text-ink rounded-xl font-heading font-bold text-sm sticker-sm">Belum Bisa</button>
                </form>
                @endif

                <form action="{{ route('messages.store', $invitation->id) }}" method="POST" class="space-y-3 mb-6">
                    @csrf
                    <input type="text" name="name" value="{{ $guest->name ?? '' }}" class="w-full bg-cream border-[2.5px] border-ink p-3 rounded-xl focus:outline-none focus:ring-4 focus:ring-sky/50 text-sm" placeholder="Nama kamu" required>
                    <textarea name="message" rows="3" class="w-full bg-cream border-[2.5px] border-ink p-3 rounded-xl focus:outline-none focus:ring-4 focus:ring-sky/50 text-sm" placeholder="Tulis ucapan &amp; doa untuk si kecil..." required></textarea>
                    <button type="submit" class="btn-press w-full py-3 bg-grape text-white font-heading font-bold rounded-xl sticker-sm">Kirim Ucapan</button>
                </form>

                <div class="space-y-3 max-h-60 overflow-y-auto pr-1">
                    @forelse($messages as $msg)
                        <div class="bg-cream p-3 rounded-xl border-2 border-ink/15">
                            <div class="flex justify-between items-center mb-1">
                                <h4 class="font-heading font-bold text-grape text-sm">{{ $msg->name }}</h4>
                                <span class="text-[10px] text-ink/50">{{ $msg->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-ink/75 text-xs">{{ $msg->message }}</p>
                        </div>
                    @empty
                        <p class="text-center text-ink/50 text-xs py-4">Belum ada ucapan. Jadi yang pertama, yuk!</p>
                    @endforelse
                </div>
            </div>

            <div class="text-center mt-8 pb-4">
                <p class="text-xs text-ink/50">Powered by <b>Velora</b></p>
            </div>
        </div>
    </div>

    <button id="music-btn" class="btn-press fixed bottom-6 right-6 w-12 h-12 bg-sun text-ink rounded-full flex items-center justify-center sticker-sm z-[100] hidden" aria-label="Putar atau jeda musik">
        <svg id="music-icon-play" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
        <svg id="music-icon-pause" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
    </button>

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

        function launchConfetti() {
            const colors = ['#FFD23F', '#4CC9F0', '#FF6B6B', '#6EE7B7', '#9B5DE5'];
            for (let i = 0; i < 40; i++) {
                const c = document.createElement('div');
                c.className = 'confetti';
                c.style.left = Math.random() * 100 + 'vw';
                c.style.background = colors[i % colors.length];
                c.style.borderRadius = i % 3 === 0 ? '50%' : '2px';
                c.style.animationDuration = (2 + Math.random() * 2.5) + 's';
                c.style.animationDelay = (Math.random() * 0.6) + 's';
                document.body.appendChild(c);
                setTimeout(() => c.remove(), 5500);
            }
        }

        function openInvitation() {
            const welcome = document.getElementById('welcome-screen');
            const main = document.getElementById('main-content');
            welcome.style.opacity = '0';
            setTimeout(() => {
                welcome.style.display = 'none';
                main.style.display = 'block';
                main.classList.add('pop-in');
                musicBtn.classList.remove('hidden');
                launchConfetti();
                music.play().then(() => { pauseIcon.classList.remove('hidden'); }).catch(() => { playIcon.classList.remove('hidden'); });
            }, 600);
        }

        musicBtn.addEventListener('click', () => {
            if (music.paused) {
                music.play(); pauseIcon.classList.remove('hidden'); playIcon.classList.add('hidden');
            } else {
                music.pause(); pauseIcon.classList.add('hidden'); playIcon.classList.remove('hidden');
            }
        });

        // Hitung mundur
        (function () {
            const box = document.getElementById('countdown');
            if (!box) return;
            const target = new Date(box.dataset.date).getTime();
            const el = id => document.getElementById(id);
            function tick() {
                let diff = Math.max(0, target - Date.now());
                el('cd-d').textContent = Math.floor(diff / 86400000);
                el('cd-h').textContent = Math.floor(diff % 86400000 / 3600000);
                el('cd-m').textContent = Math.floor(diff % 3600000 / 60000);
                el('cd-s').textContent = Math.floor(diff % 60000 / 1000);
            }
            tick();
            setInterval(tick, 1000);
        })();
    </script>
</body>
</html>