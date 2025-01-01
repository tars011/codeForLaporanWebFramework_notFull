<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Menampilkan data user
    public function index()
    {
        $user = Auth::user();
        return view('pages.user', compact('user'));
    }

    // Menampilkan form edit user
    public function edit() 
    {
        $user = Auth::user();
        return view('pages.update.user-edit', compact('user'));
    }

    // Menyimpan data user hasil edit
    public function update(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users,username,' . Auth::id(),
            'full_name' => 'required|string|max:100',
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'full_name.required' => 'Nama lengkap wajib diisi.',
        ]);

        $user = User::find(Auth::user()->id);
        $user->update($request->only('username', 'full_name'));

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
    
    // Menampilkan form edit photo
    public function photo_edit() 
    {
        $user = Auth::user();
        return view('pages.update.photo-edit', compact('user'));
    }

    // Menyimpan data photo hasil edit
    public function photo_update(Request $request)
    {
        $validated = $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'photo.required' => 'Foto wajib diunggah.',
            'photo.image' => 'File harus berupa gambar.',
            'photo.mimes' => 'Foto harus berformat jpeg, png, jpg, atau gif.',
            'photo.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        $user = User::find(Auth::user()->id);

        // Hapus foto lama jika ada
        if ($user->photo && Storage::disk('public')->exists('photo/' . $user->photo)) {
            Storage::disk('public')->delete('photo/' . $user->photo);
        }

        // Simpan foto baru
        $fileName = time() . '.' . $request->photo->extension();
        Storage::disk('public')->putFileAs('photo', $request->photo, $fileName);

        // Update foto di database
        $user->update(['photo' => $fileName]);

        return redirect()->route('profile.index')->with('success', 'Foto Profil berhasil diperbarui.');
    }

    // Menghapus data photo
    public function photo_delete() 
    {
        $user = User::find(Auth::user()->id);

        if ($user->photo && Storage::disk('public')->exists('photo/' . $user->photo)) {
            Storage::disk('public')->delete('photo/'.$user->photo);
            $user->update(['photo' => null]);

            return redirect()->route('profile.index')->with('success', 'Profile Profil berhasil dihapus.');
        }
        else {
            $user->update(['photo' => null]);
        }

        return redirect()->route('profile.index')->with('error', 'File foto tidak ditemukan.');
    }

    // Menampilkan form ubah password
    public function changePass() 
    {
        return view('pages.update.change-password');
    }

    // Menyimpan data password hasil ubah
    public function updatePass(Request $request) 
    {
        $request->validate([
            'current_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8|confirmed',
        ], [
            'current_password.required' => 'Password lama wajib diisi.',
            'current_password.min' => 'Password lama minimal 8 karakter.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.min' => 'Password baru minimal 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak sesuai.',
        ]);

        // Verifikasi password lama 
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah.']);
        }

        // Update password
        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('password.change')->with('success', 'Password berhasil diubah!');;
    }
}
