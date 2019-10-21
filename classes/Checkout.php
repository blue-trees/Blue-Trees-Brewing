<?php
require_once("Config.php");

class Checkout extends Config {
        
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
        WHERE carts.user_id = $user_id";

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
            header("Location: ../pages/thankyou.php");
        } else {
            echo $this->conn->error;
        }
    }
}