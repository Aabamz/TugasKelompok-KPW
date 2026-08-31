@extends('adminlte::page')

@section('title', $film->judul)

@section('content_header')
    <h1>{{ $film->judul }}</h1>
@stop

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
@endif

<div class="row">
    {{-- Poster --}}
    <div class="col-md-4 mb-3">
        <div class="card bg-dark text-white">
            <img src="{{ asset('storage/' . $film->poster) }}" class="card-img-top" alt="{{ $film->judul }}">
        </div>
    </div>

    {{-- Detail --}}
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h3>{{ $film->judul }} <small class="text-muted">({{ $film->tahun }})</small></h3>
                <p><span class="badge badge-info">{{ $film->genre->nama ?? 'Tanpa Genre' }}</span></p>

                @php $jumlahRating = $film->kritik->count(); @endphp
                <p>
                    @if($jumlahRating > 0)
                        <span class="text-warning">
                            {{ str_repeat('⭐', round($film->kritik->avg('point'))) }}
                        </span>
                        <strong>{{ number_format($film->kritik->avg('point'), 1) }}</strong> / 5
                        <span class="text-muted">({{ $jumlahRating }} rating)</span>
                    @else
                        <span class="text-muted">Belum ada rating dari penonton.</span>
                    @endif
                </p>
                <hr>
                <h5>Ringkasan</h5>
                <p>{{ $film->ringkasan }}</p>

                <hr>
                <h5>Pemeran</h5>
                @forelse($film->peran as $peran)
                    <span class="badge badge-secondary p-2 mb-1">
                        {{ $peran->cast->nama ?? '-' }} <em>sebagai</em> {{ $peran->nama }}
                    </span>
                @empty
                    <p class="text-muted">Belum ada data pemeran untuk film ini.</p>
                @endforelse

                <hr>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm mt-2"><i class="fas fa-arrow-left"></i> Kembali ke Katalog</a>
            </div>
        </div>
    </div>
</div>

{{-- Form Kritik/Komentar: hanya untuk user biasa, Admin tidak boleh komentar --}}
@if(!Auth::user()->isAdmin())
<div class="card card-primary mt-3">
    <div class="card-header">
        <h3 class="card-title">Tulis Ulasan / Kritik</h3>
    </div>
    <form action="{{ route('kritik.store', $film->id) }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="point">Rating</label>
                <select name="point" id="point" class="form-control @error('point') is-invalid @enderror" required>
                    <option value="">-- Pilih Rating --</option>
                    @for ($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" @selected(old('point') == $i)>{{ $i }} - {{ str_repeat('⭐', $i) }}</option>
                    @endfor
                </select>
                @error('point')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="content">Kritik / Komentar</label>
                <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="3" placeholder="Tulis pendapatmu tentang film ini..." required>{{ old('content') }}</textarea>
                @error('content')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane mr-1"></i> Kirim Ulasan</button>
        </div>
    </form>
</div>
@else
<div class="alert alert-secondary mt-3">
    <i class="fas fa-info-circle mr-1"></i> Administrator tidak dapat memberikan ulasan pada film.
</div>
@endif

{{-- Daftar Kritik / Ulasan --}}
<div class="card card-dark mt-3">
    <div class="card-header">
        <h3 class="card-title">Ulasan Penonton ({{ $film->kritik->count() }})</h3>
    </div>
    <div class="card-body">
        @forelse($film->kritik->sortByDesc('created_at') as $kritik)
            <div class="media mb-3 pb-3 border-bottom">
                <div class="media-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mt-0 mb-1 font-weight-bold">
                            <a href="{{ route('profile.view', $kritik->user->id ?? 0) }}" class="text-light">
                                {{ $kritik->user->name ?? 'Pengguna' }}
                            </a>
                        </h6>
                        <span class="text-warning">{{ str_repeat('⭐', $kritik->point) }}</span>
                    </div>
                    <p class="mb-0">{{ $kritik->content }}</p>
                    <small class="text-muted">{{ $kritik->created_at->diffForHumans() }}</small>
                </div>
            </div>
        @empty
            <p class="text-muted mb-0">Belum ada ulasan untuk film ini. Jadilah yang pertama memberi ulasan!</p>
        @endforelse
    </div>
</div>

@stop
