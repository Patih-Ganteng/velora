<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invitation->title }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&family=Zen+Maru+Gothic:wght@400;500;700;900&family=M+PLUS+Rounded+1c:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        sakura: '#ff8fab', petal: '#ffd6e0', mist: '#fff4f8', night: '#3b3468',
                        lavender: '#b9a8ff', skyanime: '#8fd3ff', gold: '#ffd166', ink: '#3a3558',
                    },
                    fontFamily: {
                        sans: ['"M PLUS Rounded 1c"', 'sans-serif'],
                        jp: ['"Zen Maru Gothic"', 'sans-serif'],
                        pop: ['"Mochiy Pop One"', '"Zen Maru Gothic"', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        :root {
            --sakura: #ff8fab; --petal: #ffd6e0; --night: #3b3468;
            --lavender: #b9a8ff; --sky: #8fd3ff; --gold: #ffd166; --ink: #3a3558;
        }

        html { scroll-behavior: smooth; }
        body {
            color: var(--ink); overflow-x: hidden; background-color: #fff4f8;
            background-image: radial-gradient(rgba(255, 143, 171, .18) 1.2px, transparent 1.4px), linear-gradient(180deg, #fff4f8 0%, #f3eeff 55%, #eaf6ff 100%);
            background-size: 14px 14px, 100% 100%; background-attachment: fixed;
        }

        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-thumb { background: var(--sakura); border-radius: 10px; border: 2px solid #fff4f8; }

        #petals { position: fixed; inset: 0; pointer-events: none; z-index: 60; overflow: hidden; }
        .petal { position: absolute; top: -40px; background: linear-gradient(135deg, #ffe3ec, #ff9fba); border-radius: 150% 0 150% 0; opacity: .85; animation: fall linear infinite, sway ease-in-out infinite alternate; }
        @keyframes fall { to { transform: translateY(110vh) rotate(540deg); } }
        @keyframes sway { from { margin-left: -25px; } to { margin-left: 25px; } }

        .float-anim { animation: float 5s ease-in-out infinite; filter: drop-shadow(0 6px 8px rgba(59, 52, 104, .25)); }
        @keyframes float { 0% { transform: translateY(0) rotate(0deg); } 50% { transform: translateY(-14px) rotate(-5deg); } 100% { transform: translateY(0) rotate(0deg); } }

        .title-card { font-family: 'Mochiy Pop One', 'Zen Maru Gothic', sans-serif; color: #fff; line-height: 1.15; text-shadow: -3px -3px 0 var(--night), 3px -3px 0 var(--night), -3px 3px 0 var(--night), 3px 3px 0 var(--night), 0 7px 0 var(--night), 5px 10px 0 var(--sakura); letter-spacing: .02em; }

        .btn-anime { display: inline-flex; align-items: center; gap: .5rem; padding: .85rem 2.2rem; font-family: 'Zen Maru Gothic', sans-serif; font-weight: 900; color: #fff; background: linear-gradient(180deg, #ff9fba, #ff7a9f); border: 3px solid #fff; border-radius: 999px; box-shadow: 0 5px 0 #d94f78, 0 12px 20px rgba(217, 79, 120, .35); transition: transform .15s, box-shadow .15s; cursor: pointer; }
        .btn-anime:hover { transform: translateY(-2px); box-shadow: 0 7px 0 #d94f78, 0 16px 24px rgba(217, 79, 120, .35); }
        .btn-anime:active { transform: translateY(4px); box-shadow: 0 1px 0 #d94f78; }

        .vn-box { position: relative; background: rgba(59, 52, 104, .94); color: #fff; border: 3px solid #fff; border-radius: 22px; padding: 1.6rem 1.4rem 1.2rem; box-shadow: 0 0 0 3px var(--lavender), 0 14px 30px rgba(59, 52, 104, .35); text-align: left; }
        .vn-name { position: absolute; top: -17px; left: 18px; background: linear-gradient(180deg, #ff9fba, #ff7a9f); color: #fff; font-family: 'Zen Maru Gothic', sans-serif; font-weight: 900; font-size: .8rem; padding: .3rem 1.1rem; border-radius: 999px; border: 3px solid #fff; box-shadow: 0 3px 0 #d94f78; }
        .vn-text { min-height: 2.4rem; font-family: 'Zen Maru Gothic', sans-serif; font-weight: 700; font-size: 1.35rem; }
        .vn-next { position: absolute; right: 18px; bottom: 8px; color: var(--gold); font-size: .85rem; animation: blink 1s steps(2) infinite; }
        @keyframes blink { 50% { opacity: 0; } }

        .card { background: #fff; border: 3px solid #fff; border-radius: 28px; box-shadow: 0 0 0 2px var(--petal), 0 10px 0 -2px rgba(255, 143, 171, .25), 0 18px 30px rgba(185, 168, 255, .25); }
        .ribbon { display: inline-block; background: linear-gradient(90deg, var(--lavender), var(--sakura)); color: #fff; font-family: 'Mochiy Pop One', sans-serif; padding: .45rem 1.6rem; border-radius: 12px 12px 12px 0; border: 3px solid #fff; box-shadow: 0 4px 0 rgba(59, 52, 104, .25); transform: rotate(-2deg); }
        .sparkle::before, .sparkle::after { content: '✦'; color: var(--gold); margin: 0 .5rem; font-size: .8em; }

        .font-arabic { font-family: 'Traditional Arabic', 'Scheherazade New', serif; font-size: 2.4rem; line-height: 1.6; text-align: center; color: var(--sakura); margin-bottom: 1rem; }

        .hud { background: radial-gradient(circle at 20% 0%, #5a4fa8 0%, var(--night) 60%); border-radius: 28px; border: 3px solid #fff; box-shadow: 0 0 0 3px var(--lavender), 0 16px 30px rgba(59, 52, 104, .35); color: #fff; }
        .hud-cell { width: 4.2rem; padding: .6rem 0 .4rem; border-radius: 16px; background: rgba(255, 255, 255, .1); border: 2px solid rgba(255, 255, 255, .5); }
        .hud-cell span.num { display: block; font-family: 'Mochiy Pop One', sans-serif; font-size: 1.6rem; color: var(--gold); text-shadow: 0 0 12px rgba(255, 209, 102, .7); }

        .quest { position: relative; text-align: left; background: linear-gradient(135deg, #fff4f8, #f3eeff); border: 2px dashed var(--sakura); border-radius: 20px; padding: 1rem 1.2rem 1rem 4rem; }
        .quest::before { content: '🌸'; position: absolute; left: .9rem; top: 50%; transform: translateY(-50%); width: 2.4rem; height: 2.4rem; display: grid; place-items: center; background: #fff; border-radius: 50%; border: 2px solid var(--petal); }

        .polaroid { position: relative; background: #fff; padding: 10px 10px 22px; border-radius: 6px; box-shadow: 0 8px 18px rgba(185, 168, 255, .35); transition: transform .3s; }
        .polaroid::before { content: ''; position: absolute; top: -10px; left: 50%; width: 64px; height: 20px; transform: translateX(-50%) rotate(-4deg); background: repeating-linear-gradient(45deg, rgba(255, 143, 171, .75) 0 6px, rgba(255, 255, 255, .75) 6px 12px); }
        .polaroid:hover { transform: translateY(-5px) rotate(0deg) !important; }

        .field { width: 100%; background: #fff9fc; border: 2px solid var(--petal); padding: .8rem 1rem; border-radius: 16px; font-size: .9rem; transition: border-color .2s, box-shadow .2s; }
        .field:focus { border-color: var(--sakura); box-shadow: 0 0 0 4px rgba(255, 143, 171, .2); outline: none; }
        .bubble { position: relative; background: #f6f1ff; border: 2px solid #e3d9ff; border-radius: 4px 20px 20px 20px; padding: .8rem 1rem; }
        .avatar { flex: none; width: 2.4rem; height: 2.4rem; border-radius: 50%; display: grid; place-items: center; color: #fff; font-family: 'Mochiy Pop One', sans-serif; background: linear-gradient(135deg, var(--lavender), var(--sakura)); border: 2px solid #fff; box-shadow: 0 2px 6px rgba(0,0,0,.15); }

        .music-btn { position: fixed; right: 16px; bottom: 16px; z-index: 55; width: 52px; height: 52px; border-radius: 50%; background: var(--night); border: 3px solid #fff; color: #fff; font-size: 1.3rem; box-shadow: 0 0 0 2px var(--lavender), 0 8px 16px rgba(59, 52, 104, .4); cursor: pointer; display: none; place-items: center; }
        .music-btn.show { display: grid; }
        .music-btn.playing span { display: inline-block; animation: spin 4s linear infinite; }
        @keyframes spin { to { transform: rotate(360deg); } }

        .fade-in { animation: fadeIn 1.2s ease both; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: none; } }
    </style>
</head>
<body class="font-sans antialiased">

@php
    $bgImg = isset($invitation->config['background_image']) ? asset('storage/' . $invitation->config['background_image']) : '';
@endphp

    <div id="petals" aria-hidden="true"></div>

    <!-- WELCOME SCREEN -->
    <div id="welcome-screen" class="fixed inset-0 z-50 flex flex-col items-center justify-center transition-opacity duration-1000 overflow-hidden px-4"
         style="background-image: url('{{ $bgImg }}'); background-size: cover; background-position: center;">

        <div class="absolute inset-0" style="background: linear-gradient(180deg, rgba(255,214,224,.88) 0%, rgba(233,224,255,.9) 55%, rgba(200,230,255,.92) 100%);"></div>
        <div class="absolute inset-0 opacity-60" style="background-image: radial-gradient(rgba(255,255,255,.9) 1.5px, transparent 2px); background-size: 38px 38px;"></div>

        @if(isset($invitation->config['sticker_images']))
            @foreach($invitation->config['sticker_images'] as $index => $sticker)
                @php
                    $positions = ['top-10 left-5', 'top-20 right-10', 'bottom-20 left-10', 'bottom-10 right-5', 'top-1/3 right-1/4'];
                    $pos = $positions[$index % 5];
                @endphp
                <img src="{{ asset('storage/' . $sticker) }}" alt="" class="absolute {{ $pos }} w-24 h-24 md:w-32 md:h-32 object-contain opacity-90 float-anim pointer-events-none z-10" style="animation-delay: {{ $index * 0.5 }}s;">
            @endforeach
        @endif

        <div class="relative z-20 w-full max-w-md text-center overflow-y-auto max-h-full py-6">
            <p class="ribbon text-sm mb-5">Our Special Day</p>
            <h1 class="title-card text-4xl md:text-6xl mb-8">{{ $invitation->title }}</h1>

            <div class="flex justify-center items-center gap-3 mb-9">
                @if(isset($invitation->config['groom_photo']))
                    <img src="{{ asset('storage/' . $invitation->config['groom_photo']) }}" alt="" class="w-24 h-24 object-cover rounded-full border-4 border-white shadow-lg -rotate-6" style="box-shadow: 0 0 0 3px var(--lavender), 0 10px 20px rgba(59,52,104,.3);">
                @endif
                <span class="title-card text-3xl">&amp;</span>
                @if(isset($invitation->config['bride_photo']))
                    <img src="{{ asset('storage/' . $invitation->config['bride_photo']) }}" alt="" class="w-24 h-24 object-cover rounded-full border-4 border-white shadow-lg rotate-6" style="box-shadow: 0 0 0 3px var(--sakura), 0 10px 20px rgba(59,52,104,.3);">
                @endif
            </div>

            <div class="vn-box mb-8">
                <span class="vn-name">Kepada Yth,</span>
                <p id="guest-line" class="vn-text" data-text="{{ $guest ? $guest->name : 'Bapak/Ibu/Saudara/i' }}">
                    {{ $guest ? $guest->name : 'Bapak/Ibu/Saudara/i' }}
                </p>
                <span class="vn-next" aria-hidden="true">▼</span>
            </div>

            <button onclick="openInvitation()" class="btn-anime text-lg">
                Buka Undangan 🌸
            </button>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div id="main-content" class="hidden w-full min-h-screen relative pb-24">

        <!-- Hero -->
        <div class="h-[75vh] flex flex-col items-center justify-center relative overflow-hidden px-4"
             style="background-image: url('{{ $bgImg }}'); background-size: cover; background-position: center;">

            <div class="absolute inset-0" style="background: linear-gradient(180deg, rgba(255,214,224,.85) 0%, rgba(233,224,255,.85) 60%, rgba(255,244,248,1) 100%);"></div>

            @if(isset($invitation->config['sticker_images']))
                @foreach($invitation->config['sticker_images'] as $index => $sticker)
                    <img src="{{ asset('storage/' . $sticker) }}" alt="" class="absolute w-20 h-20 md:w-28 md:h-28 object-contain opacity-70 float-anim pointer-events-none" style="top: {{ rand(10, 70) }}%; left: {{ rand(5, 80) }}%; animation-delay: {{ $index }}s;">
                @endforeach
            @endif

            <div class="relative z-10 text-center">
                <p class="ribbon text-sm mb-6">We're getting married</p>
                <h1 class="title-card text-5xl md:text-7xl mb-8">{{ $invitation->title }}</h1>
                <p class="inline-block bg-white font-jp font-black text-night px-6 py-2 rounded-full border-[3px] border-night shadow-[0_4px_0_var(--sakura)] sparkle">
                    {{ \Carbon\Carbon::parse($invitation->event_date)->translatedFormat('d F Y') }}
                </p>
            </div>
        </div>

        <!-- Konten Utama -->
        <div class="max-w-lg mx-auto px-5 space-y-14 -mt-10 relative z-20">

            @if(!empty($invitation->config['opening_greeting']) || !empty($invitation->config['quran_verse']))
            <section class="card p-6 text-center">
                @if(!empty($invitation->config['opening_greeting']))
                    <div class="mb-6">
                        <p class="font-arabic">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ</p>
                        <p class="font-jp text-lg text-ink leading-relaxed whitespace-pre-line">{{ $invitation->config['opening_greeting'] }}</p>
                    </div>
                @endif

                @if(!empty($invitation->config['quran_verse']))
                    <div class="p-5 rounded-2xl border-2 border-dashed border-lavender bg-[#f6f1ff]">
                        <p class="text-ink/70 text-sm leading-relaxed whitespace-pre-line italic">{{ $invitation->config['quran_verse'] }}</p>
                    </div>
                @endif
            </section>
            @endif

            @if(!empty($invitation->config['love_story']))
            <section class="card p-6 text-center" style="background: linear-gradient(180deg, #fff 0%, #fff4f8 100%);">
                <h2 class="ribbon text-xl mb-5">Kisah Cinta Kita 💖</h2>
                <p class="text-sm leading-loose text-ink/80 whitespace-pre-line">{{ $invitation->config['love_story'] }}</p>
            </section>
            @endif

            <section class="hud p-6 text-center">
                <h3 class="font-pop text-xl mb-1 sparkle">Hitung Mundur</h3>
                <p class="text-xs text-white/70 mb-5">Menuju hari bahagia kami</p>
                <div class="flex justify-center gap-2 sm:gap-3">
                    <div class="hud-cell"><span id="days" class="num">00</span><span class="text-[10px] text-white/80">Hari</span></div>
                    <div class="hud-cell"><span id="hours" class="num">00</span><span class="text-[10px] text-white/80">Jam</span></div>
                    <div class="hud-cell"><span id="minutes" class="num">00</span><span class="text-[10px] text-white/80">Menit</span></div>
                    <div class="hud-cell"><span id="seconds" class="num">00</span><span class="text-[10px] text-white/80">Detik</span></div>
                </div>
            </section>

            @if(!empty($invitation->config['event_1_name']) || !empty($invitation->config['event_2_name']))
            <section class="card p-6 text-center">
                <h2 class="ribbon text-xl mb-4">Jadwal Acara</h2>
                <p class="text-sm text-ink/70 mb-6">Kami akan menyelenggarakan acara:</p>

                <div class="space-y-4 mb-8">
                    @if(!empty($invitation->config['event_1_name']))
                    <div class="quest">
                        <h3 class="font-jp font-black text-xl text-night mb-1">{{ $invitation->config['event_1_name'] }}</h3>
                        <p class="text-sm font-bold text-sakura">{{ $invitation->config['event_1_time'] }}</p>
                    </div>
                    @endif

                    @if(!empty($invitation->config['event_2_name']))
                    <div class="quest">
                        <h3 class="font-jp font-black text-xl text-night mb-1">{{ $invitation->config['event_2_name'] }}</h3>
                        <p class="text-sm font-bold text-sakura">{{ $invitation->config['event_2_time'] }}</p>
                    </div>
                    @endif
                </div>

                @if(!empty($invitation->config['dress_code']))
                <div class="mb-8 bg-[#f6f1ff] p-4 rounded-2xl border-2 border-[#e3d9ff]">
                    <p class="text-xs text-ink/60 mb-3">Dress code yang disarankan:</p>
                    @if(isset($invitation->config['dress_code_colors']) && count($invitation->config['dress_code_colors']) > 0)
                    <div class="flex justify-center mb-3">
                        @foreach($invitation->config['dress_code_colors'] as $index => $color)
                            <div class="w-10 h-10 rounded-full border-[3px] border-white shadow-md" style="background-color: {{ $color }}; margin-left: {{ $index > 0 ? '-10px' : '0' }};"></div>
                        @endforeach
                    </div>
                    @endif
                    <p class="text-sm font-bold text-night">{{ $invitation->config['dress_code'] }}</p>
                </div>
                @endif

                @if(!empty($invitation->config['maps_link']))
                <div class="mt-4">
                    <a href="{{ $invitation->config['maps_link'] }}" target="_blank" rel="noopener" class="btn-anime text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Lihat Lokasi
                    </a>
                    @if(!empty($invitation->config['maps_address']))
                        <p class="text-xs text-ink/60 mt-4 leading-relaxed max-w-xs mx-auto">{{ $invitation->config['maps_address'] }}</p>
                    @endif
                </div>
                @endif
            </section>
            @endif

            @if(isset($invitation->config['gallery_images']) && count($invitation->config['gallery_images']) > 0)
            <section class="text-center">
                <h3 class="ribbon text-xl mb-8">Kenangan Manis 🌸</h3>
                <div class="grid grid-cols-2 gap-6">
                    @foreach($invitation->config['gallery_images'] as $index => $img)
                        @php
                            $desc = isset($invitation->config['gallery_descriptions'][$index]) && !empty($invitation->config['gallery_descriptions'][$index])
                                    ? $invitation->config['gallery_descriptions'][$index]
                                    : 'Momen ' . sprintf('%02d', $index + 1);
                        @endphp
                        <div class="polaroid transform {{ $index % 2 == 0 ? 'rotate-2' : '-rotate-2' }}">
                            <img src="{{ asset('storage/' . $img) }}" alt="{{ $desc }}" class="w-full h-40 object-cover rounded-sm">
                            <p class="text-center font-jp font-bold text-xs text-ink mt-3">{{ $desc }}</p>
                        </div>
                    @endforeach
                </div>
            </section>
            @endif

            <!-- FORM GABUNGAN: RSVP & UCAPAN (BUAT SHARE WA) -->
            <section class="card p-6 text-center">
                <h3 class="ribbon text-xl mb-5 block w-fit mx-auto">Konfirmasi & Ucapan 🌸</h3>
                
                @if(session('message_success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded-xl mb-4 text-center text-sm border-2 border-green-200">{{ session('message_success') }}</div>
                @endif
                @if(session('rsvp_success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded-xl mb-4 text-center text-sm border-2 border-green-200">{{ session('rsvp_success') }}</div>
                @endif

                <form action="{{ route('messages.store', $invitation->id) }}" method="POST" class="space-y-5 text-left">
                    @csrf
                    
                    <div>
                        <label class="text-xs font-bold text-night mb-2 block uppercase tracking-wider">Nama Anda</label>
                        <input type="text" name="name" value="{{ $guest->name ?? '' }}" class="field" placeholder="Tulis nama kamu..." {{ $guest ? 'readonly' : 'required' }}>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-night mb-2 block uppercase tracking-wider">Konfirmasi Kehadiran</label>
                        <div class="flex gap-3">
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="rsvp_status" value="hadir" class="peer hidden" required>
                                <div class="w-full text-center py-3 rounded-xl border-2 border-petal text-ink/60 font-black text-sm peer-checked:bg-sakura peer-checked:text-white peer-checked:border-transparent transition-all">Hadir</div>
                            </label>
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="rsvp_status" value="tidak_hadir" class="peer hidden">
                                <div class="w-full text-center py-3 rounded-xl border-2 border-petal text-ink/60 font-black text-sm peer-checked:bg-gray-400 peer-checked:text-white peer-checked:border-transparent transition-all">Tidak Hadir</div>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-night mb-2 block uppercase tracking-wider">Ucapan & Doa</label>
                        <textarea name="message" rows="3" class="field resize-none" placeholder="Tulis ucapan atau doa terbaikmu..." required></textarea>
                    </div>

                    <button type="submit" class="btn-anime w-full justify-center">KIRIM SEKARANG ✨</button>
                </form>

                <div class="mt-8 space-y-4 max-h-72 overflow-y-auto pr-2 text-left">
                    <h4 class="font-black text-night text-center mb-4">Buku Tamu</h4>
                    @forelse($messages as $msg)
                        <div class="flex gap-3 items-start">
                            <div class="avatar">{{ mb_strtoupper(mb_substr($msg->name, 0, 1)) }}</div>
                            <div class="bubble flex-1 min-w-0">
                                <div class="flex justify-between items-center gap-2 mb-1">
                                    <h4 class="font-bold text-night text-sm truncate">{{ $msg->name }}</h4>
                                    <span class="text-[10px] text-ink/50 shrink-0">{{ $msg->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-ink/80 text-sm break-words">{{ $msg->message }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-ink/50 text-sm italic">Belum ada ucapan. Jadilah yang pertama!</p>
                    @endforelse
                </div>
            </section>

            <p class="text-center font-pop text-night sparkle pt-4">Terima kasih telah hadir</p>
        </div>
    </div>

    <button id="music-btn" class="music-btn" onclick="toggleMusic()" aria-label="Putar atau jeda musik"><span>💿</span></button>

    <!-- AUDIO SOURCE DINAMIS -->
    <audio id="bg-music" loop>
        @if(isset($invitation->config['music_file']))
            <source src="{{ asset('storage/' . $invitation->config['music_file']) }}" type="audio/mpeg">
        @else
            <source src="https://cdn.pixabay.com/download/audio/2022/03/15/audio_c8c8a73467.mp3?filename=wedding-116846.mp3" type="audio/mpeg">
        @endif
    </audio>

    <script>
        const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        (function makePetals() {
            if (reduceMotion) return;
            const box = document.getElementById('petals');
            for (let i = 0; i < 22; i++) {
                const p = document.createElement('span');
                const size = 8 + Math.random() * 12;
                p.className = 'petal';
                p.style.width = size + 'px'; p.style.height = size + 'px';
                p.style.left = Math.random() * 100 + '%';
                p.style.animationDuration = (9 + Math.random() * 9) + 's, ' + (2 + Math.random() * 3) + 's';
                p.style.animationDelay = (-Math.random() * 14) + 's, 0s';
                box.appendChild(p);
            }
        })();

        (function typeGuest() {
            const el = document.getElementById('guest-line');
            const text = el.dataset.text;
            if (reduceMotion) return;
            el.textContent = '';
            let i = 0;
            const timer = setInterval(() => {
                el.textContent = text.slice(0, ++i);
                if (i >= text.length) clearInterval(timer);
            }, 55);
        })();

        const music = document.getElementById('bg-music');
        const musicBtn = document.getElementById('music-btn');

        function toggleMusic() {
            if (music.paused) {
                music.play().then(() => musicBtn.classList.add('playing')).catch(() => {});
            } else {
                music.pause();
                musicBtn.classList.remove('playing');
            }
        }

        function openInvitation() {
            const welcome = document.getElementById('welcome-screen');
            const main = document.getElementById('main-content');
            welcome.style.opacity = '0';
            setTimeout(() => {
                welcome.style.display = 'none';
                main.classList.remove('hidden');
                main.classList.add('fade-in');
                musicBtn.classList.add('show');
                music.play().then(() => musicBtn.classList.add('playing')).catch(() => {});
            }, 800);
        }

        const targetDate = new Date("{{ \Carbon\Carbon::parse($invitation->event_date)->toIso8601String() }}").getTime();
        function tick() {
            const distance = targetDate - new Date().getTime();
            if (distance < 0) return;
            document.getElementById("days").innerText = String(Math.floor(distance / (1000 * 60 * 60 * 24))).padStart(2, '0');
            document.getElementById("hours").innerText = String(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
            document.getElementById("minutes").innerText = String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
            document.getElementById("seconds").innerText = String(Math.floor((distance % (1000 * 60)) / 1000)).padStart(2, '0');
        }
        tick();
        setInterval(tick, 1000);
    </script>
</body>
</html>