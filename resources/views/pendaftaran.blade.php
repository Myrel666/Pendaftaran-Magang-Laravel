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
                    <ol style="white-space: pre-line">{!! $divisi->syarat !!}</ol>
                </ul>
                <p class="fw-bold">Lokasi :</p>
                <ul>
                    <ol style="white-space: pre-line">{!! $divisi->lokasi !!}</ol>
                </ul>
                <h3 class="text-capitalize fw-bolder mt-5" style="color: #32B5E9;">masukkan data diri ({{ $user }})</h3>
                <div class="row mt-5">
                    <div class="col-md-8">
                        <form action="{{ route('guest.formulir') }}" method="post" enctype="multipart/form-data">
                            <div class="d-grid gap-4">
                                @csrf
                                <input type="hidden" name="durasi" value="{{ $durasi->id }}">
                                <input type="hidden" name="divisi" value="{{ $divisi->id }}">
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
                                @if($user == 'mahasiswa')
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="fw-bold" for="univ">Universitas:</label>
                                    <div class="w-75">
                                        <input type="text" class="form-control form-control-sm" id="univ" name="univ"
                                            value="{{ old('univ') }}" aria-describedby="univError">
                                        @error('univ')
                                        <small id="univError" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="fw-bold" for="fakultas">Fakultas:</label>
                                    <div class="w-75">
                                        <input type="text" class="form-control form-control-sm" id="fakultas"
                                            name="fakultas" value="{{ old('fakultas') }}"
                                            aria-describedby="fakultasError">
                                        @error('fakultas')
                                        <small id="fakultasError" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="fw-bold" for="jurusan">Jurusan:</label>
                                    <div class="w-75">
                                        <input type="text" class="form-control form-control-sm" id="jurusan"
                                            name="jurusan" value="{{ old('jurusan') }}" aria-describedby="jurusanError">
                                        @error('jurusan')
                                        <small id="jurusanError" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                @else
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="fw-bold" for="asal">Asal Sekolah:</label>
                                    <div class="w-75">
                                        <input type="text" class="form-control form-control-sm" id="asal"
                                            name="asal" value="{{ old('asal') }}" aria-describedby="asalError">
                                        @error('asal')
                                        <small id="asalError" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="fw-bold" for="jurusan">Jurusan:</label>
                                    <div class="w-75">
                                        <input type="text" class="form-control form-control-sm" id="jurusan"
                                            name="jurusan" value="{{ old('jurusan') }}" aria-describedby="jurusanError">
                                        @error('jurusan')
                                        <small id="jurusanError" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                @endif
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
                                    <label class="fw-bold" for="vaksin">Vaksin (Vaksin ke-3):</label>
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