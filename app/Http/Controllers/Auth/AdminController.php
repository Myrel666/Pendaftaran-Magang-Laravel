<?php

namespace App\Http\Controllers\auth;

use App\Models\Durasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Show durasi pages
     * 
     * @return view
     */
    public function durasi()
    {
        $durasi = Durasi::all();
        return view('auth.admin.durasi', compact('durasi'));
    }
    /**
     * Post data durasi 
     * 
     * @return view
     */
    public function addDurasi(Request $request)
    {
        $request->validate([
            'waktu' => 'required|unique:durasi,waktu_durasi'
        ], [
            'required' => 'kolom :attribute harus diisi.',
            'unique' => 'waktu ('.$request->waktu.') sudah ada.',
        ]);

        $result = Durasi::create([
            'waktu_durasi' => $request->waktu,
            'status' => '0'
        ]);

        return redirect()->back();
    }

    /**
     * Update status durasi
     * 
     * @return json
     */
    public function updateStatusDurasi(Request $request)
    {
        $waktu = Durasi::find($request->id);
        $waktu->status = $request->status;
        $waktu->save();
        
        return response()->json([
            'status' => 200,
            'message' => 'Update Durasi OK!',
        ]);
    }

    /**
     * Delete durasi 
     * 
     * @return view
     */
    public function deleteDurasi(Durasi $durasi)
    {
        $durasi = Durasi::find($durasi->id);
        $durasi->delete();
        
        return redirect()->back();
    }
}
