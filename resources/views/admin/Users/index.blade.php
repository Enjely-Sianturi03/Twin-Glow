@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Daftar Pengguna</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
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
        <th>Created At</th>
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
    @foreach ($users as $index => $user)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->no_tlp ?? '-' }}</td>
        <td>{{ $user->created_at->format('d M Y H:i') }}</td>
        <td>
<form action="{{ route('admin.users.toggleBlock', $user->id) }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-warning">
        {{ $user->is_blocked ? 'Unblock' : 'Block' }}
    </button>
</form>
        </td>

    </tr>

    <!-- Modal Edit -->
    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Pengguna</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                        </div>
                        <div class="form-group">
                            <label>No Telepon</label>
                            <input type="text" name="no_tlp" class="form-control" value="{{ $user->no_tlp }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endforeach
</tbody>

                </table>
            </div>
        </div>
    </div>
</div>
@endsection
