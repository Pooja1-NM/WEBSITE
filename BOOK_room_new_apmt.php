<?php
include("connection.php");

// Validate POST
if (!isset($_POST['from_date'], $_POST['to_date'], $_POST['team'], $_POST['room_type'])) {
    die("Invalid request");
}

$from_date = mysqli_real_escape_string($connect, $_POST['from_date']);
$to_date   = mysqli_real_escape_string($connect, $_POST['to_date']);
$team      = (int)$_POST['team'];
$room_type = mysqli_real_escape_string($connect, $_POST['room_type']);

// --------------------------------------
// STEP 1: Get booked rooms (DATE OVERLAP)
// --------------------------------------
$booked_rooms = [];

$bookedQuery = "
    SELECT DISTINCT room_id 
    FROM bookings_apartments 
    WHERE 
        from_date < '$to_date' 
        AND to_date > '$from_date'
";

$bookedResult = mysqli_query($connect, $bookedQuery);

while ($row = mysqli_fetch_assoc($bookedResult)) {
    $booked_rooms[] = $row['room_id'];
}

// If no booked rooms, keep array safe
$booked_rooms_string = !empty($booked_rooms) 
    ? implode(',', array_map('intval', $booked_rooms)) 
    : '0';

// --------------------------------------
// STEP 2: Get available rooms
// --------------------------------------
$availableQuery = "
    SELECT id, booking_category, sub_category, charges, capacity
    FROM sub_category_price
    WHERE 
        booking_category = 'AETHERIA SERVICE APARTMENTS'
        AND room_type = '$room_type'
        AND capacity >= $team
        AND id NOT IN ($booked_rooms_string)
    ORDER BY charges ASC
";

