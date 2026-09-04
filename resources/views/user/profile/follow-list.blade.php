@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <h1>{{ $title }}</h1>
    <a href="{{ route('profile.view', $user->id) }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali ke Profil
    </a>
@stop

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
@endif

<div class="row">
    @forelse($people as $person)
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card card-dark text-center h-100 position-relative">
                <div class="card-body">
                    <a href="{{ route('profile.view', $person->id) }}" class="text-dark text-decoration-none stretched-link d-block">
                        <img src="{{ $person->avatar ? asset('storage/' . $person->avatar) : 'https://i.pravatar.cc/150?u=' . $person->id }}" alt="{{ $person->name }}" class="img-circle mb-2" style="width:80px;height:80px;object-fit:cover;">
                        <h5 class="mb-0">{{ $person->name }}</h5>
                        <p class="text-muted small mb-2">{{ $person->followers()->count() }} followers</p>
                    </a>

                    @if($person->id !== auth()->id())
                        <form action="{{ route('profile.follow', $person->id) }}" method="POST" class="position-relative" style="z-index: 2;">
                            @csrf
                            @if(auth()->user()->isFollowing($person))
                                <button type="submit" class="btn btn-outline-light btn-sm btn-block">
                                    <i class="fas fa-user-check mr-1"></i> Following
                                </button>
                            @else
                                <button type="submit" class="btn btn-primary btn-sm btn-block">
                                    <i class="fas fa-user-plus mr-1"></i> Follow
                                </button>
                            @endif
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info">Belum ada siapa-siapa di sini.</div>
        </div>
    @endforelse
</div>

<div class="d-flex justify-content-center">
    {{ $people->links() }}
</div>

@stop
