@extends('layouts.landing')

@section('content')
<main id="main">
    <img src="{{ asset('assets/img/1325-scaled 1.png') }}" alt="" class="img-fluid" style="margin-top: 70px;">

    <section class="inner-page">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md">

                            <div class="col-md-12 mb-5">
                                <form action="">
                                    <input type="text" class="form-control" placeholder="Search...">
                                </form>
                            </div>
                            <div class="col-md-12 mb-4 border border-primary rounded pt-3 px-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="fw-bold fs-5 w-75">Divisi Sumber Daya Manusia (SDM)</p>
                                    <a href="{{ route('guest.pendaftaran', ['divisi-sumber-daya-manusia', $user]) }}" class="text-dark">
                                        <p class="fs-6"> Daftar <i class="bi bi-chevron-right text-primary"></i></p>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4 border border-primary rounded pt-3 px-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="fw-bold fs-5 w-75">Divisi Komersial</p>
                                    <a href="{{ route('guest.pendaftaran', ['divisi-komersial', $user]) }}" class="text-dark">
                                        <p class="fs-6"> Daftar <i class="bi bi-chevron-right text-primary"></i></p>
                                    </a>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->
@endsection