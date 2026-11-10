<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::where('is_active', true)->get();
        return view('plans.index', compact('plans'));
    }

    public function store(Request $request, Plan $plan)
    {
        $user = Auth::user();

        // 1. Kalau milih Paket Gratis (Harga 0)
        if ($plan->price == 0) {
            $user->plan_id = $plan->id;
            $user->save();

            return redirect()->route('dashboard')->with('success', 'Paket Gratis berhasil dipilih!');
        }

        // 2. Kalau milih Paket Berbayar (Premium/Business/Enterprise)
        // Kita TOLAK dulu karena sistem pembayaran belum siap.
        if ($plan->price > 0) {
            return redirect()->back()->with('error', 'Maaf, sistem pembayaran otomatis untuk paket ' . $plan->name . ' sedang dalam tahap pengembangan. Silakan hubungi Customer Service atau gunakan Paket Gratis.');
        }

        return redirect()->back();
    }
}