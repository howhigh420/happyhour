@extends('layouts.app')
@section('title', 'Wallet')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold text-dark mb-1">
                        <i class="fas fa-wallet text-primary me-2"></i>My Wallet
                    </h2>
                    <p class="text-muted mb-0">Manage your digital assets</p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary">
                        <i class="fas fa-plus me-1"></i> Add Funds
                    </button>
                    <button class="btn btn-primary">
                        <i class="fas fa-paper-plane me-1"></i> Send
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Balance Cards Section -->
    <div class="row mb-4">
        @if($balances->isEmpty())
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <div class="mb-3">
                            <i class="fas fa-coins text-muted" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="text-muted mb-2">No Assets Yet</h5>
                        <p class="text-muted mb-3">Start by adding some cryptocurrency to your wallet</p>
                        <button class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i> Add Your First Asset
                        </button>
                    </div>
                </div>
            </div>
        @else
            @foreach($balances as $balance)
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card border-0 shadow-sm h-100 wallet-balance-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="crypto-icon me-3">
                                    @if(strtolower($balance->asset->symbol) == 'btc')
                                        <i class="fab fa-bitcoin text-warning"></i>
                                    @elseif(strtolower($balance->asset->symbol) == 'eth')
                                        <i class="fab fa-ethereum text-info"></i>
                                    @else
                                        <i class="fas fa-coins text-primary"></i>
                                    @endif
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">{{ $balance->asset->symbol }}</h6>
                                    <small class="text-muted">{{ $balance->asset->name ?? 'Cryptocurrency' }}</small>
                                </div>
                            </div>
                            <div class="balance-amount">
                                <h4 class="fw-bold text-dark mb-1">{{ number_format($balance->amount, 8) }}</h4>
                                <small class="text-muted">≈ ${{ number_format($balance->amount * 50000, 2) }}</small>
                            </div>
                            <div class="mt-3 pt-3 border-top">
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-sm btn-outline-primary flex-fill me-1">
                                        <i class="fas fa-arrow-down me-1"></i> Receive
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary flex-fill ms-1">
                                        <i class="fas fa-arrow-up me-1"></i> Send
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Recent Transactions Section -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0 fw-bold">
                                <i class="fas fa-history text-primary me-2"></i>Recent Transactions
                            </h5>
                            <small class="text-muted">Your latest Bitcoin deposits</small>
                        </div>
                        <button class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-eye me-1"></i> View All
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($transactions->isEmpty())
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="fas fa-receipt text-muted" style="font-size: 2.5rem;"></i>
                            </div>
                            <h6 class="text-muted mb-2">No Recent Transactions</h6>
                            <p class="text-muted mb-0">Your transaction history will appear here</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-0 fw-semibold text-muted">Date & Time</th>
                                        <th class="border-0 fw-semibold text-muted">Asset</th>
                                        <th class="border-0 fw-semibold text-muted">Amount</th>
                                        <th class="border-0 fw-semibold text-muted">Address</th>
                                        <th class="border-0 fw-semibold text-muted">Status</th>
                                        <th class="border-0"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transactions as $transaction)
                                        <tr class="transaction-row">
                                            <td class="border-0 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="transaction-icon me-2">
                                                        <i class="fas fa-arrow-down text-success"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-medium">{{ $transaction->created_at->format('M d, Y') }}</div>
                                                        <small class="text-muted">{{ $transaction->created_at->format('H:i') }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="border-0 py-3">
                                                <div class="d-flex align-items-center">
                                                    @if(strtolower($transaction->asset->symbol) == 'btc')
                                                        <i class="fab fa-bitcoin text-warning me-2"></i>
                                                    @else
                                                        <i class="fas fa-coins text-primary me-2"></i>
                                                    @endif
                                                    <span class="fw-medium">{{ $transaction->asset->symbol }}</span>
                                                </div>
                                            </td>
                                            <td class="border-0 py-3">
                                                <div class="fw-medium text-success">+{{ number_format($transaction->amount, 8) }}</div>
                                                <small class="text-muted">≈ ${{ number_format($transaction->amount * 50000, 2) }}</small>
                                            </td>
                                            <td class="border-0 py-3">
                                                @if($transaction->address)
                                                    <code class="bg-light px-2 py-1 rounded small">
                                                        {{ Str::limit($transaction->address, 12) }}...
                                                    </code>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td class="border-0 py-3">
                                                @php
                                                    $statusClass = match(strtolower($transaction->status)) {
                                                        'completed' => 'success',
                                                        'pending' => 'warning',
                                                        'failed' => 'danger',
                                                        default => 'secondary'
                                                    };
                                                @endphp
                                                <span class="badge bg-{{ $statusClass }} bg-opacity-10 text-{{ $statusClass }} px-2 py-1">
                                                    {{ ucfirst($transaction->status) }}
                                                </span>
                                            </td>
                                            <td class="border-0 py-3">
                                                <button class="btn btn-sm btn-ghost-primary">
                                                    <i class="fas fa-external-link-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection