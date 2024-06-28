@extends('layouts.main')
@section('container')
<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column w-100">

        <!-- Main Content -->
        <div id="content">
            <!-- Begin Page Content -->
            <div class="container-fluid text-center">

                <!-- Page Heading -->
                <div class="row col-xl-10 d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="col h3 mb-0 text-gray-800">Dashboard</h1>
                    <a href="{{ route('pdf.denda') }}" class="col-auto d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" target="_blank"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                </div>

                <!-- Content Row -->
                <div class="row justify-content-center">

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total Buku Tersedia</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBuku }}</div>
                                    </div>
                                    <div class="col-auto p-3">
                                        <i class="fas fa-solid fa-book-open fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Total Transaksi Pinjaman</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPinjaman }}</div>
                                    </div>
                                    <div class="col-auto p-3">
                                        <i class="fas fa-solid fa-hands-holding fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Total Anggota Kena Denda (Belum Lunas)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalDenda }}</div>
                                    </div>
                                    <div class="col-auto p-3">
                                        <i class="fas fa-solid fa-circle-dollar-to-slot fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Row -->

                <div class="row justify-content-center">

                    <!-- Pie Chart -->
                    <div class="col-xl-6 col-lg-5">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div
                                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Kategori Buku Populer</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-pie pt-4 pb-2">
                                    <canvas id="myPieChart"></canvas>
                                </div>
                                <div class="mt-4 text-center small">
                                    @php($colors = ['#4e73df', '#1cc88a', '#36b9cc'])
                                    @foreach ($kategori as $i => $k)
                                        @php($color = $colors[$i % count($colors)])
                                        <span class="mr-2">
                                            <i class="fas fa-circle" style="color: {{ $color }};"></i> {{ $k->kategori }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4 col-xl-5 col-lg-2">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Stok Buku</h6>
                        </div>
                        <div class="card-body">
                            @php($colors = ['bg-primary', 'bg-warning', 'bg-success', 'bg-danger', 'bg-secondary'])
                            @foreach ($stok as $s)
                                @php($color = $colors[rand(0, count($colors) - 1)])
                                <h4 class="small font-weight-bold">{{ $s->judul }}<span
                                        class="float-right">{{ $s->total }}</span></h4>
                                <div class="progress mb-4">
                                    <div class="progress-bar {{ $color }}" role="progressbar" style="width: {{ $s->total }}%"
                                        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

<script>
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [...@json($kategoriJudul)],
            datasets: [{
                data: [...@json($kategoriTotal)],
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80,
        },
    });

</script>
@endpush
