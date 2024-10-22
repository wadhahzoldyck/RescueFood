@extends('Restaurantspace.layout')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Welcome, {{ auth()->user()->name }}!</h3>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="mdi mdi-calendar"></i> Today ({{ now()->format('d M Y') }})
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                    <a class="dropdown-item" href="#">January - March</a>
                                    <a class="dropdown-item" href="#">March - June</a>
                                    <a class="dropdown-item" href="#">June - August</a>
                                    <a class="dropdown-item" href="#">August - November</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card tale-bg">
                    <div class="card-people mt-auto">
                        <img src="{{ asset('space/images/dashboard/people.svg') }}" alt="people">
                        <div class="weather-info">
                            <div class="d-flex">
                                <div>
                                    <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>31<sup>C</sup></h2>
                                </div>
                                <div class="ml-2">
                                    <h4 class="location font-weight-normal">Bangalore</h4>
                                    <h6 class="font-weight-normal">India</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 grid-margin transparent">
                <div class="row">
                    <!-- Section des Dons -->
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body">
                                <p class="mb-4">Dons d'aujourd'hui</p>
                                <p class="fs-30 mb-2">{{ $donsToday }}</p>
                                <p>{{ $donPercentageChange }}% (30 jours)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                            <div class="card-body">
                                <p class="mb-4">Total des Dons</p>
                                <p class="fs-30 mb-2">{{ $totalDons }}</p>
                                <p>{{ $donPercentageChange }}% (30 jours)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Section Nourritures ajoutées aujourd'hui -->
                    <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <p class="mb-4">Nourritures ajoutées aujourd'hui</p>
                                <p class="fs-30 mb-2">{{ $nourrituresToday }}</p>
                                <p>{{ $nourriturePercentageChange }}% (30 jours)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Section Total des Nourritures -->
                    <div class="col-md-6 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <p class="mb-4">Total des Nourritures</p>
                                <p class="fs-30 mb-2">{{ $totalNourritures }}</p>
                                <p>{{ $nourriturePercentageChange }}% (30 jours)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Statistiques des Dons Expirés</p>
                        <div class="d-flex flex-wrap mb-5">
                            <div class="mr-5 mt-3">
                                <p class="text-muted">Dons Expirés</p>
                                <h3 class="text-primary fs-30 font-weight-medium">{{ $expiredDons }}</h3>
                            </div>
                            <div class="mr-5 mt-3">
                                <p class="text-muted">Dons Disponibles</p>
                                <h3 class="text-primary fs-30 font-weight-medium">{{ $availableDons }}</h3>
                            </div>
                            <div class="mr-5 mt-3">
                                <p class="text-muted">Nourriture Collectée</p>
                                <h3 class="text-primary fs-30 font-weight-medium">{{ $foodCollected }}</h3>
                            </div>
                            <div class="mt-3">
                                <p class="text-muted">Nourriture En Attente</p>
                                <h3 class="text-primary fs-30 font-weight-medium">{{ $foodPendingCollection }}</h3>
                            </div>
                        </div>
                        <canvas id="order-chart"
                                data-expired="{{ $expiredDons }}"
                                data-available="{{ $availableDons }}"
                                data-collected="{{ $foodCollected }}">
                        </canvas>
                    </div>


                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="card-title">Détails des Dons par Nourriture</p>
                        </div>
                        <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
                        <canvas id="sales-chart"
                                data-labels='@json($donsDetailsByNourriture->pluck('nourriture'))'
                                data-data='@json($donsDetailsByNourriture->pluck('total_quantity'))'>
                        </canvas>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card position-relative">
                    <div class="card-body">
                        <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="row">
                                        <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                                            <div class="ml-xl-4 mt-3">
                                                <p class="card-title">Nourritures des 7 derniers jours</p>
                                                <h1 class="text-primary">{{ $nourrituresLast30Days }}</h1> <!-- Placeholder for the last 7 days -->
                                                <h3 class="font-weight-500 mb-xl-4 text-primary">Statistiques</h3>
                                                <p class="mb-2 mb-xl-0">Total des nourritures ajoutées au cours des 7 derniers jours.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xl-9">
                                            <div class="row">
                                                <div class="col-md-6 border-right">
                                                    <div class="table-responsive mb-3 mb-md-0 mt-3">
                                                        <table class="table table-borderless report-table">
                                                            <tr>
                                                                <td class="text-muted">Aujourd'hui</td>
                                                                <td class="w-100 px-0">
                                                                    <div class="progress progress-md mx-4">
                                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </td>
                                                                <td><h5 class="font-weight-bold mb-0">{{ $nourrituresToday }}</h5></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted">Derniers 30 jours</td>
                                                                <td class="w-100 px-0">
                                                                    <div class="progress progress-md mx-4">
                                                                        <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </td>
                                                                <td><h5 class="font-weight-bold mb-0">{{ $totalNourritures }}</h5></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted">Total des Nourritures</td>
                                                                <td class="w-100 px-0">
                                                                    <div class="progress progress-md mx-4">
                                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </td>
                                                                <td><h5 class="font-weight-bold mb-0">{{ $totalNourritures }}</h5></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="table-responsive mb-3 mb-md-0 mt-3">
                                                        <table class="table table-borderless report-table">
                                                            <tr>
                                                                <td class="text-muted">Total des Dons</td>
                                                                <td class="w-100 px-0">
                                                                    <div class="progress progress-md mx-4">
                                                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </td>
                                                                <td><h5 class="font-weight-bold mb-0">{{ $totalDons }}</h5></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted">Dons d'aujourd'hui</td>
                                                                <td class="w-100 px-0">
                                                                    <div class="progress progress-md mx-4">
                                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </td>
                                                                <td><h5 class="font-weight-bold mb-0">{{ $donsToday }}</h5></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                                            <div class="ml-xl-4 mt-3">
                                                <p class="card-title">Dons Expirés</p>
                                                <h1 class="text-danger">{{ $expiredDons }}</h1>
                                                <h3 class="font-weight-500 mb-xl-4 text-danger">Statistiques</h3>
                                                <p class="mb-2 mb-xl-0">Total des dons expirés au cours des 7 derniers jours.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xl-9">
                                            <div class="row">
                                                <div class="col-md-6 border-right">
                                                    <div class="table-responsive mb-3 mb-md-0 mt-3">
                                                        <table class="table table-borderless report-table">
                                                            <tr>
                                                                <td class="text-muted">Dons Expirés</td>
                                                                <td class="w-100 px-0">
                                                                    <div class="progress progress-md mx-4">
                                                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </td>
                                                                <td><h5 class="font-weight-bold mb-0">{{ $expiredDons }}</h5></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted">Dons Disponibles</td>
                                                                <td class="w-100 px-0">
                                                                    <div class="progress progress-md mx-4">
                                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </td>
                                                                <td><h5 class="font-weight-bold mb-0">{{ $availableDons }}</h5></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted">Nourriture Collectée</td>
                                                                <td class="w-100 px-0">
                                                                    <div class="progress progress-md mx-4">
                                                                        <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </td>
                                                                <td><h5 class="font-weight-bold mb-0">{{ $foodCollected }}</h5></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted">Nourriture En Attente</td>
                                                                <td class="w-100 px-0">
                                                                    <div class="progress progress-md mx-4">
                                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </td>
                                                                <td><h5 class="font-weight-bold mb-0">{{ $foodPendingCollection }}</h5></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#detailedReports" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#detailedReports" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid clearfix">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2024 <a href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>. All rights reserved.</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
            </div>
        </footer>
    </div>
</div>
@endsection
