<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Models\Divisi;
use App\Models\Durasi;
use App\Models\Lokasi;
use App\Models\Presensi;
use App\Models\Pendaftar;
use App\Models\Pengajuan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Formulir;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
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
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pemagang = User::where('role_id', 2)->get();
        $pendaftar = Pendaftar::where('status', '!=', 'diterima')->get();
        $divisi = Divisi::all();
        return view('auth.admin.index', compact('pemagang', 'pendaftar', 'divisi'));
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
     * Show divisi formulir page
     * 
     * @return view
     */
    public function divisiFormulir()
    {   
        $divisi = Formulir::all();
        $listDivisi = Divisi::all();
        return view('auth.admin.divisiFormulir', compact('divisi', 'listDivisi'));
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
     * Show admin/durasi with condition
     * 
     * @return json
     */
    public function showDivisiFormulir($id)
    {
        $data = Formulir::with('divisi')->where('id', $id)->first();
        return response()->json($data);
    }

    /**
     * Post divisi 
     * 
     * @return view
     */
    public function addDivisi(Request $request)
    {
        $divisi_id = null;
        if($request->has('divisi')){
            $nama_divisi = $request->divisi;
            $validation['divisi'] = 'required|unique:divisi,nama_divisi';
        }else{
            $validation['editDivisi'] = 'required';
            $nama_divisi = $request->editDivisi;
            $divisi_id = Divisi::find($request->editIdDivisi)->id;
        }
        
        $request->validate($validation, $this->validation);
        Divisi::updateOrCreate([
            'id' => $divisi_id,
        ],[
            'nama_divisi' => $nama_divisi
        ]);

        return redirect()->back();
    }

    /**
     * Post divisi formulir
     * 
     * @return view
     */
    public function addDivisiFormulir(Request $request)
    {
        // dd($request);
        $validation = [
            'syarat' => 'required',
            'lokasi' => 'required'
        ];
        
        if($request->has('idDivisi')){
            $id_divisi = $request->idDivisi;
            $validation['idDivisi'] = 'required|unique:divisi_formulir,divisi_id';
        }else{
            $id_divisi = $request->editDivisi;
        }
        
        $request->validate($validation, $this->validation);

        Formulir::updateOrCreate([
            'divisi_id' => $id_divisi,
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
     * Delete divisi formulir
     * 
     * @return view
     */
    public function deleteDivisiFormulir(DivisiFormulir $divisi)
    {
        $dvs = Formulir::find($divisi->id);
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
        $users = User::with('pendaftar')->where('role_id', 2)->get();
        return view('auth.admin.pemagang', compact('users'));
    }

    /**
     * Show pemagang detail
     * 
     * @return json
     */
    public function showPemagang($id)
    {
        $data = User::with('pendaftar')->find($id);
        return response()->json($data);
    }

    /**
     * Store data with updated
     * 
     * @return view
     */
    public function addOrUpdatePemagang(Request $request)
    {
        if($request->has('editEmail')){
            $validator['editEmail'] = 'required';
        }else{
            $validator['email'] = 'required|email';
        }

        $request->validate($validator, [
            'required' => ':attribute harus diisi.',
            'email' => ':attribute tidak valid.'
        ]);

        $cekEmailOnUser = User::where('email', $request->email)->first();
        if($cekEmailOnUser){
            return redirect()->back()->withErrors(['msg' => 'Email Sudah Ada!']);
        } 

        $data = [
            'email' => $request->has('id') ? $request->editEmail : $request->email,
            'role_id' => 2,
        ];

        if(!$request->has('id')){
            $emailCek = Pendaftar::where('email', $request->email)->where('pendidikan', $request->pendidikan)->first();

            if($emailCek == null){
                return redirect()->back()->withErrors(['msg' => 'Email Belum Terdaftar!']);
            }

            // dd($emailCek->id);
            $data['pendaftar_id'] = $emailCek->id;
            $data['name'] = $emailCek->nama ?? '';
            $data['password'] = bcrypt('rahasiaLOhBRO');
        }else{
            $data['name'] = $request->nama;
        }
        
        User::updateOrCreate([
            'id' => $request->has('id') ? $request->id : ''
        ],$data);

        return redirect()->back()->with('msg', 'Data Pemagang Berhasil Ditambahkan!');
    }

    /**
     * Delete Pemagang
     * 
     * @return view
     */
    public function deletePemagang($id)
    {
        User::find($id)->delete();

        return redirect()->back();
    }

    /**
     * Show pendaftar page
     * 
     * @return view
     */
    public function pendaftar()
    {
        $pendaftar = Pendaftar::all();
        $lokasi = Lokasi::all();
        return view('auth.admin.pendaftar', compact('pendaftar','lokasi'));
    }

    /**
     * Show detail pendaftar page
     * 
     * @return view
     */
    public function showPendaftar(Pendaftar $pendaftar)
    {
        $pendaftar = Pendaftar::find($pendaftar->id);
        return view('auth.admin.detailPendaftar', compact('pendaftar'));
    }

    /**
     * Change status pendaftar
     * 
     * @return view
     */
    public function updateStatusPendaftar(Request $request, $id)
    {
        if(count($request->all()) > 1){
            if($request->has('validasi')) {
                $status = $request->validasi;
            }

            $pendaftar = Pendaftar::find($id);

            if($status == 'lolos berkas'){
                // Email lolos berkas
                Mail::send('auth.admin.mail.mailPemagangLolosBerkas',[], function($message) use($request){
                    $message->to($request->email); 
                    $message->subject('Pengumuman Hasil Seleksi Program Magang PT. Pelabuhan Indonesia'); 
                });
            }else if($status == 'tidak lolos'){
                // Email yang tidak lolos
                Mail::send('auth.admin.mail.mailPemagangTidakLolos',[], function($message) use($request){
                    $message->to($request->email); 
                    $message->subject('Pengumuman Hasil Seleksi Program Magang PT. Pelabuhan Indonesia'); 
                });
            }else {
                $data = [
                    'email' => $request->email,
                    'role_id' => 2,
                    'pendaftar_id' => $pendaftar->id,
                    'name' => $pendaftar->nama,
                    'password' => bcrypt('rahasiaLOhBRO')
                ];

                $cekUserExist = User::where('pendaftar_id', $pendaftar->id)->get();
                if(empty($cekEmailOnUser)){
                    User::create($data);

                    $token = Str::random(64);
    
                    DB::table('password_resets')->insert([
                    'email' => $request->email, 
                    'token' => $token,
                    'created_at' => now()
                    ]);

                    Mail::send('auth.admin.mail.mailPemagangLolos', ['token' => $token], function($message) use($request){
                        $message->to($request->email);
                        $message->subject('Pengumuman Seleksi Wawancara PT. Pelabuhan Indonesia Subregional Jawa');
                    });   
                }
            }

            
            $pendaftar->status = $status;
            $pendaftar->save();

            return redirect()->route('admin.pendaftar');
        }
        return redirect()->back()->with('msg', 'Gagal Validasi Status!');
    }

    /**
     * Show pengajuan page
     * 
     * @return view
     */
    public function pengajuan()
    {
        $pengajuan = Pengajuan::orderBy('user_id')->get()->groupBy(function($query){
            return $query->user->name;
        });
        return view('auth.admin.pengajuan', compact('pengajuan'));
    }

    /**
     * Show log pengajuan page
     * 
     * @return view
     */
    public function logPengajuan($id)
    {
        $pengajuan = Pengajuan::where('user_id', $id)->get();
        return view('auth.admin.logPengajuan', compact('pengajuan'));
    }

    /**
     * Show detail pengajuan page
     * 
     * @return view
     */
    public function detailPengajuan($id)
    {
        $pengajuan = Pengajuan::find($id);
        return view('auth.admin.detailPengajuan', compact('pengajuan'));
    }

    /**
     * Change status pengajuan
     * 
     * @return view
     */
    public function updateStatusPengajuan(Request $request, $id)
    {
        if(count($request->all()) > 1){
            if($request->has('validasi')) {
                $status = $request->validasi;
            }

            $pendaftar = Pengajuan::find($id);
            $pendaftar->status = $status;
            $pendaftar->save();

            return redirect()->route('admin.pengajuan');
        }
        return redirect()->back()->with('msg', 'Gagal Validasi Status!');
    }

    /**
     * Show presensi page
     * 
     * @return view
     */
    public function presensi()
    {
        $presensi = Presensi::orderBy('user_id')->get()->groupBy(function($query){
            return $query->user->name;
        });
        return view('auth.admin.presensi', compact('presensi'));
    }

    /**
     * Show log presensi page
     * 
     * @return view
     */
    public function logPresensi($id)
    {
        $presensi = Presensi::where('user_id', $id)->get();
        $pengajuan = Pengajuan::where('user_id', $id)->get();
        return view('auth.admin.log', compact('presensi', 'pengajuan'));
    }

    /**
     * Show detail presensi page
     * 
     * @return view
     */
    public function detailPresensi($id)
    {
        $presensi = Presensi::find($id);
        return view('auth.admin.detailPresensi', compact('presensi'));
    }
}