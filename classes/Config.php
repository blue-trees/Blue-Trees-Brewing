<?php

class Config{
    // set the properties for the connections details
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "liquor";

    protected $conn;

    // create a constructor to automatically connect to the database
    public function __construct() {
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->database);

        if($conn->connect_error) {
            die("Connect Error: " . $conn->connect_error);
        }

        $this->conn = $conn;
    }
}