<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use App\Models\Dinas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('users.index', compact('users'));
    }
    public function edit(User $user)
    {
        $cities = City::get();
        $dinasList = Dinas::get();
        return view('users.edit', compact('user', 'cities', 'dinasList'));
    }
    public function editProfile()
    {
        $user = auth()->user();
        $cities = City::get();
        return view('users.edit-warga', compact('user', 'cities'));
    }
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:Pimpinan,Staff,Warga',
            'dinas_id' => 'nullable|exists:dinas,id',
            'address' => 'required|string',
            'city' => 'required|exists:cities,id',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        // Update data user
        $user->name = $validatedData['name'];
        $user->role = $validatedData['role'];
        $user->address = $validatedData['address'];
        $user->city_id = $validatedData['city'];
        $user->email = $validatedData['email'];

        // Jika role adalah 'Warga', hapus dinas_id
        if ($validatedData['role'] === 'Warga') {
            $user->dinas_id = null;
        } else {
            $user->dinas_id = $validatedData['dinas_id'];
        }

        // Update password jika ada input password baru
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        // Simpan perubahan
        $user->save();

        // Redirect ke halaman user index dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }
    public function updateProfile(Request $request)
    {
        $userData = auth()->user();
        $user = User::findOrFail($userData->id);
        $validatedData = request()->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|exists:cities,id',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        // Update data user
        $user->name = $validatedData['name'];
        $user->address = $validatedData['address'];
        $user->city_id = $validatedData['city'];
        $user->email = $validatedData['email'];

        // Update password jika ada input password baru
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        // Simpan perubahan
        $user->save();

        // Redirect ke halaman user index dengan pesan sukses
        return redirect()->route('home-page')->with('success', 'Profile updated successfully.');
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}
