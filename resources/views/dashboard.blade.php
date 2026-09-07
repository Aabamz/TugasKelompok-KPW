@extends('adminlte::page')

@section('title', 'Katalog Film')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <h1>Katalog Film</h1>
        <div class="d-flex">
            <form action="{{ route('dashboard') }}" method="GET" class="form-inline mr-2">
                @if(request('genre_id'))<input type="hidden" name="genre_id" value="{{ request('genre_id') }}">@endif
                @if(request('tahun'))<input type="hidden" name="tahun" value="{{ request('tahun') }}">@endif
                @if(request('sort'))<input type="hidden" name="sort" value="{{ request('sort') }}">@endif
                <div class="input-group">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari film..." value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-sm btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>

            {{-- Dropdown Filter --}}
            <div class="dropdown">
                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-filter mr-1"></i> Filter
                </button>
                <div class="dropdown-menu dropdown-menu-right p-3 shadow" style="min-width: 280px;" aria-labelledby="filterDropdown">
                    <p class="text-muted small mb-3">Tampilkan daftar film sesuai dengan kesukaan Anda.</p>
                    <form action="{{ route('dashboard') }}" method="GET">
                        @if(request('search'))<input type="hidden" name="search" value="{{ request('search') }}">@endif

                        <div class="form-group">
                            <label class="small font-weight-bold">Urutkan</label>
                            <select name="sort" class="form-control form-control-sm">
                                <option value="terbaru" @selected(request('sort', 'terbaru') === 'terbaru')>Terbaru</option>
                                <option value="populer" @selected(request('sort') === 'populer')>Populer (Rating)</option>
                                <option value="terlama" @selected(request('sort') === 'terlama')>Terlama</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="small font-weight-bold">Genre</label>
                            <select name="genre_id" class="form-control form-control-sm">
                                <option value="">- Pilih Genre -</option>
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}" @selected((string) request('genre_id') === (string) $genre->id)>{{ $genre->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="small font-weight-bold">Tahun</label>
                            <select name="tahun" class="form-control form-control-sm">
                                <option value="">- Pilih Tahun -</option>
                                @foreach($tahunList as $tahun)
                                    <option value="{{ $tahun }}" @selected((string) request('tahun') === (string) $tahun)>{{ $tahun }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm">Reset</a>
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-filter mr-1"></i> Terapkan Filter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')

@if(request()->filled('genre_id') || request()->filled('tahun') || request()->filled('sort'))
    <div class="mb-3">
        <span class="text-muted small mr-2">Filter aktif:</span>
        @if(request('sort') && request('sort') !== 'terbaru')
            <span class="badge badge-primary mr-1">Urutan: {{ ucfirst(request('sort')) }}</span>
        @endif
        @if(request('genre_id'))
            <span class="badge badge-info mr-1">Genre: {{ $genres->firstWhere('id', request('genre_id'))->nama ?? '-' }}</span>
        @endif
        @if(request('tahun'))
            <span class="badge badge-secondary mr-1">Tahun: {{ request('tahun') }}</span>
        @endif
        <a href="{{ route('dashboard') }}" class="small ml-2"><i class="fas fa-times-circle"></i> Reset semua</a>
    </div>
@endif

<div class="row">
    @forelse($films as $film)
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 border-0 shadow-sm position-relative">
                @if($film->created_at->diffInDays(now()) <= 7)
                    <span class="badge badge-danger position-absolute" style="top:10px; left:10px; z-index:2;">Baru!</span>
                @endif
                <form action="{{ route('wishlist.toggle', $film->id) }}" method="POST" class="position-absolute" style="top:10px; right:10px; z-index:2;">
                    @csrf
                    <button type="submit" class="btn btn-light btn-sm rounded-circle shadow-sm" title="{{ in_array($film->id, $wishlistedIds) ? 'Hapus dari wishlist' : 'Tambah ke wishlist' }}">
                        <i class="{{ in_array($film->id, $wishlistedIds) ? 'fas' : 'far' }} fa-heart text-danger"></i>
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