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
    {{-- Poster / Video --}}
    <div class="col-md-4 mb-3">
        <div class="card bg-dark text-white position-relative">
            <form action="{{ route('wishlist.toggle', $film->id) }}" method="POST" class="position-absolute" style="top:10px; right:10px; z-index:2;">
                @csrf
                <button type="submit" class="btn btn-light btn-sm rounded-circle shadow-sm" title="{{ $isWishlisted ? 'Hapus dari wishlist' : 'Tambah ke wishlist' }}">
                    <i class="{{ $isWishlisted ? 'fas' : 'far' }} fa-heart text-danger"></i>
                </button>
            </form>
            @if($film->video)
                <video src="{{ asset('storage/' . $film->video) }}" poster="{{ asset('storage/' . $film->poster) }}" controls class="card-img-top" style="width:100%;"></video>
            @else
                <img src="{{ asset('storage/' . $film->poster) }}" class="card-img-top" alt="{{ $film->judul }}">
            @endif
        </div>
    </div>

    {{-- Detail --}}
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <h3>{{ $film->judul }} <small class="text-muted">({{ $film->tahun }})</small></h3>
                    <form action="{{ route('wishlist.toggle', $film->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="{{ $isWishlisted ? 'fas' : 'far' }} fa-heart mr-1"></i> {{ $isWishlisted ? 'Di Wishlist' : 'Tambah ke Wishlist' }}
                        </button>
                        <small class="text-muted d-block text-center mt-1">{{ $film->wishlisted_by_count }} orang wishlist</small>
                    </form>
                </div>
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
    <div class="card-body pb-0">
        <div class="media align-items-center mb-3">
            <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://i.pravatar.cc/150?u=' . Auth::user()->id }}" alt="Foto profil" class="img-circle mr-2" style="width:40px;height:40px;object-fit:cover;">
            <div class="media-body">
                <strong>{{ Auth::user()->name }}</strong>
                <div class="text-muted small">Memberi ulasan sebagai akun ini</div>
            </div>
        </div>
    </div>
    <form action="{{ route('kritik.store', $film->id) }}" method="POST">
        @csrf
        <div class="card-body pt-0">
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
                <img src="{{ $kritik->user->avatar ? asset('storage/' . $kritik->user->avatar) : 'https://i.pravatar.cc/150?u=' . ($kritik->user->id ?? 0) }}" alt="Foto profil" class="img-circle mr-3" style="width:40px;height:40px;object-fit:cover;">
                <div class="media-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mt-0 mb-1 font-weight-bold">
                            <a href="{{ route('profile.view', $kritik->user->id ?? 0) }}" class="text-dark">
                                {{ $kritik->user->name ?? 'Pengguna' }}
                            </a>
                        </h6>
                        <span class="text-warning">{{ str_repeat('⭐', $kritik->point) }}</span>
                    </div>
                    <p class="mb-0">{{ $kritik->content }}</p>
                    <small class="text-muted">{{ $kritik->created_at->diffForHumans() }}</small>

                    @if(!Auth::user()->isAdmin())
                        <div>
                            <button type="button" class="btn btn-link btn-sm p-0" onclick="toggleReplyForm({{ $kritik->id }})">
                                <i class="fas fa-reply mr-1"></i> Balas
                            </button>
                        </div>

                        {{-- Form balas, tersembunyi sampai tombol "Balas" diklik --}}
                        <form action="{{ route('kritik.store', $film->id) }}" method="POST" id="reply-form-{{ $kritik->id }}" class="mt-2" style="display:none;">
                            @csrf
                            <input type="hidden" name="parent_id" value="{{ $kritik->id }}">
                            <div class="input-group input-group-sm">
                                <input type="text" name="content" class="form-control" placeholder="Tulis balasan untuk {{ $kritik->user->name ?? 'Pengguna' }}..." required>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </form>
                    @endif

                    {{-- Daftar balasan --}}
                    @if($kritik->replies->count())
                        <div class="mt-3 pl-3 border-left">
                            @foreach($kritik->replies as $reply)
                                <div class="media mb-2">
                                    <img src="{{ $reply->user->avatar ? asset('storage/' . $reply->user->avatar) : 'https://i.pravatar.cc/150?u=' . ($reply->user->id ?? 0) }}" alt="Foto profil" class="img-circle mr-2" style="width:28px;height:28px;object-fit:cover;">
                                    <div class="media-body">
                                        <h6 class="mt-0 mb-0 font-weight-bold" style="font-size: 0.9rem;">
                                            <a href="{{ route('profile.view', $reply->user->id ?? 0) }}" class="text-dark">
                                                {{ $reply->user->name ?? 'Pengguna' }}
                                            </a>
                                        </h6>
                                        <p class="mb-0" style="font-size: 0.9rem;">{{ $reply->content }}</p>
                                        <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-muted mb-0">Belum ada ulasan untuk film ini. Jadilah yang pertama memberi ulasan!</p>
        @endforelse
    </div>
</div>

@push('js')
<script>
    function toggleReplyForm(kritikId) {
        const form = document.getElementById('reply-form-' + kritikId);
        form.style.display = (form.style.display === 'none') ? 'block' : 'none';
    }
</script>
@endpush

@stop
