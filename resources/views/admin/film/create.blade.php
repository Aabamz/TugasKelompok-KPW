@extends('adminlte::page')

@section('title', 'Tambah Film')

@section('content_header')
    <h1>Tambah Film Baru</h1>
@stop

@section('content')
<div class="card card-primary">
<<<<<<< HEAD
    <form action="{{ route('admin.film.store') }}" method="POST" enctype="multipart/form-data">
=======
    <form action="{{ route('film.store') }}" method="POST" enctype="multipart/form-data">
>>>>>>> 79064e91894921fb0130794e5dc02db441f554a9
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Judul Film</label>
                <input type="text" name="judul" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Genre</label>
                <select name="genre_id" class="form-control" required>
                    <option value="">-- Pilih Genre --</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Tahun Rilis</label>
                <input type="number" name="tahun" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Ringkasan / Sinopsis</label>
                <textarea name="ringkasan" class="form-control" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label>Upload Poster</label>
                <input type="file" name="poster" class="form-control-file" accept="image/*" required>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
<<<<<<< HEAD
            <a href="{{ route('admin.film.index') }}" class="btn btn-secondary">Batal</a>
=======
            <a href="{{ route('film.index') }}" class="btn btn-secondary">Batal</a>
>>>>>>> 79064e91894921fb0130794e5dc02db441f554a9
        </div>
    </form>
</div>
@stop