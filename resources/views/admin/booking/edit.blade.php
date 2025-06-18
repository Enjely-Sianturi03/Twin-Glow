@extends('layouts.admin')

@section('title', 'Edit Booking')

@section('content')
<div class="container">
    <h1>Edit Booking #{{ $booking->id }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Ada masalah dengan input kamu.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('booking.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama">Nama Customer</label>
            <input type="text" name="nama" value="{{ old('nama', $booking->nama) }}" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label for="no_tlp">No. Telepon</label>
            <input type="text" name="no_tlp" value="{{ old('no_tlp', $booking->no_tlp) }}" class="form-control" readonly>

        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" value="{{ old('email', $booking->email) }}" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label for="jenis_layanan">Jenis Layanan</label>
            <input type="text" name="jenis_layanan" value="{{ old('jenis_layanan', $booking->jenis_layanan) }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal', $booking->tanggal) }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="waktu">Waktu</label>
            <input type="time" name="waktu" value="{{ old('waktu', $booking->waktu) }}" class="form-control" required>

        </div>

        <div class="form-group">
            <label for="note">Catatan</label>
            <textarea name="note" class="form-control" readonly>{{ old('note', $booking->note) }}</textarea>
        </div>

        <div class="form-group">
            <label for="status">Status Booking</label>
            <input type="text" class="form-control" value="{{ $booking->status }}" readonly>
            <input type="hidden" name="status" value="{{ $booking->status }}">
        </div>

        <div class="form-group">
            <label for="payment_method">Metode Pembayaran</label>
            <input type="text" class="form-control" value="{{ $booking->payment_method }}" readonly>
            <input type="hidden" name="payment_method" value="{{ $booking->payment_method }}">
<!-- =======
            <select name="status" class="form-control" required>
                <option value="pending" {{ old('status', $booking->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ old('status', $booking->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="cancelled" {{ old('status', $booking->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
>>>>>>> 3799c54a3c97b35b2f9da2befb533d90b73f1992 -->
        </div>

<!-- =======
        <div class="form-group">
            <label for="payment_method">Metode Pembayaran</label>
            <select name="payment_method" id="payment_method" class="form-control" required>
                <option value="cash" {{ old('payment_method', $booking->payment_method) == 'cash' ? 'selected' : '' }}>Cash</option>
                <option value="transfer" {{ old('payment_method', $booking->payment_method) == 'transfer' ? 'selected' : '' }}>Transfer</option>
            </select>
        </div>

>>>>>>> fffb39338c68f80768a0eb6627658f0545b222cb -->
        <button type="submit" class="btn btn-primary">Update Booking</button>
        <a href="{{ route('admin.booking.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
