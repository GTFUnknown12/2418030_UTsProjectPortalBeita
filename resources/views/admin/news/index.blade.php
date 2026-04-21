@extends('admin.dashboard')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center w-100">
        <h3 class="mb-0">Daftar Semua Berita</h3>
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary btn-sm ms-auto">
            <i class="bi bi-plus-lg"></i> Tambah Berita Baru
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th width="180px">Aksi</th> 
                    </tr>
                </thead>
                <tbody>
                    @forelse($news as $item)
                    <tr>
                        <td><img src="{{ asset('storage/'.$item->image) }}" width="80" class="rounded"></td>
                        <td class="fw-bold">{{ $item->title }}</td>
                        <td><span class="badge bg-info text-dark">{{ $item->category->name }}</span></td>
                        <td>{{ $item->date }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>

                                <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus berita ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-4">Belum ada berita.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection