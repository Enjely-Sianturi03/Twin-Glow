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

    <!-- Add SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        .custom-marquee-container {
            position: relative;
            width: 100%;
            z-index: 50;

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
<<<<<<< HEAD
            padding-left: 100%;
=======
>>>>>>> 3799c54a3c97b35b2f9da2befb533d90b73f1992
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
<<<<<<< HEAD
            0% { transform: translateX(0); }
=======
            0% { transform: translateX(100%); }
>>>>>>> 3799c54a3c97b35b2f9da2befb533d90b73f1992
            100% { transform: translateX(-100%); }
        }

        @media (max-width: 768px) {
            .custom-marquee-container {
<<<<<<< HEAD
=======
                top: 70px;
>>>>>>> 3799c54a3c97b35b2f9da2befb533d90b73f1992
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
<<<<<<< HEAD

        header {
            position: relative;
            width: 100%;
            z-index: 40;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        main {
            position: relative;
            z-index: 30;
        }

        .animated {
            animation-duration: 0.5s;
            animation-fill-mode: both;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translate3d(0, -20px, 0);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }

        .fadeInDown {
            animation-name: fadeInDown;
        }

        /* Custom SweetAlert2 Styling */
        .swal2-popup {
            border-radius: 15px !important;
            padding: 1.5rem !important;
        }

        .swal2-title {
            color: #333 !important;
            font-size: 1.5rem !important;
        }

        .swal2-icon {
            border: none !important;
            margin-top: 0 !important;
        }

        .swal2-success-circular-line-left,
        .swal2-success-circular-line-right,
        .swal2-success-fix {
            background-color: transparent !important;
        }
=======
        main {
            position: relative;
            z-index: 100;
            margin-top: 160px;
            background: white;
            padding-top: 20px;
            min-height: calc(100vh - 160px);
        }

>>>>>>> 3799c54a3c97b35b2f9da2befb533d90b73f1992
    </style>
</head>
<body>
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
    <main style="margin-top: 40px;">
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
<<<<<<< HEAD

    <!-- Add SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('testimonial_success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('testimonial_success') }}',
            showConfirmButton: false,
            timer: 2000,
            customClass: {
                popup: 'animated fadeInDown'
            }
        });
    </script>
    @endif

    <script>
        // Mobile menu toggle
        document.getElementById('mobileToggle').addEventListener('click', function() {
            document.querySelector('nav').classList.toggle('active');
        });

        // Display SweetAlert notifications if there are any flash messages
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top',
                customClass: {
                    popup: 'animated fadeInDown'
                }
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top',
                customClass: {
                    popup: 'animated fadeInDown'
                }
            });
        @endif
    </script>
=======
>>>>>>> 3799c54a3c97b35b2f9da2befb533d90b73f1992
</body>
</html> 