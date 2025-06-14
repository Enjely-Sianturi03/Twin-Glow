@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-lg-3 col-6">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-calendar-check fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0">Total Bookings</h5>
                            <h2 class="mb-0">{{ $bookings ? $bookings->count() : 0 }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0">Confirmed</h5>
                            <h2 class="mb-0">{{ $bookings->where('status', 'confirmed')->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-hourglass-half fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0">Pending</h5>
                            <h2 class="mb-0">{{ $bookings->where('status', 'pending')->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-times-circle fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0">Cancelled</h5>
                            <h2 class="mb-0">{{ $bookings->where('status', 'cancelled')->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">All Bookings</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Service</th>
                            <th>Price</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                        <tr>
                            <td>{{ optional($booking->user)->name ?? '-' }}</td>
                            <td>{{ optional($booking->user)->email ?? '-' }}</td>
                            <td>{{ $booking->jenis_layanan ?? '-' }}</td>
                            <td>
                                @php
                                    $prices = [
                                        'haircut' => 150000,
                                        'coloring' => 350000,
                                        'facial' => 250000,
                                        'nails' => 120000,
                                        'massage' => 300000,
                                        'makeup' => 400000,
                                    ];
                                    $price = optional($booking->service)->price ?? ($prices[strtolower($booking->jenis_layanan ?? '')] ?? 0);
                                @endphp
                                {{ $price ? 'Rp ' . number_format($price, 0, ',', '.') : '-' }}
                            </td>
                            <td>{{ optional($booking->tanggal)->format('d M Y') ?? '-' }}</td>
                            <td>{{ $booking->waktu ?? '-' }}</td>
                            <td>
                                <span class="badge bg-{{ 
                                    $booking->status == 'confirmed' ? 'success' : 
                                    ($booking->status == 'pending' ? 'warning' : 
                                    ($booking->status == 'cancelled' ? 'danger' : 'secondary')) 
                                }}">
                                    {{ ucfirst($booking->status ?? 'unknown') }}
                                </span>
                            </td>
                            <td>{{ optional($booking->created_at)->format('d M Y H:i') ?? '-' }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST" >
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="confirmed">
                                        <button type="submit" class="btn btn-sm btn-success">Confirm</button>
                                    </form>
                                    <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="btn btn-sm btn-danger">Cancel</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- Optional: Pagination --}}
                {{-- {{ $bookings->links() }} --}}
            </div>
        </div>
    </div>
</div>
@endsection
