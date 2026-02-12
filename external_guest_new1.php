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
          <!--div class="col-6 col-lg-6 site-logo" data-aos="fade"><a href="index.html">THE AETHERIA HOSPITALITY</a></div-->
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

    <!--section class="site-hero inner-page overlay" style="background-image: url(images/hero_4.jpg)" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
          <div class="col-md-10 text-center" data-aos="fade">
            <h1 class="heading mb-3">Dine at Ava's Café</h1>
            <ul class="custom-breadcrumbs mb-4">
              <li><a href="index.html">Home</a></li>
              <li>&bullet;</li>
              <li>Avs`s Cafe</li>
            </ul>
          </div>
        </div>
      </div>

      <a class="mouse smoothscroll" href="#next">
        <div class="mouse-icon">
          <span class="mouse-wheel"></span>
        </div>
      </a>
    </section-->
    <!-- END section -->
 
   


 <section class="section contact-section" id="next">
      <div class="container">
           <center><h1 class="heading mb-3">Login Form.</h1></center>
       
        <div class="row">
          <div class="col-md-3" data-aos="fade-up" data-aos-delay="100"></div>
          <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
            
            <form action="food_order_login.php" method="post" class="bg-white p-md-5 p-4 mb-5 border">
              <div class="row">
                <div class="col-md-6 form-group">
                  <label class="text-black font-weight-bold" for="name">Enter Phone Number</label>
                  <input type="tel" id="name" class="form-control" name="phone">
                </div>
              
          
            

             

              <div class="row">
                <div class="col-md-12 form-group">
                  <label for="adults" class="font-weight-bold text-black">SELECT TABLE </label>
                  <div class="field-icon-wrap">
                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                    <select class="form-control" id="example-single" name="table_name">
    <option value="">SELECT TABLE NUMBER</option>
    <?php
    include("connection.php");

    if ($connect) {
        $queryy = "SELECT `table_name`, `table_id` FROM `table` ";
        $resultt = mysqli_query($connect, $queryy);

        if ($resultt) {
            while ($roww = mysqli_fetch_array($resultt)) {
                echo "<option value='" . htmlspecialchars($roww['table_name']) . "'>" . htmlspecialchars($roww['table_name']) . "</option>"; 
            }
        } else {
            echo "<option value=''>No designations found</option>";
        }
    } else {
        echo "<option value=''>Connection error</option>";
    }
    ?>
</select>
                  </div>
                </div>
              
              </div>


        
            
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 form-group">
                 <center> <input type="submit" value="Generate OTP" class="btn btn-primary text-white py-3
				 px-5 font-weight-bold"></center>
                </div>
              </div>
              
              
                            

              
            </form>


          </div>
         
		 
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