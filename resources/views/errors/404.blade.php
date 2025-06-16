@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="mt-5 mb-3">
                <img src="{{ asset('images/404.png') }}" alt="404" class="img-fluid" style="max-width: 400px;">
            </div>
            <h1 class="display-4 fw-bold">Oops! Halaman tidak ditemukan.</h1>
            <p class="mb-4">Maaf, halaman yang Anda cari tidak tersedia.</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Beranda</a>
        </div>
    </div>
</div>
@endsection 