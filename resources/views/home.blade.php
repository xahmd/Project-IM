@extends('layouts.app')

@section('content')





@if(Auth::user()->role == 'Admin')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4 text-center">Admin Dashboard</h1>
        </div>
    </div>

    <!-- Analytics Summary -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Total Admins</h5>
                    <p class="card-text display-4">{{ $totalAdmins }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Total Staff</h5>
                    <p class="card-text display-4">{{ $totalStaff }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Total Leaves</h5>
                    <p class="card-text display-4">{{ $totalLeaves }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Leaves by Status</div>
                <div class="card-body">
                    <canvas id="leavesStatusChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Leave Applications Over Time</div>
                <div class="card-body">
                    <canvas id="leavesOverTimeChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const leavesStatusChart = new Chart(document.getElementById('leavesStatusChart').getContext('2d'), {
        type: 'pie',
        data: {
            labels: ['Approved', 'Pending', 'Rejected'],
            datasets: [{
                data: [{{ $approvedLeaves }}, {{ $pendingLeaves }}, {{ $rejectedLeaves }}],
                backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
            }]
        },
        options: {
            responsive: true
        }
    });

    const leavesOverTimeChart = new Chart(document.getElementById('leavesOverTimeChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: {!! json_encode($monthlyLeaveLabels) !!},
            datasets: [{
                label: 'Leave Applications',
                data: {!! json_encode($monthlyLeaveData) !!},
                borderColor: '#007bff',
                fill: false
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
@endsection
@elseif(Auth::user()->role == 'LineManager')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard for Line Managers</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome {{Auth::user()->firstName }}  {{Auth::user()->lastName}} <br />
                    {{-- Welcome {{Auth::user()->firstName }}  {{Auth::user()->lastName}} <br />
                    Welcome {{Auth::user()->firstName }}  {{Auth::user()->lastName}} <br /> --}}
                    
                </div>
            </div>
        </div>
    </div>
</div>



@else
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4>Dashboard for Regular Staff</h4>
                </div>
                <div class="card-body">
                    <h5 class="mb-4">Welcome, {{ Auth::user()->firstName }} {{ Auth::user()->lastName }}!</h5>
                    
                    <div class="row">
                        <!-- Leave Balance -->
                        <div class="col-md-6">
                            <div class="card bg-light mb-3">
                                <div class="card-header"><strong>Leave Balance</strong></div>
                                <div class="card-body">
                                    <p class="card-text">
                                        You currently have <strong>{{ Auth::user()->leavebalance }}</strong> days of leave remaining.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Notifications -->
                        <div class="col-md-6">
                            <div class="card bg-light mb-3">
                                <div class="card-header"><strong>Notifications</strong></div>
                                <div class="card-body">
                                    <p class="card-text">
                                        No new notifications at the moment.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <!-- Apply for Leave -->
                        <div class="col-md-6 text-center">
                            <a href="{{ url('/createleave') }}" class="btn btn-success btn-lg btn-block shadow">
                                <i class="fas fa-paper-plane"></i> Apply for Leave
                            </a>
                        </div>

                        <!-- Leave History -->
                        <div class="col-md-6 text-center">
                            <a href="{{ url('/staff/approval') }}" class="btn btn-info btn-lg btn-block shadow">
                                <i class="fas fa-history"></i> Leave History
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endif

@endsection
