<?php

namespace App\Http\Controllers;

use App\Models\Dinas;
use App\Models\Category;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fasilitas = Fasilitas::get();
        return view('fasilitas.index', compact('fasilitas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dinas = Dinas::all();
        $categories = Category::all();
        return view('fasilitas.create', compact('dinas', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'dinas_id' => 'required|exists:dinas,id',
                'fund_source' => 'required|in:APBN,APBD,Swasta',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'image' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048', // Validasi harus image, max 2MB
                'status' => 'required|in:Baik,Rusak',
                'categories' => 'required|array|min:1', // Wajib array dan minimal 1 kategori
                'categories.*' => 'exists:categories,id', // Setiap kategori harus valid
                'luasan' => 'required|string|max:255'
            ]);

            $file = $request->file('image');
            $fileName = time() . '_' . $file->hashName();
            $destinationPath = public_path('storage/uploads/fasilitas');
            $file->move($destinationPath, $fileName);
            $imagePath = 'storage/uploads/fasilitas/' . $fileName;

            $fasilitas = Fasilitas::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'dinas_id' => $validated['dinas_id'],
                'fund_source' => $validated['fund_source'],
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
                'image' => $imagePath,
                'status' => $validated['status'],
                'luasan' => $validated['luasan']
            ]);

            $fasilitas->categories()->attach($validated['categories']);
            DB::commit();

            return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Fasilitas $fasilitas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        $dinas = Dinas::all();
        $categories = Category::all();
        return view('fasilitas.edit', compact('dinas', 'categories', 'fasilitas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'dinas_id' => 'required|exists:dinas,id',
                'fund_source' => 'required|in:APBN,APBD,Swasta',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048', // image opsional di update
                'status' => 'required|in:Baik,Rusak',
                'categories' => 'required|array|min:1', // minimal 1 kategori harus dipilih
                'categories.*' => 'exists:categories,id',
                'luasan' => 'required|string|max:255'
            ]);

            $fasilitas = Fasilitas::findOrFail($id);

            // Jika user mengunggah gambar baru
            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada dan file masih exists
                if ($fasilitas->image && file_exists(public_path($fasilitas->image))) {
                    unlink(public_path($fasilitas->image));
                }

                // Upload gambar baru
                $file = $request->file('image');
                $fileName = time() . '_' . $file->hashName();
                $destinationPath = public_path('storage/uploads/fasilitas');
                $file->move($destinationPath, $fileName);
                $imagePath = 'storage/uploads/fasilitas/' . $fileName;
            } else {
                // Jika tidak upload gambar baru, gunakan gambar lama
                $imagePath = $fasilitas->image;
            }

            // Update data fasilitas
            $fasilitas->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'dinas_id' => $validated['dinas_id'],
                'fund_source' => $validated['fund_source'],
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
                'image' => $imagePath,
                'status' => $validated['status'],
                'luasan' => $validated['luasan']
            ]);

            // Update kategori (replace all categories with the new ones)
            $fasilitas->categories()->sync($validated['categories']);

            DB::commit();

            return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $fasilitas = Fasilitas::findOrFail($id);
            // Lepas semua relasi categories (pivot table)
            $fasilitas->categories()->detach();

            // Hapus file gambar jika ada
            if (file_exists(public_path($fasilitas->image))) {
                Storage::delete(public_path($fasilitas->image));
            }

            // Hapus data fasilitas
            $fasilitas->delete();

            DB::commit();
            return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }
    }
}
