@php
    $user = auth()->user();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HappyHour - Advanced Trading Dashboard</title>
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Google Fonts: Inter and JetBrains Mono -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body>
    <!-- Animated Background Particles -->
    <div class="particles" id="particles"></div>

    <!-- Sidebar Navigation -->
    <nav class="sidebar glass" id="sidebar">
        <div class="logo">
            <a href="{{ route('landing.index') }}">
                <i class="fas fa-chart-line"></i>
                <h2>HappyHour</h2>
            </a>
        </div>
        
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('portfolio') }}" class="nav-link {{ Route::currentRouteName() == 'portfolio' ? 'active' : '' }}">
                    <i class="fas fa-coins"></i>
                    <span>Portfolio</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('trading') }}" class="nav-link {{ Route::currentRouteName() == 'trading' ? 'active' : '' }}">
                    <i class="fas fa-exchange-alt"></i>
                    <span>Trading</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('wallet') }}" class="nav-link {{ Route::currentRouteName() == 'wallet' ? 'active' : '' }}">
                    <i class="fas fa-wallet"></i>
                    <span>Wallet</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('deposit.fiat.form') }}" class="nav-link {{ Route::currentRouteName() == 'deposit.fiat.form' ? 'active' : '' }}">
                    <i class="fas fa-credit-card"></i>
                    <span>Deposit Fiat</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('deposit.crypto.form') }}" class="nav-link {{ Route::currentRouteName() == 'deposit.crypto.form' ? 'active' : '' }}">
                    <i class="fab fa-bitcoin"></i>
                    <span>Deposit Crypto</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('history') }}" class="nav-link {{ Route::currentRouteName() == 'history' ? 'active' : '' }}">
                    <i class="fas fa-history"></i>
                    <span>History</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('analytics') }}" class="nav-link {{ Route::currentRouteName() == 'analytics' ? 'active' : '' }}">
                    <i class="fas fa-chart-bar"></i>
                    <span>Analytics</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('settings') }}" class="nav-link {{ Route::currentRouteName() == 'settings' ? 'active' : '' }}">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        <!-- Top Header -->
        <header class="top-header glass">
            <div class="header-left">
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="search-bar">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Search assets, transactions...">
                </div>
            </div>
            
            <div class="header-actions">
                <button class="action-btn" title="Notifications" id="notificationBtn">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </button>
                
                <button class="action-btn" title="Messages">
                    <i class="fas fa-envelope"></i>
                </button>
                
                <button class="action-btn" title="Settings">
                    <i class="fas fa-cog"></i>
                </button>
                
                <div class="dropdown">
                    <div class="user-profile dropdown-toggle" id="userProfile" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-avatar">{{ strtoupper(substr($user->name, 0, 2)) }}</div>
                        <div>
                            <div style="font-weight: 600; font-size: 0.9rem;">{{ $user->name }}</div>
                            <div style="font-size: 0.75rem; color: rgba(255,255,255,0.7);">Premium</div>
                        </div>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <ul class="dropdown-menu glass" aria-labelledby="userProfile">
                        <li><a class="dropdown-item" href="{{ route('profile.show', $user) }}">View Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profile</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

       @yield('content')
    </main>

    <!-- Toast Notification -->
    <div class="toast" id="toastNotification">
        <span id="toastMessage"></span>
    </div>

    <!-- Bootstrap 5.3.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- JavaScript for Interactivity -->
    <script>
        // Sidebar Toggle
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const sidebarToggle = document.getElementById('sidebarToggle');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            sidebar.classList.toggle('open');
            mainContent.classList.toggle('expanded');
        });

        // Particle Animation
        const particlesContainer = document.getElementById('particles');
        function createParticle() {
            const particle = document.createElement('div');
            particle.classList.add('particle');
            particle.style.left = Math.random() * 100 + 'vw';
            particle.style.animationDuration = Math.random() * 10 + 10 + 's';
            particle.style.animationDelay = Math.random() * 5 + 's';
            particlesContainer.appendChild(particle);
            setTimeout(() => particle.remove(), 15000);
        }

        for (let i = 0; i < 50; i++) {
            setTimeout(createParticle, i * 200);
        }
        setInterval(createParticle, 300);

        // Trading Tabs
        const tradingTabs = document.querySelectorAll('.trading-tab');
        const placeOrderBtn = document.getElementById('placeOrderBtn');
        const tradeTypeInput = document.getElementById('trade_type');

        tradingTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tradingTabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                tradeTypeInput.value = tab.dataset.tab;
                placeOrderBtn.textContent = tab.dataset.tab === 'buy' 
                    ? ' Place Buy Order' 
                    : ' Place Sell Order';
                placeOrderBtn.classList.toggle('btn-success', tab.dataset.tab === 'buy');
                placeOrderBtn.classList.toggle('btn-danger', tab.dataset.tab === 'sell');
            });
        });

        // Set Amount Buttons
        const amountInput = document.querySelector('input[name="amount"]');
        document.querySelectorAll('.set-amount').forEach(btn => {
            btn.addEventListener('click', () => {
                amountInput.value = btn.dataset.amount;
            });
        });

        // Toast Notification
        const toast = document.getElementById('toastNotification');
        const toastMessage = document.getElementById('toastMessage');

        function showToast(message, type) {
            toastMessage.textContent = message;
            toast.className = `toast ${type} show`;
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }

        // Example: Show toast on order placement
        document.getElementById('trade-form').addEventListener('submit', (e) => {
            e.preventDefault();
            const tab = document.querySelector('.trading-tab.active').dataset.tab;
            showToast(`Successfully placed ${tab} order!`, 'success');
            // Uncomment to submit form after toast
            // setTimeout(() => e.target.submit(), 1000);
        });

        // Example: Show toast on notification click
        document.getElementById('notificationBtn').addEventListener('click', () => {
            showToast('You have 3 new notifications', 'warning');
        });
    </script>
</body>
</html>