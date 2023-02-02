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
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tabel Pengajuan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="d-flex">

                            </div>
                            <a class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#addModal">
                                <i class="bi bi-plus-lg"></i> Tambah Pengajuan
                            </a>
                            <table id="durasiTabel" class="table table-bordered table-striped table-responsive-md">
                                <thead class="text-center">
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>Alasan</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @isset($pengajuan)
                                    @foreach($pengajuan as $ajuan)
                                    <tr>
                                        <td width="5%">{{ $loop->iteration }}</td>
                                        <td class="text-capitalize">{{ $ajuan->created_at }}</td>
                                        <td style="white-space: pre-line">{{ $ajuan->alasan }}</td>
                                        <td style="white-space: pre-line">{{ $ajuan->status }}</td>
                                        <td width="10%">
                                            <a href="javascript:void(0)" class="text-decoration-none text-warning"
                                                data-toggle="modal" data-target="#editModal"
                                                onclick="showPengajuan({{ $ajuan->id }})">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="{{ route('user.pengajuan.delete', $ajuan->id) }}"
                                                class="text-decoration-none text-danger"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus ini?')"><i
                                                    class="bi bi-trash3"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endisset

                                    @if($pengajuan->isEmpty())
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
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Ajuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('user.pengajuan.add') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="alasan" class="form-label">Alasan</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="alasan" id="exampleRadios1" value="izin"
                                checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Izin
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="alasan" id="exampleRadios2"
                                value="sakit">
                            <label class="form-check-label" for="exampleRadios2">
                                Sakit
                            </label>
                        </div>
                        @error('alasan')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea rows="3" class="form-control" id="keterangan" name="keterangan"></textarea>
                        @error('keterangan')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="customFile" class="form-label">Bukti Ajuan</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="bukti">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        @error('bukti')
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
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Ajuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('user.pengajuan.add') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" value="" id="idPengajuan">
                    <div class="mb-3">
                        <label for="alasan" class="form-label">Alasan</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="editAlasan" id="izin"
                                value="izin" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Izin
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="editAlasan" id="sakit"
                                value="sakit">
                            <label class="form-check-label" for="exampleRadios2">
                                Sakit
                            </label>
                        </div>
                        @error('editAlasan')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea rows="3" class="form-control" id="editKeterangan" name="editKeterangan"></textarea>
                        @error('editKeterangan')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="customFile" class="form-label">Bukti Ajuan</label><br>
                        <a href="{{ asset('uploads/pengajuan')}}"
                            id="file"
                            data-fancybox=data-caption="Optional caption" data-width="1300" data-height="1000"><i class="bi bi-file-earmark"></i>
                            Lihat File</a>
                        <div class="custom-file mt-2">
                            <input type="file" class="custom-file-input" id="customFile" name="editBukti">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        @error('ediBukti')
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
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<script>
function showPengajuan(id) {
    fetch("pengajuan/show/" + id)
        .then((response) => response.json())
        .then(data => {
            if(data.alasan == 'izin'){
                document.getElementById('izin').checked = true;
            }else{
                document.getElementById('sakit').checked = true;
            }
            document.getElementById('idPengajuan').value = data.id;
            document.getElementById('editKeterangan').value = data.keterangan;
            document.getElementById('file').href = "{{ asset('uploads/pengajuan')}}/"+data.bukti;
        });
}
</script>
@endpush