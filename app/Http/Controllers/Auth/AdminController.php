<?php

namespace App\Http\Controllers\auth;

use App\Models\Divisi;
use App\Models\Durasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    private $validation = [
        'required' => 'kolom :attribute harus diisi.',
        'unique' => 'field (:attribute) yang anda isi sudah ada.',
    ];
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
        ], $this->validation);

        $result = Durasi::create([
            'waktu_durasi' => $request->waktu,
            'status' => '1'
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

    /**
     * Show divisi page
     * 
     * @return view
     */
    public function divisi()
    {
        $divisi = Divisi::orderBy('nama_divisi')->get();
        return view('auth.admin.divisi', compact('divisi'));
    }

    /**
     * Post divisi 
     * 
     * @return view
     */
    public function addDivisi(Request $request)
    {
        $request->validate([
            'divisi' => 'required|unique:divisi,nama_divisi'
        ], $this->validation);

        Divisi::create([ 'nama_divisi' => $request->divisi ]);

        return redirect()->back();
    }

    /**
     * Delete divisi
     * 
     * @return view
     */
    public function deleteDivisi(Divisi $divisi)
    {
        $dvs = Divisi::find($divisi->id);
        $dvs->delete();

        return redirect()->back();
    }

    /**
     * Show pemagang page
     * 
     * @return view
     */
    public function pemagang()
    {
        return view('auth.admin.pemagang');
    }
}
