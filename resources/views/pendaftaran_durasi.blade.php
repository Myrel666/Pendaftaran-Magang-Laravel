@extends('layouts.landing')

@section('content')
<main id="main">
    <img src="{{ asset('assets/img/Durasi.png') }}" alt="" class="img-fluid" width="100%" style="margin-top: 70px;">

    <section class="inner-page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <h2 class="fw-bold mb-5">Durasi Magang</h2>
                    <div class="container">

                        <div class="row justify-content-center">
                            @foreach($durasi as $waktu)
                            <div
                                class="col-md-2 me-md-5 mb-4 {{ $waktu->status == 0 ? 'opacity-50' : '' }} border border-primary rounded text-center pt-3 shadow-md">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="fw-bold fs-5 text-capitalize">{{ $waktu->waktu_durasi }}</p>
                                    @if($waktu->status == 1)
                                    <a href="{{ route('guest.pendaftaran.divisi', [$user, $waktu->id]) }}" class="text-dark">
                                        <p class="fs-6"> Dibuka <i class="bi bi-chevron-right text-primary"></i></p>
                                    </a>
                                    @else
                                    <p class="fs-6">Ditutup</p>
                                    @endif
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