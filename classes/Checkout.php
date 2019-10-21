<?php
require_once("Config.php");

class Checkout extends Config {

    public function getUser($user_id) {
            
        $sql = "SELECT * FROM `users` 
        WHERE users.user_id = $user_id";

        $result = $this->conn->query($sql);

        if($result->num_rows <= 0) {
            return false;
        } else {
            $row = array();

            while($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }

            return $rows;
        }

    }

    // public function addUpdateCart($id,$quantity,$price) {

    //     $totalQuantity = $quantity + 1;
    //     $totalPrice = $price * $totalQuantity;

    //     $sql = "UPDATE `cart_items` SET cart_item_quantity=$totalQuantity, cart_item_price=$totalPrice 
    //     WHERE cart_item_id=$id";

    //     $result = $this->conn->query($sql);

    //     if($result) {
            
    //         header("Location: cart.php");
            
    //     }
    // }


    // public function subtotal($user_id) {

    //     $subtotal = 0;

    //     $sql = "SELECT SUM(cart_item_price) as total FROM `cart_items` 
    //     INNER JOIN `carts` ON carts.cart_id = cart_items.cart_id 
    //     WHERE carts.user_id=$user_id AND cart_status='available'";

    //     $result = $this->conn->query($sql);

    //     if($result->num_rows <= 0) {

    //         return false;

    //     } else {
    //         $row = $result->fetch_assoc();

    //         return $row['total'];
    //     }

    // }

}