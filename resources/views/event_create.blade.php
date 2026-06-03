@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Formulir Tambah Acara Baru</h5>
        </div>
        <div class="card-body p-4">
            {{-- MODIFIKASI 1: Tambahkan enctype untuk izin pengiriman file biner --}}
            <form action="/event/store" method="POST" enctype="multipart/form-data">
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
                    <input type="text" name="title" class="form-control" placeholder="Contoh: Pensi Akhir Tahun" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Tanggal Acara</label>
                        <input type="date" name="event_date" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Lokasi Acara</label>
                        <input type="text" name="location" class="form-control" placeholder="Contoh: Lapangan Utama" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Kuota Peserta</label>
                    <input type="number" name="quota" class="form-control" placeholder="Contoh: 100" required>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Deskripsi Acara</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Tuliskan detail acara di sini..." required></textarea>
                </div>

                {{-- MODIFIKASI 2: Tambahkan Input File & Wadah Preview (Cermin Ajaib) --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Poster Acara (Maks. 2MB)</label>

                    {{-- Tempat penampung gambar sementara --}}
                    <img class="img-preview img-fluid mb-2 rounded shadow-sm border" style="display: none; max-height: 250px;">

                    {{-- Atribut onchange memicu JavaScript saat pengguna memilih file --}}
                    <input type="file" class="form-control" id="poster" name="poster" accept="image/*" onchange="previewImage()">
                </div>

                <hr>
                <button type="submit" class="btn btn-primary btn-lg w-100">Simpan Data Acara</button>
            </form>
        </div>
    </div>
</div>

{{-- Tambahan Fungsi JavaScript untuk Fitur Pratinjau Gambar --}}
<script>
function previewImage() {
    const image = document.querySelector('#poster');
    const imgPreview = document.querySelector('.img-preview');

    imgPreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(oFREvent) {
        imgPreview.src = oFREvent.target.result;
    }
}
</script>
@endsection