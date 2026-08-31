@extends('adminlte::page')

@section('title', 'Edit Film')

@section('content_header')
    <h1>Edit Film</h1>
@stop

@section('content')
<div class="card card-primary">
    <form action="{{ route('admin.film.update', $film->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label>Judul Film</label>
                <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $film->judul) }}" required>
                @error('judul')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Genre</label>
                <select name="genre_id" class="form-control @error('genre_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Genre --</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" @selected(old('genre_id', $film->genre_id) == $genre->id)>{{ $genre->nama }}</option>
                    @endforeach
                </select>
                @error('genre_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Tahun Rilis</label>
                <input type="number" name="tahun" class="form-control @error('tahun') is-invalid @enderror" value="{{ old('tahun', $film->tahun) }}" required>
                @error('tahun')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Ringkasan / Sinopsis</label>
                <textarea name="ringkasan" class="form-control @error('ringkasan') is-invalid @enderror" rows="3" required>{{ old('ringkasan', $film->ringkasan) }}</textarea>
                @error('ringkasan')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Poster Saat Ini</label>
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $film->poster) }}" alt="{{ $film->judul }}" width="120" class="rounded d-block">
                </div>
                <label>Ganti Poster (opsional)</label>
                <input type="file" name="poster" class="form-control-file @error('poster') is-invalid @enderror" accept="image/*">
                <small class="text-muted">Kosongkan jika tidak ingin mengganti poster.</small>
                @error('poster')
                    <span class="invalid-feedback d-block">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.film.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@stop
