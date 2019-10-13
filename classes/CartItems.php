<?php
require_once("Config.php");

class CartItem extends Config {

    public function save($item_id) {
        
        $sql = "INSERT INTO `carts` (item_id,) VALUES ('$item_id')";

        $result = $this->conn->query($sql);

        if($result === TRUE) {

            $_SESSION['message'] = "Items added successfully";
            header("Location: ../pages/cart.php");
            
        } else {
            echo $this->conn->error;
        }

    }

    // public function getItem() {
        
    //     $sql = "SELECT * FROM `items` INNER JOIN categories ON categories.category_id = items.category_id";
    //     // INNER JOIN item_images ON item_images.item_id = items.item_id

    //     $result = $this->conn->query($sql);

    //     if($result->num_rows <= 0) {
    //         return false;
    //     } else {
    //         $row = array();

    //         while($row = $result->fetch_assoc()) {
    //             $rows[] = $row;
    //         }

    //         return $rows;
    //     }

    // }

    
    // public function getSingleItem($item_id) {
        
    //     $sql = "SELECT * FROM `items`  WHERE item_id = '$item_id'";

    //     $result = $this->conn->query($sql);

    //     if($result->num_rows <= 0) {
    //         return false;
    //     } elseif ($this->conn->error) {
    //         echo $this->conn->error;
    //     } else {
    //         return $result->fetch_assoc();
    //     }

    // }



}