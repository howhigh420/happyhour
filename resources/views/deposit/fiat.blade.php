@extends('layouts.app')
  @section('title', 'Deposit Fiat')
  @section('content')
  <div class="container py-5">
      <div class="row justify-content-center">
          <div class="col-md-6">
              <div class="card shadow-sm">
                  <div class="card-header bg-primary text-white finanza-header">
                      <h4 class="mb-0"><i class="fas fa-dollar-sign me-2"></i>Deposit Fiat (USD)</h4>
                  </div>
                  <div class="card-body">
                      <form method="POST" action="{{ route('deposit.fiat') }}" class="finanza-form">
                          @csrf
                          <div class="finanza-form-group mb-3">
                              <label for="amount" class="finanza-label">Amount (USD)</label>
                              <div class="input-group">
                                  <span class="input-group-text">$</span>
                                  <input type="number" class="finanza-input form-control @error('amount') is-invalid @enderror" id="amount" name="amount" step="0.01" value="{{ old('amount') }}" required>
                                  @error('amount')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                              </div>
                              <small class="form-text text-muted">Enter the amount you wish to deposit (minimum $1.00).</small>
                          </div>
                          <button type="submit" class="finanza-btn finanza-btn-primary btn-block">Deposit Now</button>
                      </form>
                      @if(session('success'))
                          <div class="alert alert-success mt-3">{{ session('success') }}</div>
                      @endif
                  </div>
              </div>
          </div>
      </div>
  </div>
  @endsection