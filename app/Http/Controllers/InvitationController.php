<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    // 1. Tampilkan daftar semua undangan (Halaman Undangan)
    public function index()
    {
        $invitations = Auth::user()->invitations()->latest()->get();
        return view('invitations.index', compact('invitations'));
    }

    // 2. Tampilkan form buat undangan (DENGAN FILTER PAKET GRATIS)
    public function create()
    {
        $user = Auth::user();
        
        // Cek batas kuota paket gratis (Maksimal 1 undangan)
        if (($user->plan_id == 1 || $user->plan_id == null) && $user->invitations()->count() >= 1) {
            return redirect()->route('plans.index')->with('error', 'Kuota undangan paket Gratis kamu sudah habis. Silakan upgrade paket!');
        }

        $categories = config('velora.categories');

        // Filter Tema untuk User Gratis
        if ($user->plan_id == 1 || $user->plan_id == null) {
            // Tema yang diizinkan untuk gratisan
            $allowedThemes = ['mewah', 'kpop', 'anak-anak', 'formal'];
            
            foreach ($categories as $catKey => &$cat) {
                if ($catKey == 'nikah' || $catKey == 'ultah') {
                    // Saring sub-tema
                    $cat['themes'] = array_values(array_filter($cat['themes'], function($theme) use ($allowedThemes) {
                        return in_array($theme, $allowedThemes);
                    }));
                } else {
                    // Kategori Umum tidak boleh sama sekali buat yang gratis
                    unset($categories[$catKey]);
                }
            }
        }

        return view('invitations.create', compact('categories'));
    }

    // 3. Simpan undangan baru ke database (VALIDASI KEAMANAN)
    public function store(Request $request)
    {
        $user = Auth::user();

        // 1. Cek Kuota
        if (($user->plan_id == 1 || $user->plan_id == null) && $user->invitations()->count() >= 1) {
            return redirect()->route('plans.index')->with('error', 'Kuota undangan paket Gratis kamu sudah habis.');
        }

        // 2. Cek Tema Terlarang (Bypass Protection)
        if ($user->plan_id == 1 || $user->plan_id == null) {
            $allowedThemes = ['mewah', 'kpop', 'anak-anak', 'formal'];
            $allowedCategories = ['nikah', 'ultah'];

            if (!in_array($request->sub_theme, $allowedThemes) || !in_array($request->category, $allowedCategories)) {
                return redirect()->route('plans.index')->with('error', 'Tema atau kategori ini khusus untuk pengguna Premium. Silakan upgrade!');
            }
        }

        $request->validate([
            'category' => 'required',
            'sub_theme' => 'required',
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
        ]);

        Auth::user()->invitations()->create([
            'category' => $request->category,
            'sub_theme' => $request->sub_theme,
            'title' => $request->title,
            'event_date' => $request->event_date,
            'status' => 'draft',
        ]);

        return redirect()->route('dashboard')->with('success', 'Undangan berhasil dibuat!');
    }

    // 4. Tampilkan halaman undangan
    public function show(Request $request, Invitation $invitation)
    {
        if ($invitation->user_id !== Auth::id() && !$request->has('to')) {
            abort(403, 'Akses ditolak.');
        }

        $guest = null;
        if ($request->has('to')) {
            $guest = $invitation->guests()->where('unique_code', $request->to)->first();
        }

        $messages = $invitation->messages;
        $viewName = 'themes.' . $invitation->category . '.' . $invitation->sub_theme;

        if (!view()->exists($viewName)) {
            $viewName = 'themes.default';
        }

        return view($viewName, compact('invitation', 'guest', 'messages'));
    }

    // 5. Simpan tamu baru dari Dashboard
    public function storeGuest(Request $request, Invitation $invitation)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $invitation->guests()->create([
            'name' => $request->name,
            'unique_code' => Str::random(8),
            'rsvp_status' => 'pending'
        ]);

        return back()->with('success', 'Tamu berhasil ditambahkan!');
    }

    // 6. Lihat daftar tamu
    public function guests(Invitation $invitation)
    {
        if ($invitation->user_id !== Auth::id()) abort(403);
        $guests = $invitation->guests()->latest()->get();
        return view('invitations.guests', compact('invitation', 'guests'));
    }

    // 7. Hapus tamu
    public function destroyGuest(Invitation $invitation, $guestId)
    {
        if ($invitation->user_id !== Auth::id()) abort(403);
        $invitation->guests()->where('id', $guestId)->delete();
        return back()->with('success', 'Tamu berhasil dihapus!');
    }

    // 8. Update status RSVP dari tamu
    public function updateRsvp(Request $request, Invitation $invitation)
    {
        $request->validate([
            'guest_code' => 'required',
            'status' => 'required|in:hadir,tidak_hadir'
        ]);

        $guest = $invitation->guests()->where('unique_code', $request->guest_code)->firstOrFail();
        $guest->update(['rsvp_status' => $request->status]);

        return back()->with('rsvp_success', 'Terima kasih atas konfirmasinya!');
    }

    // 9. Simpan Ucapan Tamu (Guestbook)
    public function storeMessage(Request $request, Invitation $invitation)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        $invitation->messages()->create([
            'name' => $request->name,
            'message' => $request->message,
        ]);

        return back()->with('message_success', 'Ucapan berhasil dikirim!');
    }

    // 10. Tampilkan form edit media
    public function edit(Invitation $invitation)
    {
        if ($invitation->user_id !== Auth::id()) abort(403);
        return view('invitations.edit', compact('invitation'));
    }

    // 11. Proses Upload Media, Galeri, Stiker, Lagu & Teks
    public function update(Request $request, Invitation $invitation)
    {
        if ($invitation->user_id !== Auth::id()) abort(403);

        $config = $invitation->config ?? [];

        // === TANGKAP PILIHAN WARNA DRESS CODE ===
        if ($request->has('dress_code_colors')) {
            $colors = array_filter($request->input('dress_code_colors')); 
            $config['dress_code_colors'] = array_values($colors);
        }

        // === PROSES TEKS & INFORMASI BARU ===
        $textFields = [
            'opening_greeting', 'quran_verse', 'love_story',
            'event_1_name', 'event_1_time', 'event_2_name', 'event_2_time',
            'dress_code', 'maps_link', 'maps_address',
            'full_name', 'nickname', 'age', // Untuk Ulang Tahun
        ];

        foreach ($textFields as $field) {
            if ($request->has($field)) {
                $config[$field] = $request->input($field);
            }
        }

        // === PROSES FILES ===
        if ($request->hasFile('groom_photo')) {
            $config['groom_photo'] = $request->file('groom_photo')->store('invitations', 'public');
        }

        if ($request->hasFile('bride_photo')) {
            $config['bride_photo'] = $request->file('bride_photo')->store('invitations', 'public');
        }

        if ($request->hasFile('background_image')) {
            $config['background_image'] = $request->file('background_image')->store('invitations', 'public');
        }

        if ($request->has('gallery_descriptions')) {
            $config['gallery_descriptions'] = $request->input('gallery_descriptions');
        }

        if ($request->hasFile('gallery_images')) {
            $gallery = $config['gallery_images'] ?? [];
            foreach ($request->file('gallery_images') as $file) {
                $gallery[] = $file->store('invitations', 'public');
            }
            $config['gallery_images'] = $gallery;
        }

        if ($request->hasFile('sticker_images')) {
            $stickers = $config['sticker_images'] ?? [];
            foreach ($request->file('sticker_images') as $file) {
                $stickers[] = $file->store('invitations', 'public');
            }
            $config['sticker_images'] = $stickers;
        }

        if ($request->hasFile('music_file')) {
            $config['music_file'] = $request->file('music_file')->store('invitations/music', 'public');
        }

        // PAKSA SIMPAN KE DATABASE
        $invitation->config = $config;
        $invitation->save();

        return redirect()->route('dashboard')->with('success', 'Semua data undangan berhasil diperbarui!');
    }
}