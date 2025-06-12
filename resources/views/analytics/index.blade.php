@extends('layouts.app')
@section('title', 'Analytics')

@section('content')
<div class="container">
        <!-- Header -->
        <div class="dashboard-header">
            <h1 class="dashboard-title">
                <i class="fas fa-chart-line"></i> Analytics Dashboard
            </h1>
            <p class="dashboard-subtitle">Monitor your portfolio performance and transaction activity</p>
        </div>

        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card balance">
                <div class="stat-header">
                    <div class="stat-icon" style="background: linear-gradient(135deg, var(--success), #059669);">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        +12.5%
                    </div>
                </div>
                <div class="stat-value">$24,567.89</div>
                <div class="stat-label">Total Balance</div>
            </div>

            <div class="stat-card assets">
                <div class="stat-header">
                    <div class="stat-icon" style="background: linear-gradient(135deg, var(--primary), var(--secondary));">
                        <i class="fas fa-coins"></i>
                    </div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        +3
                    </div>
                </div>
                <div class="stat-value">8</div>
                <div class="stat-label">Assets Held</div>
            </div>

            <div class="stat-card transactions">
                <div class="stat-header">
                    <div class="stat-icon" style="background: linear-gradient(135deg, var(--warning), #d97706);">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                    <div class="stat-change negative">
                        <i class="fas fa-arrow-down"></i>
                        -2.1%
                    </div>
                </div>
                <div class="stat-value">156</div>
                <div class="stat-label">Recent Transactions</div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="charts-section">
            <!-- Transaction Volume Chart -->
            <div class="chart-container">
                <div class="chart-header">
                    <h3 class="chart-title">Transaction Volume</h3>
                    <div class="chart-controls">
                        <button class="chart-btn active" onclick="updateChart('1M')">1M</button>
                        <button class="chart-btn" onclick="updateChart('3M')">3M</button>
                        <button class="chart-btn" onclick="updateChart('6M')">6M</button>
                        <button class="chart-btn" onclick="updateChart('1Y')">1Y</button>
                    </div>
                </div>
                <div class="chart-placeholder">
                    <canvas id="transactionVolumeChart"></canvas>
                </div>
            </div>

            <!-- Asset Allocation Chart -->
            <div class="chart-container">
                <div class="chart-header">
                    <h3 class="chart-title">Asset Allocation</h3>
                </div>
                <div class="chart-placeholder">
                    <canvas id="assetAllocationChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="transactions-section">
            <div class="section-header">
                <h3 class="section-title">Recent Transactions</h3>
                <a href="#" class="btn-primary">
                    <i class="fas fa-external-link-alt"></i>
                    View All
                </a>
            </div>
            <div class="table-container">
                <table class="table">
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
                    <tbody id="transactionsTable">
                        <tr>
                            <td>#TXN001</td>
                            <td>BTC</td>
                            <td>Buy</td>
                            <td>0.00547821</td>
                            <td>2025-06-10 14:32</td>
                            <td><span class="status-badge status-completed">Completed</span></td>
                        </tr>
                        <tr>
                            <td>#TXN002</td>
                            <td>ETH</td>
                            <td>Sell</td>
                            <td>2.45000000</td>
                            <td>2025-06-10 13:15</td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                        </tr>
                        <tr>
                            <td>#TXN003</td>
                            <td>ADA</td>
                            <td>Buy</td>
                            <td>1000.00000000</td>
                            <td>2025-06-10 12:08</td>
                            <td><span class="status-badge status-completed">Completed</span></td>
                        </tr>
                        <tr>
                            <td>#TXN004</td>
                            <td>DOT</td>
                            <td>Buy</td>
                            <td>50.00000000</td>
                            <td>2025-06-10 11:45</td>
                            <td><span class="status-badge status-failed">Failed</span></td>
                        </tr>
                        <tr>
                            <td>#TXN005</td>
                            <td>SOL</td>
                            <td>Sell</td>
                            <td>15.75000000</td>
                            <td>2025-06-10 10:22</td>
                            <td><span class="status-badge status-completed">Completed</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Sample data for charts
        const transactionData = {
            '1M': {
                labels: ['Jun 1', 'Jun 5', 'Jun 8', 'Jun 10', 'Jun 12', 'Jun 15', 'Jun 18'],
                data: [4200, 5100, 4800, 6200, 5900, 7100, 6800]
            },
            '3M': {
                labels: ['Apr', 'May', 'Jun'],
                data: [15000, 18000, 22000]
            },
            '6M': {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                data: [12000, 14000, 13500, 15000, 18000, 22000]
            },
            '1Y': {
                labels: ['Q1 2024', 'Q2 2024', 'Q3 2024', 'Q4 2024'],
                data: [35000, 42000, 48000, 55000]
            }
        };

        // Transaction Volume Chart
        const ctxVolume = document.getElementById('transactionVolumeChart').getContext('2d');
        let volumeChart = new Chart(ctxVolume, {
            type: 'line',
            data: {
                labels: transactionData['1M'].labels,
                datasets: [{
                    label: 'Transaction Volume ($)',
                    data: transactionData['1M'].data,
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    pointBackgroundColor: '#667eea',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#64748b'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#e2e8f0'
                        },
                        ticks: {
                            color: '#64748b',
                            callback: function(value) {
                                return '$' + value.toLocaleString();
                            }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });

        // Asset Allocation Chart
        const ctxAllocation = document.getElementById('assetAllocationChart').getContext('2d');
        new Chart(ctxAllocation, {
            type: 'doughnut',
            data: {
                labels: ['BTC', 'ETH', 'ADA', 'DOT', 'SOL'],
                datasets: [{
                    data: [35, 25, 15, 15, 10],
                    backgroundColor: [
                        '#667eea',
                        '#764ba2',
                        '#10b981',
                        '#f59e0b',
                        '#ef4444'
                    ],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            font: {
                                size: 12,
                                weight: '500'
                            }
                        }
                    }
                },
                cutout: '70%'
            }
        });

        // Chart controls functionality
        function updateChart(period) {
            // Update active button
            document.querySelectorAll('.chart-btn').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            // Update chart data
            const newData = transactionData[period];
            volumeChart.data.labels = newData.labels;
            volumeChart.data.datasets[0].data = newData.data;
            volumeChart.update('active');
        }

        // Add hover effects to stat cards
        document.querySelectorAll('.stat-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Add click animation to table rows
        document.querySelectorAll('.table tr').forEach(row => {
            row.addEventListener('click', function() {
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 150);
            });
        });
    </script>
@endsection