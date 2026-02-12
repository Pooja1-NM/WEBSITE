<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Avaa's Cafe | Aetheria Hospitality - Artisanal Cafe & Coffee Experience</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Experience artisanal coffee and authentic cuisine at Avaa's Cafe. A perfect blend of local flavors and international delights in Chikmagalur." />
    <meta name="keywords" content="Avaa's Cafe Chikmagalur, coffee shop, cafe, restaurant, Aetheria Hospitality cafe" />
    <meta name="author" content="Aetheria Hospitality" />
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    
    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style.css">
    
    <style>
        :root {
            --primary-color: #192436;
            --secondary-color: #192436;
            --accent-color: #f8f5f0;
            --light-color: #f8f5f0;
            --dark-color: #192436;
            --text-color: #333333;
            --text-light: #666666;
            --border-radius: 12px;
            --box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            --transition: all 0.3s ease;
        }
        
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-color);
            line-height: 1.6;
            overflow-x: hidden;
            background-color: #f9f9f9;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            color: var(--dark-color);
        }
        
        /* Header */
        .simple-header {
            background: white;
            box-shadow: 0 2px 20px rgba(0,0,0,0.05);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            padding: 15px 0;
        }
        
        .simple-header .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .simple-header .logo {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 24px;
            color: #192436;
            text-decoration: none;
        }
        
        .simple-header .logo span {
            color: #8B4513;
        }
        
        /* Desktop Menu */
        .desktop-menu {
            display: flex;
            gap: 30px;
            align-items: center;
        }
        
        .desktop-menu a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            padding: 8px 0;
            position: relative;
        }
        
        .desktop-menu a:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background: #8B4513;
            bottom: 0;
            left: 0;
            transition: width 0.3s ease;
        }
        
        .desktop-menu a:hover:after {
            width: 100%;
        }
        
        .desktop-menu .book-btn {
            background: #8B4513;
            color: white;
            padding: 10px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
        }
        
        /* Mobile Hamburger Menu */
        .hamburger-menu {
            display: none;
            cursor: pointer;
            flex-direction: column;
            gap: 4px;
        }
        
        .hamburger-menu span {
            width: 25px;
            height: 2px;
            background: #192436;
            transition: 0.3s;
        }
        
        .mobile-menu {
            display: none;
            position: fixed;
            top: 70px;
            left: 0;
            width: 100%;
            background: white;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .mobile-menu.active {
            display: block;
        }
        
        .mobile-menu a {
            display: block;
            padding: 15px;
            color: #333;
            text-decoration: none;
            border-bottom: 1px solid #eee;
            font-weight: 500;
        }
        
        .mobile-menu a:hover {
            background: #f8f5f0;
            padding-left: 20px;
        }
        
        .mobile-menu .book-btn {
            background: #8B4513;
            color: white;
            text-align: center;
            margin-top: 15px;
            border-radius: 5px;
        }
        
        /* Hero Section */
        .cafe-hero {
            height: 60vh;
            min-height: 500px;
            background: linear-gradient(rgba(62, 39, 35, 0.85), rgba(62, 39, 35, 0.7)), url('images/food-1.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            margin-top: 70px;
        }
        
        .cafe-hero-content {
            color: white;
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .cafe-hero h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .hero-subtitle {
            font-size: 1.2rem;
            color: rgba(255,255,255,0.9);
            max-width: 600px;
            margin: 0 auto 30px;
            line-height: 1.6;
        }
        
        /* About Cafe */
        .about-cafe {
            padding: 80px 0;
            background: white;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }
        
        .section-title h2 {
            font-size: 2.5rem;
            position: relative;
            display: inline-block;
            padding-bottom: 15px;
        }
        
        .section-title h2:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--secondary-color);
        }
        
        .cafe-description {
            font-size: 1.1rem;
            color: var(--text-light);
            line-height: 1.8;
            max-width: 800px;
            margin: 0 auto 40px;
            text-align: center;
        }
        
        /* Features Section */
        .cafe-features {
            padding: 80px 0;
            background: var(--light-color);
        }
        
        .feature-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 30px;
            text-align: center;
            height: 100%;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            border: 1px solid #f0f0f0;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: white;
            font-size: 2rem;
        }
        
        .feature-card h3 {
            color: var(--dark-color);
            margin-bottom: 15px;
            font-size: 1.3rem;
        }
        
        .feature-card p {
            color: var(--text-light);
            margin-bottom: 0;
            font-size: 0.95rem;
        }
        
        /* Menu Highlights */
        .menu-highlights {
            padding: 80px 0;
            background: white;
        }
        
        .menu-card {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            height: 100%;
        }
        
        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        
        .menu-image {
            height: 200px;
            overflow: hidden;
        }
        
        .menu-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .menu-card:hover .menu-image img {
            transform: scale(1.05);
        }
        
        .menu-content {
            padding: 25px;
        }
        
        .menu-content h3 {
            color: var(--dark-color);
            margin-bottom: 10px;
            font-size: 1.2rem;
        }
        
        .menu-content p {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 15px;
        }
        
        .menu-price {
            color: var(--secondary-color);
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        /* Gallery */
        .gallery-section {
            padding: 80px 0;
            background: var(--light-color);
        }
        
        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: var(--border-radius);
            margin-bottom: 30px;
            box-shadow: var(--box-shadow);
        }
        
        .gallery-item img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .gallery-item:hover img {
            transform: scale(1.05);
        }
        
        /* Contact Section */
        .contact-section {
            padding: 80px 0;
            background: white;
        }
        
        .contact-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 40px;
            box-shadow: var(--box-shadow);
            height: 100%;
        }
        
        .contact-info {
            display: flex;
            align-items: flex-start;
            margin-bottom: 25px;
            padding-bottom: 25px;
            border-bottom: 1px solid #eee;
        }
        
        .contact-info:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .contact-icon {
            width: 50px;
            height: 50px;
            background: var(--light-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            color: var(--secondary-color);
            font-size: 1.2rem;
        }
        
        .contact-details h4 {
            color: var(--dark-color);
            margin-bottom: 5px;
            font-size: 1.1rem;
        }
        
        .contact-details p {
            color: var(--text-light);
            margin-bottom: 0;
        }
        
        .contact-details a {
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 500;
        }
        
        .contact-details a:hover {
            text-decoration: underline;
        }
        
        /* Hours Card */
        .hours-card {
            background: linear-gradient(135deg, var(--dark-color), var(--primary-color));
            color: white;
            border-radius: var(--border-radius);
            padding: 40px;
            height: 100%;
        }
        
        .hours-card h3 {
            color: white;
            margin-bottom: 25px;
            text-align: center;
            font-size: 1.5rem;
        }
        
        .hours-list {
            list-style: none;
            padding: 0;
        }
        
        .hours-list li {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .hours-list li:last-child {
            border-bottom: none;
        }
        
        .day {
            font-weight: 500;
        }
        
        .time {
            color: var(--accent-color);
            font-weight: 600;
        }
        
        /* Map Section */
        .map-section {
            padding: 80px 0;
            background: var(--light-color);
        }
        
        .map-container {
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            height: 450px;
        }
        
        .map-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
        
        /* CTA Section */
        .cta-section {
            padding: 80px 0;
            background: linear-gradient(rgba(62, 39, 35, 0.85), rgba(62, 39, 35, 0.7)), url('images/cafe-bg.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
        }
        
        .cta-content h2 {
            color: white;
            margin-bottom: 20px;
        }
        
        .cta-content p {
            color: rgba(255,255,255,0.9);
            max-width: 600px;
            margin: 0 auto 30px;
            font-size: 1.1rem;
        }
        
        .btn-secondary {
            background: transparent;
            border: 2px solid var(--accent-color);
            color: white;
            padding: 12px 35px;
            border-radius: 30px;
            font-weight: 600;
            transition: var(--transition);
            display: inline-block;
            text-decoration: none;
            margin: 0 10px;
        }
        
        .btn-secondary:hover {
            background: var(--accent-color);
            color: var(--dark-color);
            transform: translateY(-2px);
        }
        
        .btn-primary {
            background: var(--accent-color);
            border: 2px solid var(--accent-color);
            color: var(--dark-color);
            padding: 12px 35px;
            border-radius: 30px;
            font-weight: 600;
            transition: var(--transition);
            display: inline-block;
            text-decoration: none;
            margin: 0 10px;
        }
        
        .btn-primary:hover {
            background: transparent;
            color: white;
            transform: translateY(-2px);
        }
        
        /* Footer */
        footer {
            background: var(--dark-color);
            color: white;
            padding: 60px 0 20px;
        }
        
        footer h5 {
            color: white;
            margin-bottom: 25px;
            font-size: 1.2rem;
            position: relative;
            padding-bottom: 10px;
        }
        
        footer h5:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background: var(--accent-color);
        }
        
        footer ul {
            list-style: none;
            padding: 0;
        }
        
        footer ul li {
            margin-bottom: 10px;
        }
        
        footer ul li a {
            color: #ccc;
            text-decoration: none;
            transition: var(--transition);
        }
        
        footer ul li a:hover {
            color: var(--accent-color);
        }
        
        .contact-detail {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
        }
        
        .contact-detail i {
            color: var(--accent-color);
            margin-right: 10px;
            margin-top: 5px;
        }
        
        .copyright {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255,255,255,0.1);
            margin-top: 40px;
            color: #aaa;
        }
        
        /* WhatsApp Button */
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 30px;
            right: 30px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .whatsapp-float:hover {
            background-color: #128C7E;
            transform: scale(1.1);
        }
        
        /* Responsive */
        @media (max-width: 991px) {
            .desktop-menu {
                display: none;
            }
            
            .hamburger-menu {
                display: flex;
            }
            
            .cafe-hero h1 {
                font-size: 2.5rem;
            }
        }
        
        @media (max-width: 768px) {
            .cafe-hero {
                height: 50vh;
                min-height: 400px;
            }
            
            .section-title h2 {
                font-size: 2rem;
            }
            
            .contact-card, .hours-card {
                padding: 25px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <header class="simple-header">
        <div class="container">
            <a href="index.html" class="logo">
                THE AETHERIA <span>HOSPITALITY</span>
            </a>
            
            <div class="desktop-menu">
                <a href="index.html">Home</a>
                <a href="about1.html">Service Apartment</a>
                <a href="about.html">Estate Retreat</a>
                <a href="food_order.php">Ava's Cafe</a>
                <a href="contact.html">Contact</a>
                
            </div>
            
            <div class="hamburger-menu" id="hamburgerMenu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        
        <div class="mobile-menu" id="mobileMenu">
            <a href="index.html">Home</a>
            <a href="about1.html">Service Apartment</a>
            <a href="about.html">Estate Retreat</a>
            <a href="food_order.php">Ava's Cafe</a>
            <a href="contact.html">Contact</a>
           
        </div>
    </header>

    <!-- Hero Section -->
    <section class="cafe-hero">
        <div class="container">
            <div class="cafe-hero-content" data-aos="fade-up">
                <h1>Avaa's Cafe</h1>
                <p class="hero-subtitle">Where every cup tells a story, and every meal is a celebration of local flavors and international delights in the heart of Chikmagalur.</p>
                <div class="mt-4">
                    <a href="#menu" class="btn-secondary">
                        <i class="fas fa-utensils me-2"></i> View Menu
                    </a>
                    <a href="#order" class="btn-primary">
                        <i class="fas fa-shopping-cart me-2"></i> Order Online
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Cafe -->
    <!--section class="about-cafe">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Our Story</h2>
            </div>
            
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="cafe-description">
                        <p>Nestled in the serene hills of Chikmagalur, Avaa's Cafe is more than just a coffee shop—it's an experience. Born from our passion for authentic flavors and warm hospitality, we bring you the finest locally sourced coffee beans blended with international culinary artistry.</p>
                        <p>Our cafe offers a perfect escape where the aroma of freshly brewed coffee meets the charm of rustic elegance. Whether you're starting your day with a perfect espresso, enjoying a leisurely lunch, or unwinding with evening snacks, every moment at Avaa's is crafted with care.</p>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="image-grid">
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="gallery-item">
                                    <img src="images/cafe-1.jpg" alt="Coffee Brewing">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="gallery-item">
                                    <img src="images/cafe-2.jpg" alt="Cafe Interior">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="gallery-item">
                                    <img src="images/cafe-3.jpg" alt="Fresh Pastries">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="gallery-item">
                                    <img src="images/cafe-4.jpg" alt="Outdoor Seating">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section-->

 

  

    <!-- Contact & Hours -->
    <section class="contact-section">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Visit Us</h2>
                <p class="cafe-description">Find us and plan your visit</p>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-8" data-aos="fade-right">
                    <div class="contact-card">
                        <h3 class="mb-4" style="color: var(--dark-color);">Contact Information</h3>
                        
                        <div class="contact-info">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Location</h4>
                                <p>Avaa's Cafe, Sirgonda, Menasina, Malledevarahalli</p>
                                <p>Chikkamagaluru, Karnataka 577133, India</p>
                            </div>
                        </div>
                        
                        <div class="contact-info">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Phone Numbers</h4>
                                <p><a href="tel:+918147475109">(+91) 8147475109</a></p>
                                <p><a href="tel:+917019454382">(+91) 7019454382</a></p>
                            </div>
                        </div>
                        
                        <div class="contact-info">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Email</h4>
                                <p><a href="mailto:Cafeavaas@gmail.com">Cafeavaas@gmail.com</a></p>
                            </div>
                        </div>
                        
                        <div class="contact-info">
                            <div class="contact-icon">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <div class="contact-details">
                                <h4>WhatsApp Orders</h4>
                                <p><a href="https://wa.me/918147475109" target="_blank">Chat with us for quick orders</a></p>
                                <p style="font-size: 0.9rem; color: var(--text-light); margin-top: 5px;">Available for pre-orders and inquiries</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4" data-aos="fade-left">
                    <div class="hours-card">
                        <h3>Opening Hours</h3>
                        <ul class="hours-list">
                            <li>
                                <span class="day">Monday - Friday</span>
                                <span class="time">7:00 AM - 9:00 PM</span>
                            </li>
                            <li>
                                <span class="day">Saturday</span>
                                <span class="time">7:00 AM - 10:00 PM</span>
                            </li>
                            <li>
                                <span class="day">Sunday</span>
                                <span class="time">8:00 AM - 9:00 PM</span>
                            </li>
                           
                        </ul>
                        
                        <div class="mt-4 pt-4 border-top border-white-10">
                            <p style="font-size: 0.9rem; opacity: 0.8;">
                                <i class="fas fa-info-circle me-2"></i>
                                Extended hours during peak season
                            </p>
                            <p style="font-size: 0.9rem; opacity: 0.8; margin-top: 5px;">
                                <i class="fas fa-utensils me-2"></i>
                                Last orders accepted 30 minutes before closing
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-section">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Find Us</h2>
                <p class="cafe-description">Located in the heart of Chikmagalur's scenic beauty</p>
            </div>
            
            <div class="map-container" data-aos="fade-up">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3883.257497553484!2d75.7390844!3d13.2718426!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bbad7e19f667a4d%3A0x376cef9abfbc5e91!2sAetheria%20Estate%20Retreat!5e0!3m2!1sen!2sin!4v1767376173116!5m2!1sen!2sin" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </section>

    <!-- CTA Section -->


    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>AVA'S CAFE</h5>
                    <p class="mt-3">Experience the perfect blend of local flavors and international cuisine in the heart of Chikmagalur. Fresh coffee, delicious food, and warm hospitality.</p>
                    <div class="social-icons mt-4">
              <a href="https://www.facebook.com/people/The-Aetheria-Service-Apartment/61574034495872/?mibextid=wwXIfr&rdid=sr6s1SDkEVuGVgf3&share_url=https%3A%2F%2Fwww.facebook.com%2Fshare%2F1BgA1t17jM%2F%3Fmibextid%3DwwXIfr" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
              <a href="https://www.instagram.com/accounts/login/?next=%2Ftheaetheriaservice%2F&source=omni_redirect" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
              <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
              <a href="https://wa.me/917019454382" target="_blank" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
            </div>
                </div>
                <div class="col-md-2 mb-4">
                    <h5>Quick Links</h5>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="#menu">Menu</a></li>
                        <li><a href="#order">Order Online</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Information</h5>
                    <ul>
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Delivery Policy</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Cafe Info</h5>
                    <div class="contact-detail">
                        <i class="fas fa-clock"></i>
                        <span>7:00 AM - 9:00 PM Daily</span>
                    </div>
                    <div class="contact-detail">
                        <i class="fas fa-phone"></i>
                        <span>(+91) 8147475109</span>
                    </div>
                    <div class="contact-detail">
                        <i class="fas fa-envelope"></i>
                        <span>Cafeavaas@gmail.com</span>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2024 AVA'S CAFE | Aetheria Hospitality. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Float Button -->
    <a href="https://wa.me/918147475109" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });
        
        // Header toggle script
        document.addEventListener('DOMContentLoaded', function() {
            const hamburgerMenu = document.getElementById('hamburgerMenu');
            const mobileMenu = document.getElementById('mobileMenu');
            
            if (hamburgerMenu && mobileMenu) {
                hamburgerMenu.addEventListener('click', function() {
                    mobileMenu.classList.toggle('active');
                    // Animate hamburger to X
                    const spans = this.querySelectorAll('span');
                    spans[0].style.transform = mobileMenu.classList.contains('active') ? 'rotate(45deg) translate(5px, 5px)' : 'none';
                    spans[1].style.opacity = mobileMenu.classList.contains('active') ? '0' : '1';
                    spans[2].style.transform = mobileMenu.classList.contains('active') ? 'rotate(-45deg) translate(7px, -6px)' : 'none';
                });
                
                // Close menu when clicking a link
                const mobileLinks = mobileMenu.querySelectorAll('a');
                mobileLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        mobileMenu.classList.remove('active');
                        hamburgerMenu.querySelectorAll('span').forEach(span => {
                            span.style.transform = 'none';
                            span.style.opacity = '1';
                        });
                    });
                });
            }
        });
    </script>
</body>
</html>