@extends('layouts.app') @section('title', 'Edit Kategori')
@section('content')
<div class="container mt-4">
<div class="card shadow border-warning">
<div class="card-header bg-warning text-dark fw-bold">
Edit Kategori Acara
</div>
<div class="card-body p-4">
<form action="/kategori/{{ $category->id }}" method="POST">
@csrf
@method('PUT') <div class="mb-3">
<label class="fw-bold text-primary mb-1">Nama Kategori</label>

<input type="text" name="name" class="form-control" value="{{ $category-
>name }}" required>
</div>
<div class="mb-4">
<label class="fw-bold text-primary mb-1">URL Slug</label>
<input type="text" name="slug" class="form-control" value="{{ $category-
>slug }}" required>
</div>
<hr>
<div class="d-flex justify-content-between">
<a href="/dashboard" class="btn btn-secondary px-4">Batal</a>

<button type="submit" class="btn btn-warning text-dark fw-bold px-
4">Simpan Perubahan</button>

</div>
</form>
</div>
</div>
</div>
@endsection