$result = mysqli_query($connect, $availableQuery);
$available_rooms = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Complete Reservation | Aetheria Service Apartments</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Complete your reservation at Aetheria Service Apartments. Fill in your details to confirm your booking." />
    <meta name="keywords" content="reservation, booking, Aetheria, Service Apartments, Chikmagalur" />
    <meta name="author" content="Aetheria Hospitality" />
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #17232F;
            --secondary-color: #ae9d81;
            --accent-color: #2c5530;
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
            color: var(--secondary-color);
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
            background: var(--secondary-color);
            bottom: 0;
            left: 0;
            transition: width 0.3s ease;
        }
        
        .desktop-menu a:hover:after {
            width: 100%;
        }
        
        .desktop-menu .book-btn {
            background: var(--secondary-color);
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
            background: var(--dark-color);
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
            background: var(--light-color);
            padding-left: 20px;
        }
        
        .mobile-menu .book-btn {
            background: var(--secondary-color);
            color: white;
            text-align: center;
            margin-top: 15px;
            border-radius: 5px;
        }
        
        /* Hero Section */
        .reservation-hero {
            height: 50vh;
            min-height: 400px;
            background: linear-gradient(rgba(23, 35, 47, 0.85), rgba(23, 35, 47, 0.7)), url('https://images.unsplash.com/photo-1613977257363-707ba9348227?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            margin-top: 70px;
        }
        
        .reservation-hero-content {
            color: white;
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .reservation-hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .breadcrumb-nav {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-bottom: 30px;
        }
        
        .breadcrumb-nav a {
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            transition: var(--transition);
        }
        
        .breadcrumb-nav a:hover {
            color: var(--secondary-color);
        }
        
        .breadcrumb-nav .separator {
            color: rgba(255,255,255,0.7);
        }
        
        .breadcrumb-nav .current {
            color: var(--secondary-color);
            font-weight: 500;
        }
        
        /* Booking Details */
        .booking-details-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: var(--box-shadow);
        }
        
        .booking-details-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--light-color);
        }
        
        .booking-details-header h3 {
            color: var(--primary-color);
            margin: 0;
        }
        
        .booking-details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }
        
        .detail-item {
            display: flex;
            flex-direction: column;
        }
        
        .detail-label {
            font-size: 0.9rem;
            color: var(--text-light);
            margin-bottom: 5px;
        }
        
        .detail-value {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 1.1rem;
        }
        
        /* Form Section */
        .form-section {
            padding: 80px 0;
        }
        
        .reservation-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 40px;
            box-shadow: var(--box-shadow);
            max-width: 800px;
            margin: 0 auto;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .section-title h2 {
            font-size: 2.5rem;
            position: relative;
            display: inline-block;
            padding-bottom: 15px;
            margin-bottom: 20px;
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
        
        .section-title p {
            color: var(--text-light);
            max-width: 600px;
            margin: 0 auto;
        }
        
        /* Form Styling */
        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 8px;
            display: block;
        }
        
        .form-control {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: var(--transition);
            background: white;
            width: 100%;
        }
        
        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(174, 157, 129, 0.25);
            outline: none;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .form-row .form-group {
            flex: 1;
            min-width: 200px;
        }
        
        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }
        
        /* Button Styling */
        .btn-primary {
            background: var(--secondary-color);
            border: none;
            padding: 14px 30px;
            font-weight: 600;
            border-radius: 30px;
            transition: var(--transition);
            color: white;
            font-size: 1.05rem;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .btn-primary:hover {
            background: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(26, 71, 42, 0.15);
        }
        
        /* Availability Alert */
        .availability-alert {
            padding: 20px;
            border-radius: var(--border-radius);
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .availability-alert.success {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }
        
        .availability-alert.danger {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
        
        .alert-icon {
            font-size: 1.5rem;
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
            background: var(--secondary-color);
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
            color: var(--secondary-color);
        }
        
        .contact-detail {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
        }
        
        .contact-detail i {
            color: var(--secondary-color);
            margin-right: 10px;
            margin-top: 5px;
        }
        
        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: white;
            margin-right: 10px;
            text-decoration: none;
            transition: var(--transition);
        }
        
        .social-icons a:hover {
            background: var(--secondary-color);
            transform: translateY(-3px);
        }
        
        .copyright {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255,255,255,0.1);
            margin-top: 40px;
            color: #aaa;
        }
        
        /* Responsive */
        @media (max-width: 991px) {
            .desktop-menu {
                display: none;
            }
            
            .hamburger-menu {
                display: flex;
            }
            
            .reservation-hero h1 {
                font-size: 2.5rem;
            }
            
            .reservation-card {
                padding: 25px;
            }
            
            .section-title h2 {
                font-size: 2rem;
            }
            
            footer .row {
                text-align: center;
            }
            
            footer h5:after {
                left: 50%;
                transform: translateX(-50%);
            }
        }
        
        @media (max-width: 768px) {
            .reservation-hero {
                height: 40vh;
                min-height: 350px;
            }
            
            .booking-details-grid {
                grid-template-columns: 1fr;
            }
            
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }
        
        /* Room details styling */
        .room-details-section {
            margin-bottom: 30px;
            padding: 25px;
            background: #f8f9fa;
            border-radius: var(--border-radius);
            border-left: 4px solid var(--secondary-color);
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
                <a href="reservation_room.html">Reserve Rooms</a>
                <a href="contact.html">Contact</a>
                <a href="reservation_room.html" class="book-btn">Book Now</a>
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
            <a href="reservation_room.html">Reserve Rooms</a>
            <a href="contact.html">Contact</a>
            <a href="reservation_room.html" class="book-btn">Book Now</a>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="reservation-hero">
        <div class="container">
            <div class="reservation-hero-content" data-aos="fade-up">
                <div class="breadcrumb-nav">
                    <a href="index.html">Home</a>
                    <span class="separator">/</span>
                    <a href="reservation_room.html">Rooms</a>
                    <span class="separator">/</span>
                    <span class="current">Reservation</span>
                </div>
                <h1>Complete Your Reservation</h1>
                <p class="lead mb-4">Just a few details needed to confirm your stay at Aetheria Service Apartments</p>
            </div>
        </div>
    </section>

    <section class="form-section" id="next">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Guest Information</h2>
                <p>Please fill in your details to complete the reservation</p>
            </div>
            
            <div class="reservation-card" data-aos="fade-up" data-aos-delay="100">
                <!-- Booking Summary -->
                <div class="booking-details-card">
                    <div class="booking-details-header">
                        <h3><i class="fas fa-calendar-check me-2"></i> Booking Summary</h3>
                        <?php if($available_rooms > 0): ?>
                            <span class="badge" style="background: var(--secondary-color)!important; padding: 8px 16px; border-radius: 20px; color: white;">
                                <i class="fas fa-check-circle me-1"></i> Available
                            </span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="booking-details-grid">
                        <div class="detail-item">
                            <span class="detail-label">Check-in Date</span>
                            <span class="detail-value"><?php echo htmlspecialchars($_POST['from_date']); ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Check-out Date</span>
                            <span class="detail-value"><?php echo htmlspecialchars($_POST['to_date']); ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Number of Guests</span>
                            <span class="detail-value"><?php echo htmlspecialchars($team); ?> Person(s)</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Accommodation Type</span>
                            <span class="detail-value">Service Apartment</span>
                        </div>
                    </div>
                    
                    <?php if($available_rooms > 0): ?>
                        <div class="availability-alert success">
                            <i class="fas fa-check-circle alert-icon"></i>
                            <div>
                                <strong>Room Available!</strong>
                                <p>Your selected room is available for the chosen dates.</p>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="availability-alert danger">
                            <i class="fas fa-exclamation-circle alert-icon"></i>
                            <div>
                                <strong>No Rooms Available</strong>
                                <p>All rooms for the selected dates are booked. Please choose another date or select a different room category.</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                
                <?php if($available_rooms > 0): ?>
                    <?php 
                    $row = mysqli_fetch_array($result);
                    $room_id = htmlspecialchars($row['id']);
                    ?>
                    
                    <!-- Room Information -->
                    <div class="room-details-section">
                        <div class="booking-details-header">
                            <h3><i class="fas fa-home me-2"></i> Room Details</h3>
                        </div>
                        
                        <div class="booking-details-grid">
                            <div class="detail-item">
                                <span class="detail-label">Apartment Category</span>
                                <span class="detail-value"><?php echo htmlspecialchars($row['sub_category']); ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Capacity</span>
                                <span class="detail-value">Up to <?php echo htmlspecialchars($row['capacity']); ?> Guests</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Nightly Rate</span>
                                <span class="detail-value">₹<?php echo htmlspecialchars($row['charges']); ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Property</span>
                                <span class="detail-value">Aetheria Service Apartments</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Reservation Form -->
                    <form action="book_apartments_customers2.php" method="post" class="reservation-form">
                        <h4 class="mb-4" style="color: var(--primary-color);">
                            <i class="fas fa-user-circle me-2"></i> Guest Information
                        </h4>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name" class="form-label">Full Name *</label>
                                <input type="text" id="name" name="C_name" class="form-control" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="phone" class="form-label">Phone Number *</label>
                                <input type="tel" id="phone" name="phone" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="form-label">Email Address *</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="address" class="form-label">Complete Address</label>
                            <textarea id="address" name="address" class="form-control" rows="4" placeholder="Enter your complete address..."></textarea>
                        </div>
                        
                        
                        
                        <!-- Hidden inputs -->
                        <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">
                        <input type="hidden" name="from_date" value="<?php echo htmlspecialchars($from_date); ?>">
<input type="hidden" name="to_date" value="<?php echo htmlspecialchars($to_date); ?>">

                      
                        <input type="hidden" name="team" value="<?php echo $team; ?>">
                        <input type="hidden" name="room_type" value="<?php echo $room_type; ?>">
                        <input type="hidden" name="charges" value="<?php echo htmlspecialchars($row['charges']); ?>">
                        <input type="hidden" name="room_category" value="<?php echo htmlspecialchars($row['sub_category']); ?>">
                        
                        <div class="mt-4">
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-lock me-2"></i> Confirm Reservation
                            </button>
                        </div>
                        
                        <p class="text-center mt-3" style="color: var(--text-light); font-size: 0.9rem;">
                            By completing this reservation, you agree to our Terms & Conditions and Privacy Policy.
                        </p>
                    </form>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="fas fa-calendar-times" style="font-size: 4rem; color: #dc3545; margin-bottom: 20px;"></i>
                        <h3 class="mb-3" style="color: var(--primary-color);">No Available Rooms</h3>
                        <p class="mb-4" style="color: var(--text-light); max-width: 500px; margin: 0 auto;">
                            We're sorry, but all rooms are booked for your selected dates. Please try different dates or explore other room options.
                        </p>
                        <a href="reservation_room.html" class="btn-primary" style="width: auto; padding: 10px 30px;">
                            <i class="fas fa-arrow-left me-2"></i> Back to Room Selection
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>THE AETHERIA HOSPITALITY</h5>
                    <p class="mt-3">Experience luxury and comfort at our premium service apartments in beautiful Chikmagalur. Enjoy modern amenities with traditional hospitality.</p>
                    <div class="social-icons mt-4">
                        <a href="#" class="me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <h5>Quick Links</h5>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="about1.html">Service Apartment</a></li>
                        <li><a href="about.html">Estate Retreat</a></li>
                        <li><a href="reservation_room.html">Reserve Rooms</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Information</h5>
                    <ul>
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Cancellation Policy</a></li>
                        <li><a href="#">FAQs</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Contact Info</h5>
                    <div class="contact-detail">
                        <i class="fas fa-phone"></i>
                        <span>(+91) 7019454382</span>
                    </div>
                    <div class="contact-detail">
                        <i class="fas fa-envelope"></i>
                        <span>aetheriahospitality@gmail.com</span>
                    </div>
                    <div class="contact-detail">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>The Aetheria Service Apartment,<br>Shetty street Chikkmaglure - 577101</span>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2024 THE AETHERIA HOSPITALITY. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

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
            
            // Form validation
            const form = document.querySelector('.reservation-form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const name = document.getElementById('name')?.value.trim();
                    const phone = document.getElementById('phone')?.value.trim();
                    const email = document.getElementById('email')?.value.trim();
                    
                    // Basic validation
                    if (!name || !phone || !email) {
                        e.preventDefault();
                        alert('Please fill in all required fields marked with *');
                        return false;
                    }
                    
                    // Email validation
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(email)) {
                        e.preventDefault();
                        alert('Please enter a valid email address');
                        return false;
                    }
                    
                    // Phone validation (basic)
                    const phoneRegex = /^[0-9]{10}$/;
                    if (!phoneRegex.test(phone.replace(/\D/g, ''))) {
                        e.preventDefault();
                        alert('Please enter a valid 10-digit phone number');
                        return false;
                    }
                    
                    return true;
                });
            }
        });
    </script>
</body>
</html>