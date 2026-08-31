@extends('adminlte::page')

@section('title', 'Kelola Genre')

@section('content_header')
    <h1>Daftar Genre</h1>
@stop

@section('content')
<div class="card card-dark">
    <div class="card-header">
        <a href="{{ route('admin.genre.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Genre</a>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Nama Genre</th>
                    <th style="width: 150px" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($genres as $key => $genre)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $genre->nama }}</td>
                        <td class="text-center">
                            <form action="{{ route('admin.genre.destroy', $genre->id) }}" method="POST">
                                <a href="{{ route('admin.genre.edit', $genre->id) }}" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Yakin hapus data?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-center">Belum ada data genre.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop