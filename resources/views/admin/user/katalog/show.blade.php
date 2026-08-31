@extends('adminlte::page')

@section('title', $film->judul)

@section('content_header')
    <h1>Detail Film: {{ $film->judul }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-4 mb-3">
        <div class="card bg-dark text-white">
            <img src="{{ asset('storage/' . $film->poster) }}" class="card-img-top" alt="{{ $film->judul }}">
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h3>{{ $film->judul }} ({{ $film->tahun }})</h3>
                <p><span class="badge badge-info">{{ $film->genre->nama ?? 'Tanpa Genre' }}</span></p>
                <hr>
                <h5>Ringkasan:</h5>
                <p>{{ $film->ringkasan }}</p>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm mt-3"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
</div>
@stop