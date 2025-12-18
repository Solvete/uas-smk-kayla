<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'SMK Multicomp' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        .navbar-brand img {
            height: 50px;
            margin-right: 10px;
        }
        footer {
            background: #0d6efd;
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-top: 60px;
        }
    </style>
</head>
<body>

    {{-- 🔹 Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ asset('compiled/jpg/SMK_Multicomp_Logo.png') }}" alt="Logo Sekolah">
                <span class="fw-bold text-primary">SMK Multicomp</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto fw-semibold">
                    <li class="nav-item"><a href="{{ route('home') }}" class="nav-link text-primary">Beranda</a></li>
                    <li class="nav-item"><a href="#tentang" class="nav-link">Tentang</a></li>
                    <li class="nav-item"><a href="#visi" class="nav-link">Visi & Misi</a></li>
                    <li class="nav-item"><a href="{{ route('login') }}" class="btn btn-primary ms-3 px-3">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- 🔹 Konten Utama --}}
    <main>
        {{ $slot }}
    </main>

    {{-- 🔹 Footer --}}
    <footer>
        <div class="container">
            <p class="mb-0">© {{ date('Y') }} SMK Multicomp. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
