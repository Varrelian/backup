@extends('layouts.app')
@section('content')
<div class="container mt-4 mb-5">
<div class="card shadow border-0">
<div class="card-header bg-warning fw-bold">Edit Data Acara</div>
<div class="card-body">
<form action="/event/{{ $event->id }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
{{-- Input Relasi Kategori (Materi P7) --}}
<div class="mb-3">
<label class="form-label fw-bold">Kategori Acara</label>
<select name="category_id" class="form-control" required>
@foreach($categories as $category)
<option value="{{ $category->id }}" {{ $event->category_id == $category->id ? 'selected'
: '' }}>
{{ $category->name }}
</option>
@endforeach
</select>
</div>
<div class="mb-3">
<label class="form-label fw-bold">Judul Acara</label>
<input type="text" class="form-control" name="title" value="{{ $event->title }}" required>
</div>
{{-- Input Data Lainnya (Tanggal, Lokasi, Kuota) --}}
<div class="row mb-3">
<div class="col-md-4">
<label class="form-label fw-bold">Tanggal</label>
<input type="date" name="event_date" class="form-control" value="{{ $event->event_date
}}" required>

</div>
<div class="col-md-4">
<label class="form-label fw-bold">Lokasi</label>
<input type="text" name="location" class="form-control" value="{{ $event->location }}"
required>
</div>
<div class="col-md-4">
<label class="form-label fw-bold">Kuota</label>
<input type="number" name="quota" class="form-control" value="{{ $event->quota }}"
required>
</div>
</div>
<div class="mb-3">
<label class="form-label fw-bold">Deskripsi</label>
<textarea name="description" class="form-control" rows="3" required>{{ $event->description
}}</textarea>
</div>
{{-- Input Media --}}
<div class="mb-3">
<label class="form-label fw-bold">Poster Saat Ini (Abaikan jika tidak diganti)</label>
<div class="mb-2">
@if($event->poster)
<img src="{{ asset('storage/' . $event->poster) }}" class="img-preview img-fluid d-block
rounded border" style="max-height: 250px;">
@else
<img class="img-preview img-fluid rounded" style="display: none; max-height: 250px;">
@endif
</div>
<input type="file" class="form-control" id="poster" name="poster" accept="image/*"
onchange="previewImage()">
</div>
<button type="submit" class="btn btn-warning">Update Data Acara</button>
</form>
</div>
</div>
</div>
<script>
function previewImage() {
const image = document.querySelector('#poster');
const imgPreview = document.querySelector('.img-preview');
imgPreview.style.display = 'block';
const oFReader = new FileReader();
oFReader.readAsDataURL(image.files[0]);

oFReader.onload = function(oFREvent) { imgPreview.src = oFREvent.target.result; }
}
</script>
@endsection