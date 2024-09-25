<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AbsensiController extends Controller
{
    public function index(){
        return Inertia::render('User/Absensi');
    }

    public function recap_index(){
        return Inertia::render('User/RecapAbsensi');
    }

    public function store(Request $request){
        if ($request->hasFile('photo')) {
            // Validasi file jika diperlukan
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Simpan file ke folder tertentu
            $filePath = $request->file('photo')->store('photos', 'public');

            return response()->json(['message' => 'Photo uploaded successfully!', 'file_path' => $filePath]);
        }

        return response()->json(['message' => 'No photo uploaded'], 400);
    }
    
}