@extends('adminlte::page')

@section('title', 'Kelola Film')

@section('content_header')
    <h1>Daftar Film</h1>
@stop

@section('content')
<div class="card card-dark">
    <div class="card-header">
        <a href="{{ route('admin.film.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Film</a>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped table-dark align-middle">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Poster</th>
                    <th>Judul</th>
                    <th>Tahun</th>
                    <th>Genre</th>
                    <th>Rating</th>
                    <th style="width: 150px" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($films as $key => $film)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $film->poster) }}" alt="Poster" width="50" class="rounded">
                        </td>
                        <td>{{ $film->judul }}</td>
                        <td>{{ $film->tahun }}</td>
                        <td><span class="badge badge-info">{{ $film->genre->nama ?? '-' }}</span></td>
                        <td>
                            @if($film->kritik_count > 0)
                                <span class="text-warning"><i class="fas fa-star"></i> {{ number_format($film->kritik_avg_point, 1) }}</span>
                                <small class="text-muted">({{ $film->kritik_count }})</small>
                            @else
                                <small class="text-muted">-</small>
                            @endif
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admin.film.destroy', $film->id) }}" method="POST">
                                <a href="{{ route('admin.film.edit', $film->id) }}" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Yakin hapus film ini?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center">Belum ada data film.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop