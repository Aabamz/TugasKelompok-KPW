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
        <div class="nav flex-column nav-pills list-group" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link list-group-item list-group-item-action active" id="v-pills-account-tab" data-toggle="pill" href="#v-pills-account" role="tab">
                <i class="fas fa-user-cog mr-2"></i> Account
            </a>
            <a class="nav-link list-group-item list-group-item-action" id="v-pills-notifications-tab" data-toggle="pill" href="#v-pills-notifications" role="tab">
                <i class="fas fa-bell mr-2"></i> Notifications
            </a>
            <a class="nav-link list-group-item list-group-item-action" id="v-pills-security-tab" data-toggle="pill" href="#v-pills-security" role="tab">
                <i class="fas fa-shield-alt mr-2"></i> Security
            </a>
            <a class="nav-link list-group-item list-group-item-action" id="v-pills-billing-tab" data-toggle="pill" href="#v-pills-billing" role="tab">
                <i class="fas fa-credit-card mr-2"></i> Billing
            </a>
            <a class="nav-link list-group-item list-group-item-action text-danger" id="v-pills-danger-tab" data-toggle="pill" href="#v-pills-danger" role="tab">
                <i class="fas fa-exclamation-triangle mr-2"></i> Danger zone
            </a>
        </div>
    </div>

    <!-- Konten Kanan (Tab Content) --> <!-- Konten Kanan (Tab Content) -->
    <div class="col-md-9">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="tab-content" id="v-pills-tabContent">
            
            <!-- 1. ACCOUNT TAB -->
            <div class="tab-pane fade show active" id="v-pills-account" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">Account Settings</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Kelola profil pengguna dan informasi akun Anda.</p>
<<<<<<< HEAD
                        <a href="{{ route('profile.show') }}" class="btn btn-primary">
=======
                        <a href="{{ route('profile.index') }}" class="btn btn-primary">
>>>>>>> 79064e91894921fb0130794e5dc02db441f554a9
                            <i class="fas fa-user-edit mr-1"></i> Buka Edit Profil
                        </a>
                    </div>
                </div>
            </div>

            <!-- 2. NOTIFICATIONS TAB -->
            <div class="tab-pane fade" id="v-pills-notifications" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">Notification Preferences</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="emailNotif" checked>
                            <label class="form-check-label" for="emailNotif">Terima pemberitahuan lewat email</label>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="newsletter">
                            <label class="form-check-label" for="newsletter">Langganan buletin & pembaruan sistem</label>
                        </div>
                        <button class="btn btn-primary" type="button">Simpan Preferensi</button>
                    </div>
                </div>
            </div>

            <!-- 3. SECURITY TAB -->
            <div class="tab-pane fade" id="v-pills-security" role="tabpanel">
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

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">Two-factor authentication</h3>
                    </div>
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="font-weight-bold mb-1">Authenticator app</h5>
                            <p class="text-muted mb-0 small">Gunakan aplikasi otentikasi seperti Google Authenticator atau Authy.</p>
                        </div>
                        <button class="btn btn-outline-primary" type="button">Enable</button>
                    </div>
                </div>
            </div>

            <!-- 4. BILLING TAB -->
            <div class="tab-pane fade" id="v-pills-billing" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">Billing & Subscription</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Kelola paket langganan dan metode pembayaran akun kamu.</p>
                        <a href="{{ route('pricing.index') }}" class="btn btn-info">
                            <i class="fas fa-tags mr-1"></i> Lihat Paket Pricing
                        </a>
                    </div>
                </div>
            </div>

            <!-- 5. DANGER ZONE TAB -->
            <div class="tab-pane fade" id="v-pills-danger" role="tabpanel">
                <div class="card border-danger">
                    <div class="card-header bg-danger text-white">
                        <h3 class="card-title font-weight-bold">Danger Zone</h3>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-bold text-danger">Hapus Akun Ini</h5>
                        <p class="text-muted">Tindakan ini tidak dapat dibatalkan. Semua data kamu akan dihapus secara permanen dari sistem.</p>
                        <button class="btn btn-danger" type="button" onclick="alert('Fitur hapus akun perlu dikonfirmasi.')">
                            Hapus Akun
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@stop