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
                    <div>
                        <span class="text-warning">{{ str_repeat('⭐', $kritik->point) }}</span>
                        @if($kritik->user_id === Auth::id() || Auth::user()->isAdmin())
                            <form action="{{ route('kritik.destroy', $kritik->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus ulasan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger btn-sm p-0 ml-2" title="Hapus ulasan">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        @endif
                    </div>
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
                    <form action="{{ route('kritik.store', $film->id) }}" method="POST" id="reply-form-{{ $kritik->id }}" class="mt-2 reply-form" style="display:none;">
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
                                    @if($reply->user_id === Auth::id() || Auth::user()->isAdmin())
                                        <form action="{{ route('kritik.destroy', $reply->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus balasan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger btn-sm p-0 ml-2" title="Hapus balasan" style="font-size: 0.8rem;">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    @endif
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
