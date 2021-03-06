<?php
require_once("Config.php");

class Item extends Config {

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

    public function save($category,$name,$price,$quantity) {
        
        $sql = "INSERT INTO `items` (category_id,item_name,item_price,item_quantity) VALUES ('$category','$name','$price','$quantity')";

        $result = $this->conn->query($sql);

        if($result === TRUE) {

            $_SESSION['message'] = "Item added successfully";
            header("Location: ../admin_pages/items.php");
            
        } else {
            echo $this->conn->error;
        }

    }

    public function getItem() {
        
        $sql = "SELECT * FROM `items` 
        INNER JOIN categories ON categories.category_id = items.category_id";
        // INNER JOIN item_images ON item_images.item_id = items.item_id

        $result = $this->conn->query($sql);

        if($result->num_rows <= 0) {
            return false;
        } else {
            // ※以下5行の意味
            $row = array();

            while($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }

            return $rows;
        }

    }

    public function getCategory() {
        
        $sql = "SELECT * FROM `categories`";

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

    public function getItemId() {
        
        $sql = "SELECT * FROM `items` 
        INNER JOIN `item_images` ON item_images.item_id = items.item_id";

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

    // DESC SORT
    public function getDesc() {
        
        $sql = "SELECT * FROM `items` 
        INNER JOIN `item_images` ON item_images.item_id = items.item_id
        ORDER BY items.item_price DESC"; 

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

    // ASC SORT
    public function getAsc() {
        
        $sql = "SELECT * FROM `items` 
        INNER JOIN `item_images` ON item_images.item_id = items.item_id
        ORDER BY items.item_price ASC"; 

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

    // CATEGORY SORT
    public function getCategoryOrder($category_id) {
        
        $sql = "SELECT * FROM `items` 
        INNER JOIN `item_images` ON item_images.item_id = items.item_id
        WHERE items.category_id = '$category_id'";

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
    
    public function getSingleItem($item_id) {
        
        $sql = "SELECT * FROM `items` 
        INNER JOIN `item_images` ON item_images.item_id = items.item_id
        WHERE items.item_id = '$item_id'";

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

    public function updateItem($name,$price,$quantity,$item_id) {

        $sql = "UPDATE `items` 
        SET item_name = '$name',
            item_price = '$price',
            item_quantity = '$quantity'
        WHERE item_id = $item_id";

        $result = $this->conn->query($sql);

        if($this->conn->error) {
            echo $this->conn->error;
        }
        else {

            header("Location: ../admin_pages/items.php");
        }
    }

    public function deleteItem($item_id) {

        $sql = "DELETE FROM items WHERE item_id=$item_id";
        $result = $this->conn->query($sql);

        if($this->conn->error) {
            echo $this->conn->error;
        }
        else {
            $_SESSION['message'] = "Item Deleted Successfully.";
            header("Location: ../admin_pages/items.php");
    }


    }




}