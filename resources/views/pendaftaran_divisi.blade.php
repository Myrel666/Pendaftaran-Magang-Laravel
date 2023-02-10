@extends('layouts.landing')

@section('content')
<main id="main">
    <img src="{{ asset('assets/img/Divisi.png') }}" alt="" class="img-fluid" width="100%" style="margin-top: 70px;">

    <section class="inner-page">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md">

                            <div class="col-md-12 mb-5">
                                <form action="{{ route('guest.cari.divisi', [$user, $durasi]) }}">
                                    <input type="text" class="form-control" placeholder="Search..." name="search">
                                </form>
                            </div>
                            @foreach($divisi as $dvs)
                            <div class="col-md-12 mb-4 border border-primary rounded pt-3 px-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="fw-bold fs-5 w-75 text-capitalize">divisi {{ $dvs->nama_divisi }}</p>
                                    <a href="{{ route('guest.pendaftaran', [$dvs->id, $user, $durasi]) }}" class="text-dark">
                                        <p class="fs-6"> Daftar <i class="bi bi-chevron-right text-primary"></i></p>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->
@endsection