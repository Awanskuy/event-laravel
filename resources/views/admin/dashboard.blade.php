@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Admin Dashboard</h2>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-primary shadow h-100 border-0">
            <div class="card-body">
                <h5 class="card-title">Total Events</h5>
                <h2 class="display-4 fw-bold">{{ $stats['total_events'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-success shadow h-100 border-0">
            <div class="card-body">
                <h5 class="card-title">Tickets Sold</h5>
                <h2 class="display-4 fw-bold">{{ $stats['tickets_sold'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-info shadow h-100 border-0">
            <div class="card-body">
                <h5 class="card-title">Registered Users</h5>
                <h2 class="display-4 fw-bold">{{ $stats['total_users'] }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="mb-4">System Overview</h5>
                <canvas id="dashboardChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('dashboardChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Events', 'Tickets Sold', 'Users'],
                datasets: [{
                    label: 'System Stats',
                    data: [{{ $stats['total_events'] }}, {{ $stats['tickets_sold'] }}, {{ $stats['total_users'] }}],
                    backgroundColor: [
                        'rgba(13, 110, 253, 0.7)',
                        'rgba(25, 135, 84, 0.7)',
                        'rgba(13, 202, 240, 0.7)'
                    ],
                    borderColor: [
                        'rgba(13, 110, 253, 1)',
                        'rgba(25, 135, 84, 1)',
                        'rgba(13, 202, 240, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endpush
