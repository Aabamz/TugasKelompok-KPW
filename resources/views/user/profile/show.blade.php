@extends('adminlte::page')

@section('title', $user->name . ' - Profil')

@section('content_header')
    <h1>{{ $isOwner ? 'Profil Saya' : $user->name . ' - Profil' }}</h1>
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
    {{-- Kartu kiri: identitas + follow stats --}}
    <div class="col-md-4">
        <div class="card card-primary card-outline bg-dark text-center">
            <div class="card-body box-profile">
                <img class="profile-user-img img-fluid img-circle mb-3" src="https://i.pravatar.cc/150?u={{ $user->id }}" alt="User profile picture">

                <h3 class="profile-username font-weight-bold mb-0">{{ $user->name }}</h3>
                <p class="text-muted">{{ $user->email }}</p>
                <span class="badge badge-success px-3 py-1 mb-3">{{ strtoupper($user->role) }}</span>

                {{-- Followers / Following / Following-count --}}
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item bg-transparent">
                        <b>Followers</b> <span class="float-right">{{ $user->followers()->count() }}</span>
                    </li>
                    <li class="list-group-item bg-transparent">
                        <b>Following</b> <span class="float-right">{{ $user->following()->count() }}</span>
                    </li>
                </ul>

                @if($isOwner)
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-block">
                        <i class="fas fa-user-edit mr-1"></i> Edit Profil
                    </a>
                @else
                    <form action="{{ route('profile.follow', $user->id) }}" method="POST">
                        @csrf
                        @if(auth()->user()->isFollowing($user))
                            <button type="submit" class="btn btn-outline-light btn-block">
                                <i class="fas fa-user-check mr-1"></i> Following
                            </button>
                        @else
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-user-plus mr-1"></i> Follow
                            </button>
                        @endif
                    </form>
                @endif
            </div>
        </div>
    </div>

    {{-- Kartu kanan: About --}}
    <div class="col-md-8">
        <div class="card card-dark">
            <div class="card-header border-bottom border-secondary">
                <h3 class="card-title font-weight-bold">About</h3>
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-3"><i class="fas fa-birthday-cake mr-1"></i> Umur</div>
                    <div class="col-sm-9 text-muted">{{ $user->profile->umur ?? '-' }} tahun</div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-sm-3"><i class="fas fa-quote-left mr-1"></i> Bio</div>
                    <div class="col-sm-9 text-muted">{{ $user->profile->bio ?? 'Belum ada bio.' }}</div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-sm-3"><i class="fas fa-map-marker-alt mr-1"></i> Alamat</div>
                    <div class="col-sm-9 text-muted">{{ $user->profile->alamat ?? '-' }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
