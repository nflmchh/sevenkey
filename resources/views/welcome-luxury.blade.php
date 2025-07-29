<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SevenKey - Luxury Fashion Management</title>
    
    <!-- Google Fonts - Luxury Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            /* Luxury Color Palette */
            --primary-black: #0D0D0D;
            --primary-gold: #D4AF37;
            --primary-cream: #F7F5F3;
            --accent-brown: #8B6F47;
            --text-dark: #1A1A1A;
            --text-light: #666666;
            --text-muted: #999999;
            --white: #FFFFFF;
            --glass-bg: rgba(255, 255, 255, 0.1);
            --shadow-luxury: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            --shadow-gold: 0 10px 40px rgba(212, 175, 55, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            overflow-x: hidden;
            background: linear-gradient(135deg, var(--primary-cream) 0%, #FFFFFF 100%);
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, 
                var(--primary-black) 0%, 
                #2A2A2A 50%, 
                var(--primary-black) 100%);
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="0.5" fill="%23D4AF37" opacity="0.1"/><circle cx="75" cy="75" r="0.3" fill="%23D4AF37" opacity="0.08"/><circle cx="50" cy="10" r="0.4" fill="%23D4AF37" opacity="0.06"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(10px, -10px) rotate(1deg); }
            66% { transform: translate(-5px, 5px) rotate(-1deg); }
        }

        .nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 20px 40px;
            background: rgba(13, 13, 13, 0.9);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(212, 175, 55, 0.2);
            transition: all 0.3s ease;
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 600;
            color: var(--white);
            text-decoration: none;
            letter-spacing: 2px;
            position: relative;
        }

        .logo::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 40px;
            height: 2px;
            background: linear-gradient(90deg, var(--primary-gold), transparent);
        }

        .nav-links {
            display: flex;
            gap: 40px;
            align-items: center;
        }

        .nav-link {
            color: var(--white);
            text-decoration: none;
            font-weight: 400;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            color: var(--primary-gold);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 1px;
            background: var(--primary-gold);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-gold), #F4D03F);
            color: var(--primary-black);
            padding: 12px 30px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            letter-spacing: 1px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-gold);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 50px rgba(212, 175, 55, 0.4);
        }

        .hero-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .hero-text h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(48px, 6vw, 72px);
            font-weight: 700;
            color: var(--white);
            line-height: 1.1;
            margin-bottom: 30px;
            letter-spacing: -1px;
        }

        .hero-text .highlight {
            background: linear-gradient(135deg, var(--primary-gold), #F4D03F);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-text p {
            font-size: 18px;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 40px;
            line-height: 1.7;
            font-weight: 300;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .btn-secondary {
            background: transparent;
            color: var(--white);
            padding: 12px 30px;
            border: 2px solid var(--primary-gold);
            border-radius: 50px;
            font-weight: 500;
            letter-spacing: 1px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: var(--primary-gold);
            color: var(--primary-black);
            transform: translateY(-2px);
        }

        .hero-visual {
            position: relative;
            height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .fashion-showcase {
            position: relative;
            width: 100%;
            height: 100%;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 20px;
        }

        .showcase-item {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(212, 175, 55, 0.3);
            border-radius: 20px;
            padding: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .showcase-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .showcase-item:hover::before {
            left: 100%;
        }

        .showcase-item:hover {
            transform: translateY(-10px);
            border-color: var(--primary-gold);
            box-shadow: var(--shadow-gold);
        }

        .showcase-item:nth-child(1) {
            grid-row: span 2;
        }

        .showcase-item:nth-child(2) {
            align-self: start;
        }

        .showcase-item:nth-child(3) {
            align-self: end;
        }

        .showcase-item i {
            font-size: 48px;
            color: var(--primary-gold);
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .showcase-item:hover i {
            transform: scale(1.1);
        }

        .showcase-item h3 {
            color: var(--white);
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 10px;
            text-align: center;
        }

        .showcase-item p {
            color: rgba(255, 255, 255, 0.7);
            text-align: center;
            font-size: 14px;
            line-height: 1.5;
        }

        /* Features Section */
        .features {
            padding: 120px 40px;
            background: var(--white);
            position: relative;
        }

        .features-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 80px;
        }

        .section-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(36px, 4vw, 48px);
            color: var(--text-dark);
            margin-bottom: 20px;
            font-weight: 600;
        }

        .section-header p {
            font-size: 18px;
            color: var(--text-light);
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.7;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 40px;
        }

        .feature-card {
            background: var(--white);
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            border: 1px solid rgba(212, 175, 55, 0.1);
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-gold), var(--accent-brown));
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-luxury);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-gold), #F4D03F);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            font-size: 32px;
            color: var(--white);
            box-shadow: var(--shadow-gold);
        }

        .feature-card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            color: var(--text-dark);
            margin-bottom: 15px;
            font-weight: 600;
        }

        .feature-card p {
            color: var(--text-light);
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .feature-link {
            color: var(--primary-gold);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .feature-link:hover {
            gap: 12px;
        }

        /* Stats Section */
        .stats {
            padding: 80px 40px;
            background: linear-gradient(135deg, var(--primary-black), #2A2A2A);
            color: var(--white);
        }

        .stats-container {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 60px;
            text-align: center;
        }

        .stat-item h3 {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            color: var(--primary-gold);
            margin-bottom: 10px;
            font-weight: 700;
        }

        .stat-item p {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.8);
            letter-spacing: 1px;
        }

        /* CTA Section */
        .cta {
            padding: 120px 40px;
            background: var(--primary-cream);
            text-align: center;
        }

        .cta-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .cta h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(36px, 4vw, 48px);
            color: var(--text-dark);
            margin-bottom: 20px;
            font-weight: 600;
        }

        .cta p {
            font-size: 18px;
            color: var(--text-light);
            margin-bottom: 40px;
            line-height: 1.7;
        }

        /* Footer */
        .footer {
            background: var(--primary-black);
            color: var(--white);
            padding: 60px 40px 30px;
        }

        .footer-container {
            max-width: 1400px;
            margin: 0 auto;
            text-align: center;
        }

        .footer-logo {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 600;
            color: var(--primary-gold);
            margin-bottom: 30px;
            letter-spacing: 2px;
        }

        .footer p {
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 30px;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .social-link {
            width: 50px;
            height: 50px;
            background: var(--glass-bg);
            border: 1px solid rgba(212, 175, 55, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: var(--primary-gold);
            color: var(--primary-black);
            transform: translateY(-3px);
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .nav {
                padding: 15px 20px;
            }
            
            .nav-links {
                gap: 20px;
            }
            
            .nav-link {
                font-size: 14px;
            }
            
            .hero-content {
                grid-template-columns: 1fr;
                gap: 40px;
                padding: 0 20px;
                text-align: center;
            }
            
            .hero-visual {
                height: 400px;
            }
            
            .fashion-showcase {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            
            .showcase-item:nth-child(1) {
                grid-row: span 1;
            }
            
            .features {
                padding: 80px 20px;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            
            .stats-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 40px;
            }
            
            .cta {
                padding: 80px 20px;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.8s ease forwards;
        }

        /* Loading Animation */
        .loading {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease;
        }

        .loading.loaded {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="nav">
        <div class="nav-container">
            <a href="#" class="logo">SevenKey</a>
            <div class="nav-links">
                <a href="#features" class="nav-link">Features</a>
                <a href="#about" class="nav-link">About</a>
                <a href="#contact" class="nav-link">Contact</a>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary">Login</a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content loading">
            <div class="hero-text">
                <h1>Luxury Fashion <span class="highlight">Management</span> System</h1>
                <p>Elevate your fashion business with our sophisticated management platform. Designed for luxury brands that demand excellence in every detail.</p>
                <div class="hero-buttons">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn-primary">Access Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn-primary">Get Started</a>
                            <a href="#features" class="btn-secondary">Learn More</a>
                        @endauth
                    @endif
                </div>
            </div>
            <div class="hero-visual">
                <div class="fashion-showcase">
                    <div class="showcase-item">
                        <i class="fas fa-crown"></i>
                        <h3>Premium Quality</h3>
                        <p>Crafted for luxury fashion brands with uncompromising standards</p>
                    </div>
                    <div class="showcase-item">
                        <i class="fas fa-chart-line"></i>
                        <h3>Analytics</h3>
                        <p>Deep insights into your fashion business performance</p>
                    </div>
                    <div class="showcase-item">
                        <i class="fas fa-users"></i>
                        <h3>Team Management</h3>
                        <p>Efficient workforce coordination and role management</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="features-container">
            <div class="section-header loading">
                <h2>Sophisticated Management Tools</h2>
                <p>Everything you need to run a successful luxury fashion business, designed with elegance and efficiency in mind.</p>
            </div>
            <div class="features-grid">
                <div class="feature-card loading">
                    <div class="feature-icon">
                        <i class="fas fa-tshirt"></i>
                    </div>
                    <h3>Inventory Excellence</h3>
                    <p>Manage your fashion inventory with precision. Track fabrics, designs, and finished products with sophisticated categorization and real-time updates.</p>
                    <a href="#" class="feature-link">Explore Inventory <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="feature-card loading">
                    <div class="feature-icon">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <h3>Team Coordination</h3>
                    <p>Streamline your team workflow with role-based access, task management, and seamless communication tools designed for fashion professionals.</p>
                    <a href="#" class="feature-link">Team Tools <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="feature-card loading">
                    <div class="feature-icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <h3>Business Intelligence</h3>
                    <p>Make informed decisions with comprehensive analytics, sales forecasting, and trend analysis tailored for the fashion industry.</p>
                    <a href="#" class="feature-link">View Analytics <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="feature-card loading">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3>Mobile Ready</h3>
                    <p>Access your fashion business from anywhere with our responsive design and mobile-optimized interface that never compromises on style.</p>
                    <a href="#" class="feature-link">Mobile Access <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="feature-card loading">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Secure & Reliable</h3>
                    <p>Enterprise-grade security protecting your valuable fashion designs, customer data, and business intelligence with military-grade encryption.</p>
                    <a href="#" class="feature-link">Security Details <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="feature-card loading">
                    <div class="feature-icon">
                        <i class="fas fa-palette"></i>
                    </div>
                    <h3>Brand Customization</h3>
                    <p>Customize the platform to reflect your brand identity with personalized themes, colors, and layouts that match your fashion aesthetic.</p>
                    <a href="#" class="feature-link">Customize Now <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="stats-container">
            <div class="stat-item loading">
                <h3>500+</h3>
                <p>Fashion Brands Trust Us</p>
            </div>
            <div class="stat-item loading">
                <h3>99.9%</h3>
                <p>Uptime Reliability</p>
            </div>
            <div class="stat-item loading">
                <h3>24/7</h3>
                <p>Premium Support</p>
            </div>
            <div class="stat-item loading">
                <h3>150+</h3>
                <p>Countries Worldwide</p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta" id="about">
        <div class="cta-container loading">
            <h2>Ready to Elevate Your Fashion Business?</h2>
            <p>Join the elite fashion brands that trust SevenKey for their business management needs. Experience the perfect blend of luxury and functionality.</p>
            @if (Route::has('login'))
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-primary">Access Your Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-primary">Start Your Journey</a>
                @endauth
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="contact">
        <div class="footer-container">
            <div class="footer-logo">SevenKey</div>
            <p>Luxury Fashion Management System - Where Elegance Meets Efficiency</p>
            <div class="social-links">
                <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-link"><i class="fab fa-facebook"></i></a>
                <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
            </div>
            <p>&copy; {{ date('Y') }} SevenKey. All rights reserved. Crafted with passion for fashion excellence.</p>
        </div>
    </footer>

    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Loading animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('loaded');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.loading').forEach(el => {
            observer.observe(el);
        });

        // Initial load animation
        window.addEventListener('load', () => {
            document.querySelector('.hero-content').classList.add('loaded');
        });

        // Nav background on scroll
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('.nav');
            if (window.scrollY > 100) {
                nav.style.background = 'rgba(13, 13, 13, 0.95)';
            } else {
                nav.style.background = 'rgba(13, 13, 13, 0.9)';
            }
        });
    </script>
</body>
</html>
