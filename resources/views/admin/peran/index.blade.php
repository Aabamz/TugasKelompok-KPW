@extends('adminlte::page')

@section('title', 'Kelola Peran')

@section('content_header')
    <h1>Daftar Peran (Cast di Film)</h1>
@stop

@section('content')
<div class="card card-dark">
    <div class="card-header">
        <a href="{{ route('admin.peran.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Peran</a>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Film</th>
                    <th>Cast</th>
                    <th>Nama Karakter</th>
                    <th style="width: 150px" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($perans as $key => $peran)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $peran->film->judul ?? '-' }}</td>
                        <td>{{ $peran->cast->nama ?? '-' }}</td>
                        <td>{{ $peran->nama }}</td>
                        <td class="text-center">
                            <form action="{{ route('admin.peran.destroy', $peran->id) }}" method="POST">
                                <a href="{{ route('admin.peran.edit', $peran->id) }}" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Yakin hapus data?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center">Belum ada data peran.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop
