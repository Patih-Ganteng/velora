<!DOCTYPE html>
<html>
<head>
    <title>Edit Undangan - Velora</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-8">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded shadow">
        <a href="{{ route('dashboard') }}" class="text-blue-500 mb-4 inline-block">&larr; Kembali ke Dashboard</a>
        <h1 class="text-2xl font-bold mb-2">Edit Undangan</h1>
        <p class="text-gray-500 mb-6">Judul: <b>{{ $invitation->title }}</b> (Kategori: {{ ucfirst($invitation->category) }})</p>

        <form action="{{ route('invitations.update', $invitation->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- ================= FORM KHUSUS ULANG TAHUN ================= -->
            @if($invitation->category === 'ultah')
            <div class="mb-8 p-4 bg-pink-50 border border-pink-100 rounded-lg">
                <h2 class="text-lg font-bold text-pink-700 mb-4 border-b pb-2">🎂 Informasi Ulang Tahun</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-3">
                    <div>
                        <label class="block text-gray-700 mb-1 font-semibold text-sm">Nama Panjang</label>
                        <input type="text" name="full_name" value="{{ $invitation->config['full_name'] ?? '' }}" placeholder="Misal: Yuda Adriansyah" class="w-full border p-2 rounded text-sm">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-1 font-semibold text-sm">Nama Panggilan</label>
                        <input type="text" name="nickname" value="{{ $invitation->config['nickname'] ?? '' }}" placeholder="Misal: Yuda" class="w-full border p-2 rounded text-sm">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-1 font-semibold text-sm">Ulang Tahun Ke-</label>
                        <input type="number" name="age" value="{{ $invitation->config['age'] ?? '' }}" placeholder="Misal: 17" class="w-full border p-2 rounded text-sm">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="block text-gray-700 mb-1 font-semibold text-sm">Teks Sapaan / Ucapan</label>
                    <textarea name="opening_greeting" rows="2" class="w-full border p-2 rounded text-sm" placeholder="Aku mengundangmu untuk datang ke pesta ulang tahunku!">{{ $invitation->config['opening_greeting'] ?? '' }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="block text-gray-700 mb-1 font-semibold text-sm">Waktu Acara</label>
                    <input type="text" name="event_1_time" value="{{ $invitation->config['event_1_time'] ?? '' }}" placeholder="Misal: 10.30 WIB" class="w-full border p-2 rounded text-sm">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3">
                    <div>
                        <label class="block text-gray-700 mb-1 font-semibold text-sm">Alamat / Tempat</label>
                        <input type="text" name="maps_address" value="{{ $invitation->config['maps_address'] ?? '' }}" placeholder="Rumah Jl. Raya..." class="w-full border p-2 rounded text-sm">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-1 font-semibold text-sm">Link Google Maps (Opsional)</label>
                        <input type="url" name="maps_link" value="{{ $invitation->config['maps_link'] ?? '' }}" placeholder="https://maps.app.goo.gl/..." class="w-full border p-2 rounded text-sm">
                    </div>
                </div>
            </div>
            @endif

            <!-- ================= FORM KHUSUS NIKAH ================= -->
            @if($invitation->category === 'nikah')
            <div class="mb-8 p-4 bg-blue-50 border border-blue-100 rounded-lg">
                <h2 class="text-lg font-bold text-blue-800 mb-4 border-b pb-2">💍 Informasi Pernikahan</h2>
                
                <div class="mb-3">
                    <label class="block text-gray-700 mb-1 font-semibold text-sm">Salam Pembuka / Doa</label>
                    <textarea name="opening_greeting" rows="3" class="w-full border p-2 rounded text-sm" placeholder="Assalamualaikum Warahmatullahi Wabarakatuh...">{{ $invitation->config['opening_greeting'] ?? '' }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="block text-gray-700 mb-1 font-semibold text-sm">Ayat Suci / Kutipan</label>
                    <textarea name="quran_verse" rows="2" class="w-full border p-2 rounded text-sm" placeholder="Dan segala sesuatu Kami ciptakan berpasang-pasangan...">{{ $invitation->config['quran_verse'] ?? '' }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="block text-gray-700 mb-1 font-semibold text-sm">Kisah Cinta</label>
                    <textarea name="love_story" rows="3" class="w-full border p-2 rounded text-sm" placeholder="Tuliskan perjalanan cinta kalian...">{{ $invitation->config['love_story'] ?? '' }}</textarea>
                </div>
                <div class="grid grid-cols-2 gap-3 mb-3">
                    <div>
                        <label class="block text-gray-700 mb-1 font-semibold text-sm">Acara 1 (Akad)</label>
                        <input type="text" name="event_1_name" value="{{ $invitation->config['event_1_name'] ?? '' }}" placeholder="Akad Nikah" class="w-full border p-2 rounded mb-1 text-sm">
                        <input type="text" name="event_1_time" value="{{ $invitation->config['event_1_time'] ?? '' }}" placeholder="Pukul 10.00 WIB" class="w-full border p-2 rounded text-sm">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-1 font-semibold text-sm">Acara 2 (Resepsi)</label>
                        <input type="text" name="event_2_name" value="{{ $invitation->config['event_2_name'] ?? '' }}" placeholder="Resepsi" class="w-full border p-2 rounded mb-1 text-sm">
                        <input type="text" name="event_2_time" value="{{ $invitation->config['event_2_time'] ?? '' }}" placeholder="Pukul 13.00 WIB" class="w-full border p-2 rounded text-sm">
                    </div>
                </div>
                <div class="mb-3 border-t pt-3">
                    <label class="block text-gray-700 mb-1 font-semibold text-sm">Dress Code (Opsional)</label>
                    <input type="text" name="dress_code" value="{{ $invitation->config['dress_code'] ?? '' }}" placeholder="Contoh: Busana batik." class="w-full border p-2 rounded text-sm mb-2">
                    
                    <label class="block text-gray-700 mb-1 font-semibold text-sm">Pilih Warna Dress Code</label>
                    <div class="flex gap-2">
                        <input type="color" name="dress_code_colors[]" value="{{ $invitation->config['dress_code_colors'][0] ?? '#ffffff' }}" class="w-12 h-10 border rounded cursor-pointer">
                        <input type="color" name="dress_code_colors[]" value="{{ $invitation->config['dress_code_colors'][1] ?? '#cccccc' }}" class="w-12 h-10 border rounded cursor-pointer">
                        <input type="color" name="dress_code_colors[]" value="{{ $invitation->config['dress_code_colors'][2] ?? '#000000' }}" class="w-12 h-10 border rounded cursor-pointer">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3">
                    <div>
                        <label class="block text-gray-700 mb-1 font-semibold text-sm">Alamat Lengkap</label>
                        <input type="text" name="maps_address" value="{{ $invitation->config['maps_address'] ?? '' }}" placeholder="RT 10 RW 02..." class="w-full border p-2 rounded text-sm">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-1 font-semibold text-sm">Link Google Maps</label>
                        <input type="url" name="maps_link" value="{{ $invitation->config['maps_link'] ?? '' }}" placeholder="https://maps.app.goo.gl/..." class="w-full border p-2 rounded text-sm">
                    </div>
                </div>
            </div>
            @endif

            <!-- ================= MEDIA (BERLAKU UNTUK SEMUA KATEGORI) ================= -->
            <div class="mb-8 p-4 bg-gray-50 border border-gray-200 rounded-lg">
                <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">📸 Media & Galeri</h2>
                
                @if($invitation->category === 'nikah')
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 mb-2 font-bold text-sm">Foto Mempelai Pria</label>
                        <input type="file" name="groom_photo" accept="image/*" class="w-full border p-1 rounded text-sm bg-white">
                        @if(isset($invitation->config['groom_photo']))
                            <img src="{{ asset('storage/' . $invitation->config['groom_photo']) }}" class="mt-2 h-16 rounded shadow">
                        @endif
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2 font-bold text-sm">Foto Mempelai Wanita</label>
                        <input type="file" name="bride_photo" accept="image/*" class="w-full border p-1 rounded text-sm bg-white">
                        @if(isset($invitation->config['bride_photo']))
                            <img src="{{ asset('storage/' . $invitation->config['bride_photo']) }}" class="mt-2 h-16 rounded shadow">
                        @endif
                    </div>
                </div>
                @endif

                @if($invitation->category === 'ultah')
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2 font-bold text-sm">Foto Utama (Yang Berulang Tahun)</label>
                    <input type="file" name="groom_photo" accept="image/*" class="w-full border p-1 rounded text-sm bg-white">
                    @if(isset($invitation->config['groom_photo']))
                        <img src="{{ asset('storage/' . $invitation->config['groom_photo']) }}" class="mt-2 h-20 w-20 object-cover rounded-full shadow">
                    @endif
                </div>
                @endif

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2 font-bold text-sm">Foto Background</label>
                    <input type="file" name="background_image" accept="image/*" class="w-full border p-1 rounded text-sm bg-white">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2 font-bold text-sm">Galeri Momen (Bisa banyak + Deskripsi)</label>
                    <input type="file" name="gallery_images[]" accept="image/*" multiple class="w-full border p-1 rounded mb-3 text-sm bg-white">
                    
                    @if(isset($invitation->config['gallery_images']) && count($invitation->config['gallery_images']) > 0)
                        <div class="space-y-2 mt-2">
                            @foreach($invitation->config['gallery_images'] as $index => $img)
                                <div class="flex items-center gap-2 bg-white p-1 rounded border">
                                    <img src="{{ asset('storage/' . $img) }}" class="h-10 w-10 object-cover rounded">
                                    <input type="text" name="gallery_descriptions[{{ $index }}]" value="{{ $invitation->config['gallery_descriptions'][$index] ?? '' }}" placeholder="Deskripsi foto..." class="w-full border p-1 text-xs rounded">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="mb-4">
                    <label class="block text-pink-700 mb-2 font-bold text-sm">Stiker Anime / Idol KPop</label>
                    <input type="file" name="sticker_images[]" accept="image/*" multiple class="w-full border p-1 rounded text-sm bg-white">
                    @if(isset($invitation->config['sticker_images']) && count($invitation->config['sticker_images']) > 0)
                        <div class="flex flex-wrap gap-2 mt-2">
                            @foreach($invitation->config['sticker_images'] as $img)
                                <img src="{{ asset('storage/' . $img) }}" class="h-10 w-10 object-contain bg-white rounded border">
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="mt-6 pt-4 border-t border-gray-300">
                    <label class="block text-indigo-700 mb-2 font-bold text-sm">🎵 Lagu Latar (Musik)</label>
                    <input type="file" name="music_file" accept="audio/mpeg, audio/mp3" class="w-full border p-1 rounded text-sm bg-white">
                    @if(isset($invitation->config['music_file']))
                        <div class="mt-3 bg-indigo-50 p-2 rounded border border-indigo-100 flex items-center gap-3">
                            <audio controls class="w-full h-10">
                                <source src="{{ asset('storage/' . $invitation->config['music_file']) }}" type="audio/mpeg">
                            </audio>
                        </div>
                    @endif
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded hover:bg-blue-700 transition">
                Simpan Semua Perubahan
            </button>
        </form>
    </div>
</body>
</html>