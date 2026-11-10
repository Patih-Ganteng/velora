<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user->plan_id) {
            return redirect()->route('plans.index');
        }

        // Ambil undangan beserta jumlah tamunya (Total, Hadir, Tidak Hadir, Ucapan)
        $invitations = $user->invitations()->withCount([
            'guests',
            'guests as hadir_count' => function ($query) {
                $query->where('rsvp_status', 'hadir');
            },
            'guests as tidak_hadir_count' => function ($query) {
                $query->where('rsvp_status', 'tidak_hadir');
            },
            'messages'
        ])->get();

        return view('dashboard', compact('invitations'));
    }
}