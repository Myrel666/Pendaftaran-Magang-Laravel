@extends('layouts.landing')

@section('content')
<main id="main">
    <div style="background: #32B5E9; color: #fff; padding-top: 70px;">
        <div class="container">
            <h2 class="text-capitalize p-4">divisi {{ Str::replace('-', ' ', $divisi->nama_divisi) }}</h2>
        </div>
    </div>
    <section>
        <div class="container">
            <div id="requitments">
                <p class="fw-bold">Persyaratan :</p>
                <ul>
                    <ol style="white-space: pre-line">{!! $divisi->divisi_formulir[0]->syarat !!}</ol>
                </ul>
                <p class="fw-bold">Lokasi :</p>
                <ul>
                    <ol style="white-space: pre-line">{!! $divisi->divisi_formulir[0]->lokasi !!}</ol>
                </ul>
                <h3 class="text-capitalize fw-bolder mt-5" style="color: #32B5E9;">masukkan data diri ({{ $user }})</h3>
                <div class="row mt-5">
                    <div class="col-md-8">
                        @if(session('limit'))
                        <div class="alert alert-warning" role="alert">
                            {{ session('limit') }}
                        </div>
                        @endif
                        @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                        @endif
                        <form action="{{ route('guest.formulir') }}" method="post" enctype="multipart/form-data">
                            <div class="d-grid gap-4">
                                @csrf
                                <input type="hidden" name="durasi" value="{{ $durasi->id }}">
                                <input type="hidden" name="divisi" value="{{ $divisi->id }}">
                                <input type="hidden" name="pendidikan" value="{{ $user }}">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="fw-bold" for="nama">Nama:</label>
                                    <div class="w-75">
                                        <input type="text" class="form-control form-control-sm" id="nama" name="nama"
                                            autocomplete="off" value="{{ old('nama') }}" aria-describedby="namaError">
                                        @error('nama')
                                        <small id="namaError" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="fw-bold" for="nomor">No. Telp:</label>
                                    <div class="w-75">
                                        <input type="number" class="form-control form-control-sm " id="nomor"
                                            name="nomor" value="{{ old('nomor') }}" aria-describedby="nomorError">
                                        @error('nomor')
                                        <small id="nomorError" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="fw-bold" for="email">Email:</label>
                                    <div class="w-75">
                                        <input type="email" class="form-control form-control-sm " id="email"
                                            name="email" value="{{ old('email') }}" aria-describedby="emailError">
                                        @error('email')
                                        <small id="emailError" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="fw-bold" for="instansi">Instansi:</label>
                                    <div class="w-75">
                                        <input type="text" class="form-control form-control-sm " id="instansi"
                                            name="instansi" value="{{ old('instansi') }}" aria-describedby="instansiError">
                                        @error('instansi')
                                        <small id="instansiError" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-md-3">
                                        <label for="form-check" class="fw-bold">Lokasi:</label>
                                    </div>
                                    @php $lokasi = explode(PHP_EOL, $divisi->divisi_formulir[0]->lokasi) @endphp
                                    <div class="col-md-9 offset-3" style="margin-top: -25px">
                                        @foreach($lokasi as $lok)
                                        @php $noNumber = explode(' ', $lok)[1] @endphp
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="lokasi"
                                                id="inlineRadio1" value="{{ $noNumber }}" aria-describedby="lokasiError>
                                            <label class="form-check-label" for="inlineRadio1">{{ $noNumber }}</label>
                                        </div>
                                        @endforeach
                                        @error('lokasi')
                                        <small id="lokasiError" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="fw-bold" for="foto">Foto:</label>
                                    <div class="w-75">
                                        <input type="file" class="form-control form-control-sm" id="foto"
                                            name="foto" aria-describedby="fotoError">
                                        @error('foto')
                                        <small id="fotoError" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="fw-bold" for="pengantar">Surat Pengantar:</label>
                                    <div class="w-75">
                                        <input type="file" class="form-control form-control-sm" id="pengantar"
                                            name="pengantar" aria-describedby="pengantarError">
                                        @error('pengantar')
                                        <small id="pengantarError" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="fw-bold" for="proposal">Proposal:</label>
                                    <div class="w-75">
                                        <input type="file" class="form-control form-control-sm " id="proposal"
                                            name="proposal" aria-describedby="proposalError">
                                        @error('proposal')
                                        <small id="proposalError" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="fw-bold" for="cv">CV:</label>
                                    <div class="w-75">
                                        <input type="file" class="form-control form-control-sm" id="cv" name="cv"
                                            aria-describedby="cvError">
                                        @error('cv')
                                        <small id="cvError" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="fw-bold" for="vaksin">Vaksin (Dosis ke-3):</label>
                                    <div class="w-75">
                                        <input type="file" class="form-control form-control-sm" id="vaksin"
                                            name="vaksin" aria-describedby="vaksinError">
                                        @error('vaksin')
                                        <small id="vaksinError" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn mt-5 px-5 py-2"
                                    style="background: #32B5E9; color: white;">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
@endsection