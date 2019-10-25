<?php
require_once("Config.php");

class ItemImage extends Config {

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


    public function updateItemImage($directory,$filename,$tmp_name,$item_image_id) {

        $sql = "UPDATE `item_images` 
        SET   item_image = '$filename'
        WHERE item_image_id = $item_image_id";

        $result = $this->conn->query($sql);

        if($result === TRUE) {
            if(move_uploaded_file($tmp_name, "$directory" . basename($filename))) {

                $_SESSION['message'] = "Item Image updated successfully";
                header("Location: ../admin_pages/itemImages.php");
            }

        } else {
            echo $this->conn->error;
        }
    }

    public function deleteItemImage($item_image_id) {

        $sql = "DELETE FROM item_images WHERE item_image_id=$item_image_id";
        $result = $this->conn->query($sql);

        if($this->conn->error) {
            echo $this->conn->error;
        }
        else {
            $_SESSION['message'] = "ItemImage Deleted Successfully.";
            header("Location: ../admin_pages/itemImages.php");
        }


    }



}