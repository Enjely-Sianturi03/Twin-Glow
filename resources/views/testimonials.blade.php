@extends('layouts.app')

@section('content')
<div class="container py-5 mt-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <h2 class="text-center mb-5">Testimoni Pelanggan</h2>
            
            @if($testimonials->isEmpty())
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle me-2"></i>
                    Belum ada testimoni yang ditampilkan.
                </div>
            @else
                <div class="row g-4">
                    @foreach($testimonials as $testimonial)
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm hover-shadow">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-circle bg-primary text-white">
                                                {{ strtoupper(substr($testimonial->nama, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="card-title mb-1">{{ $testimonial->nama }}</h5>
                                            <small class="text-muted">
                                                <i class="fas fa-envelope me-1"></i>
                                                {{ $testimonial->email }}
                                            </small>
                                        </div>
                                    </div>
                                    <div class="testimonial-content">
                                        <i class="fas fa-quote-left text-primary opacity-25 mb-2"></i>
                                        <p class="card-text mb-3">{{ $testimonial->testimoni }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ $testimonial->created_at->format('d F Y') }}
                                        </small>
                                        <div class="rating">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
    .avatar-circle {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.2rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .testimonial-content {
        position: relative;
        padding: 0.5rem 0;
    }

    .testimonial-content .fa-quote-left {
        font-size: 1.5rem;
        position: absolute;
        top: -10px;
        left: -10px;
    }

    .hover-shadow {
        transition: all 0.3s ease;
    }

    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
    }

    .rating {
        font-size: 0.9rem;
    }

    .card {
        border-radius: 15px;
        overflow: hidden;
    }
</style>
@endpush
@endsection 