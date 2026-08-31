@extends('adminlte::page')

@section('title', 'Data User')

@section('content_header')
    <h1>Daftar Pengguna Terdaftar</h1>
@stop

@section('content')
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
                </tr>
            </thead>
            <tbody>
                @forelse($users as $key => $user)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->profile->umur ?? '-' }}</td>
                        <td>{{ $user->profile->alamat ?? '-' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center">Belum ada user registered.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop