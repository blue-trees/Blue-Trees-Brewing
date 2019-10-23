<?php
session_start();
require_once('../classes/CartItems.php');

$cart_item = new CartItem;

$user_id = $_SESSION['user_id'];

$id = $_GET['id'];
$action = $_GET['action'];
$quantity = $_GET['quantity'];
$price = $_GET['price'];

// echo $id;
// echo $action;
// echo $quantity;
// echo $price;


if(isset($_POST['subUpdateCart']) && $action === "minus") {

    $cart_item->subUpdateCart($id,$quantity,$price);

} elseif(isset($_POST['addUpdateCart']) && $action === "add") {

    $cart_item->addUpdateCart($id,$quantity,$price);

}

?>