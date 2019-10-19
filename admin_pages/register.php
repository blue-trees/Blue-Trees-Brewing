<?php
session_start();
require_once("../classes/User.php");

$user = new User;

if(isset($_POST["save"])) {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['uname'];
    $number = $_POST['number'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user->register($fname,$lname,$uname,$number,$address,$email,$password);
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
                <li class="active"><a href="admin.php" class="nav-link text-left">Dashbord</a></li>
                <li><a href="categories.php" class="nav-link text-left">Categories</a></li>
                <li><a href="items.php" class="nav-link text-left">Items</a></li>
                <li><a href="itemImages.php" class="nav-link text-left">Item Images</a></li>
                <li><a href=".php" class="nav-link text-left"></a></li>
                <li><a href=".php" class="nav-link text-left"></a></li>
                <li>
                    <?php
                    if(!isset($_SESSION['user_id'] )){ 
                        echo '<a href="../pages/login.php" class="nav-link text-left">Login</a>';
                    } else {
                        echo '<a href="../pages/logout.php" class="nav-link text-left">Logout</a>';
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
<div class="container">
    <div class="mx-auto text-center mt-5">
        <h2>REGISTER</h2>
    </div>
</div>

<div class="conatiner">
        <div class="card w-75 mx-auto mt-5">
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="">First Name</label>
                        <input type="text" name="fname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Last Name</label>
                        <input type="text" name="lname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">User Name</label>
                        <input type="text" name="uname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Phone number</label>
                        <input type="number" name="number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" name="address" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Email Address</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <button type="submit" name="save" class="btn btn-primary">SAVE</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

