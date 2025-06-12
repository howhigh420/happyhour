@extends('layouts.admin')
@section('title', 'View Order')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card glass">
                <div class="card-header">
                    <h4><i class="fas fa-shopping-cart me-2"></i>Order Details</h4>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">ID</dt><dd class="col-sm-9">{{ $order->id }}</dd>
                        <dt class="col-sm-3">User</dt><dd class="col-sm-9">{{ $order->user->name ?? 'N/A' }}</dd>
                        <dt class="col-sm-3">Asset</dt><dd class="col-sm-9">{{ $order->asset->symbol ?? 'N/A' }}</dd>
                        <dt class="col-sm-3">Type</dt><dd class="col-sm-9">{{ ucfirst($order->type) }}</dd>
                        <dt class="col-sm-3">Amount</dt><dd class="col-sm-9">{{ number_format($order->amount, 8) }}</dd>
                        <dt class="col-sm-3">Price</dt><dd class="col-sm-9">{{ number_format($order->price, 2) }}</dd>
                        <dt class="col-sm-3">Status</dt><dd class="col-sm-9">{{ ucfirst($order->status) }}</dd>
                        <dt class="col-sm-3">Created At</dt><dd class="col-sm-9">{{ $order->created_at->format('Y-m-d H:i') }}</dd>
                    </dl>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-success">Back to Orders</a></dt>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection