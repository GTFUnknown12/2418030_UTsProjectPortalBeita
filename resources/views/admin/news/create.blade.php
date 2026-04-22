@extends('admin.dashboard')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

<style>
    /* Styling tambahan agar menyatu dengan tema profesional putih Anda */
    .note-editor.note-frame {
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        background-color: #fff;
    }
    .note-toolbar {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }
</style>

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
                    @forelse($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @empty
                        <option disabled>Kategori masih kosong! Isi di menu Kategori dulu.</option>
                    @endforelse
                </select>
            </div>

            <div class="mb-3">
                <label class="fw-bold">Isi Berita</label>
                <textarea id="summernote" name="content" class="form-control" required></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Tanggal Publish</label>
                    <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Upload Gambar Utama</label>
                    <input type="file" name="image" class="form-control" accept="image/*" required>
                    <small class="text-muted">Format: JPG, PNG, WEBP (Maks. 2MB)</small>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Tulis berita lengkap Anda di sini...',
            tabsize: 2,
            height: 400, // Ukuran lebih tinggi agar enak menulis
            lang: 'id-ID', // Set bahasa jika perlu
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear', 'italic']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            callbacks: {
                // Menghapus tag script otomatis untuk keamanan
                onChange: function(contents, $editable) {
                    if (contents.includes('<script>')) {
                        $(this).summernote('code', contents.replace(/<script\b[^>]*>([\s\S]*?)<\/script>/gim, ""));
                        alert("Script injection dilarang!");
                    }
                }
            }
        });

        // Menghilangkan bug padding pada toolbar summernote di beberapa template
        $('.note-editable').css('background', 'white');
    });
</script>
@endsection