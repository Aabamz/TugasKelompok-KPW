@extends('adminlte::page')

@section('title', 'Kelola Cast')

@section('content_header')
    <h1>Daftar Cast / Aktor</h1>
@stop

@section('content')
<div class="card card-dark">
    <div class="card-header">
        <a href="{{ route('admin.cast.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Cast</a>
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
                    <tr><td colspan="5" class="text-center">Belum ada data cast.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop
