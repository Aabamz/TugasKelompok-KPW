@extends('adminlte::page')

@section('title', 'Dashboard Interaktif')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Dashboard Utama Kelompok KPW</h1>
        <!-- Quick Action / Filter Periode -->
        <div>
            <button class="btn btn-sm btn-outline-primary active mr-1" onclick="filterData('Hari ini')">Hari Ini</button>
            <button class="btn btn-sm btn-outline-primary mr-1" onclick="filterData('Minggu ini')">Minggu Ini</button>
            <button class="btn btn-sm btn-outline-primary" onclick="filterData('Bulan ini')">Bulan Ini</button>
        </div>
    </div>
@stop

@section('content')
    <!-- 1. BARIS STATISTIK RINGKASAN (Small Boxes) -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3 id="stat-user">5</h3>
                    <p>Total Anggota Tim</p>
                </div>
                <div class="icon"><i class="fas fa-users"></i></div>
                <a href="javascript:void(0)" onclick="openDetailModal('Total Anggota', 'Terdiri dari 5 anggota kelompok yang mengerjakan fitur masing-masing.')" class="small-box-footer">
                    Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner"> 
                    <h3 id="stat-tugas">100<sup style="font-size: 20px">%</sup></h3>
                    <p>Pembagian Fitur</p>
                </div>
                <div class="icon"><i class="fas fa-tasks"></i></div>
                <a href="javascript:void(0)" onclick="openDetailModal('Pembagian Fitur', 'Semua anggota tim telah memiliki tugas branch masing-masing.')" class="small-box-footer">
                    Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3 id="stat-pendaftar">5</h3>
                    <p>Branch Aktif</p>
                </div>
                <div class="icon"><i class="fas fa-code-branch"></i></div>
                <a href="javascript:void(0)" onclick="openDetailModal('Branch Aktif', 'Branch: fitur-dashboard, fitur-login, fitur-register, fitur-master-data, fitur-profile.')" class="small-box-footer">
                    Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3 id="stat-laporan">0</h3>
                    <p>Konflik Git</p>
                </div>
                <div class="icon"><i class="fas fa-check-circle"></i></div>
                <a href="javascript:void(0)" onclick="openDetailModal('Status Git', 'Proyek berjalan lancar tanpa konflik merge.')" class="small-box-footer">
                    Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- 2. BARIS GRAFIK & KARTU INTERAKTIF -->
    <div class="row">
        <!-- Grafik Penjualan / Aktivitas -->
        <div class="col-lg-8">
            <div class="card card-primary card-outline">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title"><i class="fas fa-chart-line mr-1"></i> Progres Fitur Tim</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="activityChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>

        <!-- Aksi Cepat -->
        <div class="col-lg-4">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-bolt mr-1"></i> Aksi Cepat</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">Pilih tindakan untuk mengelola tugas kelompok:</p>
                    <button class="btn btn-primary btn-block mb-2" onclick="alert('Membuka dokumentasi Git & GitHub')">
                        <i class="fab fa-github mr-1"></i> Cek Repo GitHub
                    </button>
                    <button class="btn btn-success btn-block mb-2" onclick="alert('Laporan progres tim berhasil di-export!')">
                        <i class="fas fa-file-excel mr-1"></i> Export Progres (Excel)
                    </button>
                    <button class="btn btn-info btn-block" onclick="location.reload()">
                        <i class="fas fa-sync-alt mr-1"></i> Refresh Dashboard
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. TABEL AKTIVITAS TERBARU ANGGOTA (SUDAH DISESUAIKAN DENGAN NAMA TIM) -->
    <div class="row">
        <div class="col-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-users-cog mr-1"></i> Aktivitas Terbaru Anggota Kelompok</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Anggota</th>
                                <th>Tugas Fitur</th>
                                <th>Nama Branch Git</th>
                                <th>Status Fitur</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><b>Zabran</b></td>
                                <td>Dashboard Interaktif</td>
                                <td><code>fitur-dashboard</code></td>
                                <td><span class="badge bg-success">Selesai</span></td>
                                <td><button class="btn btn-xs btn-primary" onclick="openDetailModal('Zabran', 'Fitur: Dashboard Interaktif AdminLTE (Branch: fitur-dashboard)')">Detail</button></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><b>Evan</b></td>
                                <td>Fitur Login & Auth</td>
                                <td><code>fitur-login</code></td>
                                <td><span class="badge bg-warning">Dalam Proses</span></td>
                                <td><button class="btn btn-xs btn-primary" onclick="openDetailModal('Evan', 'Fitur: Autentikasi Login User (Branch: fitur-login)')">Detail</button></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><b>Della</b></td>
                                <td>Fitur Register</td>
                                <td><code>fitur-register</code></td>
                                <td><span class="badge bg-warning">Dalam Proses</span></td>
                                <td><button class="btn btn-xs btn-primary" onclick="openDetailModal('Della', 'Fitur: Pendaftaran Akun Baru (Branch: fitur-register)')">Detail</button></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><b>Siva</b></td>
                                <td>Fitur Kelola Data / Master</td>
                                <td><code>fitur-master-data</code></td>
                                <td><span class="badge bg-info">Pengembangan</span></td>
                                <td><button class="btn btn-xs btn-primary" onclick="openDetailModal('Siva', 'Fitur: Manajemen Data Master / Tabel (Branch: fitur-master-data)')">Detail</button></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td><b>Aira</b></td>
                                <td>Fitur Profile User</td>
                                <td><code>fitur-profile</code></td>
                                <td><span class="badge bg-secondary">Pending</span></td>
                                <td><button class="btn btn-xs btn-primary" onclick="openDetailModal('Aira', 'Fitur: Pengaturan Profil Pengguna (Branch: fitur-profile)')">Detail</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL POP-UP DETAIL INTERAKTIF -->
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalTitle">Detail Anggota Tim</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalBody">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Grafik Progres
        const ctx = document.getElementById('activityChart').getContext('2d');
        const activityChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Zabran', 'Evan', 'Della', 'Siva', 'Aira'],
                datasets: [{
                    label: 'Progres Fitur (%)',
                    data: [100, 60, 50, 40, 20],
                    backgroundColor: [
                        '#28a745',
                        '#ffc107',
                        '#ffc107',
                        '#17a2b8',
                        '#6c757d'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, max: 100 }
                }
            }
        });

        function filterData(periode) {
            alert('Filter diubah ke: ' + periode);
        }

        function openDetailModal(title, text) {
            document.getElementById('modalTitle').innerText = title;
            document.getElementById('modalBody').innerText = text;
            $('#modalDetail').modal('show');
        }
    </script>
@stop