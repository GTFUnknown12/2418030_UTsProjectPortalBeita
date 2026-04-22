@extends('admin.dashboard')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<style>
    /* Paksa warna agar tidak nabrak AdminLTE */
    .note-editor.note-frame { background: white !important; border: 1px solid #ced4da !important; }
    .note-editable { background: white !important; min-height: 300px !important; color: black !important; }
</style>
@endpush

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-primary text-white">
        <h3 class="mb-0 h5">Buat Postingan Baru</h3>
    </div>
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
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="fw-bold">Isi Berita</label>
                <textarea id="summernote_editor" name="content"></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Tanggal Publish</label>
                    <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Upload Gambar Utama</label>
                    <input type="file" name="image" class="form-control" accept="image/jpeg, image/png" required>
                </div>
            </div>

            <hr>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.news.index') }}" class="btn btn-secondary px-4">Kembali</a>
                <button type="submit" class="btn btn-success px-5">Terbitkan Berita</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script>
    $(document).ready(function() {
        console.log("Memulai Summernote...");
        
        $('#summernote_editor').summernote({
            placeholder: 'Tulis berita di sini...',
            tabsize: 2,
            height: 400,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear', 'italic']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });
    });
</script>
@endpush