<?php
require_once("Config.php");

class Cart extends Config {

}
public function checkCart() {
        
    $sql = "SELECT * FROM `cart` WHERE item_id = '$item_id'"
    
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