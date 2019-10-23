<?php
require_once("Config.php");

class User extends Config {

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

    public function register($fname,$lname,$uname,$number,$address_st,$address_ap,$state,$zip,$email,$password) {
        
        $hash_password = md5($password);
        $sql = "INSERT INTO users(first_name,last_name,user_name,user_number,user_address_st,user_address_ap,user_state,user_zip,user_email,user_password) VALUE('$fname','$lname','$uname','$number','$address_st','$address_ap','$state','$zip','$email','$hash_password')";
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
        // 　※確認：以下一文でuser_idのsessionを開始している？
            $_SESSION['user_id'] = $row['user_id'];

            if($row["user_role"] === 'admin'){

                header("Location: ../admin_pages/admin.php");

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