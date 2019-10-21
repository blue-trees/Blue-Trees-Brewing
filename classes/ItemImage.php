<?php
require_once("Config.php");

class ItemImage extends Config {

    public function save($id,$directory,$filename,$tmp_name) {
        
        $sql = "INSERT INTO `item_images` (item_id,item_image) VALUES ('$id','$filename')";

        $result = $this->conn->query($sql);

        if($result === TRUE) {
            if(move_uploaded_file($tmp_name, "$directory" . basename($filename))) {

                $_SESSION['message'] = "Item Image added successfully";
                header("Location: ../admin_pages/itemImages.php");
            }

        } else {
            echo $this->conn->error;
        }
    }

    public function getItemImage() {
        
        $sql = "SELECT * FROM `item_images` 
        INNER JOIN `items` ON items.item_id = item_images.item_id";

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