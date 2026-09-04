@forelse($notifications as $notif)
    <a href="{{ route('profile.view', $notif->data['follower_id']) }}" class="dropdown-item">
        <img src="{{ $notif->data['follower_avatar'] ? asset('storage/' . $notif->data['follower_avatar']) : 'https://i.pravatar.cc/150?u=' . $notif->data['follower_id'] }}"
             class="img-circle mr-2" style="width:30px;height:30px;object-fit:cover;">
        {{ $notif->data['message'] }}
        <span class="float-right text-muted text-sm">{{ $notif->created_at->diffForHumans() }}</span>
    </a>
    <div class="dropdown-divider"></div>
@empty
    <span class="dropdown-item text-muted">Belum ada notifikasi baru.</span>
@endforelse
