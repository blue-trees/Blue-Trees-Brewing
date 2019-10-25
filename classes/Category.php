<?php
require_once("Config.php");

class Category extends Config {

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

    public function save($category) {
        
        $sql = "INSERT INTO `categories` (category_name) VALUES ('$category')";

        $result = $this->conn->query($sql);

        if($result === TRUE) {

            $_SESSION['message'] = "Category added successfully";
            header("Location: ../admin_pages/categories.php");
            
        } else {
            echo $this->conn->error;
        }

    }

    public function getCategory() {
        
        $sql = "SELECT * FROM categories";

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

    public function getSingleCategory($category_id) {
        
        $sql = "SELECT * FROM `categories` 
        WHERE category_id = '$category_id'";

        $result = $this->conn->query($sql);

        if($result->num_rows <= 0) {
            return false;

        } elseif ($this->conn->error) {
            echo $this->conn->error;
        } else {
            return $result->fetch_assoc();
        }

    }

    public function updateCategory($name,$category_id) {

        $sql = "UPDATE `categories` SET category_name = '$name'
        WHERE category_id = $category_id";

        $result = $this->conn->query($sql);

        if($this->conn->error) {
            echo $this->conn->error;
        }
        else {

            header("Location: ../admin_pages/categories.php");
        }
    }

    public function deleteCategory($category_id) {

        $sql = "DELETE FROM categories WHERE category_id=$category_id";
        $result = $this->conn->query($sql);

        if($this->conn->error) {
            echo $this->conn->error;
        }
        else {
            $_SESSION['message'] = "Category Deleted Successfully.";
            header("Location: ../admin_pages/categories.php");
    }


    }


}