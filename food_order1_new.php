<?php
// Start session
session_start();

// Set session lifetime to 4 hours
ini_set('session.gc_maxlifetime', 14400); // 4 hours in seconds
session_set_cookie_params(14400); // Ensure cookies also expire after 4 hours

// Store values in session variables if available
if (isset($_GET['name'])) {
    $_SESSION['name'] = htmlspecialchars($_GET['name']);
}
if (isset($_GET['table_name'])) {
    $_SESSION['table_name'] = htmlspecialchars($_GET['table_name']);
}
if (isset($_GET['email'])) {
    $_SESSION['email'] = htmlspecialchars($_GET['email']);
}

if (isset($_GET['id'])) {
    $_SESSION['id'] = htmlspecialchars($_GET['id']);
}

// Access session variables
$name = $_SESSION['name'] ?? '';
$table_name = $_SESSION['table_name'] ?? '';
$email = $_SESSION['email'] ?? '';
//$cn_date = $_SESSION['cn_date'] ?? '';
$id = $_SESSION['id'] ?? '';
$cn_date = date('Y-m-d');
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
    <style>
        .quantity-input {
            width: 138px;
            padding: 0.25rem;
        }
        table, th, td {
            border: none;
        }
    </style>
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

    <section class="section bg-image overlay" style="background-image: url('images/hero_3.jpg');">
        <div class="container">
            <br><br>
            <br>
            <br>
            <div class="row justify-content-center text-center mb-5">
                <div class="col-md-11">
                    <h2 class="heading text-white" data-aos="fade">CHOOSE ITEMS & QUANTITY FROM MENU</h2>
                </div>
            </div>

            <div class="food-menu-tabs" data-aos="fade">
                <div class="tab-content py-5" id="myTabContent">
                    <div class="tab-pane fade show active text-left" id="mains" role="tabpanel" aria-labelledby="mains-tab">
                        <form action="food_order1_new1.php" method="POST">
                            <div class="row">
                                <!-- South Indian Dishes Column -->
                                <div class="col-md-6">
                                    <h3 class="text-white">South Indian</h3>
                                    <table class="table table-hover">
                                        <tbody>
                                            <?php
                                            include 'connection.php';
                                            $query = mysqli_query($connect, "SELECT `dish_name`, `price` FROM `food_list` WHERE `food_category`='South Indian'");
                                            while ($row = mysqli_fetch_array($query)) {
                                                $dish_name = htmlspecialchars($row['dish_name']);
                                                $price = htmlspecialchars($row['price']);
                                                echo "<tr> 
                                                    <td class='text-white text-opacity-20'><input type='checkbox' name='dish_name[]' value='$dish_name'></td>
                                                    <td class='text-white text-opacity-20'>$dish_name</td>
                                                    <td class='text-white text-opacity-20'>\u{20B9} $price</td>
                                                    <td class='text-white text-opacity-20'>
                                                        <select class='form-control text-opacity-80' name='order_Quantity[$dish_name]'>
                                                            <option value='' disabled selected>Qty</option>
                                                            <option value='1'>1</option>
                                                            <option value='2'>2</option>
                                                            <option value='3'>3</option>
                                                            <option value='4'>4</option>
                                                            <option value='5'>5</option>
                                                            <option value='6'>6</option>
                                                            <option value='7'>7</option>
                                                            <option value='8'>8</option>
                                                            <option value='9'>9</option>
                                                            <option value='10'>10</option>
                                                        </select>
                                                    </td>
                                                </tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- North Indian Dishes Column -->
                                <div class="col-md-6">
                                    <h3 class="text-white">North Indian</h3>
                                    <table class="table table-hover">
                                        <tbody>
                                            <?php
                                            // Query to fetch North Indian dishes
                                            $query = mysqli_query($connect, "SELECT `dish_name`, `price` FROM `food_list` WHERE `food_category`='North Indian'");
                                            while ($row = mysqli_fetch_array($query)) {
                                                $dish_name = htmlspecialchars($row['dish_name']);
                                                $price = htmlspecialchars($row['price']);
                                                echo "<tr> 
                                                    <td class='text-white text-opacity-20'><input type='checkbox' name='dish_name[]' value='$dish_name'></td>
                                                    <td class='text-white text-opacity-20'>$dish_name</td>
                                                    <td class='text-white text-opacity-20'>\u{20B9} $price</td>
                                                    <td class='text-white text-opacity-20'>
                                                        <select class='form-control text-opacity-80' name='order_Quantity[$dish_name]'>
                                                            <option value='' disabled selected>Qty</option>
                                                            <option value='1'>1</option>
                                                            <option value='2'>2</option>
                                                            <option value='3'>3</option>
                                                            <option value='4'>4</option>
                                                            <option value='5'>5</option>
                                                            <option value='6'>6</option>
                                                            <option value='7'>7</option>
                                                            <option value='8'>8</option>
                                                            <option value='9'>9</option>
                                                            <option value='10'>10</option>
                                                        </select>
                                                    </td>
                                                </tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="row">
                                <!-- Desserts Column -->
                                <div class="col-md-6">
                                    <h3 class="text-white">DESSERTS</h3>
                                    <table class="table table-hover">
                                        <tbody>
                                            <?php
                                            // Query to fetch Desserts
                                            $query = mysqli_query($connect, "SELECT `dish_name`, `price` FROM `food_list` WHERE `food_category`='Desserts'");
                                            while ($row = mysqli_fetch_array($query)) {
                                                $dish_name = htmlspecialchars($row['dish_name']);
                                                $price = htmlspecialchars($row['price']);
                                                echo "<tr> 
                                                    <td class='text-white text-opacity-20'><input type='checkbox' name='dish_name[]' value='$dish_name'></td>
                                                    <td class='text-white text-opacity-20'>$dish_name</td>
                                                    <td class='text-white text-opacity-20'>\u{20B9} $price</td>
                                                    <td class='text-white text-opacity-20'>
                                                        <select class='form-control text-opacity-80' name='order_Quantity[$dish_name]'>
                                                            <option value='' disabled selected>Qty</option>
                                                            <option value='1'>1</option>
                                                            <option value='2'>2</option>
                                                            <option value='3'>3</option>
                                                            <option value='4'>4</option>
                                                            <option value='5'>5</option>
                                                            <option value='6'>6</option>
                                                            <option value='7'>7</option>
                                                            <option value='8'>8</option>
                                                            <option value='9'>9</option>
                                                            <option value='10'>10</option>
                                                        </select>
                                                    </td>
                                                </tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Hidden Inputs and Submit Button -->
                            <input type='hidden' name='name' value="<?php echo $_SESSION['name']; ?>">
                            <input type='hidden' name='table_name' value="<?php echo $_SESSION['table_name']; ?>">
                           
                            <input type='hidden' name='email' value="<?php echo $_SESSION['email']; ?>">
                            <input type='hidden' name='id' value="<?php echo $_SESSION['id']; ?>">

                            <center><button type="submit" class="btn btn-primary waves-effect mt-4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PLACE ORDER&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></center>
							</form> 
							
							 <form action="check_out_page2.php" method="GET">
							     <input type='hidden' name='name' value="<?php echo $_SESSION['name']; ?>">
                            <input type='hidden' name='table_name' value="<?php echo $_SESSION['table_name']; ?>">
                           
                            <input type='hidden' name='email' value="<?php echo $_SESSION['email']; ?>">
                            <input type='hidden' name='id' value="<?php echo $_SESSION['id']; ?>">

                            <center><button type="submit" class="btn btn-primary waves-effect mt-4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CHECK OUT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></center>
                         </form>
                         
                         
                    </div>
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