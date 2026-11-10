<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invitation->title }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,500&family=Mulish:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        forest: '#1E3B34',  // hijau tua
                        brass: '#A98A4F',   // kuningan
                        ivory: '#F7F4EE',   // gading
                        mist: '#E6E9E4',    // abu hijau muda
                        ink: '#22302C'
                    },
                    fontFamily: { sans: ['Mulish', 'sans-serif'], heading: ['"Cormorant Garamond"', 'serif'] }
                }
            }
        }
    </script>
    <style>
        body { background-color: #F7F4EE; color: #22302C; overflow-x: hidden; }
        .frame { outline: 1px solid #A98A4F; outline-offset: -10px; }
        .rule { height: 1px; background: linear-gradient(to right, transparent, #A98A4F, transparent); }
        .reveal { animation: reveal 1s ease-out forwards; opacity: 0; }
        @keyframes reveal { to { opacity: 1; } }
        #main-content { display: none; }
        @media (prefers-reduced-motion: reduce) { .reveal { animation: none; opacity: 1; } }
    </style>
</head>
<body class="font-sans antialiased">

@php
    $bgImg = isset($invitation->config['background_image']) ? asset('storage/' . $invitation->config['background_image']) : '';
    $mainPhoto = isset($invitation->config['groom_photo']) ? asset('storage/' . $invitation->config['groom_photo']) : 'https://via.placeholder.com/400x500/E6E9E4/1E3B34?text=Foto';
    $fullName = $invitation->config['full_name'] ?? $invitation->title;
    $nickname = $invitation->config['nickname'] ?? '';
    $age = $invitation->config['age'] ?? '';
    $parents = $invitation->config['parent_names'] ?? '';
    $dressCode = $invitation->config['dress_code'] ?? '';
    $eventDate = \Carbon\Carbon::parse($invitation->event_date);
@endphp

    <!-- ================= WELCOME SCREEN ================= -->
    <div id="welcome-screen" class="fixed inset-0 z-50 flex items-center justify-center transition-opacity duration-1000 overflow-hidden bg-forest"
         style="background-image: url('{{ $bgImg }}'); background-size: cover; background-position: center;">
        <div class="absolute inset-0 bg-forest/90"></div>

        <div class="relative z-10 text-center px-8 py-12 max-w-sm w-[90%] bg-ivory frame reveal">
            <p class="text-sm text-ink/70 mb-5">Undangan Ulang Tahun</p>
            <h1 class="text-4xl font-heading font-semibold text-forest leading-tight mb-2">{{ $invitation->title }}</h1>
            <div class="rule w-24 mx-auto my-6"></div>

            <p class="text-sm text-ink/70 mb-1">Kepada Yth.</p>
            <h3 class="text-xl font-heading font-semibold mb-1">
                @if($guest) {{ $guest->name }} @else Bapak/Ibu/Saudara/i @endif
            </h3>
            <p class="text-xs text-ink/60 mb-8">di tempat</p>

            <button onclick="openInvitation()" class="w-full py-3 bg-forest text-ivory font-semibold text-sm tracking-wide hover:bg-ink transition-colors">
                Buka Undangan
            </button>
        </div>
    </div>

    <!-- ================= MAIN CONTENT ================= -->
    <div id="main-content" class="w-full min-h-screen relative pb-16">
        <div class="max-w-md mx-auto px-4 pt-8">

            <div class="bg-white border border-mist">

                <!-- Sampul -->
                <div class="bg-forest text-ivory text-center px-6 py-12 frame">
                    <p class="text-sm text-ivory/80 mb-4">Dengan penuh syukur, kami mengundang Anda<br>pada perayaan ulang tahun</p>
                    <h1 class="text-5xl font-heading font-semibold leading-tight">{{ $nickname ?: $fullName }}</h1>
                    @if($age)
                        <p class="mt-3 text-xl font-heading italic text-brass">yang ke-{{ $age }}</p>
                    @endif
                </div>

                <!-- Isi -->
                <div class="p-8 text-center">
                    <img src="{{ $mainPhoto }}" alt="Foto {{ $nickname ?: $fullName }}" class="w-44 h-56 object-cover mx-auto mb-8 border border-brass p-1.5 bg-white">

                    <h2 class="text-2xl font-heading font-semibold text-forest mb-4">Dengan hormat,</h2>
                    <p class="text-ink/80 mb-8 leading-loose text-sm">
                        {{ $invitation->config['opening_greeting'] ?? 'Merupakan kehormatan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa restu pada acara ulang tahun kami. Kehadiran Anda akan menjadi kebahagiaan tersendiri bagi kami.' }}
                    </p>

                    <div class="rule mb-8"></div>

                    <!-- Detail Acara -->
                    <div class="space-y-6 text-sm mb-8">
                        <div>
                            <p class="font-heading font-semibold text-lg text-forest">Hari &amp; Tanggal</p>
                            <p>{{ $eventDate->translatedFormat('l, d F Y') }}</p>
                        </div>
                        <div>
                            <p class="font-heading font-semibold text-lg text-forest">Waktu</p>
                            <p>{{ $invitation->config['event_1_time'] ?? '10.30 WIB' }}</p>
                        </div>
                        <div>
                            <p class="font-heading font-semibold text-lg text-forest">Tempat</p>
                            <p>{{ $invitation->config['maps_address'] ?? 'Rumah Jl. Raya Warung Bitung' }}</p>
                        </div>
                        @if($dressCode)
                        <div>
                            <p class="font-heading font-semibold text-lg text-forest">Busana</p>
                            <p>{{ $dressCode }}</p>
                        </div>
                        @endif
                    </div>

                    <div class="rule mb-8"></div>

                    <p class="text-ink/70 text-sm mb-8 leading-relaxed">
                        Atas kehadiran dan doa restu Bapak/Ibu/Saudara/i, kami ucapkan terima kasih.
                    </p>

                    <a href="#rsvp-section" class="inline-block w-full py-3 bg-forest text-ivory font-semibold text-sm tracking-wide hover:bg-ink transition-colors">
                        Konfirmasi Kehadiran
                    </a>

                    @if(!empty($invitation->config['maps_link']))
                    <a href="{{ $invitation->config['maps_link'] }}" target="_blank" rel="noopener" class="inline-block w-full py-3 mt-3 border border-forest text-forest font-semibold text-sm tracking-wide hover:bg-mist transition-colors">
                        Lihat Lokasi di Maps
                    </a>
                    @endif
                </div>

                <!-- Penutup -->
                <div class="bg-mist p-8 text-center">
                    <p class="text-sm text-ink/70 mb-2">Hormat kami,</p>
                    <p class="text-2xl font-heading font-semibold text-forest">{{ $fullName }}</p>
                    @if($nickname)
                        <p class="text-sm text-ink/70">({{ $nickname }})</p>
                    @endif
                    @if($parents)
                        <p class="text-xs text-ink/60 mt-3">Beserta keluarga: {{ $parents }}</p>
                    @endif
                </div>
            </div>

            <!-- FORM RSVP & BUKU UCAPAN -->
            <div id="rsvp-section" class="mt-8 bg-white border border-mist p-8">
                <h3 class="text-2xl font-heading font-semibold text-forest text-center mb-6">Konfirmasi &amp; Ucapan</h3>

                @if(session('message_success'))
                    <div class="bg-mist text-forest p-3 mb-4 text-center text-xs font-semibold">{{ session('message_success') }}</div>
                @endif

                @if($guest)
                <form action="{{ route('guests.rsvp', $invitation->id) }}" method="POST" class="flex gap-2 mb-6">
                    @csrf
                    <input type="hidden" name="guest_code" value="{{ $guest->unique_code }}">
                    <button type="submit" name="status" value="hadir" class="flex-1 py-2.5 bg-forest text-ivory font-semibold text-sm hover:bg-ink transition-colors">Hadir</button>
                    <button type="submit" name="status" value="tidak_hadir" class="flex-1 py-2.5 border border-forest text-forest font-semibold text-sm hover:bg-mist transition-colors">Tidak Hadir</button>
                </form>
                @endif

                <form action="{{ route('messages.store', $invitation->id) }}" method="POST" class="space-y-3 mb-6">
                    @csrf
                    <input type="text" name="name" value="{{ $guest->name ?? '' }}" class="w-full bg-ivory border border-mist p-3 focus:border-brass focus:outline-none text-sm" placeholder="Nama Anda" required>
                    <textarea name="message" rows="3" class="w-full bg-ivory border border-mist p-3 focus:border-brass focus:outline-none text-sm" placeholder="Tuliskan ucapan dan doa..." required></textarea>
                    <button type="submit" class="w-full py-3 bg-brass text-white font-semibold text-sm tracking-wide hover:bg-forest transition-colors">Kirim Ucapan</button>
                </form>

                <div class="space-y-3 max-h-60 overflow-y-auto pr-1">
                    @forelse($messages as $msg)
                        <div class="bg-ivory p-4 border-l-2 border-brass">
                            <div class="flex justify-between items-center mb-1">
                                <h4 class="font-heading font-semibold text-forest">{{ $msg->name }}</h4>
                                <span class="text-[10px] text-ink/50">{{ $msg->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-ink/75 text-xs leading-relaxed">{{ $msg->message }}</p>
                        </div>
                    @empty
                        <p class="text-center text-ink/50 text-xs italic py-4">Belum ada ucapan.</p>
                    @endforelse
                </div>
            </div>

            <div class="text-center mt-8 pb-4">
                <p class="text-xs text-ink/50">Powered by <b>Velora</b></p>
            </div>
        </div>
    </div>

    <button id="music-btn" class="fixed bottom-6 right-6 w-11 h-11 bg-forest text-ivory rounded-full flex items-center justify-center shadow-lg z-[100] hover:bg-ink transition-colors hidden" aria-label="Putar atau jeda musik">
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

        function openInvitation() {
            const welcome = document.getElementById('welcome-screen');
            const main = document.getElementById('main-content');
            welcome.style.opacity = '0';
            setTimeout(() => {
                welcome.style.display = 'none';
                main.style.display = 'block';
                main.classList.add('reveal');
                musicBtn.classList.remove('hidden');
                music.play().then(() => { pauseIcon.classList.remove('hidden'); }).catch(() => { playIcon.classList.remove('hidden'); });
            }, 800);
        }

        musicBtn.addEventListener('click', () => {
            if (music.paused) {
                music.play(); pauseIcon.classList.remove('hidden'); playIcon.classList.add('hidden');
            } else {
                music.pause(); pauseIcon.classList.add('hidden'); playIcon.classList.remove('hidden');
            }
        });
    </script>
</body>
</html>