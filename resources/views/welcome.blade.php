@extends('layouts.app')

@section('content')
{{-- Spanduk Utama (Hero Section) --}}
<div class="bg-primary text-white py-5 mb-5 shadow-sm">
    <div class="container text-center py-4">
        <h1 class="display-4 fw-bold">Selamat Datang di SchoolEvent</h1>
        <p class="lead">Papan Informasi Acara dan Kegiatan Resmi Sekolah</p>
    </div>
</div>

<div class="container mb-5">
    <div class="row mb-4">
        <div class="col-12 border-bottom pb-2">
            <h3 class="fw-bold text-dark">Katalog Acara Terbaru</h3>
        </div>
    </div>

    {{-- Sistem Grid Pembungkus --}}
    <div class="row g-4">
        @forelse($events as $event)
            {{-- Pembagian Layar menjadi 3 kolom (12 dibagi 4) --}}
            <div class="col-md-4">
                {{-- Komponen Card --}}
                <div class="card h-100 shadow-sm border-0">
                    {{-- Pemanggilan Aset Brankas (Storage Link) --}}
                    @if($event->poster)
                        <img src="{{ asset('storage/' . $event->poster) }}" class="card-img-top" style="height: 250px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-secondary d-flex justify-content-center align-items-center text-white" style="height: 250px;">
                            <span>Tanpa Poster</span>
                        </div>
                    @endif

                    <div class="card-body d-flex flex-column">
                        <span class="badge bg-info text-dark mb-2 align-self-start">
                            {{ $event->category->name }}
                        </span>
                        <h5 class="card-title fw-bold text-dark">{{ $event->title }}</h5>
                        
                        <p class="card-text text-muted small mb-3">
                            <span class="fw-bold">Tgl:</span> {{ date('d M Y', strtotime($event->event_date)) }} <br>
                            <span class="fw-bold">Lokasi:</span> {{ $event->location }}
                        </p>
                        
                        <p class="card-text text-truncate text-muted mb-4">{{ $event->description }}</p>

                        {{-- Tombol Detail didorong ke posisi paling bawah --}}
                        <div class="mt-auto">
                            <a href="#" class="btn btn-outline-primary w-100 fw-bold shadow-sm">Lihat Detail Acara</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <h5 class="text-muted fw-bold">Belum ada acara yang dipublikasikan.</h5>
            </div>
        @endforelse
    </div>
</div>
@endsection