<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invitation->title }}</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;1,600;1,700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { pink: '#F5A9C8', lavender: '#C7B5F5', cream: '#FFF9FC', darkpink: '#B85C87', ink: '#443344' },
                    fontFamily: { sans: ['DM Sans', 'sans-serif'], display: ['Playfair Display', 'serif'], outfit: ['Outfit', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        body { background: #FFF9FC; color: #443344; overflow-x: hidden; font-family: 'DM Sans', sans-serif; }
        .pink-gradient { background: linear-gradient(135deg, #FFF3F8, #FCE4F0, #F0E9FF); }
        .glass { background: rgba(255,255,255,.72); backdrop-filter: blur(18px); border: 1px solid rgba(255,255,255,.9); }
        .soft-shadow { box-shadow: 0 15px 45px rgba(190,120,160,.13); }
        .gradient-text { background: linear-gradient(90deg, #D875A3, #A88AE8, #D875A3); background-clip: text; -webkit-background-clip: text; color: transparent; }
        .float-anim { animation: floating 6s ease-in-out infinite; }
        @keyframes floating { 0%, 100% { transform: translateY(0) rotate(-5deg); } 50% { transform: translateY(-20px) rotate(5deg); } }
        .sparkle { position: absolute; color: #D78EB2; animation: sparkle 3s infinite; pointer-events: none; }
        @keyframes sparkle { 0%, 100% { opacity: .3; transform: scale(.8); } 50% { opacity: 1; transform: scale(1.2); } }
        .photocard { background: white; padding: 10px 10px 15px; border-radius: 12px; box-shadow: 0 10px 30px rgba(150,90,130,.15); transition: .35s ease; }
        .photocard:hover { transform: translateY(-8px) rotate(0deg) !important; }
        .kpop-button { background: linear-gradient(90deg,#EBA1C1,#BCA7F0); color: white; transition: .3s; box-shadow: 0 8px 25px rgba(215,140,180,.3); }
        .kpop-button:hover { transform: translateY(-3px); box-shadow: 0 12px 30px rgba(215,140,180,.45); }
        .section-label { letter-spacing: 4px; font-size: 10px; font-weight: 800; color: #C17FA1; text-transform: uppercase; }
        .divider { width: 45px; height: 2px; margin: 15px auto; background: linear-gradient(90deg,#F2A9C9,#BBA7ED); }
        input, textarea { outline: none; }
        input:focus, textarea:focus { border-color: #D88BB1 !important; box-shadow: 0 0 0 3px rgba(216,139,177,.12); }
        .font-arabic { font-family: 'Traditional Arabic', 'Scheherazade', serif; font-size: 2.5rem; line-height: 1.5; text-align: center; color: #443344; margin-bottom: 1rem; }
    </style>
</head>
<body>

@php
    $bgImg = isset($invitation->config['background_image']) ? asset('storage/' . $invitation->config['background_image']) : '';
@endphp

<!-- WELCOME SCREEN -->
<div id="welcome-screen" class="fixed inset-0 z-50 flex items-center justify-center transition-opacity duration-1000 overflow-hidden" style="background-image: url('{{ $bgImg }}'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 bg-white/70 backdrop-blur-md"></div>
    
    <div class="sparkle top-10 left-8 text-4xl z-10">♡</div>
    <div class="sparkle top-20 right-10 text-3xl z-10" style="animation-delay: 1s;">✦</div>
    <div class="sparkle bottom-20 left-12 text-3xl z-10" style="animation-delay: 2s;">✧</div>
    <div class="sparkle bottom-16 right-10 text-4xl z-10" style="animation-delay: 0.5s;">♡</div>

    @if(isset($invitation->config['sticker_images']))
        @foreach($invitation->config['sticker_images'] as $index => $sticker)
            @php
                $positions = ['top-6 left-[5%]', 'top-12 right-[10%]', 'top-1/4 left-[15%]', 'top-1/3 right-[5%]', 'bottom-1/3 left-[5%]', 'bottom-1/4 right-[15%]', 'bottom-10 left-[20%]', 'bottom-6 right-[5%]'];
                $pos = $positions[$index % 8];
                $delay = ($index * 0.5) . 's';
            @endphp
            <img src="{{ asset('storage/' . $sticker) }}" class="absolute {{ $pos }} w-16 h-16 md:w-24 md:h-24 object-contain opacity-70 float-anim pointer-events-none z-10" style="animation-delay: {{ $delay }};">
        @endforeach
    @endif

    <div class="relative z-20 text-center px-6 max-w-lg w-full">
        <div class="inline-block bg-white/80 rounded-full px-5 py-2 mb-7 soft-shadow">
            <span class="text-xs tracking-[3px] font-bold text-darkpink">✦ YOU ARE INVITED ✦</span>
        </div>
        <p class="section-label mb-3">THE WEDDING OF</p>
        <h1 class="font-display text-5xl md:text-7xl gradient-text mb-7 leading-tight">{{ $invitation->title }}</h1>

        <div class="flex justify-center items-center gap-5 mb-8">
            @if(isset($invitation->config['groom_photo']))
                <div class="relative">
                    <img src="{{ asset('storage/' . $invitation->config['groom_photo']) }}" class="w-24 h-32 md:w-28 md:h-36 object-cover rounded-2xl border-4 border-white shadow-xl rotate-[-5deg]">
                    <span class="absolute -bottom-3 left-1/2 -translate-x-1/2 bg-white px-3 py-1 rounded-full text-[9px] font-bold text-darkpink shadow">GROOM</span>
                </div>
            @endif
            <span class="font-display text-4xl italic text-pink">&</span>
            @if(isset($invitation->config['bride_photo']))
                <div class="relative">
                    <img src="{{ asset('storage/' . $invitation->config['bride_photo']) }}" class="w-24 h-32 md:w-28 md:h-36 object-cover rounded-2xl border-4 border-white shadow-xl rotate-[5deg]">
                    <span class="absolute -bottom-3 left-1/2 -translate-x-1/2 bg-white px-3 py-1 rounded-full text-[9px] font-bold text-darkpink shadow">BRIDE</span>
                </div>
            @endif
        </div>

        <p class="text-sm text-gray-600 mb-2 font-semibold">Special invitation for</p>
        <h2 class="text-xl font-bold text-ink mb-8 bg-white/50 inline-block px-4 py-1 rounded-full">
            @if($guest) {{ $guest->name }} @else Bapak/Ibu/Saudara/i @endif
        </h2>
        
        <br>
        <button onclick="openInvitation()" class="kpop-button px-10 py-4 rounded-full font-bold text-sm tracking-widest mt-4">OPEN INVITATION ♡</button>
    </div>
</div>

<!-- MAIN CONTENT -->
<div id="main-content" class="hidden w-full min-h-screen pb-16">
    
    <section class="relative min-h-[85vh] flex items-center justify-center overflow-hidden px-6" style="background-image: url('{{ $bgImg }}'); background-size: cover; background-position: center;">
        <div class="absolute inset-0 bg-gradient-to-br from-white/80 via-pink/70 to-lavender/80 backdrop-blur-sm z-0"></div>

        @if(isset($invitation->config['sticker_images']))
            @foreach($invitation->config['sticker_images'] as $index => $sticker)
                @php
                    $pos = ['top-10 left-[10%]', 'bottom-20 right-[10%]', 'top-1/2 left-[5%]', 'top-1/3 right-[5%]'][$index % 4];
                    $delay = ($index * 0.7) . 's';
                @endphp
                <img src="{{ asset('storage/' . $sticker) }}" class="absolute {{ $pos }} w-16 h-16 md:w-24 md:h-24 object-contain opacity-60 float-anim pointer-events-none z-10" style="animation-delay: {{ $delay }};">
            @endforeach
        @endif

        <div class="relative z-20 text-center max-w-2xl bg-white/30 p-8 md:p-12 rounded-3xl backdrop-blur-md border border-white/50 shadow-2xl">
            <div class="inline-flex items-center gap-2 bg-white/80 px-5 py-2 rounded-full mb-6">
                <span class="text-pink">✦</span>
                <span class="text-[10px] tracking-[4px] font-bold text-darkpink">OUR SPECIAL DAY</span>
                <span class="text-pink">✦</span>
            </div>
            <p class="font-display italic text-2xl text-darkpink mb-3">A love story begins...</p>
            <h1 class="font-display text-5xl md:text-7xl gradient-text leading-tight mb-6">{{ $invitation->title }}</h1>

            <div class="flex justify-center items-center gap-4 mb-6">
                @if(isset($invitation->config['groom_photo']))
                    <img src="{{ asset('storage/' . $invitation->config['groom_photo']) }}" class="w-20 h-28 md:w-28 md:h-36 object-cover rounded-2xl border-4 border-white shadow-xl rotate-[-3deg]">
                @endif
                <span class="font-display text-3xl italic text-darkpink">&</span>
                @if(isset($invitation->config['bride_photo']))
                    <img src="{{ asset('storage/' . $invitation->config['bride_photo']) }}" class="w-20 h-28 md:w-28 md:h-36 object-cover rounded-2xl border-4 border-white shadow-xl rotate-[3deg]">
                @endif
            </div>

            <div class="divider"></div>
            <p class="font-outfit font-bold tracking-[5px] text-sm text-darkpink">{{ \Carbon\Carbon::parse($invitation->event_date)->format('d . m . Y') }}</p>
            <p class="text-xs text-ink font-semibold mt-4 tracking-widest">TWO HEARTS, ONE BEAUTIFUL STORY ♡</p>
        </div>
    </section>

    @if(!empty($invitation->config['opening_greeting']) || !empty($invitation->config['quran_verse']))
    <section class="max-w-lg mx-auto px-6 py-16 text-center">
        @if(!empty($invitation->config['opening_greeting']))
            <div class="mb-10">
                <p class="font-arabic">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ</p>
                <p class="font-display text-2xl md:text-3xl text-darkpink leading-relaxed whitespace-pre-line">{{ $invitation->config['opening_greeting'] }}</p>
            </div>
        @endif

        @if(!empty($invitation->config['quran_verse']))
            <div class="glass soft-shadow rounded-3xl p-6 text-center">
                <h3 class="font-display italic text-xl text-darkpink mb-4">Firman Allah SWT</h3>
                <p class="text-sm leading-relaxed text-gray-700 whitespace-pre-line">{{ $invitation->config['quran_verse'] }}</p>
            </div>
        @endif
    </section>
    @endif

    @if(!empty($invitation->config['love_story']))
    <section class="max-w-lg mx-auto px-6 py-10">
        <div class="text-center mb-6">
            <h2 class="font-display text-3xl gradient-text">Kisah Cinta</h2>
            <div class="divider"></div>
        </div>
        <div class="glass soft-shadow rounded-3xl p-6">
            <p class="text-sm leading-relaxed text-gray-700 whitespace-pre-line">{{ $invitation->config['love_story'] }}</p>
        </div>
    </section>
    @endif

    <section class="max-w-lg mx-auto px-5 py-10 relative z-30">
        <div class="glass soft-shadow rounded-3xl p-7 text-center">
            <p class="section-label">COUNTING DOWN TO FOREVER</p>
            <h2 class="font-display text-3xl gradient-text mt-3 mb-6">Save The Date</h2>
            <div class="grid grid-cols-4 gap-3">
                <div class="bg-white rounded-2xl p-3 shadow-sm"><span id="days" class="block text-3xl font-outfit font-bold gradient-text">00</span><span class="text-[9px] tracking-widest text-gray-400">DAYS</span></div>
                <div class="bg-white rounded-2xl p-3 shadow-sm"><span id="hours" class="block text-3xl font-outfit font-bold gradient-text">00</span><span class="text-[9px] tracking-widest text-gray-400">HOURS</span></div>
                <div class="bg-white rounded-2xl p-3 shadow-sm"><span id="minutes" class="block text-3xl font-outfit font-bold gradient-text">00</span><span class="text-[9px] tracking-widest text-gray-400">MINUTES</span></div>
                <div class="bg-white rounded-2xl p-3 shadow-sm"><span id="seconds" class="block text-3xl font-outfit font-bold gradient-text">00</span><span class="text-[9px] tracking-widest text-gray-400">SECONDS</span></div>
            </div>
        </div>
    </section>

    @if(!empty($invitation->config['event_1_name']) || !empty($invitation->config['event_2_name']))
    <section class="max-w-lg mx-auto px-6 py-10 text-center">
        <p class="text-sm mb-8 text-gray-600">InsyaAllah kami akan menyelenggarakan acara:</p>
        
        <div class="space-y-8">
            @if(!empty($invitation->config['event_1_name']))
            <div>
                <h3 class="font-display text-4xl text-darkpink mb-2">{{ $invitation->config['event_1_name'] }}</h3>
                <p class="text-sm font-bold text-gray-600">{{ $invitation->config['event_1_time'] }}</p>
            </div>
            @endif

            @if(!empty($invitation->config['event_2_name']))
            <div>
                <h3 class="font-display text-4xl text-darkpink mb-2">{{ $invitation->config['event_2_name'] }}</h3>
                <p class="text-sm font-bold text-gray-600">{{ $invitation->config['event_2_time'] }}</p>
            </div>
            @endif
        </div>

        @if(!empty($invitation->config['dress_code']))
        <div class="mt-12">
            <p class="text-sm text-gray-600 mb-4">Demi kehangatan bersama, kami memohon kesediaan Anda untuk mengenakan dress code berikut:</p>
            
            @if(isset($invitation->config['dress_code_colors']) && count($invitation->config['dress_code_colors']) > 0)
            <div class="flex justify-center gap-2 mb-4">
                @foreach($invitation->config['dress_code_colors'] as $index => $color)
                    <div class="w-10 h-10 rounded-full border-2 border-white shadow-md" style="background-color: {{ $color }}; margin-left: {{ $index > 0 ? '-10px' : '0' }};"></div>
                @endforeach
            </div>
            @endif
            
            <p class="text-sm font-bold text-darkpink">{{ $invitation->config['dress_code'] }}</p>
        </div>
        @endif

        @if(!empty($invitation->config['maps_link']))
        <div class="mt-10">
            <a href="{{ $invitation->config['maps_link'] }}" target="_blank" class="inline-flex items-center gap-2 border-2 border-gray-800 text-gray-800 px-6 py-2 rounded-full font-bold text-sm hover:bg-gray-800 hover:text-white transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Lihat Google Maps
            </a>
            @if(!empty($invitation->config['maps_address']))
                <p class="text-xs text-gray-500 mt-4 leading-relaxed max-w-xs mx-auto">{{ $invitation->config['maps_address'] }}</p>
            @endif
        </div>
        @endif
    </section>
    @endif

    @if(isset($invitation->config['gallery_images']) && count($invitation->config['gallery_images']) > 0)
    <section class="max-w-lg mx-auto px-6 py-20 bg-pink-gradient">
        <div class="text-center mb-10">
            <p class="section-label">OUR PHOTOBOOK</p>
            <h2 class="font-display text-4xl gradient-text mt-3">Our Moments ♡</h2>
            <p class="text-xs text-gray-400 mt-3">Little memories, endless love.</p>
            <div class="divider"></div>
        </div>
        <div class="grid grid-cols-2 gap-5">
            @foreach($invitation->config['gallery_images'] as $index => $img)
                @php
                    $desc = isset($invitation->config['gallery_descriptions'][$index]) && !empty($invitation->config['gallery_descriptions'][$index]) 
                            ? $invitation->config['gallery_descriptions'][$index] 
                            : 'Memory No. ' . sprintf('%02d', $index + 1) . ' ♡';
                @endphp
                <div class="photocard {{ $index % 2 == 0 ? 'rotate-[-3deg]' : 'rotate-[3deg]' }}">
                    <img src="{{ asset('storage/' . $img) }}" class="w-full h-44 object-cover rounded-lg">
                    <p class="text-center font-display italic text-sm text-darkpink mt-3">{{ $desc }}</p>
                </div>
            @endforeach
        </div>
    </section>
    @endif

    <section class="max-w-lg mx-auto px-5 py-16">
        <div class="text-center mb-8">
            <p class="section-label">SEND YOUR LOVE</p>
            <h2 class="font-display text-4xl gradient-text mt-3">Fan Letter ♡</h2>
            <p class="text-xs text-gray-400 mt-3">Leave a sweet message for the happy couple.</p>
            <div class="divider"></div>
        </div>
        <div class="glass soft-shadow rounded-3xl p-7">
            @if(session('message_success'))
                <div class="bg-green-100 text-green-800 p-3 rounded-xl mb-4 text-center text-sm">{{ session('message_success') }}</div>
            @endif
            <form action="{{ route('messages.store', $invitation->id) }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="text-xs font-bold text-darkpink mb-2 block">YOUR NAME</label>
                    <input type="text" name="name" class="w-full bg-white border border-pink/30 p-4 rounded-xl text-sm text-ink" placeholder="Write your name..." required>
                </div>
                <div>
                    <label class="text-xs font-bold text-darkpink mb-2 block">YOUR MESSAGE</label>
                    <textarea name="message" rows="4" class="w-full bg-white border border-pink/30 p-4 rounded-xl text-sm text-ink resize-none" placeholder="Write your wishes & prayers... ♡" required></textarea>
                </div>
                <button type="submit" class="kpop-button w-full py-4 rounded-xl font-bold text-sm tracking-widest">SEND LOVE ♡</button>
            </form>
            
            <div class="mt-8 space-y-3 max-h-60 overflow-y-auto pr-2">
                @forelse($messages as $msg)
                    <div class="bg-white p-3 rounded-xl border border-pink/20 shadow-sm">
                        <div class="flex justify-between items-center mb-1">
                            <h4 class="font-bold text-darkpink text-sm">{{ $msg->name }}</h4>
                            <span class="text-[10px] text-gray-400">{{ $msg->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-600 text-sm">{{ $msg->message }}</p>
                    </div>
                @empty
                    <p class="text-center text-gray-400 text-sm italic">Belum ada ucapan.</p>
                @endforelse
            </div>
        </div>
    </section>

    <footer class="text-center px-6 py-10 pink-gradient mt-10">
        <p class="font-display italic text-3xl gradient-text">Happily Ever After</p>
        <p class="text-xs text-gray-500 mt-4">Made with ♡ and endless love.</p>
    </footer>
</div>

<!-- TOMBOL MUSIK -->
<button id="music-btn" class="fixed bottom-6 right-6 w-12 h-12 bg-darkpink text-white rounded-full flex items-center justify-center shadow-[0_4px_15px_rgba(184,92,135,0.5)] z-[100] hover:scale-110 transition hidden">
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
            main.classList.remove('hidden');
            main.classList.add('fade-in');
            
            // Play music and show button
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

    const targetDate = new Date("{{ \Carbon\Carbon::parse($invitation->event_date)->toIso8601String() }}").getTime();
    function updateCountdown() {
        const now = new Date().getTime();
        const distance = targetDate - now;
        if (distance < 0) return;
        document.getElementById('days').innerText = String(Math.floor(distance / (1000 * 60 * 60 * 24))).padStart(2, '0');
        document.getElementById('hours').innerText = String(Math.floor((distance / (1000 * 60 * 60)) % 24)).padStart(2, '0');
        document.getElementById('minutes').innerText = String(Math.floor((distance / (1000 * 60)) % 60)).padStart(2, '0');
        document.getElementById('seconds').innerText = String(Math.floor((distance / 1000) % 60)).padStart(2, '0');
    }
    updateCountdown();
    setInterval(updateCountdown, 1000);
</script>
</body>
</html>