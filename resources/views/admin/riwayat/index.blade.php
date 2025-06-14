@extends('layouts.admin')

@section('title', 'Riwayat Booking')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Riwayat Booking</h1>
    <a href="{{ route('booking.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 bg-secondary">
        <h6 class="m-0 font-weight-bold text-white">Booking yang Telah Diselesaikan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="riwayatTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer Name</th>
                        <th>Service</th>
                        <th>Deleted At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookingRiwayat as $history)
                    <tr>
                        <td>{{ $history->id }}</td>
                        <td>{{ $history->nama }}</td>
                        <td>{{ $history->jenis_layanan }}</td>
                        <td>{{ \Carbon\Carbon::parse($history->deleted_at)->format('d M Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada riwayat booking.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#riwayatTable').DataTable();
    });
</script>
@endpush
