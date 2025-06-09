<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HappyHour - Trade Smarter, Live Happier</title>
    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="resources/css/style.css">
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <style>
        
    </style>
</head>
<body>
    <!-- Animated Background -->
    <div class="animated-bg"></div>
    
    <!-- Floating Shapes -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <!-- Enhanced Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-chart-line me-2"></i>HappyHour
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#how-it-works">How It Works</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item ms-3">
                        <a class="btn btn-signup" href="/signup">
                            <i class="fas fa-rocket me-2"></i>Get Started
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Enhanced Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="hero-content text-center fade-in">
                        <h1>Trade Smarter, Live Happier</h1>
                        <p class="lead">Experience the future of trading with our intuitive platform powered by real-time analytics and advanced AI insights.</p>
                        <a href="/signup" class="btn-cta">
                            <i class="fas fa-play me-2"></i>Start Trading Today
                        </a>
                        <div class="mt-4">
                            <small class="text-muted">Join 50,000+ traders worldwide</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Features Section -->
    <section class="section" id="features">
        <div class="container">
            <h2 class="section-title fade-in">Why Choose HappyHour?</h2>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card fade-in">
                        <div class="feature-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h3 class="h4 mb-3">Real-Time Data</h3>
                        <p class="text-muted">Lightning-fast market updates with millisecond precision. Never miss a trading opportunity with our advanced data feeds.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card fade-in">
                        <div class="feature-icon">
                            <i class="fas fa-brain"></i>
                        </div>
                        <h3 class="h4 mb-3">AI-Powered Analytics</h3>
                        <p class="text-muted">Leverage machine learning algorithms to identify patterns and make smarter trading decisions with confidence.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card fade-in">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="h4 mb-3">Bank-Level Security</h3>
                        <p class="text-muted">Your funds are protected with military-grade encryption and multi-factor authentication protocols.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced How It Works Section -->
    <section class="section section-bg" id="how-it-works">
        <div class="container">
            <h2 class="section-title fade-in">How It Works</h2>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="step-card text-center fade-in">
                        <div class="step-number">1</div>
                        <h3 class="h4 mb-3">Quick Setup</h3>
                        <p class="text-muted">Create your account in under 2 minutes with our streamlined onboarding process.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="step-card text-center fade-in">
                        <div class="step-number">2</div>
                        <h3 class="h4 mb-3">Secure Funding</h3>
                        <p class="text-muted">Deposit funds instantly through multiple payment methods with zero fees on your first deposit.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="step-card text-center fade-in">
                        <div class="step-number">3</div>
                        <h3 class="h4 mb-3">Smart Trading</h3>
                        <p class="text-muted">Execute trades with precision using our advanced tools and real-time market insights.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Testimonials Section -->
    <section class="section">
        <div class="container">
            <h2 class="section-title fade-in">What Our Traders Say</h2>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card fade-in">
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="mb-3">"HappyHour transformed my trading experience. The AI insights helped me increase my portfolio by 35% in just 3 months!"</p>
                        <div class="d-flex align-items-center">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white me-3" style="width: 40px; height: 40px;">
                                J
                            </div>
                            <div>
                                <strong>Jane D.</strong>
                                <div class="small text-muted">Day Trader</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card fade-in">
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="mb-3">"Perfect for both beginners and pros. The interface is intuitive yet powerful enough for complex strategies."</p>
                        <div class="d-flex align-items-center">
                            <div class="bg-success rounded-circle d-flex align-items-center justify-content-center text-white me-3" style="width: 40px; height: 40px;">
                                J
                            </div>
                            <div>
                                <strong>John K.</strong>
                                <div class="small text-muted">Investment Advisor</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card fade-in">
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="mb-3">"The security features give me complete peace of mind. I can focus on trading without worrying about my funds."</p>
                        <div class="d-flex align-items-center">
                            <div class="bg-info rounded-circle d-flex align-items-center justify-content-center text-white me-3" style="width: 40px; height: 40px;">
                                A
                            </div>
                            <div>
                                <strong>Alice M.</strong>
                                <div class="small text-muted">Crypto Enthusiast</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced FAQ Section -->
    <section class="section section-bg">
        <div class="container">
            <h2 class="section-title fade-in">Frequently Asked Questions</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion fade-in" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                    <i class="fas fa-shield-alt me-3"></i>Is my money safe with HappyHour?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Absolutely. We employ bank-level security with 256-bit SSL encryption, cold storage for digital assets, and are fully regulated by financial authorities. Your funds are also insured up to $500,000.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                    <i class="fas fa-dollar-sign me-3"></i>What are your trading fees?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    We offer some of the most competitive rates in the industry, starting from 0.1% per trade. Volume traders enjoy even lower fees. Check our pricing page for detailed information.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                    <i class="fas fa-mobile-alt me-3"></i>Do you have a mobile app?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes! Our mobile app is available for both iOS and Android, featuring all the same powerful tools as our web platform with push notifications for market alerts.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Footer -->
    <footer class="footer text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="mb-4">
                        <a class="navbar-brand h2" href="/">
                            <i class="fas fa-chart-line me-2"></i>HappyHour
                        </a>
                    </div>
                    <p class="mb-3">© 2025 HappyHour. All rights reserved.</p>
                    <div class="d-flex justify-content-center gap-4 flex-wrap">
                        <a href="/terms" class="text-decoration-none">Terms of Service</a>
                        <a href="/privacy" class="text-decoration-none">Privacy Policy</a>
                        <a href="/contact" class="text-decoration-none">Contact Support</a>
                        <a href="/about" class="text-decoration-none">About Us</a>
                    </div>
                    <div class="mt-4">
                        <a href="#" class="text-decoration-none me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-decoration-none me-3"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="text-decoration-none me-3"><i class="fab fa-github"></i></a>
                        <a href="#" class="text-decoration-none"><i class="fab fa-discord"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        // Observe all fade-in elements
        document.querySelectorAll('.fade-in').forEach(el => {
            observer.observe(el);
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 100) {
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>