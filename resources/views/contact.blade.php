@extends('layouts.app')

@section('content')
<div class="container py-5 mt-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h class="text-center mb-4">Hubungi Kami</h3>
            
            @if(session('testimonial_success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('testimonial_success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    @guest
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Silakan <a href="{{ route('login') }}">login</a> terlebih dahulu untuk mengirim testimoni.

                        </div>
                    @else
                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                       id="nama" name="nama" value="{{ Auth::user()->name }}" readonly>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ Auth::user()->email }}" readonly>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="testimoni" class="form-label">Testimoni Anda</label>
                                <textarea class="form-control @error('testimoni') is-invalid @enderror" 
                                          id="testimoni" name="testimoni" rows="4" required>{{ old('testimoni') }}</textarea>
                                @error('testimoni')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-paper-plane me-2"></i>
                                    Kirim Testimoni
                                </button>
                            </div>
                        </form>
                    @endguest
                </div>
            </div>

            <div class="mt-5">
                <h3 class="text-center mb-4">Informasi Kontak</h3>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="text-center">
                            <i class="fas fa-map-marker-alt fa-2x text-primary mb-3"></i>
                            <h5>Alamat</h5>
                            <p class="text-muted">Jl. Dr.Manshyur No. 224<br>Padang Bulan, Medan 21414</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <i class="fas fa-phone fa-2x text-primary mb-3"></i>
                            <h5>Telepon</h5>
                            <p class="text-muted">+62 812-3456-789</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <i class="fas fa-envelope fa-2x text-primary mb-3"></i>
                            <h5>Email</h5>
                            <p class="text-muted">info@TwinGlow.id</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .card {
        border-radius: 15px;
        border: none;
    }
    
    .form-control {
        border-radius: 8px;
        padding: 0.75rem 1rem;
    }
    
    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
    }
    
    .btn-primary {
        border-radius: 8px;
        padding: 0.75rem 2rem;
        background-color: #ff4081;
        border-color: #ff4081;
    }
    
    .btn-primary:hover {
        background-color: #f50057;
        border-color: #f50057;
    }
    
    .alert {
        border-radius: 10px;
    }

    /* Style for readonly inputs */
    input[readonly] {
        background-color: #f8f9fa;
        cursor: not-allowed;
        opacity: 0.8;
    }
</style>
@endpush
@endsection 