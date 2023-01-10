<?php

namespace App\Http\Controllers;

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
        $durasi = Durasi::orderBy("waktu_durasi")->get();
        return view('pendaftaran_durasi', compact('user','durasi'));
    }

    /**
     * Show pendaftaran menu divisi magang
     * 
     */
    public function divisiPendaftaran($user, $durasi)
    {
        return view('pendaftaran_divisi', compact('user', 'durasi'));
    }

    /**
     * Show pendaftaran formulir
     * 
     */
    public function pendaftaran($divisi, $user, $durasi)
    {   
        return view('pendaftaran', compact('user','divisi', 'durasi'));
    }
}
