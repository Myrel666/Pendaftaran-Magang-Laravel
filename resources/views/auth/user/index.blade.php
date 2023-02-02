@extends('layouts.app')

@section('title', 'Montern')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div id="time"></div>
                        <div class="">
                            <a href="#" class="btn btn-outline-info px-5 mr-2" data-toggle="modal"
                                data-target="#masukModal" onclick="webcam('masuk')">Masuk</a>
                            <a href="#" class="btn btn-outline-danger px-5" data-toggle="modal"
                                data-target="#pulangModal" onclick="webcam('pulang')">Pulang</a>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ count($disetujui) }}</h3>

                            <p>Disetujui</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-checkmark-circled"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ count($diproses) }}</h3>

                            <p>Diproses</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-loop"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ count($ditolak) }}</h3>

                            <p>Ditolak</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-close-circled"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-12 connectedSortable">

                    <!-- Calendar -->
                    <div class="card bg-gradient-default">
                        <div class="card-header border-0">

                            <h3 class="card-title">
                                <i class="far fa-calendar-alt"></i>
                                Calendar
                            </h3>
                            <!-- tools card -->
                            <div class="card-tools">
                                <!-- button with a dropdown -->
                                <button type="button" class="btn btn-white btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /. tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pt-0">
                            <!--The calendar -->
                            <div id="calendar" style="width: 100%"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </section>
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- Masuk Modal -->
<div class="modal fade" id="masukModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeWebcam()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="uploadImage">Masuk</label><br>
                    <span class="font-italic mb-3">Wajib Menggunakan Foto Bukti Masuk</span>
                    <div class="d-flex justify-content-center mb-2">
                        <div id="my_camera" class="border border-dark"></div>
                        <div id="result"></div>
                    </div>
                </div>
                <form action="{{ route('user.absensi') }}" method="post">
                    @csrf
                    <input type="hidden" name="image" class="image-absen">
                    <input type="hidden" name="absen" value="masuk">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    onclick="closeWebcam()">Close</button>
                <button type="submit" class="btn btn-primary" onclick="take_snapshot()">Masuk</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Pulang Modal -->
<div class="modal fade" id="pulangModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Pulang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeWebcam()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="uploadImage">Pulang</label><br>
                    <span class="font-italic">Wajib Menggunakan Foto Bukti Pulang</span>
                    <br>
                    <div class="d-flex justify-content-center mb-2">
                        <div id="my_camera2" class="border border-dark"></div>
                        <div id="result"></div>
                    </div>
                </div>
                <form action="{{ route('user.absensi') }}" method="post">
                    @csrf
                    <input type="hidden" name="image" class="image-absen">
                    <input type="hidden" name="absen" value="pulang">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    onclick="closeWebcam()">Close</button>
                <button type="submit" class="btn btn-primary" onclick="take_snapshot()">Pulang</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
<script>
function webcam(absen) {
    Webcam.set({
        width: 320,
        height: 240,
        image_format: 'png',
        jpeg_quality: 90
    });

    if (absen == 'masuk') {
        Webcam.attach('#my_camera');
    } else {
        Webcam.attach('#my_camera2');
    }
}

function closeWebcam() {
    Webcam.reset();
}

function take_snapshot() {
    // take snapshot and get image data
    $('#my_camera').hide();
    Webcam.snap(function(data_uri) {
        // display results in page
        $(".image-absen").val(data_uri);
        document.getElementById('result').innerHTML =
            '<img id="imageWebcam" src="' + data_uri + '"/>';
    });
    closeWebcam();
    $('#my_camera').show();
}

$(document).ready(function() {
    function refresh() {
        $('#time').load("{{ route('time') }}");
    }

    setInterval(function() {
        refresh();
    }, 1000);
});
</script>
@endpush