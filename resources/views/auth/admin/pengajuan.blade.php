@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
@endpush
@section('title', 'Montern')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengajuan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.beranda') }}">Home</a></li>
                        <li class="breadcrumb-item active">Pengajuan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tabel Pengajuan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="pengajuanTable" class="table table-striped table-bordered table-responsive-md text-center"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No. </th>
                                        <th>Tanggal</th>
                                        <th>Nama</th>
                                        <th>Alasan</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pengajuan as $ajuan)
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ajuan->created_at }}</td>
                                    <td>{{ $ajuan->user->name }}</td>
                                    <td>{{ $ajuan->alasan }}</td>
                                    <td>
                                        @if($ajuan->status == 'ditolak')
                                            <div class="badge badge-danger">{{ $ajuan->status }}</div>
                                        @elseif($ajuan->status == 'disetujui')
                                            <div class="badge badge-success">{{ $ajuan->status }}</div>
                                        @else
                                        <div class="badge badge-warning">{{ $ajuan->status }}</div>
                                        @endif
                                        
                                    </td>
                                    <td><a href="{{ route('admin.pengajuan.detail', $ajuan->id) }}" class="btn btn-outline-info btn-sm">Detail</a></td>
                                    @endforeach
                                </tbody>
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


@endsection
@push('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>

<script>
var dataTable;

$(document).ready(function() {
    dataTable = $('#pengajuanTable').DataTable({
        "columnDefs": [{
                "orderable": false,
                "targets": [4, 5]
            },
            {
                "searchable": false,
                "targets": [4, 5]
            },
        ]
    });

});
</script>
@endpush