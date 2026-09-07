@extends('adminlte::page')

@section('title', 'Kelola Cast')

@section('content_header')
    <h1>Daftar Cast / Aktor</h1>
@stop

@section('content')
<div class="card card-dark">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
        <a href="{{ route('admin.cast.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Cast</a>
        <form action="{{ route('admin.cast.index') }}" method="GET" class="form-inline">
            <div class="input-group input-group-sm">
                <input type="text" name="search" class="form-control" placeholder="Cari nama cast..." value="{{ request('search') }}">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    @if(request('search'))
                        <a href="{{ route('admin.cast.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i></a>
                    @endif
                </div>
            </div>
        </form>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Nama</th>
                    <th style="width: 100px">Umur</th>
                    <th>Bio</th>
                    <th style="width: 150px" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($casts as $key => $cast)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $cast->nama }}</td>
                        <td>{{ $cast->umur }}</td>
                        <td>{{ Str::limit($cast->bio, 80) }}</td>
                        <td class="text-center">
                            <form action="{{ route('admin.cast.destroy', $cast->id) }}" method="POST">
                                <a href="{{ route('admin.cast.edit', $cast->id) }}" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Yakin hapus data?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center">
                        @if(request('search'))
                            Cast "{{ request('search') }}" tidak ditemukan.
                        @else
                            Belum ada data cast.
                        @endif
                    </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop
