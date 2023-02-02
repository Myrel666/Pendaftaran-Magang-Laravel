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
                    <h1>Detail Pengajuan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.pengajuan') }}">Pengajuan</a></li>
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
                            <h3 class="card-title">Detail Pengajuan</h3>
                            <span class="float-right">Status : {{ $pengajuan->status }}</span>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" aria-label="Disabled input example" disabled
                                    readonly value="{{ $pengajuan->user->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label">Alasan</label>
                                <input type="text" class="form-control" aria-label="Disabled input example" disabled
                                    readonly id="exampleFormControlInput2" value="{{ $pengajuan->alasan }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label">Keterangan</label>
                                <textarea class="form-control" aria-label="Disabled input example" disabled readonly
                                    id="exampleFormControlInput2">{{ $pengajuan->keterangan }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput3" class="form-label">Bukti Ajuan :</label>
                                <br>
                                <a href="{{ asset('uploads/pengajuan')}}/{{ $pengajuan->bukti }}" data-fancybox
                                    data-caption="Optional caption" data-type="pdf" data-width="1300"
                                    data-height="1000"><i class="bi bi-filetype-pdf"></i>
                                    Lihat Dokumen
                                </a>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="#" data-toggle="modal" data-target="#validasiModal"
                                    class="btn btn-primary btn-sm float-end px-4">Validasi</a>
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
                <form action="{{ route('admin.pengajuan.changeStatus', $pengajuan->id) }}" method="post">
                    @csrf
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="validasi" id="flexRadioDefault1"
                            value="disetujui">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Disetujui
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="validasi" id="flexRadioDefault1"
                            value="ditolak">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Ditolak
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