@extends('layouts.app')
  @section('title', 'Portfolio')
  @section('content')
  <div class="row">
      <div class="col-12">
          <div class="card mb-4">
              <div class="card-header bg-primary text-white">
                  <h4 class="mb-0">Your Portfolio</h4>
              </div>
              <div class="card-body">
                  @if($balances->isEmpty())
                      <div class="alert alert-info">No assets in your portfolio yet.</div>
                  @else
                      <div class="table-responsive">
                          <table class="table table-hover">
                              <thead>
                                  <tr>
                                      <th>Asset</th>
                                      <th>Amount</th>
                                      <th>Estimated Value (USD)</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach($balances as $balance)
                                      <tr>
                                          <td>{{ $balance->asset->symbol }}</td>
                                          <td>{{ number_format($balance->amount, 8) }}</td>
                                          <td>$0.00</td> <!-- Placeholder for future price integration -->
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
  @endsection