<?php
session_start();

require_once("../classes/Checkout.php");

$user_id = $_SESSION['user_id'];

$checkout = new Checkout;

$get_user = $checkout->getUser($user_id);

$get_subtotal = $checkout->subtotal($user_id);

$get_cart_item = $checkout->getCartItem($user_id);

if(isset($_POST['purchase'])) {

  if(isset($_POST['checkShipping'])) {

    $fname = $_POST['c_fname'];
    $lname = $_POST['c_lname'];
    $street = $_POST['c_street'];
    $apartment = $_POST['c_apartment'];
    $state = $_POST['c_state'];
    $zip = $_POST['c_zip'];
    $email = $_POST['c_email'];
    $number = $_POST['c_number'];

    $checkout->addShipping($user_id,$fname,$lname,$street,$apartment,$state,$zip,$email,$number);

  } else {

    $fname = $_POST['o_fname'];
    $lname = $_POST['o_lname'];
    $street = $_POST['o_street'];
    $apartment = $_POST['o_apartment'];
    $state = $_POST['o_state'];
    $zip = $_POST['o_zip'];
    $email = $_POST['o_email'];
    $number = $_POST['o_number'];

    $checkout->addShipping($user_id,$fname,$lname,$street,$apartment,$state,$zip,$email,$number);

  }

}

// $to = $get_user['user_email'];
// $subject = "Blue Tree Brewing";
// $message = "Thank you for your purchace.";
// $headers = "From: sylvaticas@gmail.com";

// if(isset($_POST['purchase'])) {

//   mail($to, $subject, $message, $headers);

// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Blue Tree Brewing</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Cinzel:400,700|Montserrat:400,700|Roboto&display=swap" rel="stylesheet"> 
  <link rel="stylesheet" href="../fonts/icomoon/style.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/jquery-ui.css">
  <link rel="stylesheet" href="../css/owl.carousel.min.css">
  <link rel="stylesheet" href="../css/owl.theme.default.min.css">
  <link rel="stylesheet" href="../css/owl.theme.default.min.css">
  <link rel="stylesheet" href="../css/jquery.fancybox.min.css">
  <link rel="stylesheet" href="../css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="../fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="../css/aos.css">
  <link href="../css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="icon" type="image/x-icon" href="../images/favicon.ico">

