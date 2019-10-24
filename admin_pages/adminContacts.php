<?php

session_start();
require_once("../classes/Item.php");
include("../classes/Contact.php");

$item = new Item;
$contact = new Contact;

$user_id = $_SESSION['user_id'];

$get_user_name = $item->getUsername($user_id);
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
          echo '<a href="../pages/login.php" class="nav-link text-right font-weight-bold">Login</a>';
        } else {
          $name = $get_user_name['user_name'];
          echo "<a href='../pages/logout.php' class='nav-link text-right font-weight-bold'>Hello! $name (LOGOUT) </a>";
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
    </div>
      
      
      <div class="site-navbar py-2 js-sticky-header site-navbar-target d-none pl-0 d-lg-block" role="banner">

      <div class="container">
        <div class="d-flex align-items-center">
          <div class="mx-auto">
            <nav class="site-navigation position-relative text-left" role="navigation">
            <ul class="site-menu main-menu js-clone-nav mx-auto d-none pl-0 d-lg-block border-none">
                <li><a href="admin.php" class="nav-link text-left">Dashbord</a></li>
                <li><a href="categories.php" class="nav-link text-left">Categories</a></li>
                <li  class="active"><a href="items.php" class="nav-link text-left">Items</a></li>
                <li><a href="itemImages.php" class="nav-link text-left">Item Images</a></li>
                <li><a href="adminContacts.php" class="active nav-link text-left">Contacts</a></li>
                <li><a href="../pages/index.php" class="nav-link text-left">User Page</a></li>
              </ul>                                                                                                                                                                                                                                                                                           
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>

    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                <?php
                    if(isset($_SESSION['message'])){
                        echo "<div class='alert alert-success'>" .$_SESSION['message']. "</div>";
                        unset($_SESSION['message']);
                    }
                ?>
                <table class="table table-striped">
                    <thead class="text-center bg-secondary text-white">
                      <th>Contact ID</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email Address</th>
                      <th>Phone Number</th>
                      <th>Message</th>
                    </thead>
                    <tbody class="text-center">
                      <?php
                        $result = $contact->getContact();

                        if($result === FALSE) {
                          echo "<td colspan='6'>No Data Found.</td>";
                        } else {
                          foreach($result as $key => $row) {

                            echo "<tr>";
                            echo "<td>" . $row['contact_id'] . "</td>";
                            echo "<td>" . $row['first_name'] . "</td>";
                            echo "<td>" . $row['last_name'] . "</td>";
                            echo "<td>" . $row['email_address'] . "</td>";
                            echo "<td>" . $row['phone_number'] . "</td>";
                            echo "<td>" . $row['message'] . "</td>";
                            echo "</tr>";
                          }
                        }
                      ?>
                    </tbody>
                </table>
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
