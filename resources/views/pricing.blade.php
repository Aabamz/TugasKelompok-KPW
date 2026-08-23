@extends('adminlte::page')

@section('title', 'Pricing')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Pricing</h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Pricing</li>
        </ol>
    </div>
@stop

@section('content')
<div class="text-center my-4">
    <h2 class="font-weight-bold">Pick the plan that fits your team</h2>
    <p class="text-muted">Simple, transparent pricing. No hidden fees. Cancel any time.</p>
</div>

<!-- Grid Kartu Pricing -->
<div class="row justify-content-center">
    <!-- Starter Plan -->
    <div class="col-md-4 col-sm-6 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body d-flex flex-column">
                <h4 class="card-title font-weight-bold">Starter</h4>
                <p class="card-text text-muted small">For individuals getting started.</p>
                
                <div class="my-3">
                    <span class="h1 font-weight-bold">$0</span>
                    <span class="text-muted">/mo</span>
                </div>

                <a href="#" class="btn btn-outline-primary btn-block mb-4">Get started</a>

                <ul class="list-unstyled text-left mt-auto">
                    <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> Up to 3 projects</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> Community support</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> 1 GB storage</li>
                    <li class="text-muted"><i class="far fa-times-circle mr-2"></i> Advanced analytics</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Pro Plan (Most Popular) -->
    <div class="col-md-4 col-sm-6 mb-4">
        <div class="card h-100 border-primary shadow" style="position: relative;">
            <div class="badge badge-primary style-badge" style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); padding: 6px 12px; font-size: 12px;">
                Most popular
            </div>
            <div class="card-body d-flex flex-column">
                <h4 class="card-title font-weight-bold">Pro</h4>
                <p class="card-text text-muted small">For growing teams that need more.</p>

                <div class="my-3">
                    <span class="h1 font-weight-bold">$29</span>
                    <span class="text-muted">/mo</span>
                </div>

                <a href="#" class="btn btn-primary btn-block mb-4">Start free trial</a>

                <ul class="list-unstyled text-left mt-auto">
                    <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> Unlimited projects</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> Priority email support</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> 100 GB storage</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> Advanced analytics</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Enterprise Plan -->
    <div class="col-md-4 col-sm-6 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body d-flex flex-column">
                <h4 class="card-title font-weight-bold">Enterprise</h4>
                <p class="card-text text-muted small">For organizations with custom needs.</p>

                <div class="my-3">
                    <span class="h1 font-weight-bold">Custom</span>
                </div>

                <a href="#" class="btn btn-outline-primary btn-block mb-4">Contact sales</a>

                <ul class="list-unstyled text-left mt-auto">
                    <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> Everything in Pro</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> SSO & SCIM</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> Dedicated account manager</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> Custom SLA</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Perbandingan Fitur -->
<div class="card mt-4">
    <div class="card-header border-0">
        <h3 class="card-title font-weight-bold">Compare features</h3>
    </div>
    <div class="card-body p-0 table-responsive">
        <table class="table table-striped table-valign-middle">
            <thead>
                <tr>
                    <th>Feature</th>
                    <th class="text-center">Starter</th>
                    <th class="text-center">Pro</th>
                    <th class="text-center">Enterprise</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Projects</td>
                    <td class="text-center">3</td>
                    <td class="text-center">Unlimited</td>
                    <td class="text-center">Unlimited</td>
                </tr>
                <tr>
                    <td>Storage</td>
                    <td class="text-center">1 GB</td>
                    <td class="text-center">100 GB</td>
                    <td class="text-center">Custom</td>
                </tr>
                <tr>
                    <td>Support</td>
                    <td class="text-center">Community</td>
                    <td class="text-center">Priority Email</td>
                    <td class="text-center">24/7 Dedicated</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@stop