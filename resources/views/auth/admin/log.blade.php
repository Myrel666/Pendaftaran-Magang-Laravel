@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
@endpush
@section('title', 'Montern')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Log Presensi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.presensi') }}">Presensi</a></li>
                        <li class="breadcrumb-item active">Log</li>
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
                            <h3 class="card-title">Tabel Presensi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="pengajuanTable" class="table table-striped table-bordered table-responsive-md text-center"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No. </th>
                                        <th>Tanggal</th>
                                        <th>Jam Masuk</th>
                                        <th>Jam Pulang</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $user @endphp
                                    @foreach($presensi as $absen)
                                    @php $user = $absen->user->name @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $absen->tgl }}</td>
                                        <td>{{ $absen->created_at->format('H:i:s') }}</td>
                                        <td>{{ $absen->updated_at->format('H:i:s') }}</td>
                                        <td>
                                            @php 
                                            $masuk = $absen->created_at->format('H:i:s');
                                            $pulang = $absen->updated_at->format('H:i:s');
                                            @endphp
                                            @if($pulang >= '17:00:00' && $masuk <= '08:00:00')
                                            Hadir
                                            @elseif($absen->bukti_pulang == null)
                                            Hadir Tanpa Absen Pulang
                                            @elseif($absen->bukti_masuk == null)
                                            Hadir Tanpa Absen Masuk
                                            @elseif($pulang < '17:00:00' && $masuk <='08:00:00')
                                            Hadir Pulang Cepat
                                            @else 
                                            A
                                            @endif
                                        </td>
                                        <td><a href="{{ route('admin.presensi.detail', $absen->id) }}" class="btn btn-outline-info btn-sm">Detail</a></td>
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

<!-- pdf button -->
<script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>

<script>
var dataTable;

$(document).ready(function() {
    dataTable = $('#pengajuanTable').DataTable({
        dom: 'Bfrtip',
        buttons: [{
            extend: 'pdfHtml5',
            title: 'Log Presensi',
            filename: 'Data Presensi {{ $user }}',
            exportOptions: {
                columns: [ 0, 1, 2, 3, 4]
            }
        }],
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

    $('.buttons-pdf').addClass('btn btn-outline-info btn-sm');
    $('.buttons-pdf').removeClass('dt-button');
    $('.buttons-pdf span').html('<i class="bi bi-filetype-pdf me-1"></i> Export PDF');

});
</script>
@endpush