@extends('adminlte::page')

@section('title', 'Edit Genre')

@section('content_header')
    <h1>Edit Genre</h1>
@stop

@section('content')
<div class="card card-primary">
    <form action="{{ route('admin.genre.update', $genre->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="nama">Nama Genre</label>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ old('nama', $genre->nama) }}" required>
                @error('nama')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.genre.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@stop
