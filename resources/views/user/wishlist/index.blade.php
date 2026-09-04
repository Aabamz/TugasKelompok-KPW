@extends('adminlte::page')

@section('title', 'Wishlist Saya')

@section('content_header')
    <h1>Wishlist Saya</h1>
@stop

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
@endif

<div class="row">
    @forelse($films as $film)
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 border-0 shadow-sm position-relative">
                <form action="{{ route('wishlist.toggle', $film->id) }}" method="POST" class="position-absolute" style="top:10px; right:10px; z-index:2;">
                    @csrf
                    <button type="submit" class="btn btn-light btn-sm rounded-circle shadow-sm" title="Hapus dari wishlist">
                        <i class="fas fa-heart text-danger"></i>
                    </button>
                </form>
                <img src="{{ asset('storage/' . $film->poster) }}" class="card-img-top" alt="{{ $film->judul }}" style="height: 300px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge badge-info">{{ $film->genre->nama ?? 'Umum' }}</span>
                        <small class="text-muted"><i class="fas fa-calendar"></i> {{ $film->tahun }}</small>
                    </div>
                    <div class="mb-2">
                        @if($film->ulasan_utama_count > 0)
                            <span class="text-warning">
                                <i class="fas fa-star"></i> {{ number_format($film->ulasan_utama_avg_point, 1) }}
                            </span>
                            <small class="text-muted">({{ $film->ulasan_utama_count }} ulasan)</small>
                        @else
                            <small class="text-muted"><i class="far fa-star"></i> Belum ada rating</small>
                        @endif
                    </div>
                    <h5 class="card-title font-weight-bold text-truncate">{{ $film->judul }}</h5>
                    <small class="text-muted mb-2"><i class="fas fa-heart text-danger mr-1"></i> {{ $film->wishlisted_by_count }} orang wishlist</small>
                    <a href="{{ route('film.detail', $film->id) }}" class="btn btn-primary btn-block btn-sm mt-2">
                        <i class="fas fa-eye"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <i class="fas fa-heart-broken fa-3x text-muted mb-3"></i>
            <p class="text-muted">Belum ada film yang di-wishlist. Yuk cari film menarik di Katalog!</p>
        </div>
    @endforelse
</div>

@stop
