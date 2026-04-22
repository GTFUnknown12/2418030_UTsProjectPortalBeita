@extends('admin.dashboard')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Berita Terbaru di Dashboard</h2>
    <div class="row">
        @forelse($news as $item)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <img src="{{ asset('storage/'.$item->image) }}" class="card-img-top" style="height: 180px; object-fit: cover;">
                <div class="card-body">
                    <span class="badge bg-warning text-dark mb-2">{{ $item->category->name }}</span>
                    <h5 class="card-title">{{ $item->title }}</h5>
                    <p class="text-muted small">{{ $item->date }}</p>
                    
                    <div class="card-text">
                        {!! \Illuminate\Support\Str::limit(strip_tags($item->content), 70) !!}
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted">Belum ada berita. Silakan buat berita pertama kamu!</p>
        </div>
        @endforelse
    </div>
</div>
@endsection