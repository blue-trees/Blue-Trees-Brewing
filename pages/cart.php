<?php

session_start();

require_once("../classes/CartItems.php");

$user_id = $_SESSION['user_id'];

$cart_item = new CartItem;

$get_cart_item = $cart_item->getCartItem($user_id);

$get_user_name = $cart_item->getUsername($user_id);

$get_subtotal = $cart_item->subtotal($user_id);

if(isset($_POST['remove'])) {

  $cart_item->removeCartItem();

}

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

    <div class="container mt-4">
      <?php
        if(!isset($_SESSION['user_id'] )){ 
          echo '<a href="login.php" class="nav-link text-right font-weight-bold">Login</a>';
        } else {
          $name = $get_user_name['user_name'];
          echo "<a href='logout.php' class='nav-link text-right font-weight-bold'>Hello! $name (LOGOUT) </a>";
        }
      ?>
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
                <li class="active"><a href="index.php" class="nav-link text-left">Home</a></li>
                <li><a href="about.php" class="nav-link text-left">About</a></li>
                <li><a href="shop.php" class="nav-link text-left">Shop</a></li>
                <li><a href="contact.php" class="nav-link text-left">Contact</a></li>
              </ul>                                                                                                                                                                                                                                                                                         
            </nav>
          </div>
        </div>
      </div>
    </div>
    </div>


    <div class="site-section  pb-0">
      <div class="container">
        <div class="row mb-2 justify-content-center">
          <div class="col-7 section-title text-center mb-5">
            <h2 class="d-block">Cart</h2>
          </div>
        </div>
        <div class="row mb-5">
          <form class="col-md-12" method="post">
            <div class="site-blocks-table">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="product-thumbnail">Image</th>
                    <th class="product-name">Product</th>
                    <th class="product-price">Price</th>
                    <th class="product-quantity">Quantity</th>
                    <th class="product-total">Total</th>
                    <th class="product-remove">Remove</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  if($get_cart_item === FALSE) {
                    echo "<td colspan='6' class='bg-light font-weight-bold'>No Items in Your Cart.</td>";
                  } else {
                    foreach($get_cart_item as $key => $row) {
                      $quantity = $row['cart_item_quantity'];
                      $price = $row['item_price'];
                      $ci_id = $row['cart_item_id'];
                      $item_image = $row['item_image'];
                      echo "<tr>";
                      echo "<td><image src='../images/$item_image' width='100'></td>";
                      echo "<td>" . $row['item_name'] . "</td>";
                      echo "<td>" . number_format($row['item_price'],2) . "</td>";
                      echo "<td>                 
                              <div class='input-group mb-1 mx-auto' style='max-width: 120px;'>
                                <div class='input-group-prepend'>
                                  <form method='post' action='updateCartItem.php?id=$ci_id&quantity=$quantity&price=$price&action=minus'>
                                    <button type='submit' name='subUpdateCart' class='btn btn-outline-primary'>&minus;</button>
                                  </form>
                                </div>
                                <input type='text' name='quantity' class='form-control text-center border px-2 mr-0' value='$quantity'
                                  aria-label='Example text with button addon' aria-describedby='button-addon1'>
                                <div class='input-group-append'>
                                  <form method='post' action='updateCartItem.php?id=$ci_id&quantity=$quantity&price=$price&action=add'>
                                    <button type='submit' name='addUpdateCart' class='btn btn-outline-primary'>&plus;</button>
                                  </form>
                                </div>
                              </div>
                            </td>";
                      echo "<td>" . number_format($row['cart_item_price'],2) . "</td>";
                      echo "<td>
                      <a href ='removeCartItem.php?cart_item_id=$ci_id' class='btn btn-primary'>×</a>
                            </td>";
                      echo "</tr>";
                    }
                  }
                ?>
                </tbody>
              </table>
            </div>
          </form>
        </div>
    
      </div>
    </div>

    <div class="site-section pt-5 bg-light">
      <div class="container">
        <div class="row">

        <div class="col-md-6 pl-5">
          <div class="row justify-content-end">
            <div class="container mt-4">
              <div class="row mb-5">
                <div class="col-md-6 mb-3 mb-md-0">
                  <button class="btn btn-primary btn-md btn-block py-3 ">Update Cart</button>
                </div>
                <div class="col-md-6">
                  <a href="shop.php" class="btn btn-outline-primary btn-md btn-block py-3">Continue Shopping</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        
          <div class="col-md-6 pl-5">
            <div class="row justify-content-end">
              <div class="col-md-11">
                <div class="row">
                  <div class="col-md-12 text-right border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <h3 class="text-black ">Subtotal</h3>
                  </div>
                  <div class="col-md-6 text-right">
                    <h3 class="text-black">P <?php echo number_format($get_subtotal,2); ?></h3>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <h3 class="text-black ">Shipping Fee</h3>
                  </div>
                  <div class="col-md-6 text-right">
                    <h3 class="text-black">P 100.00</h3>
                  </div>
                </div>
                <hr style="background-color:black;">
                <div class="row mb-5">
                  <div class="col-md-6">
                    <h3 class="text-black">Total</h3>
                  </div>
                  <div class="col-md-6 text-right">
                    <h3 class="text-black">P <?php echo number_format($get_subtotal + 100,2); ?></h3>
                  </div>
                </div>
    
                <div class="row">
                  <div class="col-md-12">
                    <a class="btn btn-primary btn-lg btn-block" href="checkout.php?cart_id=<?php echo $row['cart_id']; ?>" >Proceed To Checkout</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
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