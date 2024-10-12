<?php

include_once './database/Database.php';
class Product {
    public $sku;
    public $name;
    public $price;
    public $size;

    public function save() {
        $query = "INSERT INTO products(sku, name, price, size) 
        VALUES ('$this->sku', '$this->name', '$this->price', '$this->size')";

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