<?php


namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Riwayat;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
   
    public function index()
    {
        if(Auth::check()) {
            $riwayat = Auth::user()
                ->riwayats()
                ->with('penyakit')
                ->latest()
                ->paginate(10);



            
        } else {
            $riwayat = Riwayat::with('penyakit')
                ->latest()
                ->paginate(10);
        }
    
        return response()->json($riwayat);
    }

    public function show(Riwayat $riwayat)
    {
        // Pastikan pengguna yang masuk adalah pemilik riwayat
        if (Auth::user()->id !== $riwayat->user_id) {
            return response()->json(['message' => 'Not authorized'], 403);
        }
    
        // Ubah data yang diserialkan menjadi array
        $riwayat->hasil_diagnosa = unserialize($riwayat->hasil_diagnosa);
        $riwayat->cf_max = unserialize($riwayat->cf_max);
        $riwayat->gejala_terpilih = unserialize($riwayat->gejala_terpilih);
        
        return response()->json($riwayat);
    }
}
