@extends('admin.dashboard')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-primary text-white"><h3>Buat Postingan Baru</h3></div>
    <div class="card-body">
        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="fw-bold">Judul Berita</label>
                <input type="text" name="title" class="form-control" placeholder="Masukkan judul..." required>
            </div>
            <div class="mb-3">
                <label class="fw-bold">Pilih Kategori</label>
                <select name="category_id" class="form-select" required>
                    @forelse($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @empty
                        <option disabled>Kategori masih kosong! Isi di menu Kategori dulu.</option>
                    @endforelse
                </select>
            </div>
            <div class="mb-3">
                <label class="fw-bold">Isi Berita</label>
                <textarea name="content" class="form-control" rows="6" placeholder="Tulis berita lengkap..." required></textarea>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Tanggal Publish</label>
                    <input type="date" name="date" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Upload Gambar</label>
                    <input type="file" name="image" class="form-control" required>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-success px-5">Terbitkan Berita</button>
            </div>
        </form>
    </div>
</div>
@endsection