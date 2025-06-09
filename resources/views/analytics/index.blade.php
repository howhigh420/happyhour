@extends('layouts.app')
@section('title', 'Analytics')

@section('content')
<div class="container py-5 dashboard-content">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header -->
            <div class="card glass shadow-lg mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Analytics Dashboard</h4>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="stats-grid mb-4">
                <div class="stat-card glass">
                    <div class="stat-icon" style="background: linear-gradient(135deg, var(--success), #059669);">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div class="stat-value pulse">${{ number_format($totalBalance, 2) }}</div>
                    <div class="stat-label">Total Balance</div>
                </div>
                <div class="stat-card glass">
                    <div class="stat-icon" style="background: linear-gradient(135deg, var(--primary), var(--secondary));">
                        <i class="fas fa-coins"></i>
                    </div>
                    <div class="stat-value">{{ count($balances) }}</div>
                    <div class="stat-label">Assets Held</div>
                </div>
                <div class="stat-card glass">
                    <div class="stat-icon" style="background: linear-gradient(135deg, var(--warning), #d97706);">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                    <div class="stat-value">{{ count($recentTransactions) }}</div>
                    <div class="stat-label">Recent Transactions</div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="charts-section mb-4">
                <!-- Transaction Volume Chart -->
                <div class="chart-container glass">
                    <div class="chart-header">
                        <h3 class="chart-title">Transaction Volume (30 Days)</h3>
                        <div class="chart-controls">
                            <button class="chart-btn active">1M</button>
                            <button class="chart-btn">3M</button>
                            <button class="chart-btn">6M</button>
                        </div>
                    </div>
                    <div class="chart-placeholder">
                        <canvas id="transactionVolumeChart"></canvas>
                    </div>
                </div>

                <!-- Asset Allocation Chart -->
                <div class="chart-container glass">
                    <div class="chart-header">
                        <h3 class="chart-title">Asset Allocation</h3>
                    </div>
                    <div class="chart-placeholder">
                        <canvas id="assetAllocationChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions -->
            <div class="transactions-section glass">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3>Recent Transactions</h3>
                    <a href="{{ route('history') }}" class="btn btn-primary">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table transactions-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Asset</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentTransactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->id }}</td>
                                    <td>{{ $transaction->asset->symbol ?? 'N/A' }}</td>
                                    <td>{{ ucfirst($transaction->type) }}</td>
                                    <td>{{ number_format($transaction->amount, 8) }}</td>
                                    <td>{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                                    <td><span class="status-badge status-{{ $transaction->status }}">{{ ucfirst($transaction->status) }}</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No recent transactions.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
 .transaction-type-sell { background-color: #fff3cd; color: #856404; }

.status-completed { background-color: #d4edda; color: #155724; }
.status-pending { background-color: #fff3cd; color: #856404; }
.status-failed { background-color: #f8d7da; color: #721c24; }

.transaction-row:hover {
    background-color: rgba(0, 123, 255, 0.05);
    cursor: pointer;
}

.asset-icon img {
    object-fit: cover;
}

.empty-state {
    padding: 3rem 1rem;
}

.table th a {
    color: inherit !important;
}

.table th a:hover {
    color: var(--bs-primary) !important;
}
    </style>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.js"></script>
<script>
    // Transaction Volume Chart
    const ctxVolume = document.getElementById('transactionVolumeChart').getContext('2d');
    new Chart(ctxVolume, {
        type: 'line',
        data: {
            labels: @json($transactionVolume->keys()),
            datasets: [{
                label: 'Transaction Volume',
                data: @json($transactionVolume->values()),
                borderColor: '#1a73e8',
                backgroundColor: 'rgba(26, 115, 232, 0.1)',
                fill: true,
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: { title: { display: true, text: 'Date' } },
                y: { title: { display: true, text: 'Amount' }, beginAtZero: true }
            }
        }
    });

    // Asset Allocation Chart
    const ctxAllocation = document.getElementById('assetAllocationChart').getContext('2d');
    new Chart(ctxAllocation, {
        type: 'pie',
        data: {
            labels: @json($assetAllocation->keys()),
            datasets: [{
                data: @json($assetAllocation->values()),
                backgroundColor: ['#1a73e8', '#34c38f', '#f1b44c', '#ff6b6b', '#6c757d'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' }
            }
        }
    });
</script>
@endsection