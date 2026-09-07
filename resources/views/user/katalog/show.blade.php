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

{{-- Player Cinema Full-Width (mirip LK21) --}}
@if($film->video)
    <div class="mb-3" style="background:#000; border-radius:4px; overflow:hidden;">
        <video controls preload="metadata" poster="{{ asset('storage/' . $film->poster) }}" style="width:100%; max-height:600px; display:block; background:#000;">
            <source src="{{ asset('storage/' . $film->video) }}">
            Browser kamu tidak mendukung pemutaran video HTML5.
        </video>
        <div class="d-flex justify-content-between align-items-center px-3 py-2" style="background:#1a1a1a;">
            <span class="text-muted small"><i class="fas fa-film mr-1"></i> {{ $film->judul }}</span>
            <form action="{{ route('wishlist.toggle', $film->id) }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-sm btn-link text-light">
                    <i class="{{ $isWishlisted ? 'fas' : 'far' }} fa-heart mr-1 text-danger"></i> {{ $isWishlisted ? 'Di Wishlist' : 'Tambah ke Wishlist' }}
                </button>
            </form>
        </div>
    </div>
@endif

<div class="row">
    {{-- Poster kecil (cuma tampil kalau film gak punya video) --}}
    @unless($film->video)
        <div class="col-md-4 mb-3">
            <div class="card bg-dark text-white position-relative">
                <form action="{{ route('wishlist.toggle', $film->id) }}" method="POST" class="position-absolute" style="top:10px; right:10px; z-index:2;">
                    @csrf
                    <button type="submit" class="btn btn-light btn-sm rounded-circle shadow-sm" title="{{ $isWishlisted ? 'Hapus dari wishlist' : 'Tambah ke wishlist' }}">
                        <i class="{{ $isWishlisted ? 'fas' : 'far' }} fa-heart text-danger"></i>
                    </button>
                </form>
                <img src="{{ asset('storage/' . $film->poster) }}" class="card-img-top" alt="{{ $film->judul }}">
            </div>
        </div>
    @endunless

    {{-- Detail --}}
    <div class="{{ $film->video ? 'col-md-12' : 'col-md-8' }}">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <h3>{{ $film->judul }} <small class="text-muted">({{ $film->tahun }})</small></h3>
                    @if(!$film->video)
                        <form action="{{ route('wishlist.toggle', $film->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="{{ $isWishlisted ? 'fas' : 'far' }} fa-heart mr-1"></i> {{ $isWishlisted ? 'Di Wishlist' : 'Tambah ke Wishlist' }}
                            </button>
                            <small class="text-muted d-block text-center mt-1">{{ $film->wishlisted_by_count }} orang wishlist</small>
                        </form>
                    @else
                        <small class="text-muted">{{ $film->wishlisted_by_count }} orang wishlist</small>
                    @endif
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
<div class="card card-dark mt-3" id="comments-section" data-film-id="{{ $film->id }}">
    @include('user.katalog.partials.comments', ['film' => $film])
</div>

@push('js')
<script>
    function toggleReplyForm(kritikId) {
        const form = document.getElementById('reply-form-' + kritikId);
        form.style.display = (form.style.display === 'none') ? 'block' : 'none';
    }

    // Auto-refresh daftar ulasan tiap 8 detik, tanpa reload halaman
    (function () {
        const section = document.getElementById('comments-section');
        const filmId = section.dataset.filmId;
        const baseRefreshUrl = '{{ route("film.comments", ":id") }}'.replace(':id', filmId);

        function refreshUrl() {
            const params = new URLSearchParams(window.location.search);
            const sort = params.get('sort_ulasan') || 'terbaru';
            return baseRefreshUrl + '?sort_ulasan=' + sort;
        }

        function isUserTyping() {
            // Jangan timpa halaman kalau user lagi ngetik balasan
            const active = document.activeElement;
            return active && active.tagName === 'INPUT' && active.closest('.reply-form');
        }

        function refreshComments() {
            if (isUserTyping()) return;

            fetch(refreshUrl(), { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(res => res.text())
                .then(html => {
                    section.innerHTML = html;
                })
                .catch(err => console.log('Gagal refresh komentar:', err));
        }

        setInterval(refreshComments, 8000);
    })();
</script>
@endpush

@stop
