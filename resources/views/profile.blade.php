@extends('adminlte::page')

@section('title', 'Profil Saya')

@section('content_header')
    <h1>Profil Saya</h1>
@stop

@section('content')
<div class="row">
    <!-- Kartu Informasi Ringkas (Kiri) -->
    <div class="col-md-4">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile text-center">
                <div class="mb-3">
                    @if(Auth::user()?->avatar)
                        <img class="profile-user-img img-fluid img-circle" 
                             src="{{ Storage::url(Auth::user()->avatar) }}" 
                             alt="Foto Profil" style="width: 120px; height: 120px; object-fit: cover;">
                    @else
                        <img class="profile-user-img img-fluid img-circle" 
                             src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" 
                             alt="Foto Profil Default">
                    @endif
                </div>

                <h3 class="profile-username text-center">{{ Auth::user()?->name ?? 'Tamu' }}</h3>
                <p class="text-muted text-center">{{ Auth::user()?->email ?? '-' }}</p>

                <ul class="list-group list-group-unbordered mb-3 text-left">
                    <li class="list-group-item">
                        <b>No. HP</b> <a class="float-right">{{ Auth::user()?->phone ?? '-' }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Bio</b> <p class="text-muted mt-1 mb-0">{{ Auth::user()?->bio ?? 'Belum ada bio.' }}</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Form Edit Profil (Kanan) -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header p-2">
                <h3 class="card-title p-2">Edit Data Diri</h3>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', Auth::user()?->name) }}" required>
                            @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', Auth::user()?->email) }}" required>
                            @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-sm-3 col-form-label">No. Handphone</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', Auth::user()?->phone) }}" placeholder="08123456789">
                            @error('phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="bio" class="col-sm-3 col-form-label">Bio Singkat</label>
                        <div class="col-sm-9">
                            <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="3" placeholder="Ceritakan sedikit tentang dirimu...">{{ old('bio', Auth::user()?->bio) }}</textarea>
                            @error('bio') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="avatar" class="col-sm-3 col-form-label">Foto Profil</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control-file @error('avatar') is-invalid @enderror" id="avatar" name="avatar">
                            <small class="form-text text-muted">Format: JPG, PNG, GIF. Maksimal 2MB.</small>
                            @error('avatar') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="offset-sm-3 col-sm-9">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop