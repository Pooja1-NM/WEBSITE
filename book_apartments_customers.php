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
            <h1 class="heading mb-3">Rooms</h1>
            <ul class="custom-breadcrumbs mb-4">
              <li><a href="index.html">Home</a></li>
              <li>&bullet;</li>
              <li>Rooms</li>
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

              $from_date = $_POST['from_date'];
              $to_date = $_POST['to_date'];
              $team = $_POST['team'];
?>
             

    <section class="section">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-10">
            <h2 class="heading" data-aos="fade-up">Discover Your Perfect Retreat</h2>
            
          </div>
        </div>
        <div class="row">
         
<div class="col-md-2"></div>
          <div class="col-md-6 col-lg-4" data-aos="fade-up">
            <a href="#" class="room">
              <figure class="img-wrap">
                <img src="images/r1.JPG" alt="Free website template" class="img-fluid mb-3">
              </figure>
              <div class="p-3 text-center room-info">
                <h2>2BHK - Apartment</h2>
                 <span class="text-uppercase" style="color: black;"> Capacity - 2</span><br>
				 
                <span class="text-uppercase letter-spacing-1"><?php echo  " \u{20B9}"; ?> 4980 / per night</span><br>
				 
				 <form action="book_apmt_Customer_side.php" method="post">
             <button type="submit" class="btn btn-primary" style="color: white;">Book Now</button>
              <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">
                              <input type="hidden" name="from_date" value="<?php echo $from_date; ?>">
                              <input type="hidden" name="to_date" value="<?php echo $to_date; ?>">
                              <input type="hidden" name="team" value="<?php echo $team; ?>">
                              <input type="hidden" name="room_type" value="2bhk">
                               </form>
				 
              </div>
            </a>
          </div>


  <div class="col-md-6 col-lg-4" data-aos="fade-up">
            <a href="#" class="room">
              <figure class="img-wrap">
                <img src="images/p1.JPG" alt="Free website template" class="img-fluid mb-3">
              </figure>
              <div class="p-3 text-center room-info">
                <h2>Pent House</h2>
                 <span class="text-uppercase" style="color: black;">Capacity - 6</span><br>
				
                <span class="text-uppercase letter-spacing-1"><?php echo  " \u{20B9}"; ?> 6000 / per night</span><br>
				 
				 
				 <form action="book_apmt_Customer_side.php" method="post">
             <button type="submit" class="btn btn-primary" style="color: white;">Book Now</button>
              <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">
                              <input type="hidden" name="from_date" value="<?php echo $from_date; ?>">
                              <input type="hidden" name="to_date" value="<?php echo $to_date; ?>">
                              <input type="hidden" name="team" value="<?php echo $team; ?>">
                              <input type="hidden" name="room_type" value="penthouse">
                               </form>
				 
              </div>
            </a>
          </div>



        
        </div>
		
		<br>
		<br>
		 <div class="row">
		  
         
        
        </div>
		
		
      </div>
    </section>
    
       

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
            <p><span class="d-block"><span class="ion-ios-location h5 mr-3" style="color: #ffffff;"></span>Address:</span> <span> The Aetheria Service Apartment,  <br> Shetty street Chikmagalur - 577101.</span></p>
             </div>
		  
		   <div class="col-md-3 mb-5 pr-md-5 contact-info"><!-- <li>198 West 21th Street, <br> Suite 721 New York NY 10016</li> -->
            <p><span class="d-block"><span class="ion-ios-location h5 mr-3" style="color: #ffffff;"></span>Address:</span> <span> Aetheria Lake Front Cottage,  <br>  MMD village,  Mugthihalli post Chikmagalur - 577133.</span></p>
              </div>
		  
          <div class="col-md-3 mb-5">
          <p><span class="d-block"><span class="ion-ios-telephone h5 mr-3" style="color: #ffffff;"></span>Phone:</span> <span> (+91) 7019454382</span></p>
            <p><span class="d-block"><span class="ion-ios-email h5 mr-3" style="color: #ffffff;"></span>Email:</span> <span> aetheriahospitality@gmail.com</span></p>
         
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