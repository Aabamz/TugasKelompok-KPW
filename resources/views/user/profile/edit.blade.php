@extends('adminlte::page')

@section('title', 'Edit Profil')

@section('content_header')
    <h1>Edit Profil Saya</h1>
@stop

@section('content')
<div class="mb-3">
    <a href="{{ route('profile.show') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali ke Profil
    </a>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="card card-primary card-outline bg-dark">
            <div class="card-body box-profile text-center">
                <div class="text-center mb-3">
                    <img id="avatar-preview" class="profile-user-img img-fluid img-circle" src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://i.pravatar.cc/150?u=' . $user->id }}" alt="User profile picture">
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
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label>Foto Profil</label>
                        <input type="file" name="avatar" id="avatar-input" class="form-control-file" accept="image/*" onchange="document.getElementById('avatar-preview').src = window.URL.createObjectURL(this.files[0])">
                        @error('avatar')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Format JPG/PNG/GIF, maksimal 2MB.</small>
                    </div>
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