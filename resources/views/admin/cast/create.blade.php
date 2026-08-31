@extends('adminlte::page')

@section('title', 'Tambah Cast')

@section('content_header')
    <h1>Tambah Cast Baru</h1>
@stop

@section('content')
<div class="card card-primary">
    <form action="{{ route('admin.cast.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Nama Cast</label>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                @error('nama')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Umur</label>
                <input type="number" name="umur" class="form-control @error('umur') is-invalid @enderror" value="{{ old('umur') }}" required>
                @error('umur')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Bio</label>
                <textarea name="bio" class="form-control @error('bio') is-invalid @enderror" rows="3" required>{{ old('bio') }}</textarea>
                @error('bio')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.cast.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@stop
