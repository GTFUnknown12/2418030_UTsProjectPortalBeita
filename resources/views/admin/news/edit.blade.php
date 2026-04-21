@extends('admin.dashboard')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-dark text-white">
        <h3 class="mb-0">Edit Berita</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- PENTING: Laravel butuh ini untuk proses update --}}

            <div class="mb-3">
                <label class="form-label">Judul Berita</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $news->title) }}" required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-select" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected($cat->id == $news->category_id)>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="date" class="form-control" value="{{ old('date', $news->date) }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Konten</label>
                <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="5" required>{{ old('content', $news->content) }}</textarea>
                @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar (Kosongkan jika tidak ingin diganti)</label>
                <div class="mb-2">
                    <small class="text-muted">Gambar saat ini:</small><br>
                    <img src="{{ asset('storage/'.$news->image) }}" width="150" class="rounded border">
                </div>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection