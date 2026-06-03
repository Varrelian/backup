
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">
    {{-- Menangkap dan Menampilkan Notifikasi Sukses dari Controller --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-primary shadow-sm">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0 fw-bold">Panel Admin</h5>
        </div>
        
        <div class="card-body p-4">
            {{-- BAGIAN BARU: Judul dan Tiga Tombol Aksi Berjejer --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-primary fw-bold mb-0">Daftar Kategori Acara</h5>
                <div>
                    <a href="/events" class="btn btn-outline-primary btn-sm shadow-sm me-2">
                        Lihat Manajemen Acara
                    </a>
                    <a href="/dashboard/category/create" class="btn btn-success btn-sm shadow-sm me-2">
                        + Tambah Kategori
                    </a>
                    <a href="/event/create" class="btn btn-primary btn-sm shadow-sm">
                        + Tambah Acara
                    </a>
                </div>
            </div> 

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle mb-0">
                    <thead class="table-dark text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th class="text-start">Nama Kategori</th>
                            <th>URL Slug</th>
                            <th>Tanggal Dibuat</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="fw-bold text-primary">{{ $category->name }}</td>
                                <td class="text-center">
                                    <span class="badge bg-secondary">{{ $category->slug }}</span>
                                </td>
                                <td class="text-center">
                                    {{ date('d M Y', strtotime($category->created_at)) }}
                                </td>
                                <td class="text-center">
                                    <a href="/kategori/{{ $category->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                                    
                                    <form action="/kategori/{{ $category->id }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini secara permanen?');">
                                        @csrf
                                        @method('DELETE') 
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <p class="text-muted fw-bold mb-0">Belum ada Kategori terdaftar di gudang data.</p>
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

```