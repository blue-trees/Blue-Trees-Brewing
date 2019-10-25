<?php
require_once("Config.php");
        // email部分

/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* Include the Composer generated autoload.php file. */
require 'C:\xampp\composer\vendor\autoload.php';

class Checkout extends Config {

    public function getUsername($user_id) {
        
        $sql = "SELECT * FROM `users`
        WHERE users.user_id = '$user_id'";

        $result = $this->conn->query($sql);

        if($result->num_rows <= 0) {
            return false;
            
        } elseif ($this->conn->error) {
            echo $this->conn->error;
        } else {
            return $result->fetch_assoc();
        }

    }
        
    public function getUser($user_id) {
        
        $sql = "SELECT * FROM `users` 
        WHERE users.user_id = $user_id";

        $result = $this->conn->query($sql);
        if($result->num_rows <= 0) {
            return false;
        // ※確認：elseif必要？
        } elseif ($this->conn->error) {
            echo $this->conn->error;
        } else {
            return $result->fetch_assoc();
        }

    }

    public function subtotal($user_id) {

        $subtotal = 0;

        $sql = "SELECT SUM(cart_item_price) as total FROM `cart_items` 
        INNER JOIN `carts` ON carts.cart_id = cart_items.cart_id 
        WHERE carts.user_id=$user_id AND cart_status='available'";

        $result = $this->conn->query($sql);

        if($result->num_rows <= 0) {

            return false;

        } else {
            $row = $result->fetch_assoc();

            return $row['total'];
        }

    }

    public function getCartItem($user_id) {
            
        $sql = "SELECT * FROM `cart_items` 
        INNER JOIN `carts` ON carts.cart_id = cart_items.cart_id
        INNER JOIN `items` ON items.item_id = cart_items.item_id
        INNER JOIN `item_images` ON item_images.item_id = cart_items.item_id
        WHERE carts.user_id = $user_id AND cart_status='available'";

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

    public function addShipping($user_id,$fname,$lname,$street,$apartment,$state,$zip,$email,$number) {
        
        $sql = "INSERT INTO `shipping` (user_id,first_name,last_name,address_st,address_ap,state,zip,email,number) VALUE('$user_id','$fname','$lname','$street','$apartment','$state','$zip','$email','$number')";
        $result = $this->conn->query($sql);

        if($result === TRUE) {
            // header("Location: ../pages/thankyou.php");
            return true;
        } else {
            echo $this->conn->error;
        }
    }
    
    public function addCheckout($cart_id,$payment_id) {
        
        $sql = "INSERT INTO `checkouts` (cart_id,payment_id) VALUE('$cart_id','$payment_id')";
        $result = $this->conn->query($sql);

        if(!$result === TRUE) {
            echo $this->conn->error;
        } else {
            return true;
        }
    }

    public function getPayment() {
        
        $sql = "SELECT * FROM `payments`";

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

    public function closeCart($user_id) {

        $sql = "UPDATE `carts` SET cart_status ='close' 
                WHERE user_id = $user_id";

        $result = $this->conn->query($sql);
    }
}