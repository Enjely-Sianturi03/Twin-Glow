@extends('layouts.app')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Checkout</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @php
                                $serviceImages = [
                                    'facial' => 'facial treatment.jpg',
                                    'haircut' => 'hairstyling.jpg',
                                    'coloring' => 'haircolour.jpg',
                                    'nails' => 'nailart.jpg',
                                    'massage' => 'bodyMassage.jpg',
                                    'makeup' => 'makeup profesional.jpg',
                                ];
                                $serviceKey = strtolower(str_replace([' ', '-'], '', $booking->jenis_layanan));
                                $serviceImage = isset($serviceImages[$serviceKey]) ? 'image/' . $serviceImages[$serviceKey] : 'image/galeri1.jpg';
                            @endphp
                            <div class="service-image-container mb-3">
                                <img src="{{ asset($serviceImage) }}" 
                                     alt="{{ $booking->jenis_layanan }}" 
                                     class="img-fluid rounded shadow-sm"
                                     style="width: 100%; height: 200px; object-fit: cover;">
                                <div class="service-name-overlay">
                                    <span class="badge bg-primary">{{ $booking->jenis_layanan }}</span>
                                </div>
                            <!-- </div> bla -->
                        </div>
                        <div class="col-md-8">
                            <h5 class="border-bottom pb-2">Booking Details</h5>
                            <div class="mb-4">
                                <p><strong>Service:</strong> {{ $booking->jenis_layanan }}</p>
                                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($booking->tanggal)->format('d F Y') }}</p>
                                <p><strong>Time:</strong> {{ $booking->waktu }}</p>
                                <p><strong>Total Amount:</strong> <span class="text-primary fw-bold">Rp {{ number_format($amount, 0, ',', '.') }}</span></p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('checkout.process', $booking) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="payment_method" class="form-label fw-bold">Payment Method</label>
                            <select name="payment_method" id="payment_method" class="form-select" required>
                                <option value="">Select Payment Method</option>
                                <option value="transfer">Bank Transfer</option>
                                <option value="cash">Cash</option>
                            </select>
                        </div>

                        <div id="transfer-details" class="mb-3 d-none">
                            <div class="alert alert-info">
                                <h6 class="alert-heading mb-3">Bank Transfer Details</h6>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="fw-bold">Bank:</span>
                                    <span>Bank Twin Glow</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="fw-bold">Account Number:</span>
                                    <span>17283947261</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="fw-bold">Account Name:</span>
                                    <span>Twin Glow Salon Padang Bulan</span>
                                </div>
                                <div class="alert alert-warning mt-3">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Penting:</strong> Mohon bawa bukti transfer saat kunjungan ke salon untuk verifikasi pembayaran.
                                </div>
                            </div>
                        </div>

                        <div id="cash-details" class="mb-3 d-none">
                            <div class="alert alert-warning">
                                <h6 class="alert-heading mb-3">Cash Payment Information</h6>
                                <p class="mb-0">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Pembayaran cash dilakukan saat kunjungan ke salon. Mohon datang tepat waktu sesuai jadwal booking.
                                </p>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-credit-card me-2"></i>Process Payment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .service-image-container {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
    }
    .service-name-overlay {
        position: absolute;
        bottom: 10px;
        left: 10px;
        right: 10px;
        text-align: center;
    }
    .service-name-overlay .badge {
        font-size: 1rem;
        padding: 8px 16px;
    }
</style>
@endpush

@push('scripts')
<script>
    document.getElementById('payment_method').addEventListener('change', function() {
        const transferDetails = document.getElementById('transfer-details');
        const cashDetails = document.getElementById('cash-details');
        
        transferDetails.classList.add('d-none');
        cashDetails.classList.add('d-none');
        
        if (this.value === 'transfer') {
            transferDetails.classList.remove('d-none');
        } else if (this.value === 'cash') {
            cashDetails.classList.remove('d-none');
        }
    });
</script>
@endpush
@endsection 