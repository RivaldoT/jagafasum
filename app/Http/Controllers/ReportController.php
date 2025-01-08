<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Report;
use App\Models\Category;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use App\Models\HistoryReport;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (auth()->user()->role === 'Warga') {
            $laporans = Report::with(['user', 'fasilitas'])
                ->where('user_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $laporans = Report::with(['user', 'fasilitas'])
                ->orderBy('created_at', 'desc')
                ->get();
        }


        $month = $request->input('month', Carbon::now()->month);
        $categories = Category::with(['fasilitas' => function ($query) use ($month) {
            $query->where('status', 'Rusak')
                ->whereMonth('updated_at', $month);
        }])->get();
        $damagedFacilities = Fasilitas::where('status', 'Rusak')
            ->whereMonth('updated_at', $month)
            ->get();

        //belom baca soal 4 poin 3 gk ngerti
        $unresolved7Days = Report::where('status', '!=', 'Selesai')
            ->whereBetween('created_at', [
                Carbon::now()->subDays(7)->startOfDay(),
                Carbon::now()->endOfDay()
            ])
            ->get();

        $unresolved14Days = Report::where('status', '!=', 'Selesai')
            ->whereBetween('created_at', [
                Carbon::now()->subDays(14)->startOfDay(),
                Carbon::now()->endOfDay()
            ])
            ->get();

        $unresolved30Days = Report::where('status', '!=', 'Selesai')
            ->whereBetween('created_at', [
                Carbon::now()->subDays(30)->startOfDay(),
                Carbon::now()->endOfDay()
            ])
            ->get();

        $topReporters = User::withCount('reports')
            ->orderBy('reports_count', 'desc')
            ->take(5)
            ->get();

        return view('reports.index', compact(
            'laporans',
            'categories',
            'damagedFacilities',
            'month',
            'unresolved7Days',
            'unresolved14Days',
            'unresolved30Days',
            'topReporters'
        ));
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

        return redirect()->route('report.index')->with('success', 'Laporan berhasil dikirim!');
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
            'status' => 'required|string|in:Antri,Dikerjakan,Selesai,Tidak terselesaikan',
        ]);

        $report->update([
            'description' => $request->deskripsi,
            'status' => $request->status,
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

    public function getReportDetails(Request $request, $id)
    {
        // Validasi ID dari route
        $validatedData = Validator::make(
            ['id' => $id],
            ['id' => 'required|integer|exists:reports,id']
        );

        if ($validatedData->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'ID tidak valid atau laporan tidak ditemukan.',
            ], 400);
        }

        // Ambil data riwayat laporan
        $historyReport = HistoryReport::with('user')
            ->where('report_id', $id)
            ->get();

        if ($historyReport->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak ada riwayat untuk laporan ini.',
            ], 404);
        }

        // Format data untuk JSON response
        $formattedData = $historyReport->map(function ($report) {
            return [
                'report_id' => $report->report_id,
                'updated_by' => $report->user->name ?? 'Tidak diketahui',
                'note' => $report->note ?? 'Tidak ada catatan',
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $formattedData,
        ]);
    }
}
