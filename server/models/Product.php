<?php

include_once '../database/Database.php';

abstract class Product {
    private $id;
    private $sku;
    private $name;
    private $price;
    private $type;

    public function __construct($sku, $name, $price, $type) {
        // $this->id = $id;
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->type = $type;
    }


    public function save($query) {
        // $query = "INSERT INTO products(sku, name, price, size) 
        // VALUES ('$this->sku', '$this->name', '$this->price', '$this->size')";

        $db = new Database();
        $dbConnection = $db->getConnection();

        if ($dbConnection->connect_error) {
            die("Connection failed: " . $dbConnection->connect_error);
        }

        if (mysqli_query($dbConnection, $query)) {
            echo "Success";
        } else {
            echo $dbConnection->error;
        }
    }

    
}
?>