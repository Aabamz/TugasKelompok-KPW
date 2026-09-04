@extends('adminlte::page')

@section('title', 'Cari Pengguna')

@section('content_header')
    <h1>Cari Pengguna</h1>
@stop

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
@endif

<div class="card card-dark mb-3">
    <div class="card-body">
        <form action="{{ route('profile.search') }}" method="GET" class="form-inline">
            <input type="text" name="q" class="form-control mr-2" style="min-width:250px;" placeholder="Cari nama pengguna..." value="{{ $keyword }}">
            <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-search mr-1"></i> Cari</button>
            @if($keyword)
                <a href="{{ route('profile.search') }}" class="btn btn-secondary">Reset</a>
            @endif
        </form>
    </div>
</div>

<div class="row">
    @forelse($users as $user)
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card card-dark text-center h-100 position-relative">
                <div class="card-body">
                    <a href="{{ route('profile.view', $user->id) }}" class="text-dark text-decoration-none stretched-link d-block">
                        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://i.pravatar.cc/150?u=' . $user->id }}" alt="{{ $user->name }}" class="img-circle mb-2" style="width:80px;height:80px;object-fit:cover;">
                        <h5 class="mb-0">{{ $user->name }}</h5>
                        <p class="text-muted small mb-2">{{ $user->followers()->count() }} followers</p>
                    </a>

                    <form action="{{ route('profile.follow', $user->id) }}" method="POST" class="position-relative" style="z-index: 2;">
                        @csrf
                        @if(auth()->user()->isFollowing($user))
                            <button type="submit" class="btn btn-outline-light btn-sm btn-block">
                                <i class="fas fa-user-check mr-1"></i> Following
                            </button>
                        @else
                            <button type="submit" class="btn btn-primary btn-sm btn-block">
                                <i class="fas fa-user-plus mr-1"></i> Follow
                            </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info">Tidak ada pengguna yang ditemukan.</div>
        </div>
    @endforelse
</div>

<div class="d-flex justify-content-center">
    {{ $users->links() }}
</div>

@stop
