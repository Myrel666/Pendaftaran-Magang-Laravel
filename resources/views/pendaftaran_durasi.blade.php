@extends('layouts.landing')

@section('content')
<main id="main">
    <img src="{{ asset('assets/img/1325-scaled 1.png') }}" alt="" class="img-fluid" style="margin-top: 70px;">

    <section class="inner-page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <h2 class="fw-bold mb-5">Durasi Magang</h2>
                    <div class="container">

                        <div class="row justify-content-center">
    
                            <div class="col-md-2 me-md-5 mb-4 opacity-50 border border-primary rounded text-center pt-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="fw-bold fs-5">1 Bulan</p>
                                    <p class="fs-6">Ditutup</p>
                                </div>
                            </div>
                            <div class="col-md-2 me-md-5 mb-4 border border-primary rounded text-center pt-3 shadow-md">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="fw-bold fs-5">3 Bulan</p>
                                    <a href="{{ route('guest.pendaftaran.divisi', $user) }}" class="text-dark"><p class="fs-6"> Dibuka <i class="bi bi-chevron-right text-primary"></i></p></a>
                                </div>
                            </div>
                            <div class="col-md-2 me-md-5 mb-4 opacity-50 border border-primary rounded text-center pt-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="fw-bold fs-5">6 Bulan</p>
                                    <p class="fs-6">Ditutup</p>
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