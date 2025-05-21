<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twin Glow - Layanan Kecantikan Terbaik</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container header-container">
            <a href="#" class="logo">Twin<span>Glow</span></a>
            <button class="mobile-toggle" id="mobileToggle">
                <i class="fas fa-bars"></i>
            </button>
            <x-navbar></x-navbar>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Temukan Kecantikan Sejatimu</h1>
            <p>Twin Glow menawarkan layanan kecantikan premium dengan harga terjangkau. Jadwalkan kunjungan Anda sekarang!</p>
            <a href="#booking" class="btn">Booking Sekarang</a>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services" id="services">
        <div class="container">
            <div class="section-title">
                <h2>Layanan Kami</h2>
            </div>
            <div class="services-grid">
                <!-- Service 1 -->
                <div class="service-card">
                    <div class="service-image">
                        <img src="image/hairstyling.jpg" alt="Haircut & Styling" style="width:100%; height:100%; object-fit:cover;">
                    </div>
                    <div class="service-content">
                        <h3>Potong & Styling Rambut</h3>
                        <p>Potong rambut profesional dan styling sesuai dengan bentuk wajah dan keinginan Anda.</p>
                        <div class="service-price">Mulai Rp 150.000</div>
                        <a href="#booking" class="btn">Booking</a>
                    </div>
                </div>
                
                <!-- Service 2 -->
                <div class="service-card">
                    <div class="service-image">
                        <img src="image/haircolour.jpg" alt="Hair Coloring" style="width:100%; height:100%; object-fit:cover;">
                    </div>
                    <div class="service-content">
                        <h3>Pewarnaan Rambut</h3>
                        <p>Pewarnaan rambut dengan produk premium dan teknik terbaru untuk hasil maksimal.</p>
                        <div class="service-price">Mulai Rp 350.000</div>
                        <a href="#booking" class="btn">Booking</a>
                    </div>
                </div>
                
                <!-- Service 3 -->
                <div class="service-card">
                    <div class="service-image">
                        <img src="image/facial treatment.jpg" alt="Facial Treatment" style="width:100%; height:100%; object-fit:cover;">
                    </div>
                    <div class="service-content">
                        <h3>Perawatan Wajah</h3>
                        <p>Perawatan wajah lengkap untuk kulit bersih, sehat, dan bercahaya.</p>
                        <div class="service-price">Mulai Rp 250.000</div>
                        <a href="#booking" class="btn">Booking</a>
                    </div>
                </div>
                
                <!-- Service 4 -->
                <div class="service-card">
                    <div class="service-image">
                        <img src="image/nailart - Copy.jpg" alt="Nail Art" style="width:100%; height:100%; object-fit:cover;">
                    </div>
                    <div class="service-content">
                        <h3>Nail Art & Manicure</h3>
                        <p>Perawatan kuku dan nail art dengan berbagai desain pilihan.</p>
                        <div class="service-price">Mulai Rp 120.000</div>
                        <a href="#booking" class="btn">Booking</a>
                    </div>
                </div>
                
                <!-- Service 5 -->
                <div class="service-card">
                    <div class="service-image">
                        <img src="image/bodyMassage.jpg" alt="Body Massage" style="width:100%; height:100%; object-fit:cover;">
                    </div>
                    <div class="service-content">
                        <h3>Body Massage</h3>
                        <p>Pijat relaksasi untuk meredakan stres dan menyegarkan tubuh.</p>
                        <div class="service-price">Mulai Rp 300.000</div>
                        <a href="#booking" class="btn">Booking</a>
                    </div>
                </div>
                
                <!-- Service 6 -->
                <div class="service-card">
                    <div class="service-image">
                        <img src="image/makeup profesional.jpg" alt="Makeup" style="width:100%; height:100%; object-fit:cover;">
                    </div>
                    <div class="service-content">
                        <h3>Makeup Profesional</h3>
                        <p>Makeup untuk berbagai acara dengan produk premium dan hasil terbaik.</p>
                        <div class="service-price">Mulai Rp 400.000</div>
                        <a href="#booking" class="btn">Booking</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Section -->
    <section class="booking" id="booking">
        <div class="container">
            <div class="section-title">
                <h2>Booking Layanan</h2>
            </div>
            @if(session('success'))
                <div class="success-message" style="display: block;">
                    {{ session('success') }}
                </div>
            @endif
            @guest
                <div class="login-required-message">
                    <p>Silakan <a href="{{ route('login') }}">login</a> terlebih dahulu untuk melakukan booking.</p>
                </div>
            @else
                <div class="booking-form">
                    <form id="appointmentForm" action="{{ route('booking.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-column">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" id="nama" name="nama" class="form-control" value="{{ Auth::user()->name }}" required>
                                    @error('nama')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-column">
                                <div class="form-group">
                                    <label for="no_tlp">Nomor Telepon</label>
                                    <input type="tel" id="no_tlp" name="no_tlp" class="form-control" value="{{ Auth::user()->no_tlp ?? '' }}" required>
                                    @error('no_tlp')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-column">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required>
                                    @error('email')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-column">
                                <div class="form-group">
                                    <label for="jenis_layanan">Pilih Layanan</label>
                                    <select id="jenis_layanan" name="jenis_layanan" class="form-control" required>
                                        <option value="">--Pilih Layanan--</option>
                                        <option value="haircut">Potong & Styling Rambut</option>
                                        <option value="coloring">Pewarnaan Rambut</option>
                                        <option value="facial">Perawatan Wajah</option>
                                        <option value="nails">Nail Art & Manicure</option>
                                        <option value="massage">Body Massage</option>
                                        <option value="makeup">Makeup Profesional</option>
                                    </select>
                                    @error('jenis_layanan')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-column">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" id="tanggal" name="tanggal" class="form-control" required>
                                    @error('tanggal')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-column">
                                <div class="form-group">
                                    <label for="waktu">Waktu</label>
                                    <select id="waktu" name="waktu" class="form-control" required>
                                        <option value="">--Pilih Waktu--</option>
                                        <option value="09:00">09:00</option>
                                        <option value="10:00">10:00</option>
                                        <option value="11:00">11:00</option>
                                        <option value="12:00">12:00</option>
                                        <option value="13:00">13:00</option>
                                        <option value="14:00">14:00</option>
                                        <option value="15:00">15:00</option>
                                        <option value="16:00">16:00</option>
                                        <option value="17:00">17:00</option>
                                        <option value="18:00">18:00</option>
                                    </select>
                                    @error('waktu')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="note">Catatan Tambahan</label>
                            <textarea id="note" name="note" class="form-control" rows="4"></textarea>
                            @error('note')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn" style="width: 100%;">Booking Sekarang</button>
                    </form>
                </div>
            @endguest
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <div class="section-title">
                <h2>Testimoni Pelanggan</h2>
            </div>
            <div class="testimonial-slider">
                <div class="testimonial-item">
                    <div class="testimonial-image">
                        <img src="/api/placeholder/100/100" alt="Testimonial 1" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
                    </div>
                    <p class="testimonial-text">"Saya sangat puas dengan layanan di Twin Glow. Hairstylist-nya sangat profesional dan hasilnya sesuai dengan keinginan saya. Pasti akan kembali lagi!"</p>
                    <h4 class="testimonial-author">Dewi Sartika</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery" id="gallery">
        <div class="container">
            <div class="section-title">
                <h2>Galeri</h2>
            </div>
            <div class="gallery-grid">
                <!-- Gallery Item 1 -->
                <div class="gallery-item">
                    <img src="image/galeri1.jpg" alt="Gallery 1" style="width:100%; height:100%; object-fit:cover;">
                </div>
                
                <!-- Gallery Item 2 -->
                <div class="gallery-item">
                    <img src="image/galeri2.jpg" alt="Gallery 2" style="width:100%; height:100%; object-fit:cover;">
                </div>
                
                <!-- Gallery Item 3 -->
                <div class="gallery-item">
                    <img src="image/galeri3.jpg" alt="Gallery 3" style="width:100%; height:100%; object-fit:cover;">
                </div>
                
                <!-- Gallery Item 4 -->
                <div class="gallery-item">
                    <img src="image/galeri4(1).jpg" alt="Gallery 4" style="width:100%; height:100%; object-fit:cover;">
                </div>
                
                <!-- Gallery Item 5 -->
                <div class="gallery-item">
                    <img src="image/galeri5.jpg" alt="Gallery 5" style="width:100%; height:100%; object-fit:cover;">
                </div>
                
                <!-- Gallery Item 6 -->
                <div class="gallery-item">
                    <img src="image/galeri6.jpg" alt="Gallery 6" style="width:100%; height:100%; object-fit:cover;">
                </div>
                
                <!-- Gallery Item 7 -->
                <div class="gallery-item">
                    <img src="image/galeri7.jpg" alt="Gallery 7" style="width:100%; height:100%; object-fit:cover;">
                </div>
                
                <!-- Gallery Item 8 -->
                <div class="gallery-item">
                    <img src="image/galeri8.jpg" alt="Gallery 8" style="width:100%; height:100%; object-fit:cover;">
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contact">
        <div class="container">
            <div class="section-title">
                <h2>Hubungi Kami</h2>
            </div>
            <div class="contact-container">
                <div class="contact-info">
                    <h3>Informasi Kontak</h3>
                    <div class="contact-details">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-text">
                                <p>Jl. Kecantikan No. 123, Jakarta Selatan, Indonesia</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-text">
                                <p>+62 21 1234 5678</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-text">
                                <p>info@TwinGlow.id</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="contact-text">
                                <p>Senin - Sabtu: 09:00 - 19:00<br>Minggu: 10:00 - 16:00</p>
                            </div>
                        </div>
                    </div>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="contact-form">
                    @if(session('success'))
                        <div class="success-message" style="display: block;">
                            {{ session('success') }}
                        </div>
                    @endif
                    @guest
                        <div class="login-required-message">
                            <p>Silakan <a href="{{ route('login') }}">login</a> terlebih dahulu untuk mengirim testimoni.</p>
                        </div>
                    @else
                        <form id="contactForm" action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" id="nama" name="nama" class="form-control" value="{{ Auth::user()->name }}" required>
                                @error('nama')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required>
                                @error('email')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="testimoni">Testimoni</label>
                                <textarea id="testimoni" name="testimoni" class="form-control" rows="4" required></textarea>
                                @error('testimoni')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <x-footer></x-footer>          
</body>
</html>