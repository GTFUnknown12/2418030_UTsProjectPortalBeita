@extends('admin.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">Tambah Kategori Baru</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="name" class="form-control" placeholder="Ketik nama kategori di sini (contoh: Politik)..." required>
                            <button type="submit" class="btn btn-success px-4">Simpan Kategori</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12 mb-5">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-secondary text-white">
                    <h3 class="card-title mb-0">Daftar Kategori</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 50px" class="text-center">No</th>
                                <th>Nama Kategori</th>
                                <th>Slug</th>
                                <th style="width: 180px" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $cat)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="fw-bold">{{ $cat->name }}</td>
                                <td><code>{{ $cat->slug }}</code></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $cat->id }}">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </button>

                                        <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="editModal{{ $cat->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-warning text-dark">
                                            <h5 class="modal-title" id="editModalLabel">Edit Nama Kategori</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.categories.update', $cat->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body text-start">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Nama Kategori</label>
                                                    <input type="text" name="name" class="form-control" value="{{ $cat->name }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Belum ada kategori. Ayo ketik di atas!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <hr class="my-5">

        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white">
                    <h3 class="card-title mb-0">Daftar Berita Terkini</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 50px">No</th>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($news as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" width="60" class="rounded border">
                                    @else
                                        <span class="badge bg-light text-dark border">No Image</span>
                                    @endif
                                </td>
                                <td class="fw-bold">{{ $item->title }}</td>
                                <td><span class="badge bg-info text-dark">{{ $item->category->name }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection