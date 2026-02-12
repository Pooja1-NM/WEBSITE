<?php
		  
include("connection.php");

 $from_date=$_POST['from_date'];
 $to_date=$_POST['to_date'];
 $team=$_POST['team'];
 $room_type=$_POST['room_type'];



?>


<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>THE AETHERIA HOSPITALITY</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=|Roboto+Sans:400,700|Playfair+Display:400,700">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
    <link rel="stylesheet" href="css/fancybox.min.css">
    
    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">

    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    
        <header class="site-header js-site-header">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-6 col-lg-6 site-logo" data-aos="fade"><a href="index.html">THE AETHERIA HOSPITALITY</a></div>
          <div class="col-6 col-lg-6">


            <div class="site-menu-toggle js-site-menu-toggle"  data-aos="fade">
              <span></span>
              <span></span>
              <span></span>
            </div>
            <!-- END menu-toggle -->

            <div class="site-navbar js-site-navbar">
              <nav role="navigation">
                <div class="container">
                  <div class="row full-height align-items-center">
                    <div class="col-md-6 mx-auto">
                          <ul class="list-unstyled menu">
                        <li class="active"><a href="index.html">Home</a></li>
						<!--li><a href="about.html">Lake Front Cottage</a></li-->
						<li><a href="about1.html"> Service Apartment</a></li>
                        <li><a href="reservation_room.html">Reserve Rooms</a></li>
                        <!--li><a href="food_order.php">Ava's Cafe</a></li-->                        
                      </ul>
                    </div>
                  </div>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- END head -->

    <section class="site-hero inner-page overlay" style="background-image: url(images/hero_4.jpg)" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
          <div class="col-md-10 text-center" data-aos="fade">
            <h1 class="heading mb-3">Reservation Form</h1>
            <ul class="custom-breadcrumbs mb-4">
              <li><a href="index.html">Home</a></li>
              <li>&bullet;</li>
              <li>Reservation</li>
            </ul>
          </div>
        </div>
      </div>

      <a class="mouse smoothscroll" href="#next">
        <div class="mouse-icon">
          <span class="mouse-wheel"></span>
        </div>
      </a>
    </section>
    <!-- END section -->






<?php
include("connection.php");

/*
// Get all booked room IDs for the specified date range
$booked_rooms = [];
$query1 = mysqli_query($connect, "SELECT `room_id` FROM `bookings_villa` WHERE  
    (from_date BETWEEN '$from_date' AND '$to_date') 
    OR (output_checkout BETWEEN '$from_date' AND '$to_date')");

while ($row1 = mysqli_fetch_array($query1)) {
    $booked_rooms[] = $row1['room_id'];
}

// Prepare the second query to fetch available rooms
$booked_rooms_string = implode(',', $booked_rooms);
$query = "SELECT `booking_category`, `sub_category`, `charges`, `id`, `capacity` FROM `sub_category_price` 
          WHERE booking_category='AETHERIA LAKE FRONT VILLAS' 
          AND room_type='$room_type'";

// Exclude booked rooms if any
if (!empty($booked_rooms_string)) {
    $query .= " AND id NOT IN ($booked_rooms_string)";
}

$query .= " ORDER BY charges ASC";
*/

