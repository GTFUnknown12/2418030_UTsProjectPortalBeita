@extends('admin.dashboard')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<style>
    /* Styling agar konsisten dengan AdminLTE 4 */
    .note-editor.note-frame { background: white !important; border: 1px solid #ced4da !important; }
    .note-editable { background: white !important; min-height: 350px !important; color: black !important; }
</style>
@endpush

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-dark text-white">
        <h3 class="mb-0 h5">Edit Berita</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="fw-bold">Judul Berita</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $news->title) }}" required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Kategori</label>
                    <select name="category_id" class="form-select" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected($cat->id == $news->category_id)>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Tanggal</label>
                    <input type="date" name="date" class="form-control" value="{{ old('date', $news->date) }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="fw-bold">Isi Berita</label>
                <textarea id="summernote_edit" name="content" class="form-control @error('content') is-invalid @enderror" required>{!! old('content', $news->content) !!}</textarea>
                @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="fw-bold">Upload Gambar Utama</label>
                <div class="mb-2 p-2 border rounded bg-light" style="width: fit-content;">
                    <small class="text-muted d-block mb-1">Gambar saat ini:</small>
                    <img src="{{ asset('storage/'.$news->image) }}" width="150" class="rounded shadow-sm">
                </div>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/jpeg, image/png">
                <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <hr>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.news.index') }}" class="btn btn-secondary px-4">Batal</a>
                <button type="submit" class="btn btn-primary px-5">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script>
    $(document).ready(function() {
        $('#summernote_edit').summernote({
            placeholder: 'Edit isi berita di sini...',
            tabsize: 2,
            height: 400,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear', 'italic']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });
    });
</script>
@endpush