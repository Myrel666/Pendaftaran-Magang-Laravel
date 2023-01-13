@extends('layouts.app')

@section('title', 'Montern')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Pemagang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Data Pemagang</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tabel Pemagang</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="d-flex">

                            </div>
                            <a class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#addModal">
                                <i class="bi bi-plus-lg"></i> Tambah Pemagang
                            </a>
                            <table id="durasiTabel" class="table table-bordered table-striped">
                                <thead class="text-center">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama </th>
                                        <th>Email </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td width="5%">1</td>
                                        <td class="text-capitalize">Ega Almira</td>
                                        <td >egaalmira@gmail.com</td>
                                        <td width="20%">
                                            <a href="" class="text-decoration-none text-warning">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="" class="text-decoration-none text-primary">
                                                <i class="bi bi-box-arrow-up-right"></i>
                                            </a>
                                            <a href=""
                                                class="text-decoration-none text-danger"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus ini?')">
                                                <i class="bi bi-trash3"></i>
                                            </a>
                                        </td>
                                    </tr>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
</div>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Pemagang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="waktu" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="waktu" placeholder="Ega Almira" name="nama">
                        @error('nama')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection