@extends('adminlte::page')

@section('title', 'Notifikasi')

@section('content_header')
    <h1>Notifikasi</h1>
@stop

@section('content')

<div class="card card-dark">
    <div class="card-body p-0">
        @forelse($notifications as $notif)
            <a href="{{ route('profile.view', $notif->data['follower_id']) }}" class="d-flex align-items-center p-3 border-bottom text-dark {{ $notif->read_at ? '' : 'bg-light' }}">
                <img src="{{ $notif->data['follower_avatar'] ? asset('storage/' . $notif->data['follower_avatar']) : 'https://i.pravatar.cc/150?u=' . $notif->data['follower_id'] }}"
                     class="img-circle mr-3" style="width:45px;height:45px;object-fit:cover;">
                <div class="flex-grow-1">
                    {{ $notif->data['message'] }}
                    <div class="text-muted small">{{ $notif->created_at->diffForHumans() }}</div>
                </div>
            </a>
        @empty
            <div class="p-4 text-center text-muted">Belum ada notifikasi.</div>
        @endforelse
    </div>
</div>

<div class="d-flex justify-content-center mt-3">
    {{ $notifications->links() }}
</div>

@stop
