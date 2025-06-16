@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid py-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

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
                            <th>Payment</th>
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
                                @if($booking->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($booking->status == 'confirmed')
                                    <span class="badge bg-success">Confirmed</span>
                                @elseif($booking->status == 'cancelled')
                                    <span class="badge bg-danger">Cancelled</span>
                                @elseif($booking->status == 'done')
                                    <span class="badge bg-primary">Done</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($booking->status) }}</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $booking->payment_method == 'transfer' ? 'bg-info' : 'bg-success' }}">
                                    {{ ucfirst($booking->payment_method) }}
                                </span>
                            </td>
                            <td>{{ optional($booking->created_at) ? optional($booking->created_at)->setTimezone('Asia/Jakarta')->format('d M Y H:i') : '-' }}</td>
                            <td>
                                <div class="d-flex flex-column gap-2">
                                    @if($booking->status == 'pending')
                                    <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST" class="mb-1">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="confirmed">
                                        <button type="submit" class="btn btn-sm btn-success" title="Konfirmasi booking">
                                            <i class="fas fa-check"></i> Confirm
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST" class="mb-1">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="btn btn-sm btn-danger" title="Batalkan booking">
                                            <i class="fas fa-times"></i> Cancel
                                        </button>
                                    </form>
                                    @endif

                                    @if($booking->status == 'confirmed')
                                    <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST" class="mb-1">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="done">
                                        <button type="submit" class="btn btn-sm btn-primary" title="Selesaikan booking">
                                            <i class="fas fa-check-double"></i> Done
                                        </button>
                                    </form>
                                    @endif

                                    @if($booking->status == 'cancelled')
                                    <span class="badge bg-secondary">Dibatalkan</span>
                                    @endif
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

