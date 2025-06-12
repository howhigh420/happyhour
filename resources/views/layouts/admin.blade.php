<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Happy Hour Admin - @yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    @vite(['resources/scss/admin.scss', 'resources/js/app.js'])
</head>
<body>
     <div class="admin-layout">
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h4>
                    <i class="fas fa-cocktail"></i>
                    <span class="text">Happy Hour</span>
                </h4>
            </div>
            <div class="sidebar-nav">
                <div class="nav-item">
                    <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="{{ route('admin.users.index') }}">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="#transactions">
                        <i class="fas fa-exchange-alt"></i>
                        <span>Transactions</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="#orders">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Orders</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="#assets">
                        <i class="fas fa-coins"></i>
                        <span>Assets</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="#analytics">
                        <i class="fas fa-chart-bar"></i>
                        <span>Analytics</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="#settings">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="#logs">
                        <i class="fas fa-file-alt"></i>
                        <span>Logs</span>
                    </a>
                </div>
            </div>
            <div class="logout-form">
                <button class="logout-btn" onclick="handleLogout()">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="header-left">
                    <button class="sidebar-toggle" id="sidebarToggle" data-tooltip="Toggle Sidebar">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="page-title">Dashboard</h1>
                </div>
                <div class="header-right">
                    <div class="search-container">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Search anything...">
                    </div>
                    <div class="header-actions">
                        <button class="action-btn tooltip" data-tooltip="Notifications">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">3</span>
                        </button>
                        <button class="action-btn tooltip" data-tooltip="Toggle Dark Mode" id="themeToggle">
                            <i class="fas fa-moon"></i>
                        </button>
                        <button class="action-btn tooltip" data-tooltip="Messages">
                            <i class="fas fa-envelope"></i>
                            <span class="notification-badge">5</span>
                        </button>
                        <div class="user-menu">
                            <div class="user-avatar tooltip" data-tooltip="Admin User">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

        <!-- Main Content -->
        <div class="main-content flex-grow-1">
            <header class="bg-white shadow-sm p-3">
               
            </header>
            <main class="content container-fluid py-4">
                @if (session('status') || session('error'))
                    <div class="alert {{ session('error') ? 'alert-danger' : 'alert-success' }}">
                        {{ session('status') ?? session('error') }}
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Initialize Laravel CSRF token for AJAX requests
        window.Laravel = {
            csrfToken: document.querySelector('meta[name="csrf-token"]').content
        };

        // Sidebar toggle functionality
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const themeToggle = document.getElementById('themeToggle');
        const userAvatar = document.getElementById('userAvatar');
        const userDropdown = document.getElementById('userDropdown');
        const notificationsBtn = document.getElementById('notificationsBtn');
        const messagesBtn = document.getElementById('messagesBtn');
        const searchInput = document.querySelector('.search-input');

        // Toggle sidebar
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            const icon = sidebarToggle.querySelector('i');
            icon.className = sidebar.classList.contains('collapsed') ? 'fas fa-bars' : 'fas fa-times';
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        });

        // Restore sidebar state
        if (localStorage.getItem('sidebarCollapsed') === 'true') {
            sidebar.classList.add('collapsed');
            sidebarToggle.querySelector('i').className = 'fas fa-bars';
        }

        // Theme toggle functionality
        let isDarkMode = localStorage.getItem('darkMode') === 'true';
        function updateTheme() {
            if (isDarkMode) {
                document.documentElement.setAttribute('data-theme', 'dark');
                themeToggle.querySelector('i').className = 'fas fa-sun';
                themeToggle.setAttribute('data-tooltip', 'Toggle Light Mode');
            } else {
                document.documentElement.removeAttribute('data-theme');
                themeToggle.querySelector('i').className = 'fas fa-moon';
                themeToggle.setAttribute('data-tooltip', 'Toggle Dark Mode');
            }
        }

        themeToggle.addEventListener('click', () => {
            isDarkMode = !isDarkMode;
            localStorage.setItem('darkMode', isDarkMode);
            updateTheme();
        });

        updateTheme();

        // User dropdown toggle
        userAvatar.addEventListener('click', () => {
            userDropdown.classList.toggle('show');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!userAvatar.contains(e.target) && !userDropdown.contains(e.target)) {
                userDropdown.classList.remove('show');
            }
        });

        // Search functionality
        searchInput.addEventListener('input', debounce((e) => {
            const query = e.target.value.trim().toLowerCase();
            if (query.length > 2) {
                // Implement AJAX search (example)
                fetch('/admin/search', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': window.Laravel.csrfToken,
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ query })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Search results:', data);
                    // Update UI with search results
                })
                .catch(error => console.error('Search error:', error));
            }
        }, 300));

        // Debounce function
        function debounce(func, wait) {
            let timeout;
            return function (...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), wait);
            };
        }

        // Navigation active state
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                // Allow default behavior for actual navigation
                navLinks.forEach(l => l.classList.remove('active'));
                link.classList.add('active');
                const pageTitle = document.querySelector('.page-title');
                const linkText = link.querySelector('span').textContent;
                pageTitle.textContent = linkText;
            });
        });

        // Notification click handler
        notificationsBtn.addEventListener('click', () => {
            console.log('Opening notifications...');
            // Implement notification panel logic
        });

        // Messages click handler
        messagesBtn.addEventListener('click', () => {
            console.log('Opening messages...');
            // Implement messages panel logic
        });

        // Auto-hide alerts
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.animation = 'fadeOut 0.3s ease-out forwards';
                setTimeout(() => alert.remove(), 300);
            }, 5000);
        });

        // FadeOut animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeOut {
                from { opacity: 1; transform: translateY(0); }
                to { opacity: 0; transform: translateY(-10px); }
            }
        `;
        document.head.appendChild(style);

        // Logout confirmation
        document.querySelectorAll('#logout-form').forEach(form => {
            form.addEventListener('submit', (e) => {
                if (!confirm('Are you sure you want to logout?')) {
                    e.preventDefault();
                }
            });
        });

        // Mobile sidebar
        function handleResize() {
            if (window.innerWidth <= 768) {
                sidebar.classList.add('collapsed');
                sidebarToggle.querySelector('i').className = 'fas fa-bars';
            } else if (!localStorage.getItem('sidebarCollapsed')) {
                sidebar.classList.remove('collapsed');
                sidebarToggle.querySelector('i').className = 'fas fa-times';
            }
        }

        window.addEventListener('resize', handleResize);
        handleResize();

        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            // Ctrl/Cmd + K for search
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                searchInput.focus();
            }
            // Ctrl/Cmd + B for sidebar toggle
            if ((e.ctrlKey || e.metaKey) && e.key === 'b') {
                e.preventDefault();
                sidebarToggle.click();
            }
            // Ctrl/Cmd + T for theme toggle
            if ((e.ctrlKey || e.metaKey) && e.key === 't') {
                e.preventDefault();
                themeToggle.click();
            }
        });

        // Smooth scrolling
        document.documentElement.style.scrollBehavior = 'smooth';

        // Accessibility: Focus management
        navLinks.forEach(link => {
            link.setAttribute('tabindex', '0');
            link.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    link.click();
                }
            });
        });

        // Initialize tooltips
        document.querySelectorAll('.tooltip').forEach(tooltip => {
            tooltip.setAttribute('aria-label', tooltip.getAttribute('data-tooltip'));
        });
    </script>
    
</body>
</html>