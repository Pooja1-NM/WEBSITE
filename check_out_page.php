<?php
// Start the session
session_start();

// Check if query parameters are passed in the URL, otherwise use default values
$name = $_GET['name'] ?? '';
$table_name = $_GET['table_name'] ?? '';
$email = $_GET['email'] ?? '';
$id = $_GET['id'] ?? '';
$cn_date = $_GET['cn_date'] ?? ''; // Assuming cn_date is passed via URL
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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

    <section class="site-hero inner-page overlay" style="background-image: url(images/hero_4.jpg)" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
          <div class="col-md-10 text-center" data-aos="fade-up">
            <span class="custom-caption text-uppercase text-white d-block  mb-3">Welcome To THE <span class="fa fa-star text-primary"></span>  Ava's Café </span>
            <h1 class="heading">Where Nature Meets Flavor</h1>
          </div>
        </div>
      </div>
      <a class="mouse smoothscroll" href="#next">
        <div class="mouse-icon">
          <span class="mouse-wheel"></span>
        </div>
      </a>
    </section>

    <section class="section bg-light">
        <form class="md-float-material" method="get" action="food_order1_new.php" enctype="multipart/form-data">              
          <input type="hidden" name="name" value="<?php echo $name; ?>"> 
          <input type="hidden" name="table_name" value="<?php echo $table_name; ?>"> 
          <input type="hidden" name="email" value="<?php echo $email; ?>"> 
          <input type="hidden" name="cn_date" value="<?php echo $cn_date; ?>"> 
          <input type="hidden" name="id" value="<?php echo $id; ?>"> 
          <center><button type="submit" class="btn btn-primary  waves-effect">&nbsp;
            <i class="fas fa-utensils food-symbol"></i> &nbsp;&nbsp; ORDER MORE FOOD  &nbsp;</button></center>                      
        </form>
        <br>

        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-sm-8 table-responsive">
            <table class="table table-striped table-bordered table-hover table-dark table-sm">
              <thead>
                <tr>
                  <th>SL NO</th>
                  <th>DISH</th>
                  <th>QUANTITY</th>
                  <th>CHARGES</th>
                  <th>STATUS</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include 'connection.php';

                $sl_no = 1;

                $query = mysqli_query($connect, "SELECT `dish_name`, `name`, `table_no`, `order_Quantity`, `currentDate`, `status`, `order_id`, `time`, 
                `charges`, `invoice_status`, `email` FROM `food_order` WHERE name='$name' AND table_no='$table_name' AND currentDate='$cn_date' 
                AND email='$email' and invoice_status='No Invoice generated' and customer_id='$id'");

                while ($row = mysqli_fetch_array($query)) {
                    echo "<tr> 
                        <td>$sl_no</td>
                        <td>{$row['dish_name']}</td>
                        <td>{$row['order_Quantity']}</td>
                        <td>{$row['charges']}</td>
                        <td>{$row['status']}</td>
                    </tr>";

                    $sl_no++;
                }
                ?>
              </tbody>
            </table>

            <form class="md-float-material" method="get" action="request_checkout.php" enctype="multipart/form-data">              
              <input type="hidden" name="name" value="<?php echo $name; ?>"> 
              <input type="hidden" name="table_name" value="<?php echo $table_name; ?>"> 
              <input type="hidden" name="currentDate" value="<?php echo $cn_date; ?>"> 
              <input type="hidden" name="email" value="<?php echo $email; ?>"> 
              <input type="hidden" name="id" value="<?php echo $id; ?>"> 
              <center><button type="submit" class="btn btn-primary  waves-effect">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               CHECK OUT &#128722;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></center>                       
            </form>
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
