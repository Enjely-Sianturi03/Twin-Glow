@extends('layouts.admin')

@section('title', 'Booking Management')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Booking</h1>
    <a href="{{ route('booking.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Booking
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Booking Table -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Booking List</h6>
<!-- =======
<!-- Booking Aktif -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Booking Aktif</h6>
>>>>>>> c6ea0260a8d50d634a3ad16d55310cda8cc865b5 -->
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="bookingTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer Name</th>
                        <th>Service</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Note</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
<!-- =======
                    @forelse($bookingsAktif as $booking)
>>>>>>> c6ea0260a8d50d634a3ad16d55310cda8cc865b5 -->
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->nama }}</td>
                        <td>{{ $booking->jenis_layanan }}</td>
                        <td>
                            @php
                                // Mapping harga manual jika tidak ada relasi service
<!-- =======
>>>>>>> c6ea0260a8d50d634a3ad16d55310cda8cc865b5 -->
                                $prices = [
                                    'haircut' => 150000,
                                    'coloring' => 350000,
                                    'facial' => 250000,
                                    'nails' => 120000,
                                    'massage' => 300000,
                                    'makeup' => 400000,
                                ];
                                $price = $booking->service->price ?? ($prices[strtolower($booking->jenis_layanan)] ?? 0);
                            @endphp
                            {{ $price ? 'Rp ' . number_format($price, 0, ',', '.') : '-' }}
                        </td>
                        <td>{{ $booking->tanggal->format('d M Y') }}</td>
                        <td>{{ $booking->waktu }}</td>
                        <td>{{ $booking->note ?? '-' }}</td>
                        <td>
                            @if($booking->status == 'pending')
                                <span class="badge badge-warning">Pending</span>
                            @elseif($booking->status == 'confirmed')
                                <span class="badge badge-success">Confirmed</span>
                            @elseif($booking->status == 'cancelled')
                                <span class="badge badge-danger">Cancelled</span>
                            @else
                                <span class="badge badge-secondary">{{ ucfirst($booking->status) }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('booking.edit', $booking->id) }}" class="btn btn-sm btn-info">Edit</a>

                            <form action="{{ route('admin.booking.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Yakin ingin memindahkan ke riwayat?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">Done</button>
</form>

<!-- =======
                            <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure to delete this booking?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">Done</button>
                            </form>
>>>>>>> c6ea0260a8d50d634a3ad16d55310cda8cc865b5 -->
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">No bookings found.</td>
<!-- =======
                        <td colspan="9" class="text-center">No bookings found.</td>
>>>>>>> c6ea0260a8d50d634a3ad16d55310cda8cc865b5 -->
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- =======
    </div>
</div>
>>>>>>> c6ea0260a8d50d634a3ad16d55310cda8cc865b5 -->
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#bookingTable').DataTable();
// =======
//         $('#historyTable').DataTable();
// >>>>>>> c6ea0260a8d50d634a3ad16d55310cda8cc865b5
    });
</script>
@endpush
