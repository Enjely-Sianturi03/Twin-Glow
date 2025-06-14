<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twin Glow - Layanan Kecantikan Terbaik</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        .custom-marquee-container {
            position: fixed;
            top: 80px;
            left: 0;
            width: 100%;
/* <<<<<<< HEAD
            z-index: 99;
======= */
            z-index: 999;
            background: rgba(255, 92, 166, 0.2);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            padding: 10px 0;
            box-shadow: 0 2px 10px rgba(255, 92, 166, 0.15);
        }

        .custom-marquee-bar {
            overflow: hidden;
            white-space: nowrap;
            position: relative;
        }

        .custom-marquee-inner {
            display: inline-flex;
            align-items: center;
            animation: marquee 30s linear infinite;
        }

        .custom-marquee-item {
            color: #d4004f;
            font-weight: 600;
            font-size: 1.15rem;
            margin-right: 40px;
            display: inline-flex;
            align-items: center;
            text-shadow: 1px 1px 0 #fff, 
                        -1px -1px 0 #fff,
                        1px -1px 0 #fff,
                        -1px 1px 0 #fff;
            letter-spacing: 0.3px;
        }

        .custom-marquee-item i {
            margin-right: 10px;
            font-size: 1.25rem;
            color: #ff5ca6;
            filter: drop-shadow(1px 1px 0 white);
        }

        @keyframes marquee {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }

        @media (max-width: 768px) {
            .custom-marquee-container {
                top: 70px;
                background: rgba(255, 92, 166, 0.25);
            }
            .custom-marquee-item {
                font-size: 1rem;
                margin-right: 30px;
            }
            .custom-marquee-item i {
                font-size: 1.1rem;
            }
        }

        main {
            position: relative;
            z-index: 100;
            margin-top: 160px;
            background: white;
            padding-top: 20px;
            min-height: calc(100vh - 160px);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container header-container">
            <a href="/" class="logo">Twin<span>Glow</span></a>
            <button class="mobile-toggle" id="mobileToggle">
                <i class="fas fa-bars"></i>
            </button>
            <x-navbar></x-navbar>
        </div>
    </header>

    <!-- Marquee berjalan yang unik -->
    <div class="custom-marquee-container">
        <div class="custom-marquee-bar">
            <div class="custom-marquee-inner">
                <span class="custom-marquee-item">
                    <i class="fas fa-star"></i>
                    Twin Glow Salon & Spa 😊 Salon dan Spa langganan mahasiswa/i favoritmu
                </span>
                <span class="custom-marquee-item">
                    <i class="fas fa-gift"></i>
                    Dapatkan Diskon 20% untuk Booking Online!
                </span>
                <span class="custom-marquee-item">
                    <i class="fas fa-clock"></i>
                    Buka Setiap Hari - Senin-Jumat: 09:00-19:00, Sabtu: 09:00-18:00, Minggu: 10:00-16:00
                </span>
                <span class="custom-marquee-item">
                    <i class="fas fa-phone"></i>
                    Hubungi Kami: +62 812-3456-789
                </span>
                <span class="custom-marquee-item">
                    <i class="fas fa-map-marker-alt"></i>
                    Jl. Dr.Manshyur No. 224, Padang Bulan, Medan
                </span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} Twin Glow. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom Scripts -->
    @stack('scripts')

    <!-- Custom JS -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
