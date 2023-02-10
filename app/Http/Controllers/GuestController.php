<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\Divisi;
use App\Models\Lokasi;
use App\Models\Durasi;
use Illuminate\Http\Request;
use File;

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
        $divisi = Divisi::orderBy('nama_divisi')->has('divisi_formulir')->get();
        return view('pendaftaran_divisi', compact('user', 'durasi', 'divisi'));
    }

    /**
     * Cari divisi magang
     * 
     */
    public function cariDivisi(Request $request, $user, $durasi)
    {
        $divisi = Divisi::where('nama_divisi', 'like', "%".$request->search."%")->has('divisi_formulir')->get();

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
        $pendaftar = Pendaftar::all();
        $durasiLimit = Durasi::where('pendidikan', $request->pendidikan)->where('id', $request->durasi)->first();
        if($pendaftar->count() == $durasiLimit->limit){
            // redirect ke halaman sebelumnya
            return redirect()->back()->with('limit', 'Gagal Mengirim Berkas Karena Pendaftar Sudah Mencapai Limit!');
        }

        $validator = [
            'nama' => 'required',
            'nomor' => 'required|numeric',
            'email' => 'required|email',
            'instansi' => 'required',
            'lokasi' => 'required',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:5000',
            'pengantar' => 'required|file|mimes:pdf,jpg,png|max:1024',
            'proposal' => 'required|file|mimes:pdf,jpg,png|max:1024',
            'cv' => 'required|file|mimes:pdf,jpg,png|max:1024',
            'vaksin' => 'required|file|mimes:pdf,jpg,png|max:1024',
        ];

        // validasi
        $request->validate($validator, [
            'required' => ':attribute harus diisi.',
            'nomor.required' => 'no. telp harus diisi.',
            'pengantar.required' => 'surat pengantar harus diisi.',
            'foto.mimes' => 'foto harus berekstensi jpg,jpeg,png.',
            'pengantar.mimes' => 'surat pengantar harus berupa jpg,png,pdf.',
            'mimes' => 'dokumen :attribute harus berupa jpg,png,pdf.',
            'foto.max' => 'file size maksimal 5 MB.',
            'max' => 'file size maksimal 1 MB.',
        ]);

        // data yang mau dimasukkan di db
        $data = [
            'divisi_id' => $request->divisi,
            'durasi_id' => $request->durasi,
            'nama' => $request->nama,
            'nomor_telepon' => $request->nomor,
            'email' => $request->email,
            'pendidikan' => $request->pendidikan,
            'instansi' => $request->instansi,
            'lokasi' => $request->lokasi,
            'status' => 'belum diproses',
            'foto' => time().'_profile.'.$request->foto->extension(),
            'surat_pengantar' => time().'_pengantar.'.$request->pengantar->extension(),
            'proposal' => time().'_proposal.'.$request->proposal->extension(),
            'cv' => time().'_cv.'.$request->cv->extension(),
            'vaksin' => time().'_vaksin.'.$request->vaksin->extension()
        ];
     
        // upload file
        $request->foto->move(public_path('uploads/profiles'), $data['foto']);
        $request->pengantar->move(public_path('uploads'), $data['surat_pengantar']);
        $request->proposal->move(public_path('uploads'), $data['proposal']);
        $request->cv->move(public_path('uploads'), $data['cv']);
        $request->vaksin->move(public_path('uploads'), $data['vaksin']);

        $existing = Pendaftar::where(function($query) use($request) {
                        $query->where('email', $request->email);
                        $query->orWhere('nomor_telepon', $request->nomor);
                        $query->orWhere('nama', $request->nama);
                    })->first();

        $cekLokasi = Lokasi::where('name', $request->lokasi)->get();
        if($cekLokasi->isEmpty()){
            Lokasi::create(['name' => $request->lokasi]);
        }
        
        if ($existing) {
            // do an update on $existing
            File::delete('uploads/profiles/'.$existing->foto);
            File::delete('uploads/'.$existing->surat_pengantar);
            File::delete('uploads/'.$existing->proposal);
            File::delete('uploads/'.$existing->cv);
            File::delete('uploads/'.$existing->vaksin);
            $existing->fill($data)->save();

            // redirect ke halaman sebelumnya
            return redirect()->back()->with('success', 'Berkas Anda Berhasil Diganti.');
        } else {
            // create new one
            Pendaftar::create($data);
            // redirect ke halaman sebelumnya
            return redirect()->back()->with('success', 'Berkas Anda Sudah Terkirim.');
        }
        
    }
}