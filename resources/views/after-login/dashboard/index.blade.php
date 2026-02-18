@extends('layout.user')
@section('headers')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    /* Mengatur ukuran canvas agar grafik tidak terlalu besar */
    #pieChart {
        width: 100% !important; /* Lebar responsif */
        height: 200px !important; /* Menyesuaikan tinggi pie chart */
    }

    #barChart {
        width: 100% !important; /* Lebar responsif */
        height: 200px !important; /* Menyesuaikan tinggi bar chart */
    }
</style>
@endsection

@section('title', 'Dashboard')
@section('content')

<div class="row">
    <!-- Card Summary -->
    <div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xxl-7 mb-2 mb-lg-0">
        <div class="row">
            <!-- Card for Total Students -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-4 mb-2">
                <x-card.summary header="Jumlah Mahasiswa" value="{{ formatRibuan(rand(50, 200)) }}" footer="Mahasiswa terdaftar" color="black">
                </x-card.summary>
            </div>

            <!-- Card for Assignment Graded -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-4 mb-2">
                <x-card.summary header="Assign Udah Dinilai" value="{{ formatRibuan(rand(10, 50)) }}" footer="Assignment yang sudah dinilai" color="black">
                </x-card.summary>
            </div>

            <!-- Card for Assignment Not Graded -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-4 mb-2">
                <x-card.summary header="Assign Belum Dinilai" value="{{ formatRibuan(rand(5, 30)) }}" footer="Assignment yang belum dinilai" color="black">
                </x-card.summary>
            </div>

            <!-- Card for Total Courses -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-4 mb-2">
                <x-card.summary header="Total Mata Kuliah" value="{{ formatRibuan(rand(5, 15)) }}" footer="Jumlah mata kuliah aktif" color="black">
                </x-card.summary>
            </div>
        </div>
    </div>

    <!-- Pie Chart (Positioned to the Right) -->
    <div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xxl-5">
        <div class="card">
            <div class="card-header" style="font-size: 1.25rem; padding: 15px;">
                <strong>Distribusi Nilai Assignment</strong>
            </div>
            <div class="card-body">
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Assignment List Section: Tabel berada di bawah -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header" style="font-size: 1.25rem; padding: 15px;">
                <strong>Assignment Terbaru</strong>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 40%;">Judul Assignment</th>
                            <th style="width: 30%;">Deadline</th>
                            <th style="width: 30%;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // Generate random data for assignments
                            $assignments = [
                                ['title' => 'Assignment 1', 'deadline' => '2026-03-10', 'score' => rand(60, 100)],
                                ['title' => 'Assignment 2', 'deadline' => '2026-03-15', 'score' => null],
                                ['title' => 'Assignment 3', 'deadline' => '2026-03-20', 'score' => rand(50, 95)],
                                ['title' => 'Assignment 4', 'deadline' => '2026-03-25', 'score' => null],
                                ['title' => 'Assignment 5', 'deadline' => '2026-03-30', 'score' => rand(70, 100)],
                            ];
                        @endphp

                        @foreach($assignments as $assignment)
                            <tr>
                                <td>{{ $assignment['title'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($assignment['deadline'])->format('d-m-Y') }}</td>
                                <td>
                                    @if($assignment['score'] !== null)
                                        <span class="badge bg-success">Dinilai</span>
                                    @else
                                        <span class="badge bg-warning">Belum Dinilai</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Bar Chart Section -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header" style="font-size: 1.25rem; padding: 15px;">
                <strong>Statistik Assignment (Dinilai vs Belum Dinilai)</strong>
            </div>
            <div class="card-body">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Pie Chart
    var ctxPie = document.getElementById('pieChart').getContext('2d');
    var pieChart = new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: ['Nilai Tertinggi', 'Nilai Menengah', 'Nilai Rendah'],
            datasets: [{
                label: 'Distribusi Nilai Assignment',
                data: [30, 50, 20],  // data random
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'], // modern colors
                borderColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            aspectRatio: 1,  // Mengatur aspect ratio menjadi 1:1 untuk membuat lingkaran lebih kecil
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            size: 14
                        }
                    }
                },
            }
        }
    });

    // Bar Chart
    var ctxBar = document.getElementById('barChart').getContext('2d');
    var barChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: ['Assign 1', 'Assign 2', 'Assign 3', 'Assign 4', 'Assign 5'],
            datasets: [{
                label: 'Nilai Assignment',
                data: [85, 60, 70, 50, 90],  // data random untuk nilai
                backgroundColor: '#4e73df', // blue color for bars
                borderColor: '#4e73df',
                borderWidth: 2,
                borderRadius: 5, // Rounded bars for modern look
                barPercentage: 0.6 // Menyesuaikan ketebalan batang
            }]
        },
        options: {
            responsive: true,
            aspectRatio: 1.5,  // Menyesuaikan lebar dan tinggi grafik batang
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 10
                    },
                    grid: {
                        display: true,
                        color: 'rgba(0, 0, 0, 0.1)', // lighter grid lines
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
@endsection
