<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show durasi pages
     * 
     */
    public function durasi(){
        return view('auth.admin.durasi');
    }
}