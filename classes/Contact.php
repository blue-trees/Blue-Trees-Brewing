<?php
require_once("Config.php");




class Contact extends Config {

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

    public function save($fname,$lname,$email,$tel,$message) {
        
        $sql = "INSERT INTO `contacts` (first_name,last_name,email_address,phone_number,message) 
        VALUE ('$fname','$lname','$email','$tel','$message')";

        $result = $this->conn->query($sql);

        if($result === TRUE) {
            header("Location: ../pages/contactThankyou.php");
        } else {
            echo $this->conn->error;
        }
    }
    
    public function getContact() {
            
        $sql = "SELECT * FROM `contacts`";

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