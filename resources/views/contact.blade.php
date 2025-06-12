@extends('layouts.app')

@section('content')
<div class="container py-5 mt-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2 class="text-center mb-4">Hubungi Kami</h2>
            
            @if(session('testimonial_success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('testimonial_success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                   id="nama" name="nama" value="{{ old('nama') }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required>
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
                </div>
            </div>

            <div class="mt-5">
                <h3 class="text-center mb-4">Informasi Kontak</h3>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="text-center">
                            <i class="fas fa-map-marker-alt fa-2x text-primary mb-3"></i>
                            <h5>Alamat</h5>
                            <p class="text-muted">Jl. Contoh No. 123<br>Jakarta, Indonesia</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <i class="fas fa-phone fa-2x text-primary mb-3"></i>
                            <h5>Telepon</h5>
                            <p class="text-muted">+62 123 4567 890</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <i class="fas fa-envelope fa-2x text-primary mb-3"></i>
                            <h5>Email</h5>
                            <p class="text-muted">info@salon.com</p>
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
    }
    
    .alert {
        border-radius: 10px;
    }
</style>
@endpush
@endsection 