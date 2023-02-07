@extends('layouts.app')

@section('title', 'Montern')
@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
@endpush
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Pendaftar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.pendaftar') }}">Pendaftar</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detail Pendaftar</h3>
                            <span class="float-right">Status : {{ $pendaftar->status }}</span>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" aria-label="Disabled input example" disabled
                                    readonly value="{{ $pendaftar->nama }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label">Email</label>
                                <input type="text" class="form-control" aria-label="Disabled input example" disabled
                                    readonly id="exampleFormControlInput2" value="{{ $pendaftar->email }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput3" class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control" aria-label="Disabled input example" disabled
                                    readonly id="exampleFormControlInput3" value="{{ $pendaftar->nomor_telepon }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput4" class="form-label">Instansi</label>
                                <input type="text" class="form-control" aria-label="Disabled input example" disabled
                                    readonly id="exampleFormControlInput4" value="{{ $pendaftar->instansi }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput5" class="form-label">Lokasi</label>
                                <input type="text" class="form-control" aria-label="Disabled input example" disabled
                                    readonly id="exampleFormControlInput5" value="{{ $pendaftar->lokasi }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput3" class="form-label">Pendidikan</label>
                                <input type="text" class="form-control" aria-label="Disabled input example" disabled
                                    readonly id="exampleFormControlInput3" value="{{ $pendaftar->pendidikan }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput3" class="form-label">Divisi</label>
                                <input type="text" class="form-control" aria-label="Disabled input example" disabled
                                    readonly id="exampleFormControlInput3"
                                    value="{{ $pendaftar->divisi->nama_divisi }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput3" class="form-label">Durasi</label>
                                <input type="text" class="form-control" aria-label="Disabled input example" disabled
                                    readonly id="exampleFormControlInput3"
                                    value="{{ $pendaftar->durasi->waktu_durasi }}">
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput3" class="form-label">Foto :</label>
                                        <br>
                                        <a href="{{ asset('uploads/profiles')}}/{{ $pendaftar->foto }}" data-fancybox
                                            data-caption="Foto">
                                            <i class="bi bi-card-image"></i>
                                            Lihat Gambar
                                        </a>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput3" class="form-label">Surat Pengantar
                                            :</label>
                                        <br>
                                        <a href="{{ asset('uploads')}}/{{ $pendaftar->surat_pengantar }}"
                                            data-fancybox=data-caption="Optional caption" data-type="pdf"
                                            data-width="1300" data-height="1000"><i class="bi bi-filetype-pdf"></i>
                                            Lihat Dokumen</a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput3" class="form-label">Proposal :</label>
                                        <br>
                                        <a href="{{ asset('uploads')}}/{{ $pendaftar->proposal }}"
                                            data-fancybox=data-caption="Optional caption" data-type="pdf"
                                            data-width="1300" data-height="1000"><i class="bi bi-filetype-pdf"></i>
                                            Lihat Dokumen</a>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput3" class="form-label">CV :</label>
                                        <br>
                                        <a href="{{ asset('uploads')}}/{{ $pendaftar->cv }}"
                                            data-fancybox=data-caption="Optional caption" data-type="pdf"
                                            data-width="1300" data-height="1000"><i class="bi bi-filetype-pdf"></i>
                                            Lihat Dokumen</a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput3" class="form-label">Vaksin :</label>
                                        <br>
                                        <a href="{{ asset('uploads')}}/{{ $pendaftar->vaksin }}"
                                            data-fancybox=data-caption="Optional caption" data-type="pdf"
                                            data-width="1300" data-height="1000"><i class="bi bi-filetype-pdf"></i>
                                            Lihat Dokumen</a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end">
                                        <a href="#" data-toggle="modal" data-target="#validasiModal"
                                            class="btn btn-primary btn-sm float-end px-4">Validasi</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Validasi Modal -->
<div class="modal fade" id="validasiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Validasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.pendaftar.changeStatus', $pendaftar->id) }}" method="post">
                    @csrf
                    <input type="hidden" value="{{ $pendaftar->email }}" name="email">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="validasi" id="flexRadioDefault1"
                            value="lolos berkas">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Lolos Berkas
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="validasi" id="flexRadioDefault1"
                            value="diterima">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Diterima
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="validasi" id="flexRadioDefault1"
                            value="tidak lolos">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Tidak Lolos
                        </label>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm">Validasi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
@endpush