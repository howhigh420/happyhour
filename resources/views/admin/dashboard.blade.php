@extends('layouts.admin')
@section('title', 'Admin Dashboard')

@section('content')
 <!-- Content -->
<main class="content">
    <!-- Sample Alert -->
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        <span>Welcome back! Your dashboard has been updated with the latest data.</span>
    </div>

    <!-- Dashboard Stats -->
    <div class="dashboard-grid">
        <div class="stat-card">
            <div class="stat-card-header">
                <div class="stat-card-title">Total Users</div>
                <div class="stat-card-icon primary">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <div class="stat-card-value">24,567</div>
            <div class="stat-card-change positive">
                <i class="fas fa-arrow-up"></i>
                <span>+12.5% from last month</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-card-header">
                <div class="stat-card-title">Total Revenue</div>
                <div class="stat-card-icon success">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
            <div class="stat-card-value">$89,432</div>
            <div class="stat-card-change positive">
                <i class="fas fa-arrow-up"></i>
                <span>+8.2% from last month</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-card-header">
                <div class="stat-card-title">Active Orders</div>
                <div class="stat-card-icon warning">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>
            <div class="stat-card-value">1,234</div>
            <div class="stat-card-change negative">
                <i class="fas fa-arrow-down"></i>
                <span>-3.1% from last month</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-card-header">
                <div class="stat-card-title">System Health</div>
                <div class="stat-card-icon success">
                    <i class="fas fa-heart"></i>
                </div>
            </div>
            <div class="stat-card-value">98.5%</div>
            <div class="stat-card-change positive">
                <i class="fas fa-arrow-up"></i>
                <span>+0.3% uptime</span>
            </div>
        </div>
    </div>

    <!-- Placeholder for main content -->
    <div class="stat-card">
        <h3 style="margin-bottom: 1rem; color: var(--text-primary);">Recent Activity</h3>
        <p style="color: var(--text-secondary);">Your main content area will be displayed here. This enhanced admin interface includes:</p>
        <ul style="margin: 1rem 0; padding-left: 1.5rem; color: var(--text-secondary);">
            <li>Collapsible sidebar with smooth animations</li>
            <li>Dark mode toggle with theme persistence</li>
            <li>Real-time search functionality</li>
            <li>Notification system with badges</li>
            <li>Responsive design for mobile devices</li>
            <li>Modern card-based layout</li>
            <li>Interactive hover effects</li>
            <li>Improved accessibility features</li>
            <li>Enhanced visual feedback</li>
            <li>Professional dashboard statistics</li>
        </ul>
    </div>
</main>


@endsection