@extends('layouts.admin')

@section('title', 'Tambah Booking')

@section('content')
<div class="container">
    <h1>Tambah Booking Baru</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.booking.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="no_tlp">No. Telepon</label>
            <input type="text" name="no_tlp" id="no_tlp" class="form-control" value="{{ old('no_tlp') }}" required>
        </div>

        <div class="form-group">
            <label for="jenis_layanan">Jenis Layanan</label>
            <input type="text" name="jenis_layanan" id="jenis_layanan" class="form-control" value="{{ old('jenis_layanan') }}" required>
        </div>

        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal') }}" required>
        </div>

        <div class="form-group">
            <label for="waktu">Waktu</label>
            <input type="time" name="waktu" id="waktu" class="form-control" value="{{ old('waktu') }}" required>
        </div>

        <div class="form-group">
            <label for="note">Catatan (opsional)</label>
            <textarea name="note" id="note" class="form-control">{{ old('note') }}</textarea>
        </div>

<!-- =======
        <div class="form-group">
            <label for="payment_method">Metode Pembayaran</label>
            <select name="payment_method" id="payment_method" class="form-control" required>
                <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                <option value="transfer" {{ old('payment_method') == 'transfer' ? 'selected' : '' }}>Transfer</option>
            </select>
        </div>
<<<<<<< HEAD

>>>>>>> fffb39338c68f80768a0eb6627658f0545b222cb -->
=======
>>>>>>> medeleine
        <button type="submit" class="btn btn-primary">Simpan Booking</button>
    </form>
</div>
@endsection