$booked_rooms = [];
$query1 = mysqli_query($connect, "SELECT `room_id` 
                                  FROM `bookings_villa` 
                                  WHERE (`from_date` < '$to_date' AND `to_date` > '$from_date')");

while ($row1 = mysqli_fetch_array($query1)) {
    $booked_rooms[] = $row1['room_id'];
}

// Create a string of booked room IDs for the SQL query
$booked_rooms_string = implode(',', $booked_rooms);

// Prepare the second query to fetch available rooms
$query = "SELECT `booking_category`, `sub_category`, `charges`, `id`, `capacity` 
          FROM `sub_category_price` 
          WHERE booking_category='AETHERIA LAKE FRONT VILLAS'  AND room_type='$room_type' ";

// Exclude booked rooms if there are any
if (!empty($booked_rooms_string)) {
    $query .= " AND id NOT IN ($booked_rooms_string)";
}

$query .= " ORDER BY charges ASC";


$result = mysqli_query($connect, $query);

// Display available rooms with booking status
$available_rooms = mysqli_num_rows($result);
?>

<!DOCTYPE HTML>
<html>
<head>
    <!-- (Include your head content here) -->
</head>
<body>
    <!-- (Header and Navigation Code) -->

   <section class="section">
    <div class="container">
        <div class="row">
             
            <?php
            // Check if there are any available rooms
            if ($available_rooms > 0) {
                // If there are available rooms, show them and the booking form
                while ($row = mysqli_fetch_array($result)) {
                    $room_id = htmlspecialchars($row['id']);
                }
                    ?>
                    
                    
                    <!-- Display room details here -->
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <center><h2 class="heading" data-aos="fade-up">Please fill in your basic details and proceed to book your room</h2></center>
                        <h4><?php echo htmlspecialchars($row['sub_category']); ?></h4>
                       

                        <!-- Booking Form -->
                        <form action="book_villa_customers2.php" method="post" class="bg-white p-md-5 p-4 mb-5 border">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="text-black font-weight-bold" for="name">Name</label>
                                    <input type="text" id="name" name="C_name" class="form-control ">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="text-black font-weight-bold" for="phone">Phone</label>
                                    <input type="text" id="phone" class="form-control " name="phone">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label class="text-black font-weight-bold" for="email">Email</label>
                                    <input type="email" id="email" class="form-control" name="email">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-12 form-group">
                                    <label class="text-black font-weight-bold" for="message">Address</label>
                                    <textarea name="address" id="message" class="form-control" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="submit" value="Reserve Now" class="btn btn-primary text-white py-3 px-5 font-weight-bold">
                                </div>
                            </div>

                            <!-- Hidden inputs -->
                            <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">
                            <input type="hidden" name="from_date" value="<?php echo $from_date; ?>">
                            <input type="hidden" name="to_date" value="<?php echo $to_date; ?>">
                            <input type="hidden" name="team" value="<?php echo $team; ?>">
                        </form>
                    </div>
                    <?php
            
            } else {
                // If no rooms are available, display a message
                echo "<p class='text-danger'>All rooms for the selected dates are booked. Please choose another date or select a different room category.</p>";
            }
            ?>
        </div>
    </div>
</section>


    <!-- (Footer and other scripts) -->


   
    
    
<footer class="section footer-section">
      <div class="container">
        <div class="row mb-4">
          <div class="col-md-3 mb-5">
            <ul class="list-unstyled link">
             
              <li><a href="#">Terms &amp; Conditions</a></li>
              <li><a href="#">Privacy Policy</a></li>
             <li><a href="reservation_room.html">Rooms</a></li>
             <li><a href="food_order.php">Restaurant</a></li>
            
            </ul>
          </div>
          <!--div class="col-md-3 mb-5">
            <ul class="list-unstyled link">
              <li><a href="#">Villa(s) &amp; Service Apartment(s)</a></li>
              <li><a href="about.html">About Us</a></li>
              <li><a href="contact.html">Contact Us</a></li>
              
            </ul>
          </div-->
          <div class="col-md-3 mb-5 pr-md-5 contact-info"><!-- <li>198 West 21th Street, <br> Suite 721 New York NY 10016</li> -->
            <p><span class="d-block"><span class="ion-ios-location h5 mr-3 text-primary"></span>Address:</span> <span> The Aetheria Service Apartment,  <br> Shetty street Chikkmaglure - 577101.</span></p>
             </div>
		  
		   <div class="col-md-3 mb-5 pr-md-5 contact-info"><!-- <li>198 West 21th Street, <br> Suite 721 New York NY 10016</li> -->
            <p><span class="d-block"><span class="ion-ios-location h5 mr-3 text-primary"></span>Address:</span> <span> Aetheria Lake Front Cottage,  <br> Near MMD village, Near government school, Mugthi halli post Chikkmaglure - 577133.</span></p>
              </div>
		  
          <div class="col-md-3 mb-5">
          <p><span class="d-block"><span class="ion-ios-telephone h5 mr-3 text-primary"></span>Phone:</span> <span> (+91) 7019454382</span></p>
            <p><span class="d-block"><span class="ion-ios-email h5 mr-3 text-primary"></span>Email:</span> <span> aetheriahospitality@gmail.com</span></p>
         
          </div>
        </div>
       
      </div>
    </footer>
    
    
    
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    
    
    <script src="js/aos.js"></script>
    
    <script src="js/bootstrap-datepicker.js"></script> 
    <script src="js/jquery.timepicker.min.js"></script> 

    

    <script src="js/main.js"></script>
  </body>
</html>