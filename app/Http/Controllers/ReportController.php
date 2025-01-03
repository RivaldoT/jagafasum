<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporans = Report::with(['user', 'fasilitas'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('reports.index', compact('laporans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $wargas = User::where('role', '=', 'Warga')->with('city')->get();

        if (auth()->user()->role == 'Pimpinan') {
            $fasilitas = Fasilitas::all();
        } else {
            $fasilitas = Fasilitas::whereHas('dinas', function ($query) {
                $query->where('city_id', auth()->user()->city_id);
            })->get();
        }
        return view('reports.create', compact('wargas', 'fasilitas'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required|exists:users,id',
            'deskripsi' => 'required|string',
            'fasilitas' => 'required|array|min:1',
        ]);

        $report = Report::create([
            'user_id' => $request->warga_id,
            'description' => $request->deskripsi,
            'status' => 'Antri',
            'created_at' => now(),
        ]);

        $report->fasilitas()->attach($request->fasilitas);

        return redirect()->back()->with('success', 'Laporan berhasil dikirim!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        return view('reports.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $laporan = Report::findOrFail($id);
        $fasilitas = Fasilitas::all();

        return view('reports.edit', [
            'laporan' => $laporan,
            'fasilitas' => $fasilitas,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        $request->validate([
            'deskripsi' => 'required|string',
            'fasilitas' => 'required|array|min:1',
        ]);

        $report->update([
            'description' => $request->deskripsi,
        ]);

        $report->fasilitas()->sync($request->fasilitas);
        return redirect()->route('report.index')->with('success', 'Laporan berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('report.index')->with('success', 'Report deleted successfully!');
    }
}
