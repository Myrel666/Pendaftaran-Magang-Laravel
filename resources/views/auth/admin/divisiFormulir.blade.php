@extends('layouts.app')

@section('title', 'Montern')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengaturan Formulir</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.beranda') }}">Home</a></li>
                        <li class="breadcrumb-item active">Pengaturan Formulir</li>
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
                            <h3 class="card-title">Tabel Divisi Formulir</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="d-flex">

                            </div>
                            <a class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#addModal">
                                <i class="bi bi-plus-lg"></i> Tambah Persyaratan
                            </a>
                            <table id="durasiTabel" class="table table-bordered table-striped table-responsive-md">
                                <thead class="text-center">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Divisi</th>
                                        <th>Persyaratan</th>
                                        <th>Lokasi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @isset($divisi)
                                    @foreach($divisi as $dvs)
                                    <tr>
                                        <td width="5%">{{ $loop->iteration }}</td>
                                        <td class="text-capitalize">{{ $dvs->divisi->nama_divisi }}</td>
                                        <td style="white-space: pre-line">{{ $dvs->syarat }}</td>
                                        <td style="white-space: pre-line">{{ $dvs->lokasi }}</td>
                                        <td width="10%">
                                            <a href="javascript:void(0)" class="text-decoration-none text-warning"
                                                data-toggle="modal" data-target="#editModal"
                                                onclick="showDivisiFormulir({{ $dvs->id }})">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="{{ route('admin.divisi.formulir.delete', $dvs->id) }}"
                                                class="text-decoration-none text-danger"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus ini?')"><i
                                                    class="bi bi-trash3"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endisset

                                    @if($divisi->isEmpty())
                                    <td colspan="5">Data tidak ada.</td>
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
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Divisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.divisi.formulir.add') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="divisi" class="form-label">Nama Divisi</label>
                        <select class="custom-select" name="idDivisi">
                            <option selected>...</option>
                            @foreach($listDivisi as $dvs)
                            <option value="{{ $dvs->id }}">{{ $dvs->nama_divisi }}</option>
                            @endforeach
                        </select>
                        @error('idDivisi')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="syarat" class="form-label">Syarat</label>
                        <textarea rows="3" class="form-control" id="syarat"
                            placeholder="1. Warga Negara Indonesia.&#10;2. Jurusan Psikologi dan sejenisnya."
                            name="syarat"></textarea>
                        @error('syarat')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Lokasi</label>
                        <textarea rows="3" class="form-control" id="lokasi" placeholder="1. Surabaya&#10;2. Gresik"
                            name="lokasi"></textarea>
                        @error('lokasi')
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
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Divisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.divisi.formulir.add') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="editDivisi" class="form-label">Nama Divisi</label>
                        <select class="custom-select" disabled>
                            <option value="" selected id="divisi">...</option>
                        </select>
                        <input type="hidden" value="" id="editDivisi" name="editDivisi">
                    </div>
                    <div class="mb-3">
                        <label for="editSyarat" class="form-label">Syarat</label>
                        <textarea rows="3" class="form-control" id="editSyarat"
                            placeholder="1. Warga Negara Indonesia.&#10;2. Jurusan Psikologi dan sejenisnya."
                            name="syarat"></textarea>
                        @error('syarat')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="editLokasi" class="form-label">Lokasi</label>
                        <textarea rows="3" class="form-control" id="editLokasi" placeholder="1. Surabaya&#10;2. Gresik"
                            name="lokasi"></textarea>
                        @error('lokasi')
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
function showDivisiFormulir(id) {
    fetch("formulir/show/" + id)
        .then((response) => response.json())
        .then(data => {
            document.getElementById('editDivisi').value = data.id;
            document.getElementById('divisi').innerHTML = data.divisi.nama_divisi;
            document.getElementById('editSyarat').value = data.syarat;
            document.getElementById('editLokasi').value = data.lokasi;
        });
}
</script>
@endpush