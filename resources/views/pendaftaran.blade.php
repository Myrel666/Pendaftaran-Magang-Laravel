@extends('layouts.landing')

@section('content')
<main id="main">
    <div style="background: #32B5E9; color: #fff; padding-top: 70px;">
        <div class="container">
            <h2 class="text-capitalize p-4">{{ Str::replace('-', ' ', $divisi) }}</h2>
        </div>
    </div>
    <section>
        <div class="container">
            <div id="requitments">
                <p class="fw-bold">Persyaratan :</p>
                <ul>
                    <ol>1. Warga Negara Indonesia.</ol>
                    <ol>2. Jurusan Psikologi dan sejenisnya.</ol>
                    <ol>3. Melampirkan surat pengantar, CV, dan proposal.</ol>
                    <ol>4. Pas Foto 6x4</ol>
                </ul>
                <p class="fw-bold">Lokasi :</p>
                <ul>
                    <ol>1. Surabaya</ol>
                    <ol>2. Gresik</ol>
                </ul>
                <h3 class="text-capitalize fw-bolder mt-5" style="color: #32B5E9;">masukkan data diri ({{ $user }})</h3>
                <div class="row mt-5">
                    <div class="col-md-8">
                        <form action="">
                            <div class="d-grid gap-4">

                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="fw-bold" for="nama">Nama:</label>
                                    <input type="text" class="form-control form-control-sm w-75" id="nama">
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="fw-bold" for="nomor">No. Telp:</label>
                                    <input type="text" class="form-control form-control-sm w-75" id="nomor">
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="fw-bold" for="email">Email:</label>
                                    <input type="text" class="form-control form-control-sm w-75" id="email">
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="fw-bold" for="univ">Universitas:</label>
                                    <input type="text" class="form-control form-control-sm w-75" id="univ">
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="fw-bold" for="fakultas">Fakultas:</label>
                                    <input type="text" class="form-control form-control-sm w-75" id="fakultas">
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="fw-bold" for="jurusan">Jurusan:</label>
                                    <input type="text" class="form-control form-control-sm w-75" id="jurusan">
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="fw-bold" for="pengantar">Surat Pengantar:</label>
                                    <input type="file" class="form-control form-control-sm w-75" id="pengantar">
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="fw-bold" for="proposal">Proposal:</label>
                                    <input type="file" class="form-control form-control-sm w-75" id="proposal">
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="fw-bold" for="cv">CV:</label>
                                    <input type="file" class="form-control form-control-sm w-75" id="cv">
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="fw-bold" for="vaksin">Vaksin (Vaksin ke-3):</label>
                                    <input type="file" class="form-control form-control-sm w-75" id="vaksin">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn mt-5 px-5 py-2" style="background: #32B5E9; color: white;">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
@endsection