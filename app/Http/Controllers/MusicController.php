<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $music = Music::all();
        return view('musik.index',compact('music'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('musik.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'artist' => 'required',
            'genre' => 'required',
            'description' => 'required',
            'pendengar' => 'required|numeric',
            'img' => 'required|mimes:jpeg,png,jpg|max:2048',
            'audio' => 'required|mimes:mp3,wav,aac|max:20480'
        ]);
        
        // Simpan gambar lagu
        $imagePath = $request->file('img')->store('images/lagu', 'public');
        
        // Simpan audio jika ada
        $audioPath = null;
        if ($request->hasFile('audio')) {
            $audioPath = $request->file('audio')->store('audios', 'public');
        }
        
        // Simpan data ke tabel Music
        Music::create([
            'name-music' => $request->name,
            'artist' => $request->artist,
            'genre' => $request->genre,
            'description' => $request->description,
            'pendengar' => $request->pendengar,
            'img' => $imagePath,
            'audio' => $audioPath,
        ]);
        
        return redirect()->back()->with('success', 'Berhasil menambahkan Lagu!');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Music $music)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Music $music,$id)
    {
        $music = Music::findOrFail($id);
        return view('musik.edit',compact('music'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Music $music,$id)
    {
        $request->validate([
            'name' => 'required',
            'artist' => 'required',
            'genre' => 'required',
            'description' => 'required',
            'pendengar' => 'required|numeric',
            'img' => 'nullable|mimes:jpeg,png,jpg|max:2048',
            'audio' => 'required|mimes:mp3,wav,aac|max:20480'
        ]);
        
        $music = Music::findOrFail($id);
        
        // Jika ada gambar baru, proses penghapusan dan penyimpanan gambar
        if ($request->hasFile('img')) {
            // Hapus gambar lama jika ada
            if ($music->img) {
                Storage::delete('public/' . $music->img); // Menghapus gambar lama dari storage
            }
        
            // Simpan gambar baru
            $imagePath = $request->file('img')->store('images/lagu', 'public');
            $music->img = $imagePath; // Set gambar baru
            $audioPath = $request->file('audio')->store('audio', 'public');
            $music->audio = $audioPath; // Set gambar baru
        }
        
        // Update semua data yang sesuai
        $music->update([
            'name-music' => $request->name,  // Nama kolom yang benar sesuai di database
            'artist' => $request->artist,
            'genre' => $request->genre,
            'description' => $request->description,
            'pendengar' => $request->pendengar,
            'audio' => $request->audio,
            'img' => $music->img  // Gambar akan di-update jika ada, jika tidak tetap yang lama

        ]);
        
        return redirect()->back()->with('success', 'Berhasil mengubah Lagu!');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Music $music,$id)
    {
        Music::where("id",$id)->delete();

        return redirect()->back()->with('deleted','berhasil menghapus Lagu!');
    }
}
