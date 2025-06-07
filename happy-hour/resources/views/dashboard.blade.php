@extends('layouts.app')
  @section('title', 'Dashboard')
  @section('content')
  <div class="row">
      <div class="col-md-6 mb-4">
          <div class="card">
              <div class="card-header bg-primary text-white">
                  <h5 class="mb-0">Market Prices</h5>
              </div>
              <div class="card-body">
                  <p>BTC/USD: <span id="btc-price" class="fw-bold">$0.00</span></p>
                  <p>ETH/USD: <span id="eth-price" class="fw-bold">$0.00</span></p>
              </div>
          </div>
      </div>
      <div class="col-md-6 mb-4">
          <div class="card">
              <div class="card-header bg-primary text-white">
                  <h5 class="mb-0">BTC Price Chart</h5>
              </div>
              <div class="card-body">
                  <canvas id="priceChart"></canvas>
              </div>
          </div>
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