@extends('layouts.app')

@section('content')
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
                        <a href="#booking" class="btn btn-booking" data-service="haircut">Booking</a>
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
                        <a href="#booking" class="btn btn-booking" data-service="coloring">Booking</a>
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
                        <a href="#booking" class="btn btn-booking" data-service="facial">Booking</a>
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
                        <a href="#booking" class="btn btn-booking" data-service="nails">Booking</a>
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
                        <a href="#booking" class="btn btn-booking" data-service="massage">Booking</a>
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
                        <a href="#booking" class="btn btn-booking" data-service="makeup">Booking</a>
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
            @if(session('booking_success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('booking_success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                                    <input type="text" id="nama" name="nama" class="form-control" value="{{ Auth::user()->name }}" readonly style="background-color: #f8f9fa;">
                                    @error('nama')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-column">
                                <div class="form-group">
                                    <label for="no_tlp">Nomor Telepon</label>
                                    <input type="tel" id="no_tlp" name="no_tlp" class="form-control" value="{{ Auth::user()->no_tlp }}" readonly style="background-color: #f8f9fa;">
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
                                    <input type="email" id="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly style="background-color: #f8f9fa;">
                                    @error('email')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-column">
                                <div class="form-group">
                                    <label for="jenis_layanan">Jenis Layanan</label>
                                    <select id="jenis_layanan" name="jenis_layanan" class="form-control" required>
                                        <option value="">Pilih Layanan</option>
                                        <option value="haircut">Haircut</option>
                                        <option value="coloring">Coloring</option>
                                        <option value="facial">Facial</option>
                                        <option value="nails">Nails</option>
                                        <option value="massage">Massage</option>
                                        <option value="makeup">Makeup</option>
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
                                    <input type="date" id="tanggal" name="tanggal" class="form-control" required min="{{ date('Y-m-d') }}">
                                    @error('tanggal')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-column">
                                <div class="form-group">
                                    <label for="waktu">Waktu</label>
                                    <select id="waktu" name="waktu" class="form-control" required>
                                        <option value="">Pilih Waktu</option>
                                    </select>
                                    @error('waktu')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                    <small class="form-text text-muted" id="operationalHours"></small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="note">Catatan (Opsional)</label>
                            <textarea id="note" name="note" class="form-control" rows="3"></textarea>
                            @error('note')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Book Now</button>
                    </form>
                </div>
            @endguest
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials" id="testimonials">
        <div class="container" style="position:relative; z-index:2;">
            <div class="section-title">
                <h2 style="color:#fff; text-shadow:0 2px 8px #000;">Testimoni Pelanggan</h2>
            </div>
            <div class="testimonial-slider">
                @php
                    $testimonials = \App\Models\Testimonial::where('is_approved', true)->latest()->get();
                @endphp
                @forelse($testimonials as $testimonial)
                    <div class="testimonial-item" style="text-align:left; margin-bottom:32px;">
                        <div style="margin-bottom:8px; font-weight:600; display:flex; align-items:center; gap:10px;">
                            <span style="color:#ff5ca6;">{{ $testimonial->nama }}</span>
                            <span style="font-size:0.95em; color:#eee; font-weight:400;">({{ $testimonial->email }})</span>
                        </div>
                        <p class="testimonial-text" style="text-align:justify; margin-bottom:0; color:#fff; text-shadow:0 1px 6px #222; font-size:1.25rem; line-height:1.7;">{{ $testimonial->testimoni }}</p>
                    </div>
                @empty
                    <div class="testimonial-item">
                        <p class="testimonial-text" style="color:#fff;">Belum ada testimoni yang ditampilkan.</p>
                    </div>
                @endforelse
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
            <div class="row">
                <div class="col-md-6">
                    <div class="contact-info">
                        <h3>Informasi Kontak</h3>
                        <div class="contact-details">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="contact-text">
                                    <p>Jl. Dr.Manshyur No. 224, Padang Bulan, Medan 21414</p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="contact-text">
                                    <p>+62 812-3456-789</p>
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
                                    <p>Senin - Jumat: 09:00 - 19:00<br>Sabtu: 09:00 - 18:00 <br> Minggu: 10:00 - 16:00</p>
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
                </div>
                <div class="col-md-6">
                    <div class="contact-form">
                        @if(session('testimonial_success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('testimonial_success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
        </div>
    </section>

    <!-- Footer -->
    <x-footer></x-footer>
@endsection

@push('styles')
<style>
    .testimonial-item {
        background: #faf7ff;
        border-radius: 10px;
        padding: 24px 28px;
        box-shadow: 0 2px 8px rgba(160,32,240,0.04);
        margin-bottom: 24px;
    }
    .testimonial-text {
        font-style: normal;
        font-size: 1.08rem;
        line-height: 1.7;
    }
    @media (max-width: 600px) {
        .testimonial-item { padding: 16px 10px; }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const operationalHours = {
        'Minggu': { open: '10:00', close: '16:00' },
        'Senin': { open: '09:00', close: '19:00' },
        'Selasa': { open: '09:00', close: '19:00' },
        'Rabu': { open: '09:00', close: '19:00' },
        'Kamis': { open: '09:00', close: '19:00' },
        'Jumat': { open: '09:00', close: '19:00' },
        'Sabtu': { open: '09:00', close: '18:00' }
    };

    const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    const tanggalInput = document.getElementById('tanggal');
    const waktuInput = document.getElementById('waktu');
    const operationalHoursText = document.getElementById('operationalHours');

    function generateTimeOptions(openTime, closeTime, selectedDate) {
        // Clear existing options
        waktuInput.innerHTML = '<option value="">Pilih Waktu</option>';
        
        // Convert times to hours
        const start = parseInt(openTime.split(':')[0]);
        const end = parseInt(closeTime.split(':')[0]);
        
        // Get current date and time
        const now = new Date();
        const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
        const selectedDateTime = new Date(selectedDate);
        
        // Check if selected date is today
        const isToday = today.getTime() === selectedDateTime.getTime();
        const currentHour = now.getHours();
        
        // Generate options for each hour
        for (let hour = start; hour <= end; hour++) {
            // Skip past hours if it's today
            if (isToday && hour <= currentHour) {
                continue;
            }
            
            const timeString = hour.toString().padStart(2, '0') + ':00';
            const option = document.createElement('option');
            option.value = timeString;
            option.textContent = timeString;
            waktuInput.appendChild(option);
        }

        // If no options were added (all times have passed), show message
        if (waktuInput.options.length === 1) {
            const option = document.createElement('option');
            option.value = "";
            option.textContent = "Tidak ada jam tersedia untuk hari ini";
            option.disabled = true;
            waktuInput.appendChild(option);
        }
    }

    function updateOperationalHours() {
        const date = new Date(tanggalInput.value);
        if (date) {
            const dayName = days[date.getDay()];
            const hours = operationalHours[dayName];
            
            if (hours) {
                operationalHoursText.textContent = `Jam operasional: ${hours.open} - ${hours.close}`;
                generateTimeOptions(hours.open, hours.close, tanggalInput.value);
            }
        }
    }

    // Set minimum date to today
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const dd = String(today.getDate()).padStart(2, '0');
    tanggalInput.min = `${yyyy}-${mm}-${dd}`;

    tanggalInput.addEventListener('change', updateOperationalHours);
    updateOperationalHours();
});
</script>
@endpush