<?php
require_once("Config.php");

class Cart extends Config {


public function checkCart($user_id) {


    if(!isset($_SESSION['user_id'] )){ 

       header("Location: ../pages/cart.php");

    } else {
       echo '<a href="logout.php" class="nav-link text-left">Logout</a>';
        
            $sql = "SELECT * FROM `cart` WHERE user_id = '$user_id'"
            
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

}