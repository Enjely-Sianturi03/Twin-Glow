@extends('layouts.admin')

@section('title', 'Riwayat Booking')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Riwayat Booking</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Riwayat Booking</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" width="100%" cellspacing="0">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No Telepon</th>
                            <th>Layanan</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Diselesaikan Pada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookingRiwayat as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->no_tlp }}</td>
                            <td>{{ $item->jenis_layanan }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->waktu }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->deleted_at)->format('d M Y H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">Belum ada data riwayat booking.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
<!-- =======
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
>>>>>>> c6ea0260a8d50d634a3ad16d55310cda8cc865b5 -->
        </div>
    </div>
</div>
@endsection
<!-- =======

@push('scripts')
<script>
    $(document).ready(function() {
        $('#riwayatTable').DataTable();
    });
</script>
@endpush
>>>>>>> c6ea0260a8d50d634a3ad16d55310cda8cc865b5 -->
