<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $wargas = User::where('role', '=', 'Warga')->with('city')->get();

        $fasilitas = Fasilitas::whereHas('dinas', function ($query) {
            $query->where('city_id', auth()->user()->city_id);
        })->get();
        return view('dashboard', compact('fasilitas'));

    }
}
