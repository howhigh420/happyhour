@extends('layouts.admin')
@section('title', 'View Transaction')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card glass">
                <div class="card-header">
                    <h4><i class="fas fa-exchange-alt me-2"></i>Transaction Details</h4>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">ID</dt><dd class="col-sm-9">{{ $transaction->id }}</dd>
                        <dt class="col-sm-3">User</dt><dd class="col-sm-9">{{ $transaction->user->name ?? 'N/A' }}</dd>
                        <dt class="col-sm-3">Asset</dt><dd class="col-sm-9">{{ $transaction->asset->symbol ?? 'N/A' }}</dd>
                        <dt class="col-sm-3">Type</dt><dd class="col-sm-9">{{ ucfirst($transaction->type) }}</dd>
                        <dt class="col-sm-3">Amount</dt><dd class="col-sm-9">{{ number_format($transaction->amount, 8) }}</dd>
                        <dt class="col-sm-3">Status</dt><dd class="col-sm-9">{{ ucfirst($transaction->status) }}</dd>
                        <dt class="col-sm-3">Address</dt><dd class="col-sm-9">{{ $transaction->address ?? 'N/A' }}</dd>
                        <dt class="col-sm-3">Created At</dt><dd class="col-sm-9">{{ $transaction->created_at->format('Y-m-d H:i') }}</dd>
                    </dl>
                    <a href="{{ route('admin.transactions.index') }}" class="btn btn-primary">Back to Transactions</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection