@extends('layout.app')

@section('title', 'App dashboard')

@section('content')
    <div class="col-lg-12">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav class="mt-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Today: {{ date('d-m-Y') }}</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">

                <div class="col-lg-8">
                    <div class="row">
                        <!-- Revenue Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    {{-- <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>

                                        <li><a class="dropdown-item" href="#">Today</a></li>
                                        <li><a class="dropdown-item" href="#">This Month</a></li>
                                        <li><a class="dropdown-item" href="#">This Year</a></li>
                                    </ul> --}}
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title"><a href="{{ route('payments.index') }}">Payments</a> <span>|
                                            today</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>$ {{ $today_payment }}</h6>
                                            <span class="text-success small pt-1 fw-bold">{{ $today_transactions }}</span>
                                            <span class="text-muted small pt-2 ps-1">Transaction</span>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->


                    </div>

                </div>

            </div>
        </section>

    </div>
@endsection
