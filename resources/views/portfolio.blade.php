@extends('layouts.app')

@section('content')
    <div class="dashboard-content">
        <h2>Portfolio Overview</h2>
        <p>View your current holdings, performance, and recent activity.</p>

        <!-- Statistics Cards (Optional, customize as needed) -->
        <div class="stats-grid">
            <div class="stat-card glass">
                <div class="stat-icon" style="background: linear-gradient(135deg, var(--success), #059669);">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="stat-value pulse">{{ auth()->user()->balance ?? '$47,352.89' }}</div>
                <div class="stat-label">Total Balance</div>
                <div class="stat-change change-positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>{{ auth()->user()->balance_change ?? '+12.5% from last month' }}</span>
                </div>
            </div>
            <div class="stat-card glass">
                <div class="stat-icon" style="background: linear-gradient(135deg, var(--primary), var(--secondary));">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-value pulse">{{ auth()->user()->portfolio_value ?? '$8,429.73' }}</div>
                <div class="stat-label">Portfolio Value</div>
                <div class="stat-change change-positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>{{ auth()->user()->portfolio_change ?? '+8.3% today' }}</span>
                </div>
            </div>
        </div>

        <!-- Recent Transactions (Reusing the same section as dashboard) -->
        <div class="transactions-section glass" style="padding: 2rem; border-radius: var(--border-radius);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <h3>Recent Transactions</h3>
                <a href="{{ route('history') }}" class="btn btn-primary">View All</a>
            </div>
            <table class="table transactions-table">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Asset</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->asset }}</td>
                            <td>{{ $transaction->type }}</td>
                            <td>{{ $transaction->amount }} ({{ $transaction->value }})</td>
                            <td>{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                            <td><span class="status-badge status-{{ $transaction->status }}">{{ ucfirst($transaction->status) }}</span></td>
                        </tr>
                    @endforeach
                    @if ($transactions->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center">No transactions found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection