<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Akun::all();
        return view('akun.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('akun.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:akuns,email',
            'password' => 'required|min:1',
            'role' => 'required',
            'img' => 'nullable|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        // Cek jika ada gambar yang diunggah
        if ($request->hasFile('img')) {
            $imagePathAkun = $request->file('img')->store('images/akun', 'public');
        } else {
            // Set gambar default jika tidak ada gambar yang diunggah
            $imagePathAkun = 'images/akun/default.jpg';
        }
        
        // Simpan data akun ke tabel Akun
        $proses = Akun::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
            'img' => $imagePathAkun // Menyimpan path gambar akun
        ]);
        
        if ($proses) {
            return redirect()->route('akun.index')->with('success', 'Berhasil mengubah data akun!');
        } else {
            return redirect()->back()->with('failed', 'Gagal mengubah data akun!');
        }
        return view('template.app', ['imagePathAkun' => $imagePathAkun]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Akun $akun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = Akun::findOrFail($id);
        return view('akun.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Akun $akun)
{
    $request->validate([
        'name' => 'required',
        'email' => 'sometimes|required_if:old_email,'.$request->old_email.'|email|unique:akuns,email,'.$akun->id.'|max:100',
        'password' => 'required|min:1',
        'img' => 'nullable|mimes:jpeg,png,jpg|max:2048',
        'role' => 'required|min:2|in:admin,user',
    ], [
        'name.required' => 'Nama harus diisi!',
        'email.required' => 'Email harus diisi!',
        'password.required' => 'Password harus diisi!',
        'name.max' => 'Nama maksimal 100 karakter!',
        'email.min' => 'Email minimal 3 karakter!',
    ]);

    // $akun = Akun::findOrFail($id);

    if ($request->hasFile('img')) {
        // Hapus gambar lama jika ada
        if ($akun->img) {
            Storage::delete('public/' . $akun->img); // Menghapus gambar lama dari storage
        }
        // Simpan gambar baru
        $imgPath = $request->file('img')->store('images/akun', 'public');
        $akun->img = $imgPath;
    } else {
        // Jika tidak ada gambar baru, gunakan gambar lama
        $imgPath = $akun->img;
    }
    

    // Perbarui data akun
    $proses = $akun->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'img' => $imgPath,  // Gunakan $imgPath yang sudah ditentukan
        'role' => $request->role,
    ]);
    
    if ($proses) {
        return redirect()->route('akun.index')->with('success', 'Berhasil mengubah data akun!');
    } else {
        return redirect()->back()->with('failed', 'Gagal mengubah data akun!');
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Akun::where('id',$id)->delete();
        return redirect()->back()->with('deleted', 'berhasil menghapus Akun');

    }
    
    public function login()
    {
        return view('login');  // pastikan kamu memiliki file login.blade.php di folder resources/views
    }

    // Fungsi untuk autentikasi login
    public function loginAuth(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Ambil kredensial input
        $credentials = $request->only('email', 'password');

        // Proses autentikasi
        if (Auth::attempt($credentials)) {
            // Autentikasi berhasil, redirect ke halaman landing (atau dashboard)
            return redirect()->route('landing')->with('success', 'Login berhasil');
        } else {
            // Autentikasi gagal, kembali ke halaman login dengan pesan error
            return redirect()->back()->with('failed', 'Gagal login, pastikan email dan password benar');
        }
    }

    // Fungsi untuk logout
    public function logout()
    {
        Auth::logout();  // Proses logout
        return redirect()->route('login')->with('logout', 'Anda telah logout');
    }
}

