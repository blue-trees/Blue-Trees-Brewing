<?php
require_once("Config.php");

class User extends Config {

    public function register($fname,$lname,$uname,$number,$address,$email,$password) {
        
        $hash_password = md5($password);
        $sql = "INSERT INTO users(first_name,last_name,user_name,user_number,user_address,user_email,user_password) VALUE('$fname','$lname','$uname','$number','$address','$email','$hash_password')";
        $result = $this->conn->query($sql);

        if($result === TRUE) {
            header("Location: ../pages/login.php");
        } else {
            echo $this->conn->error;
        }
    }

    public function login($email,$password) {
        $hash_password = md5($password);

        $sql = "SELECT * FROM users WHERE user_email = '$email'
        AND user_password = '$hash_password'";

        $result = $this->conn->query($sql);

        if($result->num_rows <= 0) {
            return "Invalid Username or Password";

        }else {

            $row = $result->fetch_assoc();
            $_SESSION['user_id'] = $row['user_id'];

            if($row["user_role"] === 'admin'){

                header("Location: ../pages/admin.php");

            }elseif($row["user_role"] === 'user'){

                header("Location: ../pages/index.php");
            }
        }
    }

    public function logout() {

        session_destroy();
        header("Location: ../pages/login.php");
        
    }

}