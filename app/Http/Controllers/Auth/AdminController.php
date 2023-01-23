<?php

namespace App\Http\Controllers\auth;

use App\Models\Divisi;
use App\Models\Durasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller
{
    private $validation = [
        'required' => 'kolom :attribute harus diisi.',
        'unique' => 'field (:attribute) yang anda isi sudah ada.'
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('auth.master');
    }

    /**
     * Show admin/durasi pages
     * 
     * @return view
     */
    public function durasi(Request $request)
    {   
        if($request->pendidikan == null){
            $durasi = Durasi::where('pendidikan', 'siswa')->get();
        }else{
            $durasi = Durasi::where('pendidikan', $request->pendidikan)->get();
        }
        return view('auth.admin.durasi', compact('durasi'));
    }

    /**
     * Show admin/durasi with condition
     * 
     * @return json
     */
    public function showDurasi($id)
    {
        $data = Durasi::find($id);
        return response()->json($data);
    }
    /**
     * Post data durasi 
     * 
     * @return view
     */
    public function addDurasi(Request $request)
    {
        $validation = [
            'waktu' => 'required',
            'pendidikan' => 'required',
            'limit' => 'required|numeric'
        ];

        $request->validate($validation, $this->validation);

        $result = Durasi::updateOrCreate([
            'pendidikan' => $request->pendidikan,
            'waktu_durasi' => $request->waktu
        ],[
            'limit' => $request->limit,
            'status' => $request->has('status') ? $request->status : '0'
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
     * Show admin/durasi with condition
     * 
     * @return json
     */
    public function showDivisi($id)
    {
        $data = Divisi::find($id);
        return response()->json($data);
    }

    /**
     * Post divisi 
     * 
     * @return view
     */
    public function addDivisi(Request $request)
    {
        $validation = [
            'syarat' => 'required',
            'lokasi' => 'required'
        ];
        
        if($request->has('divisi')){
            $nama_divisi = $request->divisi;
            $validation['divisi'] = 'required|unique:divisi,nama_divisi';
        }else{
            $nama_divisi = $request->editDivisi;
        }
        
        $request->validate($validation, $this->validation);
        Divisi::updateOrCreate([
            'nama_divisi' => $nama_divisi,
        ],[
            'syarat' => $request->syarat,
            'lokasi' => $request->lokasi,
        ]);

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
