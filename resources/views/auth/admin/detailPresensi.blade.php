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
                    <h1>Detail Presensi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.presensi') }}">Presensi</a></li>
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
                            <h3 class="card-title">Detail Presensi</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput3" class="form-label">Bukti Masuk :</label>
                                <br>
                                <a href="{{ asset('uploads/absensi')}}/{{ $presensi->bukti_masuk }}" data-fancybox
                                    data-caption="Foto" data-width="1300" data-height="1000">
                                    <i class="bi bi-card-image"></i>
                                    Lihat Gambar
                                </a>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput3" class="form-label">Bukti Pulang :</label>
                                <br>
                                <a href="{{ asset('uploads/absensi')}}/{{ $presensi->bukti_pulang }}" data-fancybox
                                    data-caption="Foto" data-width="1300" data-height="1000">
                                    <i class="bi bi-card-image"></i>
                                    Lihat Gambar
                                </a>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="{{ url()->previous() }}" class="btn btn-info btn-sm float-end px-4">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
@endpush