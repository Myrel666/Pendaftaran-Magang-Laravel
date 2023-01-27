@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
@endpush
@section('title', 'Montern')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pendaftar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.beranda') }}">Home</a></li>
                        <li class="breadcrumb-item active">Pendaftar</li>
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
                            <h3 class="card-title">Tabel Pendaftar</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 col-7 d-flex align-items-center">
                                    <span class="mr-2">Lokasi: </span>
                                    <select name="lokasi" class="custom-select custom-select-sm" onchange="filterLokasi()"
                                        aria-label=".form-select-sm example">
                                        <option value="" selected>Pilih Lokasi</option>
                                        @foreach($lokasi as $lok)
                                        <option value="{{ $lok->name }}">{{ $lok->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="border-bottom border-secondary my-3"></div>
                            <table id="pendaftarTable" class="table table-striped table-bordered table-responsive-md text-center"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No. </th>
                                        <th>Nama</th>
                                        <th class="lokasi">Lokasi</th>
                                        <th>Divisi</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendaftar as $daftar)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $daftar->nama }}</td>
                                        <td>{{ $daftar->lokasi }}</td>
                                        <td>{{ $daftar->divisi->nama_divisi }}</td>
                                        <td>
                                            @if($daftar->status == 'belum diproses' )
                                            <span class="badge bg-warning">{{ $daftar->status }}</span>
                                            @elseif($daftar->status == 'lolos berkas')
                                            <span class="badge bg-info">{{ $daftar->status }}</span>
                                            @elseif($daftar->status == 'diterima')
                                            <span class="badge bg-success">{{ $daftar->status }}</span>
                                            @elseif($daftar->status == 'tidak lolos')
                                            <span class="badge bg-danger">{{ $daftar->status }}</span>
                                            @endif
                                        </td>
                                        <td><a href="{{ route('admin.pendaftar.detail', $daftar->id) }}" class="text-dark">Detail</a></td>
                                    </tr>
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
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>

<script>
var dataTable;

$(document).ready(function() {
    dataTable = $('#pendaftarTable').DataTable({
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

function filterLokasi() {
    let pilihanLokasi = $('select[name=lokasi] option').filter(':selected').val();
    dataTable.columns('.lokasi').search(pilihanLokasi).draw();
}
</script>
@endpush