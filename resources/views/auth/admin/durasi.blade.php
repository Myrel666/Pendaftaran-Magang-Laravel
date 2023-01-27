@extends('layouts.app')

@section('title', 'Montern')
@push('css')
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/fontawesome-free/css/all.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<style>
/* The switch - the box around the slider */
.switch {
    position: relative;
    display: inline-block;
    width: 30px;
    height: 17px;
}

/* Hide default HTML checkbox */
.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

/* The slider */
.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 13px;
    width: 13px;
    left: 2px;
    bottom: 2px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
}

input:checked+.slider {
    background-color: #2196F3;
}

input:focus+.slider {
    box-shadow: 0 0 1px #2196F3;
}

input:checked+.slider:before {
    -webkit-transform: translateX(13px);
    -ms-transform: translateX(13px);
    transform: translateX(13px);
}

/* Rounded sliders */
.slider.round {
    border-radius: 17px;
}

.slider.round:before {
    border-radius: 50%;
}
</style>
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengaturan Durasi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.beranda') }}">Home</a></li>
                        <li class="breadcrumb-item active">Pengaturan Durasi</li>
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
                            <h3 class="card-title">Tabel Durasi Magang</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <a class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#addModal">
                                    <i class="bi bi-plus-lg"></i> Tambah Durasi
                                </a>
                                <form action="{{ route('admin.durasi') }}" method="get" class="w-25">
                                    <select class="custom-select rounded-0 w-50 mr-2" id="exampleSelectBorder"
                                        name="pendidikan">
                                        @if(!$durasi->isEmpty())
                                        <option value="siswa" {{ $durasi[0]->pendidikan == 'siswa' ? 'selected' : '' }}>
                                            Siswa</option>
                                        <option value="mahasiswa"
                                            {{ $durasi[0]->pendidikan == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa
                                        </option>
                                        @else
                                        <option value="siswa">Siswa</option>
                                        <option value="mahasiswa">Mahasiswa</option>
                                        @endif
                                    </select>
                                    <button type="submit" class="btn btn-outline-primary btn-sm">Tampilkan</button>
                                </form>
                            </div>
                            <table id="durasiTabel" class="table table-bordered table-striped table-responsive-md">
                                <thead class="text-center">
                                    <tr>
                                        <th>No.</th>
                                        <th>Durasi</th>
                                        <th>Limit</th>
                                        <th>Pendidikan</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @isset($durasi)
                                    @foreach($durasi as $waktu)
                                    <tr>
                                        <td width="5%">{{ $loop->iteration }}</td>
                                        <td class="text-capitalize">{{ $waktu->waktu_durasi }}</td>
                                        <td class="text-capitalize">{{ $waktu->limit }} orang</td>
                                        <td class="text-capitalize">{{ $waktu->pendidikan }}</td>
                                        <td width="15%">
                                            <div class="switch">
                                                <div class="toggle-1-bulan"></div>
                                                <label class="switch">
                                                    <input type="checkbox" id="checkbox{{ $waktu->id }}"
                                                        onchange="setStatusDurasi({{ $waktu->id }})" {{ $waktu->status == 1 ? 'checked' : '' }}
                                                        >
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td width="10%">
                                            <a href="javascript:void(0)" class="text-decoration-none text-warning"
                                                data-toggle="modal" data-target="#editModal"
                                                onclick="showDurasi({{ $waktu->id }})">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="{{ route('admin.durasi.delete', $waktu->id) }}"
                                                class="text-decoration-none text-danger"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus ini?')">
                                                <i class="bi bi-trash3"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endisset

                                    @if($durasi->isEmpty())
                                    <td colspan="6">Data tidak ada.</td>
                                    @endif
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

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Durasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.durasi.add') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="waktu" class="form-label">Waktu Magang</label>
                        <input type="text" class="form-control" placeholder="3 Bulan" name="waktu"
                            autocomplete="off">
                        @error('waktu')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Pendidikan</label>
                        <select class="form-control" name="pendidikan">
                            <option value="siswa">Siswa</option>
                            <option value="mahasiswa">Mahasiswa</option>
                        </select>
                        @error('pendidikan')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="limit" class="form-label">Set Limit Pendaftar</label>
                        <input type="number" class="form-control" placeholder="30" name="limit" min="1">
                        @error('limit')
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

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Durasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.durasi.add') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="pendidikan" value="" name="pendidikan">
                    <input type="hidden" id="status" value="" name="status">
                    <input type="hidden" class="form-control" id="waktu" name="waktu" value="">
                    <div class="form-group">
                        <label for="limit" class="form-label">Set Limit Pendaftar</label>
                        <input type="number" class="form-control" id="limit" placeholder="30" name="limit" min="1" value="">
                        @error('limit')
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
@push('js')
<script>
function setStatusDurasi(id) {
    var cek = $('#checkbox'+id).is(":checked");
    if (cek) {
        fetch("{{ route('admin.durasi.updateStatus') }}", {
                method: 'PUT', // or 'PUT'
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': "{{ csrf_token() }}",
                },
                body: JSON.stringify({
                    id,
                    status: '1'
                }),
            })
            .then((response) => response.json())
            .catch((error) => {
                console.error('Error:', error);
            });
    } else {
        fetch("{{ route('admin.durasi.updateStatus') }}", {
                method: 'PUT', // or 'PUT'
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': "{{ csrf_token() }}",
                },
                body: JSON.stringify({
                    id,
                    status: '0'
                }),
            })
            .then((response) => response.json())
            .catch((error) => {
                console.error('Error:', error);
            });
    }
}

function showDurasi(id) {
    fetch("durasi/show/" + id)
        .then((response) => response.json())
        .then(data => {
            document.getElementById('waktu').value = data.waktu_durasi;
            document.getElementById('limit').value = data.limit;
            document.getElementById('pendidikan').value = data.pendidikan;
            document.getElementById('status').value = data.status;
        });
}
</script>
@endpush