</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>

    <div class="header-top">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12 text-center">
            <a href="index.php" class="site-logo">
              <img src="../images/logo.png" alt="Image" class="img-fluid">
            </a>
          </div>
          <a href="#" class="mx-auto d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black"><span
                class="icon-menu h3"></span></a>
        </div>
      </div>
      
      <div class="site-navbar py-2 js-sticky-header site-navbar-target d-none pl-0 d-lg-block" role="banner">

      <div class="container">
        <div class="d-flex align-items-center">
          
          <div class="mx-auto">
            <nav class="site-navigation position-relative text-left" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mx-auto d-none pl-0 d-lg-block border-none">
                <li><a href="index.php" class="nav-link text-left">Home</a></li>
                <li><a href="about.php" class="nav-link text-left">About</a></li>
                <li class="active"><a href="shop.php" class="nav-link text-left">Shop</a></li>
                <li><a href="contact.php" class="nav-link text-left">Contact</a></li>
                <li>
                  <?php
                   if(!isset($_SESSION['user_id'] )){ 
                      echo '<a href="login.php" class="nav-link text-left">Login</a>';
                   } else {
                      echo '<a href="logout.php" class="nav-link text-left">Logout</a>';
                   }
                  ?>
                </li>
              </ul>                                                                                                                                                                                                                                                                                         
            </nav>
          </div>
        </div>
      </div>
    </div>
    </div>
  <form method="post">
    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6 mb-5 mb-md-0">
            <h2 class="h3 mb-3 text-black font-heading-serif">Billing Details</h2>
            <div class="p-3 p-lg-5 border">
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="o_fname" value="<?php echo $get_user['first_name']; ?>">
                </div>
                <div class="col-md-6">
                  <label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="o_lname" value="<?php echo $get_user['last_name']; ?>">
                </div>
              </div>
    
              <div class="form-group row">
                <div class="col-md-12">
                  <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="o_street" placeholder="Street address" value="<?php echo $get_user['user_address_st']; ?>">
                </div>
              </div>

              <div class="form-group">
                <input type="text" class="form-control" name="o_apartment" placeholder="Apartment, suite, unit etc. (optional)" value="<?php echo $get_user['user_address_ap']; ?>">
              </div>
    
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="c_state_country" class="text-black">State / Country <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="o_state" value="<?php echo $get_user['user_state']; ?>">
                </div>
                <div class="col-md-6">
                  <label for="c_postal_zip" class="text-black">Posta / Zip <span class="text-danger">*</span></label>
                  <input type="number" class="form-control" name="o_zip" value="<?php echo $get_user['user_zip']; ?>">
                </div>
              </div>
    
              <div class="form-group row mb-5">
                <div class="col-md-6">
                  <label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
                  <input type="email" class="form-control" name="o_email" value="<?php echo $get_user['user_email']; ?>">
                </div>
                <div class="col-md-6">
                  <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                  <input type="number" class="form-control" name="o_number" placeholder="Phone Number" value="<?php echo $get_user['user_number']; ?>">
                </div>
              </div>
    
              <!-- <div class="form-group">
                <label for="c_create_account" class="text-black" data-toggle="collapse" href="#create_an_account"
                  role="button" aria-expanded="false" aria-controls="create_an_account"><input type="checkbox" value="1"
                    id="c_create_account"> Create an account?</label>
                <div class="collapse" id="create_an_account">
                  <div class="py-2">
                    <p class="mb-3">Create an account by entering the information below. If you are a returning customer
                      please login at the top of the page.</p>
                    <div class="form-group">
                      <label for="c_account_password" class="text-black">Account Password</label>
                      <input type="email" class="form-control" id="c_account_password" name="c_account_password"
                        placeholder="">
                    </div>
                  </div>
                </div>
              </div> -->
    
    
              <div class="form-group">
                <label for="c_ship_different_address" class="text-black" data-toggle="collapse"
                  href="#ship_different_address" role="button" aria-expanded="false"
                  aria-controls="ship_different_address"><input type="checkbox" name="checkShipping" value="1" id="c_ship_different_address">
                  Ship To A Different Address?</label>
                <div class="collapse" id="ship_different_address">
                  <div class="py-2">

                  <div class="form-group row">
                <div class="col-md-6">
                  <label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="c_fname">
                </div>
                <div class="col-md-6">
                  <label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="c_lname">
                </div>
              </div>
    
              <div class="form-group row">
                <div class="col-md-12">
                  <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="c_street" placeholder="Street address">
                </div>
              </div>

              <div class="form-group">
                <input type="text" class="form-control" name="c_apartment" placeholder="Apartment, suite, unit etc. (optional)" >
              </div>
    
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="c_state_country" class="text-black">State / Country <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="c_state">
                </div>
                <div class="col-md-6">
                  <label for="c_postal_zip" class="text-black">Posta / Zip <span class="text-danger">*</span></label>
                  <input type="number" class="form-control" name="c_zip">
                </div>
              </div>
    
              <div class="form-group row mb-5">
                <div class="col-md-6">
                  <label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
                  <input type="email" class="form-control" name="c_email">
                </div>
                <div class="col-md-6">
                  <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                  <input type="number" class="form-control" name="c_number" placeholder="Phone Number">
                </div>
              </div>
    
                  </div>
    
                </div>
              </div>
    
              <div class="form-group">
                <label for="c_order_notes" class="text-black">Order Notes</label>
                <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control"
                  placeholder="Write your notes here..."></textarea>
              </div>
    
            </div>
          </div>
          <div class="col-md-6">
    
            <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black font-heading-serif">Your Order</h2>
                <div class="p-3 p-lg-5 border">
                  <table class="table site-block-order-table mb-5">
                    <thead>
                      <th>Product</th>
                      <th>Total</th>
                    </thead>
                    <tbody>
                    <tr>
                    <?php
                        if($get_cart_item === FALSE) {
                          echo "<td colspan='6' class='bg-light font-weight-bold'>No Items in Your Cart.</td>";
                        } else {
                          foreach($get_cart_item as $key => $row) {
                            $name = $row['item_name'];
                            $quantity = $row['cart_item_quantity'];
                            $price = $row['cart_item_price'];

                            echo "<tr>";
                            echo "<td>" . $name . "<strong class='mx-2'>" . "x" . "</strong>" . $quantity . "</td>";
                            echo "<td>" . "P " . number_format($row['cart_item_price'],2) . "</td>";
                            echo "</tr>";
                          }
                        }
                      ?>
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
                        <td class="text-black font-weight-bold">P <?php echo number_format($get_subtotal,2); ?></td>
                      </tr>
                      <tr>
                        <td class="text-black"><strong>Shipping Fee</strong></td>
                        <td class="text-black">P 100.00</td>
                      </tr>
                      <tr>
                        <td class="text-black font-weight-bold"><h5 class="font-weight-bold">Order Total</strong></h5>
                        <td class="text-black font-weight-bold"><h5 class="font-weight-bold">P <?php echo number_format($get_subtotal + 100,2); ?></h5>
                      </tr>
                    </tbody>
                  </table>

                  <div class="form-group text-black my-5">
                      <h5 class="my-4 font-weight-bold text-decoration-underlined"><u>How to Purchase</u></h5>
                      <input class="d-inline-block my-3 text-black" type="radio" name="payment" value="creditCard"> Credit Card
                      <br>
                      <input class="d-inline-block my-3 text-black" type="radio" name="payment" value="paypal"> Paypal
                      <br>
                      <input class="d-inline-block my-3 text-black" type="radio" name="payment" value="convinienceStore"> Convinience Store
                  </div>

                  <div class="form-group">
                    <button class="btn btn-primary btn-lg btn-block" name="purchase" type="submit">PlaceOrder</button>
                  </div>
    
                </div>
              </div>
            </div>
    
          </div>
        </div>
      </form>
        <!-- </form> -->
      </div>
    </div>
  

    
    
    <div class="footer">
      <div class="container">
        
        <div class="row">
          <div class="col-12 text-center">
            <div class="social-icons">
              <a href="#"><span class="icon-facebook"></span></a>
              <a href="#"><span class="icon-twitter"></span></a>
              <a href="#"><span class="icon-youtube"></span></a>
              <a href="#"><span class="icon-instagram"></span></a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="copyright">
                <p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- .site-wrap -->


  <!-- loader -->
  <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#ff5e15"/></svg></div>

  <script src="../js/jquery-3.3.1.min.js"></script>
  <script src="../js/jquery-migrate-3.0.1.min.js"></script>
  <script src="../js/jquery-ui.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/owl.carousel.min.js"></script>
  <script src="../js/jquery.stellar.min.js"></script>
  <script src="../js/jquery.countdown.min.js"></script>
  <script src="../js/bootstrap-datepicker.min.js"></script>
  <script src="../js/jquery.easing.1.3.js"></script>
  <script src="../js/aos.js"></script>
  <script src="../js/jquery.fancybox.min.js"></script>
  <script src="../js/jquery.sticky.js"></script>
  <script src="../js/jquery.mb.YTPlayer.min.js"></script>
  <script src="../js/main.js"></script>

</body>

</html>