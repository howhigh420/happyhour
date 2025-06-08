@extends('layouts.app')
  @section('content')
  <div class="card">
      <div class="card-header">Deposit Crypto</div>
      <div class="card-body">
          <form method="POST" action="{{ route('deposit.crypto') }}">
              @csrf
              <div class="mb-3">
                  <label for="asset" class="form-label">Asset</label>
                  <select class="form-select" name="asset" required>
                      @foreach($assets as $asset)
                          <option value="{{ $asset->id }}">{{ $asset->symbol }}</option>
                      @endforeach
                  </select>
              </div>
              <button type="submit" class="btn btn-primary">Generate Address</button>
          </form>
          @if(session('address'))
              <p class="mt-3">Bitcoin Address: <code>{{ session('address') }}</code></p>
              <p class="text-warning">Share this address securely via an encrypted channel like Signal. Do not reuse this address.</p>
              <p class="text-success">{{ session('success') }}</p>
          @endif
      </div>
  </div>
  @endsection