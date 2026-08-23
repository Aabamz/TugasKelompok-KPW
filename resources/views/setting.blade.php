@extends('adminlte::page')

@section('title', 'Settings')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Settings</h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Settings</li>
        </ol>
    </div>
@stop

@section('content')
<div class="row">
    <!-- Menu Sidebar Navigasi Kiri -->
    <div class="col-md-3 mb-3">
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-user-cog mr-2"></i> Account</a>
            <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-bell mr-2"></i> Notifications</a>
            <a href="#" class="list-group-item list-group-item-action active"><i class="fas fa-shield-alt mr-2"></i> Security</a>
            <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-credit-card mr-2"></i> Billing</a>
            <a href="#" class="list-group-item list-group-item-action text-danger"><i class="fas fa-exclamation-triangle mr-2"></i> Danger zone</a>
        </div>
    </div>

    <!-- Konten Security / Form Password Kanan -->
    <div class="col-md-9">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Card Change Password -->
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">Password</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('settings.update-password') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="current_password">Current password</label>
                        <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                        @error('current_password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="password">New password</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="password_confirmation">Confirm new password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update password</button>
                </form>
            </div>
        </div>

        <!-- Card Two-Factor Authentication -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">Two-factor authentication</h3>
            </div>
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="font-weight-bold mb-1">Authenticator app</h5>
                    <p class="text-muted mb-0 small">Use an authenticator app such as 1Password or Authy.</p>
                </div>
                <button class="btn btn-outline-primary" type="button">Enable</button>
            </div>
        </div>
    </div>
</div>
@stop