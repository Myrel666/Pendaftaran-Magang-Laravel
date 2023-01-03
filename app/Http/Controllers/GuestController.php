<?php

namespace App\Http\Controllers;

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
        return view('pendaftaran_durasi', compact('user'));
    }

    /**
     * Show pendaftaran menu divisi magang
     * 
     */
    public function divisiPendaftaran($user)
    {
        return view('pendaftaran_divisi', compact('user'));
    }

    /**
     * Show pendaftaran formulir
     * 
     */
    public function pendaftaran($divisi, $user)
    {   
        return view('pendaftaran', compact('user','divisi'));
    }
}
