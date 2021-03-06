<?php

session_start();
require_once("../classes/Cart.php");
include("../classes/Item.php");

$cart = new Cart;
$item = new Item;

if(isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $get_user_name = $cart->getUsername($user_id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Blue Tree Brewing</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Cinzel:400,700|Montserrat:400,700|Roboto&display=swap"
    rel="stylesheet">
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
                  <li><a href="index.php" class="nav-link text-left">Home</a></li>
                  <li><a href="about.php" class="nav-link text-left">About</a></li>
                  <li class="active"><a href="shop.php" class="nav-link text-left">Shop</a></li>
                  <li><a href="contact.php" class="nav-link text-left">Contact</a></li>
                  <!-- <li><a href="cart.php" class="nav-link text-left">Cart</a></li> -->
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section mt-2">
      <div class="container">
        <div class="row mb-2">
          <div class="col-12 section-title text-center mb-2">
            <h2 class="d-block">Our Products</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi, perspiciatis!</p>
          </div>
        </div>

        <div class="mx-auto row mb-4">

          <div class="col-5 ml-3 mx-auto">
            <h6 for="" class="text-black ml-4">Price Sort</h6>
            <div class="row">
              <form action="" method="post" class="mb-3 col-12 form-inline">
                <div class="form-group mx-sm-3 mb-2">
                  <select name="price_order" class="form-control" style="width:280px">
                    <option value="1">Price in Descending Order</option>
                    <option value="2">Price in Ascending Order</option>
                  </select>
                </div>
                <button type="submit" name="price_sort" class="form-group btn btn-primary mb-2">SORT</button>
              </form>
            </div>
          </div>

          <div class="col-5 ml-3 mx-auto">
            <h6 for="" class="text-black ml-4">Category Sort</h6>
            <div class="row">
              <form action="" method="post" class="mb-3 col-12 form-inline">
                <div class="form-group mx-sm-3 mb-2">
                  <select name="category_order" class="form-control" style="width:280px">
                    <?php
                    $result = $item->getCategory();
                    foreach($result as $key => $row) {
                      $category_id = $row['category_id'];
                      $category_name = $row['category_name'];
                      echo "<option value='$category_id'>$category_name</option>";
                    }
                  ?>
                  </select>
                </div>
                <button type="submit" name="category_sort" class="form-group btn btn-primary">SORT</button>
              </form>
            </div>
          </div>

        </div>

        <div class="row">

          <?php
          if(isset($_POST['price_sort'])) {
  
            $price_sort = $_POST['price_order'];
          
            if($price_sort == 1) {
          
              $result = $item->getDesc();
            } elseif($price_sort == 2) {
          
              $result = $item->getAsc();
            }

          } elseif(isset($_POST['category_sort'])){
            
            $category_id = $_POST['category_order'];
            
            $result = $item->getCategoryOrder($category_id);
          } else {

            $result = $item->getItemId();
          }
          foreach($result as $key => $row) {
              $item_id = $row['item_id'];
              $item_name = $row['item_name'];
              $item_image = $row['item_image'];
              $item_price = number_format($row['item_price'], 2);

              echo "
                  <div class='col-lg-4 mb-5 col-md-6'>

                    <div class='wine_v_1 text-center pb-4>
                      <a href='shop-single.php?item_id=$item_id' class='thumbnail d-block mb-4'><img src='../images/$item_image' alt='Image' class='img-fluid'></a>
                      <div>
                        <h3 class='heading mb-1 mt-4'><a href='shop-single.php?item_id=$item_id'>$item_name</a></h3>
                        <span class='price mt-3'>P $item_price</span>
                      </div>

                      <div class='wine-actions'>
                          
                        <h3 class='heading-2'><a href='shop-single.php?item_id=$item_id'>$item_name</a></h3>
                        <span class='price d-block'>P $item_price</span>
                        
                        <a href='cart.php' class='btn add'><span class='icon-shopping-bag mr-3'></span> Add to Cart</a>
                      </div>
                    </div>

                  </div>";
          }
        ?>

        </div>
      </div>
    </div>

    <div class="hero-2" style="background-image: url('../images/hero_2.jpg');">
      <div class="container">
        <div class="row justify-content-center text-center align-items-center">
          <div class="col-md-8">
            <span class="sub-title">Welcome</span>
            <h2>Alcoholes For Everyone</h2>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-light">
      <div class="container">
        <div class="owl-carousel owl-slide-3 owl-slide">

          <blockquote class="testimony">
            <img src="../images/person_1.jpg" alt="Image">
            <p>&ldquo;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero sapiente beatae, nemo quasi quo
              neque consequatur rem porro reprehenderit, a dignissimos unde ut enim fugiat deleniti quae placeat in
              cumque?&rdquo;</p>
            <p class="small text-primary">&mdash; Collin Miller</p>
          </blockquote>
          <blockquote class="testimony">
            <img src="../images/person_2.jpg" alt="Image">
            <p>&ldquo;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero sapiente beatae, nemo quasi quo
              neque consequatur rem porro reprehenderit, a dignissimos unde ut enim fugiat deleniti quae placeat in
              cumque?&rdquo;</p>
            <p class="small text-primary">&mdash; Harley Perkins</p>
          </blockquote>
          <blockquote class="testimony">
            <img src="../images/person_3.jpg" alt="Image">
            <p>&ldquo;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero sapiente beatae, nemo quasi quo
              neque consequatur rem porro reprehenderit, a dignissimos unde ut enim fugiat deleniti quae placeat in
              cumque?&rdquo;</p>
            <p class="small text-primary">&mdash; Levi Morris</p>
          </blockquote>
          <blockquote class="testimony">
            <img src="../images/person_1.jpg" alt="Image">
            <p>&ldquo;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero sapiente beatae, nemo quasi quo
              neque consequatur rem porro reprehenderit, a dignissimos unde ut enim fugiat deleniti quae placeat in
              cumque?&rdquo;</p>
            <p class="small text-primary">&mdash; Allie Smith</p>
          </blockquote>

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
                Copyright &copy;<script>
                  document.write(new Date().getFullYear());
                </script> All rights reserved | This template is made with <i class="icon-heart text-danger"
                  aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
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
  <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
        stroke="#ff5e15" /></svg></div>

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