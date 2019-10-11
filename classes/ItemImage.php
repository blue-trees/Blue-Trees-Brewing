<?php
require_once("Config.php");

class ItemImage extends Config {

    public function save($item,$image) {
        
        $sql = "INSERT INTO `item_images` (item_id,item_image_name) VALUES ('$item','$image')";

        $result = $this->conn->query($sql);

        if($result === TRUE) {

            $_SESSION['message'] = "Item Image added successfully";
            header("Location: ../pages/itemImages.php");
            
        } else {
            echo $this->conn->error;
        }

    }

    public function getItemImage() {
        
        $sql = "SELECT * FROM `item_images` INNER JOIN items ON items.item_id = item_images.item_id";

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


}