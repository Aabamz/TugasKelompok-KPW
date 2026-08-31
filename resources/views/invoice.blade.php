@extends('adminlte::page')

@section('title', 'Invoice')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Invoice</h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Invoice</li>
        </ol>
    </div>
@stop

@section('content')
<!-- Tombol Aksi Kanan Atas -->
<div class="d-flex justify-content-end mb-3 d-print-none">
    <button onclick="window.print()" class="btn btn-outline-secondary mr-2">
        <i class="fas fa-print mr-1"></i> Print
    </button>
    <button class="btn btn-outline-secondary mr-2">
        <i class="fas fa-download mr-1"></i> PDF
    </button>
    <button class="btn btn-primary">
        <i class="fas fa-paper-plane mr-1"></i> Send invoice
    </button>
</div>

<!-- Kartu Utama Invoice -->
<div class="card p-4">
    <div class="row mb-4">
        <!-- Informasi Perusahaan / Pengirim -->
        <div class="col-sm-6">
            <h4 class="text-primary font-weight-bold">AdminLTE, Inc.</h4>
            <address class="text-muted mb-0">
                795 Folsom Ave, Suite 600<br>
                San Francisco, CA 94107<br>
                billing@example.com
            </address>
            <br>
            <small class="text-muted">Billed to</small>
            <h5 class="font-weight-bold mb-0">Acme Corporation</h5>
            <div class="text-muted">
                Attn: Jane Doe<br>
                1234 Market Street<br>
                San Francisco, CA 94103
            </div>
        </div>

        <!-- Detail No Invoice & Tanggal -->
        <div class="col-sm-6 text-sm-right mt-3 mt-sm-0">
            <h2 class="font-weight-bold mb-0">Invoice</h2>
            <p class="text-muted mb-1">#INV-2026-00428</p>
            <span class="badge badge-success px-3 py-1 mb-3">Paid</span>

            <div class="text-muted">
                <small class="d-block">Issue date</small>
                <strong>May 18, 2026</strong>
            </div>
            <div class="text-muted mt-2">
                <small class="d-block">Due date</small>
                <strong>June 1, 2026</strong>
            </div>
        </div>
    </div>

    <!-- Tabel Item Tagihan -->
    <div class="table-responsive">
        <table class="table table-borderless table-striped">
            <thead>
                <tr>
                    <th>Description</th>
                    <th class="text-center">Qty</th>
                    <th class="text-right">Unit price</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>Pro plan subscription</strong><br>
                        <small class="text-muted">May 18 - Jun 18, 2026</small>
                    </td>
                    <td class="text-center align-middle">1</td>
                    <td class="text-right align-middle">$29.00</td>
                    <td class="text-right align-middle">$29.00</td>
                </tr>
                <tr>
                    <td>
                        <strong>Additional seats</strong><br>
                        <small class="text-muted">Pro-rated for current period</small>
                    </td>
                    <td class="text-center align-middle">3</td>
                    <td class="text-right align-middle">$12.50</td>
                    <td class="text-right align-middle">$37.50</td>
                </tr>
                <tr>
                    <td>
                        <strong>SMS notifications add-on</strong><br>
                        <small class="text-muted">1,000 messages</small>
                    </td>
                    <td class="text-center align-middle">1</td>
                    <td class="text-right align-middle">$5.00</td>
                    <td class="text-right align-middle">$5.00</td>
                </tr>
            </tbody>
        </table>
    </div>

    <hr>

    <!-- Ringkasan Total Tagihan -->
    <div class="row justify-content-end">
        <div class="col-md-4">
            <table class="table table-sm table-borderless">
                <tr>
                    <th class="text-muted">Subtotal</th>
                    <td class="text-right">$71.50</td>
                </tr>
                <tr>
                    <th class="text-muted">Tax (8.25%)</th>
                    <td class="text-right">$5.90</td>
                </tr>
                <tr class="border-top">
                    <th>Total due</th>
                    <td class="text-right h4 font-weight-bold text-primary">$77.40 USD</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@stop