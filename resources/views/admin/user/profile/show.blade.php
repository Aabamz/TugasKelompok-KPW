@extends('adminlte::page')

@section('title', 'Profil Saya')

@section('content_header')
    <h1>Pengaturan Profil Saya</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card card-primary card-outline bg-dark">
            <div class="card-body box-profile text-center">
                <div class="text-center mb-3">
                    <img class="profile-user-img img-fluid img-circle" src="https://i.pravatar.cc/150?u={{ $user->id }}" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center font-weight-bold">{{ $user->name }}</h3>
                <p class="text-muted text-center">{{ $user->email }}</p>
                <span class="badge badge-success px-3 py-1">{{ strtoupper($user->role) }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card card-dark">
            <div class="card-header border-bottom border-secondary">
                <h3 class="card-title font-weight-bold">Edit Detail Profil</h3>
            </div>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label>Umur</label>
                        <input type="number" name="umur" class="form-control" value="{{ old('umur', $user->profile->umur ?? '') }}" placeholder="Masukkan umur" required>
                    </div>
                    <div class="form-group">
                        <label>Bio Singkat</label>
                        <textarea name="bio" class="form-control" rows="3" placeholder="Tuliskan bio singkat anda..." required>{{ old('bio', $user->profile->bio ?? '') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat..." required>{{ old('alamat', $user->profile->alamat ?? '') }}</textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop