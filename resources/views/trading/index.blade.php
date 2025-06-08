@extends('layouts.app')

@section('title', 'Trading')

@section('content')
    <!-- Market Ticker -->
    <div class="market-ticker">
        <div class="ticker-content" id="marketTicker">
            <!-- Populated via JavaScript -->
        </div>
    </div>

    <!-- Header -->
    <header class="trading-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <div class="header-nav">
                    <a href="{{ route('trading') }}" class="nav-tab active">
                        <i class="fas fa-chart-line me-2"></i>Spot Trading
                    </a>
                    <a href="#" class="nav-tab disabled" title="Coming Soon">
                        <i class="fas fa-coins me-2"></i>Margin
                    </a>
                    <a href="#" class="nav-tab disabled" title="Coming Soon">
                        <i class="fas fa-rocket me-2"></i>Futures
                    </a>
                    <a href="{{ route('settings') }}" class="nav-tab">
                        <i class="fas fa-cog me-2"></i>Settings
                    </a>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="text-end">
                        <div class="text-muted small">Total Balance</div>
                        <div class="text-primary h5 mb-0">{{ auth()->user()->balance ?? '$12,456.78' }}</div>
                    </div>
                    <div class="pulse">
                        <i class="fas fa-circle text-success" style="font-size: 0.5rem;"></i>
                        <span class="text-success ms-1 small">Live</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Trading Layout -->
    <div class="trading-layout">
        <!-- Chart Section -->
        <div class="chart-section">
            <!-- Asset Selector -->
            <div class="trading-card">
                <div class="asset-selector" id="assetSelector">
                    <a href="#" class="asset-button active" data-asset="BTC/USD">
                        <i class="fab fa-bitcoin" style="color: #f7931a;"></i>
                        <div>
                            <div>BTC/USD</div>
                            <div class="price-change" data-asset="BTC/USD"></div>
                        </div>
                    </a>
                    <a href="#" class="asset-button" data-asset="ETH/USD">
                        <i class="fab fa-ethereum" style="color: #627eea;"></i>
                        <div>
                            <div>ETH/USD</div>
                            <div class="price-change" data-asset="ETH/USD"></div>
                        </div>
                    </a>
                    <a href="#" class="asset-button" data-asset="ADA/USD">
                        <i class="fas fa-coins" style="color: #3cc8c8;"></i>
                        <div>
                            <div>ADA/USD</div>
                            <div class="price-change" data-asset="ADA/USD"></div>
                        </div>
                    </a>
                    <a href="#" class="asset-button" data-asset="SOL/USD">
                        <i class="fas fa-sun" style="color: #9945ff;"></i>
                        <div>
                            <div>SOL/USD</div>
                            <div class="price-change" data-asset="SOL/USD"></div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Price Chart -->
            <div class="trading-card">
                <div class="chart-controls">
                    <div class="d-flex align-items-center gap-3">
                        <h3 class="mb-0" id="currentAsset">BTC/USD</h3>
                        <div class="h4 mb-0 text-primary" id="currentPrice">$45,234.56</div>
                        <span class="price-change" id="currentChange">+$1,023.45 (+2.34%)</span>
                    </div>
                    <div class="time-selector">
                        <button class="time-btn" data-time="1m">1m</button>
                        <button class="time-btn" data-time="5m">5m</button>
                        <button class="time-btn" data-time="15m">15m</button>
                        <button class="time-btn active" data-time="1h">1h</button>
                        <button class="time-btn" data-time="4h">4h</button>
                        <button class="time-btn" data-time="1d">1d</button>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="priceChart"></canvas>
                </div>
            </div>

            <!-- Order Book -->
            <div class="trading-card">
                <h5 class="mb-3">
                    <i class="fas fa-list-ul me-2"></i>Order Book
                </h5>
                <div class="order-book" id="orderBook">
                    <div class="order-book-header">
                        <div>Price (USD)</div>
                        <div>Amount (Asset)</div>
                        <div>Total (USD)</div>
                    </div>
                    <!-- Populated via JavaScript -->
                </div>
            </div>
        </div>

        <!-- Trading Panel -->
        <div class="trading-panel">
            <!-- Quick Actions -->
            <div class="quick-actions">
                <div class="quick-action" title="Market Scanner">
                    <i class="fas fa-search"></i>
                </div>
                <div class="quick-action" title="Price Alerts">
                    <i class="fas fa-bell"></i>
                </div>
                <div class="quick-action" title="Watchlist">
                    <i class="fas fa-star"></i>
                </div>
                <div class="quick-action" title="Portfolio">
                    <i class="fas fa-briefcase"></i>
                </div>
            </div>

            <!-- Portfolio Stats -->
            <div class="trading-card">
                <h5 class="mb-3">
                    <i class="fas fa-wallet me-2"></i>Portfolio Overview
                </h5>
                <div class="portfolio-stats">
                    <div class="stat-card">
                        <div class="stat-value">{{ auth()->user()->balance ?? '$8,234.56' }}</div>
                        <div class="stat-label">Available Balance</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">$4,222.22</div>
                        <div class="stat-label">In Orders</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value text-success">{{ auth()->user()->balance_change ?? '+12.5%' }}</div>
                        <div class="stat-label">Today's P&L</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value text-primary">{{ auth()->user()->return_rate ?? '+45.2%' }}</div>
                        <div class="stat-label">Total Return</div>
                    </div>
                </div>
            </div>

            <!-- Trading Form -->
            <div class="trading-card">
                <div class="trading-tabs">
                    <button class="trading-tab active" data-tab="buy">
                        <i class="fas fa-arrow-up me-2"></i>Buy
                    </button>
                    <button class="trading-tab" data-tab="sell">
                        <i class="fas fa-arrow-down me-2"></i>Sell
                    </button>
                </div>

                <form class="order-form mt-3" action="{{ route('trade') }}" method="POST" id="tradeForm">
                    @csrf
                    <input type="hidden" name="trade_type" id="tradeType" value="buy">
                    <input type="hidden" name="asset" id="tradeAsset" value="BTC/USD">

                    <div class="form-group">
                        <label class="form-label">Order Type</label>
                        <select class="form-input" name="order_type">
                            <option value="market">Market Order</option>
                            <option value="limit">Limit Order</option>
                            <option value="stop_loss">Stop Loss</option>
                            <option value="take_profit">Take Profit</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Amount (Asset)</label>
                        <input type="number" class="form-input" name="amount" id="amountInput" placeholder="0.00000000" step="0.00000001" required>
                        <div class="percentage-buttons mt-2">
                            <button type="button" class="percentage-btn" data-percentage="0.25">25%</button>
                            <button type="button" class="percentage-btn" data-percentage="0.50">50%</button>
                            <button type="button" class="percentage-btn" data-percentage="0.75">75%</button>
                            <button type="button" class="percentage-btn" data-percentage="1.00">100%</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Price (USD)</label>
                        <input type="number" class="form-input" name="price" id="priceInput" placeholder="0.00" value="45234.56" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Total (USD)</label>
                        <input type="number" class="form-input" name="total" id="totalInput" placeholder="0.00" readonly>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Allocation</label>
                        <input type="range" class="order-slider" name="allocation" id="allocationSlider" min="0" max="100" value="0">
                        <div class="text-muted small mt-1" id="allocationValue">0%</div>
                    </div>

                    <button type="submit" class="buy-button" id="submitButton">
                        <i class="fas fa-plus-circle me-2"></i>Place Buy Order
                    </button>
                </form>
            </div>

            <!-- Recent Trades -->
            <div class="trading-card">
                <h5 class="mb-3">
                    <i class="fas fa-history me-2"></i>Recent Trades
                </h5>
                <div class="recent-trades" id="recentTrades">
                    @foreach ($transactions as $transaction)
                        <div class="trade-item">
                            <div class="trade-info">
                                <div class="trade-pair">{{ $transaction->asset }}</div>
                                <div class="trade-time">{{ $transaction->created_at->format('Y-m-d H:i') }}</div>
                            </div>
                            <div class="trade-amount {{ $transaction->type == 'buy' ? 'text-success' : 'text-danger' }}">
                                {{ $transaction->type == 'buy' ? '+' : '-' }}{{ $transaction->amount }} ({{ $transaction->value }})
                            </div>
                        </div>
                    @endforeach
                    @if ($transactions->isEmpty())
                        <div class="text-center text-muted">No recent trades.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- External Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.min.js"></script>
    <script>
        // Market Ticker
        async function updateMarketTicker() {
            try {
                const response = await fetch('{{ route('api.prices') }}');
                const data = await response.json();
                const ticker = document.getElementById('marketTicker');
                ticker.innerHTML = '';
                for (const [pair, info] of Object.entries(data)) {
                    const changeClass = info.change >= 0 ? 'text-success' : 'text-danger';
                    const item = document.createElement('span');
                    item.className = 'ticker-item';
                    item.innerHTML = `${pair}: $${info.price.toLocaleString()} <span class="${changeClass}">${info.change >= 0 ? '+' : ''}${info.change}%</span>`;
                    ticker.appendChild(item);
                }
            } catch (error) {
                console.error('Error fetching market data:', error);
            }
        }
        updateMarketTicker();
        setInterval(updateMarketTicker, 60000);

        // Asset Selector
        const assetButtons = document.querySelectorAll('.asset-button');
        assetButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                assetButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                const asset = button.dataset.asset;
                document.getElementById('currentAsset').textContent = asset;
                document.getElementById('tradeAsset').value = asset;
                updateChart(asset);
                updateOrderBook(asset);
            });
        });

        // Chart Setup
        const ctx = document.getElementById('priceChart').getContext('2d');
        const priceChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Price (USD)',
                    data: [],
                    borderColor: 'var(--accent-blue)',
                    backgroundColor: 'rgba(0, 212, 255, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: { display: true, title: { display: true, text: 'Time' } },
                    y: { display: true, title: { display: true, text: 'Price (USD)' } }
                }
            }
        });

        async function updateChart(asset, timeframe = '1h') {
            try {
                const response = await fetch(`{{ route('api.prices') }}?asset=${asset}&timeframe=${timeframe}`);
                const data = await response.json();
                priceChart.data.labels = data.labels;
                priceChart.data.datasets[0].data = data.prices;
                priceChart.update();
                document.getElementById('currentPrice').textContent = `$${data.currentPrice.toLocaleString()}`;
                const changeClass = data.change >= 0 ? 'positive' : 'negative';
                document.getElementById('currentChange').textContent = `${data.change >= 0 ? '+' : ''}$${data.changeAmount.toLocaleString()} (${data.change}%)`;
                document.getElementById('currentChange').className = `price-change ${changeClass}`;
            } catch (error) {
                console.error('Error fetching chart data:', error);
            }
        }
        updateChart('BTC/USD');

        // Time Selector
        document.querySelectorAll('.time-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.time-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                const asset = document.querySelector('.asset-button.active').dataset.asset;
                updateChart(asset, btn.dataset.time);
            });
        });

        // Order Book
        async function updateOrderBook(asset) {
            // Mock data for now; replace with real API
            const orderBook = document.getElementById('orderBook');
            orderBook.innerHTML = orderBook.querySelector('.order-book-header').outerHTML;
            const mockOrders = [
                { type: 'sell', price: 45267.89, amount: 0.0234, total: 1059.27 },
                { type: 'sell', price: 45256.34, amount: 0.1567, total: 7089.67 },
                { type: 'buy', price: 45234.56, amount: 0.2345, total: 10607.51 },
                { type: 'buy', price: 45223.12, amount: 0.0876, total: 3961.54 },
                { type: 'buy', price: 45198.76, amount: 0.3456, total: 15620.71 }
            ];
            mockOrders.forEach(order => {
                const row = document.createElement('div');
                row.className = `order-row ${order.type}`;
                row.innerHTML = `
                    <div style="color: var(--${order.type === 'buy' ? 'success' : 'danger'});">${order.price.toLocaleString()}</div>
                    <div>${order.amount.toFixed(4)}</div>
                    <div>${order.total.toLocaleString()}</div>
                `;
                orderBook.appendChild(row);
            });
        }
        updateOrderBook('BTC/USD');

        // Trading Tabs
        const tradingTabs = document.querySelectorAll('.trading-tab');
        const submitButton = document.getElementById('submitButton');
        tradingTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tradingTabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                const tradeType = tab.dataset.tab;
                document.getElementById('tradeType').value = tradeType;
                submitButton.textContent = `Place ${tradeType.charAt(0).toUpperCase() + tradeType.slice(1)} Order`;
                submitButton.className = tradeType === 'buy' ? 'buy-button' : 'sell-button';
            });
        });

        // Form Calculations
        const amountInput = document.getElementById('amountInput');
        const priceInput = document.getElementById('priceInput');
        const totalInput = document.getElementById('totalInput');
        const allocationSlider = document.getElementById('allocationSlider');
        const allocationValue = document.getElementById('allocationValue');

        function calculateTotal() {
            const amount = parseFloat(amountInput.value) || 0;
            const price = parseFloat(priceInput.value) || 0;
            totalInput.value = (amount * price).toFixed(2);
        }

        amountInput.addEventListener('input', calculateTotal);
        priceInput.addEventListener('input', calculateTotal);

        allocationSlider.addEventListener('input', () => {
            allocationValue.textContent = `${allocationSlider.value}%`;
            const balance = {{ auth()->user()->balance ?? 8234.56 }};
            const price = parseFloat(priceInput.value) || 45234.56;
            amountInput.value = ((allocationSlider.value / 100) * balance / price).toFixed(8);
            calculateTotal();
        });

        // Percentage Buttons
        document.querySelectorAll('.percentage-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const percentage = parseFloat(btn.dataset.percentage);
                allocationSlider.value = percentage * 100;
                allocationValue.textContent = `${percentage * 100}%`;
                const balance = {{ auth()->user()->balance ?? 8234.56 }};
                const price = parseFloat(priceInput.value) || 45234.56;
                amountInput.value = (percentage * balance / price).toFixed(8);
                calculateTotal();
            });
        });

        // Form Submission
        document.getElementById('tradeForm').addEventListener('submit', (e) => {
            // Optional: Add client-side validation
            const amount = parseFloat(amountInput.value);
            if (amount <= 0) {
                e.preventDefault();
                alert('Please enter a valid amount.');
            }
        });
    </script>
@endsection