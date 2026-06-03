@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
<h5 class="mb-0">Formulir Tambah Acara Baru</h5>
</div>
<div class="card-body p-4">
<form action="/event/store" method="POST">
@csrf
<div class="mb-3">
<label class="fw-bold">Pilih Kategori Acara</label>
<select name="category_id" class="form-control" required>
<option value="">-- Silakan Pilih --</option>
{{-- Looping kategori dari Database --}}
@foreach($categories as $category)
<option value="{{ $category->id }}">{{ $category->name }}</option>
@endforeach
</select>
</div>
<div class="mb-3">
<label class="fw-bold">Judul Acara</label>
<input type="text" name="title" class="form-control" placeholder="Contoh:
Pensi Akhir Tahun" required>
</div>
<div class="row">
<div class="col-md-6 mb-3">
<label class="fw-bold">Tanggal Acara</label>
<input type="date" name="event_date" class="form-control" required>
</div>
<div class="col-md-6 mb-3">
<label class="fw-bold">Lokasi Acara</label>

<input type="text" name="location" class="form-control"
placeholder="Contoh: Lapangan Utama" required>
</div>
</div>
<div class="mb-3">
<label class="fw-bold">Kuota Peserta</label>
<input type="number" name="quota" class="form-control"
placeholder="Contoh: 100" required>
</div>
<div class="mb-3">
<label class="fw-bold">Deskripsi Acara</label>
<textarea name="description" class="form-control" rows="4"
placeholder="Tuliskan detail acara di sini..." required></textarea>
</div>
<hr>
<button type="submit" class="btn btn-primary btn-lg w-100">Simpan Data
Acara</button>
</form>
</div>
</div>
</div>
@endsection