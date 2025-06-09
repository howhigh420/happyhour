@extends('layouts.app')
@section('title', 'Transaction History')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1 fw-bold text-dark">
                        <i class="fas fa-history text-primary me-2"></i>Transaction History
                    </h2>
                    <p class="text-muted mb-0">Track all your trading activities and transactions</p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exportModal">
                        <i class="fas fa-download me-2"></i>Export
                    </button>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-2"></i>Dashboard
                    </a>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                        <i class="fas fa-arrow-up text-success"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="text-muted mb-1">Total Deposits</h6>
                                    <h4 class="mb-0 fw-bold">{{ $stats['total_deposits'] ?? '0' }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                                        <i class="fas fa-arrow-down text-danger"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="text-muted mb-1">Total Withdrawals</h6>
                                    <h4 class="mb-0 fw-bold">{{ $stats['total_withdrawals'] ?? '0' }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-info bg-opacity-10 rounded-circle p-3">
                                        <i class="fas fa-exchange-alt text-info"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="text-muted mb-1">Total Trades</h6>
                                    <h4 class="mb-0 fw-bold">{{ $stats['total_trades'] ?? '0' }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                                        <i class="fas fa-clock text-warning"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="text-muted mb-1">Pending</h6>
                                    <h4 class="mb-0 fw-bold">{{ $stats['pending_transactions'] ?? '0' }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="mb-0 fw-semibold">All Transactions</h5>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#filtersCollapse">
                                <i class="fas fa-filter me-1"></i>Filters
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Filters -->
                <div class="collapse" id="filtersCollapse">
                    <div class="card-body border-bottom bg-light">
                        <form method="GET" action="{{ route('history') }}" id="filterForm">
                            <div class="row g-3">
                                <div class="col-lg-2 col-md-4">
                                    <label class="form-label small text-muted">Transaction Type</label>
                                    <select name="type" class="form-select form-select-sm">
                                        <option value="">All Types</option>
                                        <option value="deposit" {{ request('type') == 'deposit' ? 'selected' : '' }}>
                                            <i class="fas fa-arrow-down"></i> Deposit
                                        </option>
                                        <option value="withdrawal" {{ request('type') == 'withdrawal' ? 'selected' : '' }}>
                                            <i class="fas fa-arrow-up"></i> Withdrawal
                                        </option>
                                        <option value="buy" {{ request('type') == 'buy' ? 'selected' : '' }}>
                                            <i class="fas fa-shopping-cart"></i> Buy
                                        </option>
                                        <option value="sell" {{ request('type') == 'sell' ? 'selected' : '' }}>
                                            <i class="fas fa-tag"></i> Sell
                                        </option>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-4">
                                    <label class="form-label small text-muted">Asset</label>
                                    <select name="asset" class="form-select form-select-sm">
                                        <option value="">All Assets</option>
                                        @foreach($assets as $asset)
                                            <option value="{{ $asset->symbol }}" {{ request('asset') == $asset->symbol ? 'selected' : '' }}>
                                                {{ $asset->symbol }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-4">
                                    <label class="form-label small text-muted">Status</label>
                                    <select name="status" class="form-select form-select-sm">
                                        <option value="">All Status</option>
                                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <label class="form-label small text-muted">From Date</label>
                                    <input type="date" name="date_from" class="form-control form-control-sm" value="{{ request('date_from') }}">
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <label class="form-label small text-muted">To Date</label>
                                    <input type="date" name="date_to" class="form-control form-control-sm" value="{{ request('date_to') }}">
                                </div>
                                <div class="col-lg-2 col-md-12">
                                    <label class="form-label small text-muted">&nbsp;</label>
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary btn-sm flex-fill">
                                            <i class="fas fa-search me-1"></i>Apply
                                        </button>
                                        <a href="{{ route('history') }}" class="btn btn-outline-secondary btn-sm">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-body p-0">
                    <!-- Enhanced Transactions Table -->
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0 fw-semibold text-muted small">
                                        <a href="#" class="text-decoration-none text-muted">
                                            ID <i class="fas fa-sort text-xs"></i>
                                        </a>
                                    </th>
                                    <th class="border-0 fw-semibold text-muted small">Asset</th>
                                    <th class="border-0 fw-semibold text-muted small">Type</th>
                                    <th class="border-0 fw-semibold text-muted small text-end">Amount</th>
                                    <th class="border-0 fw-semibold text-muted small">
                                        <a href="#" class="text-decoration-none text-muted">
                                            Date <i class="fas fa-sort text-xs"></i>
                                        </a>
                                    </th>
                                    <th class="border-0 fw-semibold text-muted small">Status</th>
                                    <th class="border-0 fw-semibold text-muted small text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $transaction)
                                    <tr class="transaction-row" data-transaction-id="{{ $transaction->id }}">
                                        <td class="align-middle">
                                            <span class="font-monospace small text-muted">#{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center">
                                                @if($transaction->asset)
                                                    <div class="asset-icon me-2">
                                                        <img src="{{ asset('images/crypto/' . strtolower($transaction->asset->symbol) . '.png') }}" 
                                                             alt="{{ $transaction->asset->symbol }}" 
                                                             class="rounded-circle" 
                                                             width="24" height="24"
                                                             onerror="this.src='{{ asset('images/crypto/default.png') }}'">
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold">{{ $transaction->asset->symbol }}</div>
                                                        <small class="text-muted">{{ $transaction->asset->name ?? '' }}</small>
                                                    </div>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge transaction-type-{{ $transaction->type }} rounded-pill">
                                                @switch($transaction->type)
                                                    @case('deposit')
                                                        <i class="fas fa-arrow-down me-1"></i>Deposit
                                                        @break
                                                    @case('withdrawal')
                                                        <i class="fas fa-arrow-up me-1"></i>Withdrawal
                                                        @break
                                                    @case('buy')
                                                        <i class="fas fa-shopping-cart me-1"></i>Buy
                                                        @break
                                                    @case('sell')
                                                        <i class="fas fa-tag me-1"></i>Sell
                                                        @break
                                                    @default
                                                        {{ ucfirst($transaction->type) }}
                                                @endswitch
                                            </span>
                                        </td>
                                        <td class="align-middle text-end">
                                            <div class="fw-semibold">{{ number_format($transaction->amount, 8) }}</div>
                                            @if($transaction->usd_value)
                                                <small class="text-muted">${{ number_format($transaction->usd_value, 2) }}</small>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            <div>{{ $transaction->created_at->format('M d, Y') }}</div>
                                            <small class="text-muted">{{ $transaction->created_at->format('H:i A') }}</small>
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge status-{{ $transaction->status }} rounded-pill">
                                                @switch($transaction->status)
                                                    @case('completed')
                                                        <i class="fas fa-check-circle me-1"></i>Completed
                                                        @break
                                                    @case('pending')
                                                        <i class="fas fa-clock me-1"></i>Pending
                                                        @break
                                                    @case('failed')
                                                        <i class="fas fa-times-circle me-1"></i>Failed
                                                        @break
                                                    @default
                                                        {{ ucfirst($transaction->status) }}
                                                @endswitch
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-outline-primary btn-sm" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#transactionModal{{ $transaction->id }}"
                                                        title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                @if($transaction->type == 'withdrawal' && $transaction->txid)
                                                    <a href="#" class="btn btn-outline-secondary btn-sm" title="View on Blockchain">
                                                        <i class="fas fa-external-link-alt"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <div class="empty-state">
                                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                                <h5 class="text-muted">No transactions found</h5>
                                                <p class="text-muted">Try adjusting your filters or make your first transaction</p>
                                                <a href="{{ route('dashboard') }}" class="btn btn-primary">
                                                    <i class="fas fa-plus me-2"></i>Start Trading
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Enhanced Pagination -->
                    @if($transactions->hasPages())
                        <div class="card-footer bg-white border-top">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-muted small">
                                    Showing {{ $transactions->firstItem() }} to {{ $transactions->lastItem() }} 
                                    of {{ $transactions->total() }} results
                                </div>
                                <div>
                                    {{ $transactions->appends(request()->query())->links() }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Transaction Details Modal -->
@foreach($transactions as $transaction)
    <div class="modal fade" id="transactionModal{{ $transaction->id }}" tabindex="-1" aria-labelledby="transactionModalLabel{{ $transaction->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-bottom">
                    <div>
                        <h5 class="modal-title mb-1" id="transactionModalLabel{{ $transaction->id }}">
                            Transaction Details
                        </h5>
                        <small class="text-muted">ID: #{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</small>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border-0 bg-light h-100">
                                <div class="card-body">
                                    <h6 class="card-title text-muted mb-3">Transaction Info</h6>
                                    <dl class="row mb-0">
                                        <dt class="col-5 small text-muted">Asset:</dt>
                                        <dd class="col-7 small">
                                            @if($transaction->asset)
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('images/crypto/' . strtolower($transaction->asset->symbol) . '.png') }}" 
                                                         alt="{{ $transaction->asset->symbol }}" 
                                                         class="rounded-circle me-2" 
                                                         width="20" height="20"
                                                         onerror="this.src='{{ asset('images/crypto/default.png') }}'">
                                                    {{ $transaction->asset->symbol }}
                                                </div>
                                            @else
                                                N/A
                                            @endif
                                        </dd>
                                        <dt class="col-5 small text-muted">Type:</dt>
                                        <dd class="col-7 small">
                                            <span class="badge transaction-type-{{ $transaction->type }} rounded-pill">
                                                {{ ucfirst($transaction->type) }}
                                            </span>
                                        </dd>
                                        <dt class="col-5 small text-muted">Amount:</dt>
                                        <dd class="col-7 small fw-semibold">{{ number_format($transaction->amount, 8) }}</dd>
                                        <dt class="col-5 small text-muted">Status:</dt>
                                        <dd class="col-7 small">
                                            <span class="badge status-{{ $transaction->status }} rounded-pill">
                                                {{ ucfirst($transaction->status) }}
                                            </span>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 bg-light h-100">
                                <div class="card-body">
                                    <h6 class="card-title text-muted mb-3">Additional Details</h6>
                                    <dl class="row mb-0">
                                        <dt class="col-5 small text-muted">Date:</dt>
                                        <dd class="col-7 small">{{ $transaction->created_at->format('M d, Y H:i A') }}</dd>
                                        @if($transaction->address)
                                            <dt class="col-5 small text-muted">Address:</dt>
                                            <dd class="col-7 small">
                                                <code class="small bg-white p-1 rounded">
                                                    {{ substr($transaction->address, 0, 20) }}...
                                                </code>
                                                <button class="btn btn-sm btn-link p-0" onclick="copyToClipboard('{{ $transaction->address }}')">
                                                    <i class="fas fa-copy"></i>
                                                </button>
                                            </dd>
                                        @endif
                                        @if($transaction->txid)
                                            <dt class="col-5 small text-muted">TX ID:</dt>
                                            <dd class="col-7 small">
                                                <code class="small bg-white p-1 rounded">
                                                    {{ substr($transaction->txid, 0, 20) }}...
                                                </code>
                                                <button class="btn btn-sm btn-link p-0" onclick="copyToClipboard('{{ $transaction->txid }}')">
                                                    <i class="fas fa-copy"></i>
                                                </button>
                                            </dd>
                                        @endif
                                        @if($transaction->fee)
                                            <dt class="col-5 small text-muted">Fee:</dt>
                                            <dd class="col-7 small">{{ number_format($transaction->fee, 8) }}</dd>
                                        @endif
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @if($transaction->type == 'withdrawal' && $transaction->txid)
                        <a href="#" class="btn btn-primary">
                            <i class="fas fa-external-link-alt me-2"></i>View on Blockchain
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach

<!-- Export Modal -->
<div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="exportModalLabel">Export Transactions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('history.export') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Export Format</label>
                        <select name="format" class="form-select" required>
                            <option value="csv">CSV File</option>
                            <option value="pdf">PDF Report</option>
                            <option value="excel">Excel Spreadsheet</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date Range</label>
                        <div class="row g-2">
                            <div class="col">
                                <input type="date" name="export_date_from" class="form-control" required>
                            </div>
                            <div class="col">
                                <input type="date" name="export_date_to" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="include_pending" id="includePending">
                            <label class="form-check-label" for="includePending">
                                Include pending transactions
                            </label>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-download me-2"></i>Export
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom Styles */
.transaction-type-deposit { background-color: #d4edda; color: #155724; }
.transaction-type-withdrawal { background-color: #f8d7da; color: #721c24; }
.transaction-type-buy { background-color: #d1ecf1; color: #0c5460; }
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

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show toast or notification
        const toast = document.createElement('div');
        toast.className = 'toast align-items-center text-white bg-success border-0 position-fixed top-0 end-0 m-3';
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-check me-2"></i>Copied to clipboard!
                </div>
            </div>
        `;
        document.body.appendChild(toast);
        const bsToast = new bootstrap.Toast(toast);
        bsToast.show();
        setTimeout(() => toast.remove(), 3000);
    });
}

// Auto-submit filters on change
document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('filterForm');
    const filterInputs = filterForm.querySelectorAll('select, input[type="date"]');
    
    filterInputs.forEach(input => {
        input.addEventListener('change', function() {
            if (this.value !== '') {
                filterForm.submit();
            }
        });
    });
});
</script>
@endsection