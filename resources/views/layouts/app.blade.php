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

    <!-- Marquee berjalan seperti contoh -->
    <div class="custom-marquee-bar" style="background:#f8e1ff; overflow:hidden; white-space:nowrap;">
        <div class="custom-marquee-inner" style="display:flex; align-items:center; width:max-content;">
            @for($i=0; $i<10; $i++)
                <span style="color:#a020f0; font-weight:bold; font-size:1.1rem; margin-right:32px; display:inline-block;">
                    Twin Glow Salon & Spa 😊 Salon dan Spa langganan mahasiswa/i favoritmu
                </span>
            @endfor
        </div>
    </div>
    <script>
        // Marquee berjalan seperti contoh
        document.addEventListener('DOMContentLoaded', function() {
            const marquee = document.querySelector('.custom-marquee-inner');
            const bar = document.querySelector('.custom-marquee-bar');
            if (marquee && bar) {
                let pos = 0;
                function animate() {
                    pos -= 1;
                    if (Math.abs(pos) >= marquee.offsetWidth/2) pos = 0;
                    marquee.style.transform = `translateX(${pos}px)`;
                    requestAnimationFrame(animate);
                }
                animate();
            }
        });
    </script>

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
</body>
</html> 