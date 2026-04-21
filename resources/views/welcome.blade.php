<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal berita CwnXtech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">
    
    <style>
        /* Trik agar footer tidak terangkat */
        html, body {
            height: 100%;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            color: #2d3436;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 1.2rem 0;
        }
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 900;
            letter-spacing: 2px;
            color: #1a1a1a !important;
            text-transform: uppercase;
        }

        /* Typography */
        h2 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            position: relative;
            display: inline-block;
            margin-bottom: 2rem;
        }
        h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: #c0392b;
        }

        /* Card Customization */
        .news-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            background: #fff;
        }
        .news-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
        }
        .card-img-top {
            transition: transform 0.6s ease;
        }
        .news-card:hover .card-img-top {
            transform: scale(1.1);
        }
        .img-container {
            overflow: hidden;
            height: 220px;
        }

        /* Elements */
        .badge-category {
            background: rgba(192, 57, 43, 0.1);
            color: #c0392b;
            text-transform: uppercase;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 1px;
            padding: 5px 12px;
            border-radius: 50px;
        }
        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            line-height: 1.4;
            margin-top: 15px;
            color: #1a1a1a;
        }
        .date-text {
            font-size: 0.8rem;
            color: #95a5a6;
            text-transform: uppercase;
        }
        .read-more {
            font-size: 0.9rem;
            font-weight: 600;
            color: #c0392b;
            text-decoration: none;
            transition: 0.3s;
        }
        .read-more:hover {
            color: #1a1a1a;
        }

        /* Admin Login Button */
        .admin-login-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0;
            background: transparent;
            border: none;
            color: #2d3436;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .admin-login-btn:hover {
            color: #c0392b;
            transform: translateX(2px);
        }
        .admin-login-btn i {
            font-size: 1rem;
        }

        /* Footer khusus agar tetap di bawah */
        footer {
            margin-top: auto !important; 
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-light sticky-top mb-5">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="#">The Newsroom</a>
            <div class="d-flex align-items-center gap-4">
                <span class="text-muted small d-none d-md-block">{{ date('l, d F Y') }}</span>
                <a href="{{ route('auth.login') }}" class="admin-login-btn">
                    <i class="bi bi-shield-lock"></i>
                    Login admin
                </a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="row align-items-end mb-4">
            <div class="col-md-8">
                <h2>Berita Terbaru</h2>
            </div>
            <div class="col-md-4 text-md-end">
                <p class="text-muted small">Menampilkan berita terkurasi hari ini</p>
            </div>
        </div>

        <div class="row">
            @forelse($news as $item)
            <div class="col-md-4 mb-5">
                <div class="card h-100 news-card shadow-sm">
                    <div class="img-container">
                        <img src="{{ asset('storage/'.$item->image) }}" class="card-img-top" alt="{{ $item->title }}">
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge-category">{{ $item->category->name }}</span>
                            <span class="date-text">{{ \Carbon\Carbon::parse($item->date)->format('M d, Y') }}</span>
                        </div>
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text text-muted small mt-3">
                            {{ Str::limit(strip_tags($item->content), 100) }}
                        </p>
                        <hr class="my-3 opacity-25">
                        <a href="#" class="read-more">Baca Selengkapnya &rarr;</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-newspaper text-muted mb-3" style="font-size: 3rem;"></i>
                <p class="text-muted">Belum ada berita yang tersedia saat ini.</p>
            </div>
            @endforelse
        </div>
    </div>

    <footer class="py-5 bg-white border-top">
        <div class="container text-center">
            <p class="text-muted small">© {{ date('Y') }} CwnXtech News Portal. All Rights Reserved.</p>
        </div>
    </footer>

</body>
</html>