<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AbsensiController extends Controller
{
    public function index(){
        return Inertia::render('User/Absensi');
    }

    public function recap_index(){
        $fetch = Absensi::with('user')->where('id_user',Auth::user()->id)->get();
        return Inertia::render('User/RecapAbsensi',
    ['data'=>$fetch]);
    }

    public function store(Request $request){
        if ($request->hasFile('photo')) {
            // Validasi file jika diperlukan
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'id_user'=>'required'
            ]);

            // Simpan file ke folder tertentu
            $filePath = $request->file('photo')->store('photos', 'public');
            Absensi::create([
                'foto'=>$filePath,
                'status'=>'Hadir',
                'lokasi'=>'Karawang',
                'id_user'=> $request->input('id_user')
            ]);
            return response()->json(['message' => 'Photo uploaded successfully!', 'file_path' => $filePath]);
        }

        return response()->json(['message' => 'No photo uploaded'], 400);
    }
    
}