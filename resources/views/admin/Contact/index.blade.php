@extends('layouts.admin') {{-- Ganti dengan layout admin kamu --}}

@section('title', 'Daftar Testimoni')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Daftar Testimoni</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Testimoni Pengguna</h6>
        </div>
        <div class="card-body">
            @if($contacts->count())
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Testimoni</th>
                            <th>Tanggal Submit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contacts as $contact)
                            <tr>
                                <td>{{ $contact->nama }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->testimoni }}</td>
                                <td>{{ $contact->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    @php
                                        $isPosted = \App\Models\Testimonial::where('nama', $contact->nama)
                                            ->where('email', $contact->email)
                                            ->where('testimoni', $contact->testimoni)
                                            ->where('is_approved', true)
                                            ->exists();
                                    @endphp
                                    @if(!$isPosted)
                                        <form action="{{ route('admin.contact.postTestimoni', $contact->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Post Testimoni</button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.contact.retractTestimoni', $contact->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Tarik Testimoni</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Tidak ada testimoni yang ditemukan.</p>
            @endif
        </div>
    </div>
</div>
@endsection
