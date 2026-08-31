@extends('adminlte::page')

@section('title', 'Data User')

@section('content_header')
    <h1>Daftar Pengguna Terdaftar</h1>
@stop

@section('content')

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card card-dark">
    <div class="card-body p-0">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Umur</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $key => $user)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><a href="{{ route('profile.view', $user->id) }}">{{ $user->name }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->profile->umur ?? '-' }}</td>
                        <td>{{ $user->profile->alamat ?? '-' }}</td>
                        <td>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus user {{ $user->name }}? Data ulasan dan profilnya juga akan ikut terhapus.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center">Belum ada user registered.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop