<?php
require_once("Config.php");

class Cart extends Config {

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

public function addToCart($item_id, $quantity, $user_id, $price) {
    // user_idとそのuserのstatusがavailableであるcartを選択
    $sql = "SELECT * FROM carts WHERE user_id=$user_id AND cart_status='available'";
    $result = $this->conn->query($sql);

    // user_idとそのuserのstatusがavailableであるcartが無い場合はcartsTBに新規にuse_idを登録して、
    // 同時にinsert_idでcartsTBのprimary keyであるcart_idを新規に取得する
    // user_idとそのuserのstatusがavailableであるcartがある場合は、そのcartのcart_idを取得する
    if($result->num_rows <= 0){
        $sql = "INSERT INTO `carts`(user_id) VALUES ('$user_id')";
        $result = $this->conn->query($sql);
        $cart_id = $this->conn->insert_id;
    } else {
        $row = $result->fetch_assoc();
        $cart_id = $row['cart_id'];
    }

    if($result) {
        // cart_itemTBとcartTBをcar_idで結合して、shop-singleでaddtocartしたときの
        // user_id,item_idを取得する(statusがavailableのもの)
        $sql = "SELECT * FROM cart_items 
        INNER JOIN carts ON carts.cart_id = cart_items.cart_id
        WHERE carts.user_id=$user_id AND cart_items.item_id=$item_id AND carts.cart_status='available'";
        $result = $this->conn->query($sql);

        // cartにitemが存在しない場合(statusがavailableでない場合)、新規にcart_itemTBに
        // cart_id,item_id,quantity,totalpriceをinsertする
        if($result->num_rows <= 0){
            $total_price = $quantity * $price;
            $sqla = "INSERT INTO `cart_items`(cart_id, item_id, cart_item_quantity, cart_item_price) 
            VALUES ('$cart_id', '$item_id', '$quantity', '$total_price')";
            // $sql = "INSERT INTO `cart_items`(cart_id, item_id, cart_item_quantity, cart_item_price) 
            //         VALUES ($cart_id, $item_id, $quantity, $total_price)　AND `items`(item_quantity) VALUE ('$quantity') 
            //         INNER JOIN　`items` ON items.items_id = cart_items.items_id";
            $result = $this->conn->query($sqla);
        // cartにitemが存在する場合(statusがavailableの場合)、
        // cart_id,item_id,quantity,totalpriceをupdateする
        } else {
            $row = $result->fetch_assoc();
            $ci_id = $row['cart_item_id'];
            $total_quantity = $row['cart_item_quantity'] + $quantity;
            $total_price = $total_quantity * $price;
            $sql = "UPDATE cart_items SET cart_item_quantity=$total_quantity,
                    cart_item_price=$total_price WHERE cart_item_id=$ci_id";
            $result = $this->conn->query($sql);
        }

        if($result) {
        $sql = "UPDATE `items` SET item_quantity=$quantity WHERE item_id = $item_id";

            $result = $this->conn->query($sql);

        }

        if($result) {
            return true;
        }
    }
}

}