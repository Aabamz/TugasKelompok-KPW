@extends('adminlte::page')

@section('title', 'Tambah Genre')

@section('content_header')
    <h1>Tambah Genre</h1>
@stop

@section('content')
<div class="card card-primary">
<<<<<<< HEAD
    <form action="{{ route('admin.genre.store') }}" method="POST">
=======
    <form action="{{ route('genre.store') }}" method="POST">
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="nama">Nama Genre</label>
                <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan nama genre" required>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
<<<<<<< HEAD
            <a href="{{ route('admin.genre.index') }}" class="btn btn-secondary">Batal</a>
=======
            <a href="{{ route('genre.index') }}" class="btn btn-secondary">Batal</a>
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
        </div>
    </form>
</div>
@stop