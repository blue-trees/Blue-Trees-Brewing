<?php
require_once("Config.php");

class Item extends Config {

    public function save($) {
        
        $sql = "UPDATE student INNER JOIN login ON student.loginid=login.loginid
        SET student.studFname = '$fname',login.username = '$uname'";


        $result = $this->conn->query($sql);

        if($result === TRUE) {

            $_SESSION['message'] = "Item added successfully";
            header("Location: ../pages/items.php");
            
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