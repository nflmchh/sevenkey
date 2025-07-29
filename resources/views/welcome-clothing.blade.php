<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SevenKey - Premium Fashion Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #f8f9fa;
            color: #2c3e50;
            line-height: 1.6;
        }

        /* Header */
        .header {
            background: white;
            padding: 20px 40px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
            text-decoration: none;
        }

        .nav {
            display: flex;
            gap: 40px;
            align-items: center;
        }

        .nav a {
            color: #6c757d;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav a:hover {
            color: #2c3e50;
        }

        .cart-icon {
            width: 24px;
            height: 24px;
            stroke: #6c757d;
            stroke-width: 2;
            fill: none;
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 40px;
        }

        /* Hero Section - New Arrivals */
        .hero-section {
            background: linear-gradient(rgba(44, 62, 80, 0.6), rgba(44, 62, 80, 0.6)), url('https://images.unsplash.com/photo-1445205170230-053b83016050?w=1200&h=600&fit=crop&crop=center');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 80px 0;
            margin: 40px 0;
            border-radius: 16px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23000" opacity="0.03"/><circle cx="75" cy="75" r="1" fill="%23000" opacity="0.03"/><circle cx="50" cy="10" r="1" fill="%23000" opacity="0.02"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.5;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 56px;
            font-weight: 700;
            color: #495057;
            margin-bottom: 20px;
            letter-spacing: -2px;
        }

        .hero-subtitle {
            font-size: 18px;
            color: #6c757d;
            margin-bottom: 40px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-btn {
            background: #495057;
            color: white;
            padding: 16px 32px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .hero-btn:hover {
            background: #343a40;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(73, 80, 87, 0.3);
        }

        /* Featured Collection */
        .featured-section {
            margin: 80px 0;
        }

        .section-title {
            font-size: 36px;
            font-weight: 700;
            color: #495057;
            text-align: center;
            margin-bottom: 60px;
            letter-spacing: -1px;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-bottom: 40px;
        }

        .products-grid-bottom {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }

        .product-card {
            background: #e9ecef;
            aspect-ratio: 1;
            border-radius: 12px;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .product-card::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60px;
            height: 60px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="%23adb5bd" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>');
            opacity: 0.4;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.1);
        }

        .product-card:hover::before {
            opacity: 0.6;
        }

        /* About Section */
        .about-section {
            margin: 80px 0;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .about-images {
            display: grid;
            grid-template-columns: 2fr 1fr;
            grid-template-rows: 1fr 1fr;
            gap: 16px;
            height: 400px;
        }

        .about-image-large {
            background: #e9ecef;
            border-radius: 12px;
            grid-row: span 2;
            position: relative;
            overflow: hidden;
        }

        .about-image-small {
            background: #e9ecef;
            border-radius: 12px;
            position: relative;
            overflow: hidden;
        }

        .about-image-large::before,
        .about-image-small::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 40px;
            height: 40px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="%23adb5bd" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>');
            opacity: 0.3;
        }

        .about-content h2 {
            font-size: 32px;
            font-weight: 700;
            color: #495057;
            margin-bottom: 24px;
            letter-spacing: -1px;
        }

        .about-content p {
            font-size: 16px;
            color: #6c757d;
            line-height: 1.7;
            margin-bottom: 32px;
        }

        .about-features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .about-feature {
            background: #e9ecef;
            border-radius: 8px;
            aspect-ratio: 1;
            position: relative;
            overflow: hidden;
        }

        .about-feature::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 32px;
            height: 32px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="%23adb5bd" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>');
            opacity: 0.3;
        }

        /* Auth Buttons */
        .auth-buttons {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .btn-login {
            color: #6c757d;
            text-decoration: none;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #f8f9fa;
            color: #2c3e50;
        }

        .btn-dashboard {
            background: #2c3e50;
            color: white;
            text-decoration: none;
            font-weight: 500;
            padding: 10px 20px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .btn-dashboard:hover {
            background: #1a252f;
            transform: translateY(-1px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header {
                padding: 16px 20px;
            }

            .container {
                padding: 0 20px;
            }

            .nav {
                gap: 20px;
            }

            .hero-title {
                font-size: 36px;
            }

            .hero-subtitle {
                font-size: 16px;
            }

            .products-grid,
            .products-grid-bottom {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }

            .about-section {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .about-features {
                grid-template-columns: repeat(3, 1fr);
            }

            .section-title {
                font-size: 28px;
            }

            .about-content h2 {
                font-size: 24px;
            }
        }

        /* Loading Animation - Remove for real images */
        .product-card {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        
        .about-image-large,
        .about-image-small,
        .about-feature {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .product-card::before {
            display: none; /* Hide X icon when we have real images */
        }

        .about-feature::before {
            display: none; /* Hide X icon when we have real images */
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <a href="/" class="logo">SevenKey</a>
            
            <nav class="nav">
                <a href="#home">Home</a>
                <a href="#about">About</a>
                <a href="#contact">Contact</a>
                
                <!-- Cart Icon -->
                <svg class="cart-icon" viewBox="0 0 24 24">
                    <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6.28"/>
                </svg>
                
                <!-- Auth Buttons -->
                <div class="auth-buttons">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn-dashboard">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn-login">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-dashboard">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <!-- Hero Section - New Arrivals -->
        <section class="hero-section">
            <div class="hero-content">
                <h1 class="hero-title">New Arrivals</h1>
                <p class="hero-subtitle">
                    Discover our latest collection of premium fashion management solutions designed for modern businesses.
                </p>
                <a href="{{ route('login') }}" class="hero-btn">Shop Now</a>
            </div>
        </section>

        <!-- Featured Collection -->
        <section class="featured-section">
            <h2 class="section-title">Featured Collection</h2>
            
            <!-- First Row -->
            <div class="products-grid">
                <div class="product-card" style="background-image: url('https://images.unsplash.com/photo-1571945153237-4929e783af4a?w=400&h=400&fit=crop&crop=center');"></div>
                <div class="product-card" style="background-image: url('https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=400&h=400&fit=crop&crop=center');"></div>
                <div class="product-card" style="background-image: url('https://images.unsplash.com/photo-1434389677669-e08b4cac3105?w=400&h=400&fit=crop&crop=center');"></div>
                <div class="product-card" style="background-image: url('https://images.unsplash.com/photo-1551488831-00ddcb6c6bd3?w=400&h=400&fit=crop&crop=center');"></div>
            </div>
            
            <!-- Second Row -->
            <div class="products-grid-bottom">
                <div class="product-card" style="background-image: url('https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?w=400&h=400&fit=crop&crop=center');"></div>
                <div class="product-card" style="background-image: url('https://images.unsplash.com/photo-1485230895905-ec40ba36b9bc?w=400&h=400&fit=crop&crop=center');"></div>
                <div class="product-card" style="background-image: url('https://images.unsplash.com/photo-1506629905607-d7b94c105b76?w=400&h=400&fit=crop&crop=center');"></div>
                <div class="product-card" style="background-image: url('https://images.unsplash.com/photo-1581338834647-b0fb40704e21?w=400&h=400&fit=crop&crop=center');"></div>
            </div>
        </section>

        <!-- About Section -->
        <section class="about-section">
            <!-- Images Column -->
            <div class="about-images">
                <div class="about-image-large" style="background-image: url('https://images.unsplash.com/photo-1469334031218-e382a71b716b?w=400&h=600&fit=crop&crop=center');"></div>
                <div class="about-image-small" style="background-image: url('https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=200&h=200&fit=crop&crop=center');"></div>
                <div class="about-image-small" style="background-image: url('https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?w=200&h=200&fit=crop&crop=center');"></div>
            </div>
            
            <!-- Content Column -->
            <div class="about-content">
                <h2>About Our Brand</h2>
                <p>
                    SevenKey represents the pinnacle of fashion management solutions, combining elegant design with powerful functionality to streamline your business operations and elevate your brand's digital presence.
                </p>
                
                <!-- Small Feature Grid -->
                <div class="about-features">
                    <div class="about-feature" style="background-image: url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=150&h=150&fit=crop&crop=center');"></div>
                    <div class="about-feature" style="background-image: url('https://images.unsplash.com/photo-1558769132-cb1aea458c5e?w=150&h=150&fit=crop&crop=center');"></div>
                    <div class="about-feature" style="background-image: url('https://images.unsplash.com/photo-1540331547168-8b63109225b7?w=150&h=150&fit=crop&crop=center');"></div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
