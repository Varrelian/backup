@extends('layouts.app')

@section('title', 'Manajemen Acara')

@section('content')
<div class="container mt-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary">Manajemen Data Acara</h3>
        <a href="/event/create" class="btn btn-success shadow-sm">
            + Tambah Acara Baru
        </a>
    </div>

    {{-- Menampilkan Notifikasi Sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark text-center">
                        <tr>
                            <th width="5%" class="py-3">No</th>
                            <th width="10%" class="py-3">Poster</th>
                            <th class="text-start py-3">Judul Acara</th>
                            <th class="py-3">Kategori</th>
                            <th class="py-3">Tanggal & Lokasi</th>
                            <th class="py-3">Kuota</th>
                            <th width="15%" class="py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $event)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                
                                {{-- Kolom Poster --}}
                                <td class="text-center">
                                    @if($event->poster)
                                        <img src="{{ asset('storage/' . $event->poster) }}" width="60" class="rounded shadow-sm">
                                    @else
                                        <span class="badge bg-secondary">Tanpa Poster</span>
                                    @endif
                                </td>

                                <td class="fw-bold text-start">{{ $event->title }}</td>
                                
                                {{-- [PEMANGGILAN RELASI] Menerjemahkan ID menjadi Nama Kategori --}}
                                <td class="text-center">
                                    <span class="badge bg-primary">
                                        {{ $event->category->name }}
                                    </span>
                                </td>
                                
                                <td class="text-center">
                                    <small class="d-block fw-bold">
                                        {{ date('d M Y', strtotime($event->event_date)) }}
                                    </small>
                                    <small class="text-muted">{{ $event->location }}</small>
                                </td>
                                
                                <td class="text-center">
                                    <span class="badge bg-warning text-dark">{{ $event->quota }} Orang</span>
                                </td>

                                {{-- Kolom Aksi --}}
                                <td class="text-center">
                                    <a href="/event/{{ $event->id }}/edit" class="btn btn-warning btn-sm shadow-sm">Edit</a>
                                    <form action="/event/{{ $event->id }}" method="POST" class="d-inline" onsubmit="return confirm('Peringatan: File gambar posternya juga akan dihancurkan. Lanjutkan?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm shadow-sm">Hapus</button>
                                    </form>
                                </td> 
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted fw-bold">
                                    Belum ada data acara yang terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection