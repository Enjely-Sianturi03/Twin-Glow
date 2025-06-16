@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="mt-5 mb-3">
                <h1 style="font-size: 120px; font-weight: 700; color: #ff4081; margin-bottom: 0;">403</h1>
            </div>
            <h2 class="display-4 fw-bold" style="color: #333;">Oops! Akses Ditolak</h2>
            <p class="mb-4 text-muted" style="font-size: 18px;">Maaf, Anda tidak memiliki akses ke halaman ini.</p>
            <a href="{{ route('home') }}" class="btn btn-primary" style="background-color: #ff4081; border-color: #ff4081; padding: 10px 30px; font-size: 16px;">Kembali ke Beranda</a>
        </div>
    </div>
</div>

<style>
    .btn-primary:hover {
        background-color: #f50057 !important;
        border-color: #f50057 !important;
    }
</style>
@endsection 