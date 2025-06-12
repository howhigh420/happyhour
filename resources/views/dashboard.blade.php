@extends('layouts.app')
  @section('title', 'Dashboard')
  @section('content')
  <!-- Dashboard Content -->
  <div class="dashboard-content">
    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card glass">
            <div class="stat-icon" style="background: linear-gradient(135deg, var(--success), #059669);">
                <i class="fas fa-wallet"></i>
            </div>
            <div class="stat-value pulse">{{ $user->balance ?? '$47,352.89' }}</div>
            <div class="stat-label">Total Balance</div>
            <div class="stat-change change-positive">
                <i class="fas fa-arrow-up"></i>
                <span>{{ $user->balance_change ?? '+12.5% from last month' }}</span>
            </div>
        </div>
        
        <div class="stat-card glass">
            <div class="stat-icon" style="background: linear-gradient(135deg, var(--primary), var(--secondary));">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="stat-value pulse">{{ $user->portfolio_value ?? '$8,429.73' }}</div>
            <div class="stat-label">Portfolio Value</div>
            <div class="stat-change change-positive">
                <i class="fas fa-arrow-up"></i>
                <span>{{ $user->portfolio_change ?? '+8.3% today' }}</span>
            </div>
        </div>
        
        <div class="stat-card glass">
            <div class="stat-icon" style="background: linear-gradient(135deg, var(--warning), #d97706);">
                <i class="fas fa-coins"></i>
            </div>
            <div class="stat-value">{{ $user->active_positions ?? '24' }}</div>
            <div class="stat-label">Active Positions</div>
            <div class="stat-change change-positive">
                <i class="fas fa-arrow-up"></i>
                <span>{{ $user->position_change ?? '+3 new positions' }}</span>
            </div>
        </div>
        
        <div class="stat-card glass">
            <div class="stat-icon" style="background: linear-gradient(135deg, var(--info), #0284c7);">
                <i class="fas fa-percentage"></i>
            </div>
            <div class="stat-value">{{ $user->return_rate ?? '+18.7%' }}</div>
            <div class="stat-label">30-Day Return</div>
            <div class="stat-change change-positive">
                <i class="fas fa-arrow-up"></i>
                <span>{{ $user->return_change ?? '+2.1% from last period' }}</span>
            </div>
        </div>
    </div>

    <!-- Charts and Trading Panel -->
    <div class="charts-section">
        <div class="chart-container glass">
            <div class="chart-header">
                <h3 class="chart-title">Portfolio Performance</h3>
                <div class="chart-controls">
                    <button class="chart-btn active">1D</button>
                    <button class="chart-btn">7D</button>
                    <button class="chart-btn">1M</button>
                    <button class="chart-btn">3M</button>
                    <button class="chart-btn">1Y</button>
                </div>
            </div>
            <div class="chart-placeholder">
                <div class="mock-chart"></div>
                <div style="z-index: 2; position: relative;">
                    <i class="fas fa-chart-area" style="font-size: 3rem; opacity: 0.3;"></i>
                    <p style="margin-top: 1rem; opacity: 0.7;">Live Chart Integration</p>
                </div>
            </div>
        </div>
        
        <div class="trading-panel glass">
            <form id="trade-form" action="{{ route('trade') }}" method="POST">
                @csrf
                <div class="trading-tabs">
                    <button type="button" class="trading-tab active" data-tab="buy">Buy</button>
                    <button type="button" class="trading-tab" data-tab="sell">Sell</button>
                </div>
                
                <input type="hidden" name="trade_type" id="trade_type" value="buy">
                
                <div class="form-group">
                    <label class="form-label">Asset</label>
                    <input type="text" class="form-input" name="asset" placeholder="BTC/USD" value="BTC/USD">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Amount</label>
                    <input type="number" class="form-input" name="amount" placeholder="0.00">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Price</label>
                    <input type="number" class="form-input" name="price" placeholder="Market Price" value="$43,250.00">
                </div>
                
                <button type="submit" class="btn btn-success" style="width: 100%; margin-bottom: 1rem;" id="placeOrderBtn">
                    <i class="fas fa-plus-circle"></i> Place Buy Order
                </button>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                    <button type="button" class="btn set-amount" data-amount="0.25" style="background: rgba(255,255,255,0.1);">25%</button>
                    <button type="button" class="btn set-amount" data-amount="0.50" style="background: rgba(255,255,255,0.1);">50%</button>
                    <button type="button" class="btn set-amount" data-amount="0.75" style="background: rgba(255,255,255,0.1);">75%</button>
                    <button type="button" class="btn set-amount" data-amount="1.00" style="background: rgba(255,255,255,0.1);">MAX</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="transactions-section glass" style="padding: 2rem; border-radius: var(--border-radius);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h3>Recent Transactions</h3>
            <a href="{{ route('history') }}" class="btn btn-primary">View All</a>
        </div>
        <table class="table-container transactions-table">
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
            </tbody>
        </table>
    </div>
</div>

  <script>
      async function fetchPrices() {
          try {
              const response = await fetch('{{ route('api.prices') }}');
              const data = await response.json();
              document.getElementById('btc-price').innerText = `$${data.bitcoin.usd.toFixed(2)}`;
              document.getElementById('eth-price').innerText = `$${data.ethereum.usd.toFixed(2)}`;
              updateChart(data.bitcoin.usd);
          } catch (error) {
              console.error('Error fetching prices:', error);
          }
      }

      let chartData = [];
      const ctx = document.getElementById('priceChart').getContext('2d');
      const chart = new window.Chart(ctx, {
          type: 'line',
          data: {
              datasets: [{
                  label: 'BTC Price',
                  data: chartData,
                  borderColor: '#1a73e8',
                  backgroundColor: 'rgba(26, 115, 232, 0.1)',
                  fill: true,
              }]
          },
          options: {
              responsive: true,
              scales: {
                  x: { type: 'time', time: { unit: 'minute' } },
                  y: { beginAtZero: false }
              }
          }
      });

      function updateChart(price) {
          chartData.push({ x: new Date(), y: price });
          if (chartData.length > 20) chartData.shift();
          chart.update();
      }

      setInterval(fetchPrices, 60000);
      fetchPrices();
  </script>
  @endsection