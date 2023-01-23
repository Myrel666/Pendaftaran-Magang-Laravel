<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Divisi;
use App\Models\Durasi;
use App\Models\Mahasiswa;
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
        $validator = [
            'nama' => 'required',
            'nomor' => 'required|numeric',
            'email' => 'required|email',
            'jurusan' => 'required',
            'pengantar' => 'required|file|mimes:pdf,jpg,png|max:1024',
            'proposal' => 'required|file|mimes:pdf,jpg,png|max:1024',
            'cv' => 'required|file|mimes:pdf,jpg,png|max:1024',
            'vaksin' => 'required|file|mimes:pdf,jpg,png|max:1024',
        ];

        if($request->has('asal_sekolah')){
            $validator['asal'] = 'required';
        }else{
            $validator['univ'] = 'required';
            $validator['fakultas'] = 'required';
        }

        $request->validate($validator, [
            'required' => ':attribute harus diisi.',
            'nomor.required' => 'no. telp harus diisi.',
            'univ.required' => 'universitas harus diisi.',
            'pengantar.required' => 'surat pengantar harus diisi.',
            'pengantar.mimes' => 'surat pengantar harus berupa jpg,png,pdf.',
            'mimes' => 'dokumen :attribute harus berupa jpg,png,pdf.',
            'max' => 'file size maksimal 1024 KB.',
        ]);



        $data = [
            'divisi_id' => $request->divisi,
            'durasi_id' => $request->durasi,
            'nama' => $request->nama,
            'nomor_telepon' => $request->nomor,
            'jurusan' => $request->jurusan,
            'surat_pengantar' => time().'_pengantar.'.$request->pengantar->extension(),
            'proposal' => time().'_proposal.'.$request->proposal->extension(),
            'cv' => time().'_cv.'.$request->cv->extension(),
            'vaksin' => time().'_vaksin.'.$request->vaksin->extension()
        ];
     
        $request->pengantar->move(public_path('uploads'), $data['surat_pengantar']);
        $request->proposal->move(public_path('uploads'), $data['proposal']);
        $request->cv->move(public_path('uploads'), $data['cv']);
        $request->vaksin->move(public_path('uploads'), $data['vaksin']);

        if($request->pendidikan == 'mahasiswa'){
            $data['universitas'] = $request->univ;
            $data['fakultas'] = $request->fakultas;
            Mahasiswa::updateOrCreate([
                'email' => $request->email
            ],$data);
        }else{
            $data['asal_sekolah'] = $request->asal;
            Siswa::updateOrCreate([
                'email' => $request->email
            ],$data);
        }
        
        return redirect()->back()->with('success', 'Berkas Anda Sudah Terkirim.');
    }
}

