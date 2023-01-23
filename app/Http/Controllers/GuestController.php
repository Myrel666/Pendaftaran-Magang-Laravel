<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Durasi;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Show index / landing page 
     * 
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Show pendaftaran menu durasi magang
     * 
     */
    public function durasiPendaftaran($user)
    {
        $durasi = Durasi::where('pendidikan', $user)->orderBy("waktu_durasi")->get();
        return view('pendaftaran_durasi', compact('user','durasi'));
    }

    /**
     * Show pendaftaran menu divisi magang
     * 
     */
    public function divisiPendaftaran($user, $durasi)
    {
        $divisi = Divisi::orderBy('nama_divisi')->get();
        return view('pendaftaran_divisi', compact('user', 'durasi', 'divisi'));
    }

    /**
     * Show pendaftaran formulir
     * 
     */
    public function pendaftaran(Divisi $divisi, $user, Durasi $durasi)
    {   
        return view('pendaftaran', compact('user','divisi', 'durasi'));
    }

    /**
     * Store data formulir
     * 
     * @return view
     */
    public function formulir(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nomor' => 'required|numeric',
            'email' => 'required|email',
            'univ' => 'required',
            'fakultas' => 'required',
            'jurusan' => 'required',
            'pengantar' => 'required|file|mimes:pdf,jpg,png|max:1024',
            'proposal' => 'required|file|mimes:pdf,jpg,png|max:1024',
            'cv' => 'required|file|mimes:pdf,jpg,png|max:1024',
            'vaksin' => 'required|file|mimes:pdf,jpg,png|max:1024',
        ], [
            'required' => ':attribute harus diisi.',
            'nomor.required' => 'no. telp harus diisi.',
            'univ.required' => 'universitas harus diisi.',
            'pengantar.required' => 'surat pengantar harus diisi.',
            'pengantar.mimes' => 'surat pengantar harus berupa jpg,png,pdf.',
            'mimes' => ':attribute harus berupa jpg,png,pdf.',
            'max' => 'file size maksimal 1024 KB.',
        ]);

        dd($request);
        return redirect()->back()->withInput();
    }
}

