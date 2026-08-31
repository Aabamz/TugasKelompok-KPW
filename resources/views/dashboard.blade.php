@extends('adminlte::page')

@section('title', 'Katalog Film')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Katalog Film</h1>
        <form action="{{ route('dashboard') }}" method="GET" class="form-inline">
            <div class="input-group">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari film..." value="{{ request('search') }}">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-sm btn-default"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
@stop

@section('content')
<div class="row">
    @forelse($films as $film)
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <img src="{{ asset('storage/' . $film->poster) }}" class="card-img-top" alt="{{ $film->judul }}" style="height: 300px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge badge-info">{{ $film->genre->nama ?? 'Umum' }}</span>
                        <small class="text-muted"><i class="fas fa-calendar"></i> {{ $film->tahun }}</small>
                    </div>
                    <div class="mb-2">
                        @if($film->kritik_count > 0)
                            <span class="text-warning">
                                <i class="fas fa-star"></i> {{ number_format($film->kritik_avg_point, 1) }}
                            </span>
                            <small class="text-muted">({{ $film->kritik_count }} ulasan)</small>
                        @else
                            <small class="text-muted"><i class="far fa-star"></i> Belum ada rating</small>
                        @endif
                    </div>
                    <h5 class="card-title font-weight-bold text-truncate">{{ $film->judul }}</h5>
                    <p class="card-text text-muted small flex-grow-1" style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                        {{ $film->ringkasan }}
                    </p>
                    <a href="{{ route('film.detail', $film->id) }}" class="btn btn-primary btn-block btn-sm mt-2">
                        <i class="fas fa-eye"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <i class="fas fa-film fa-3x text-muted mb-3"></i>
            <p class="text-muted">Film tidak ditemukan atau belum ada data film di database.</p>
        </div>
    @endforelse
</div>
@stop