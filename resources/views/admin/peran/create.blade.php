@extends('adminlte::page')

@section('title', 'Tambah Peran')

@section('content_header')
    <h1>Tambah Peran Baru</h1>
@stop

@section('content')
<div class="card card-primary">
    <form action="{{ route('admin.peran.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Film</label>
                <select name="film_id" class="form-control @error('film_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Film --</option>
                    @foreach($films as $film)
                        <option value="{{ $film->id }}" @selected(old('film_id') == $film->id)>{{ $film->judul }}</option>
                    @endforeach
                </select>
                @error('film_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Cast</label>
                <select name="cast_id" class="form-control @error('cast_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Cast --</option>
                    @foreach($casts as $cast)
                        <option value="{{ $cast->id }}" @selected(old('cast_id') == $cast->id)>{{ $cast->nama }}</option>
                    @endforeach
                </select>
                @error('cast_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Nama Karakter yang Diperankan</label>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="cth: Dominic Toretto" required>
                @error('nama')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.peran.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@stop
