<?php

include_once './database/Database.php';
include_once './models/Product.php';

class ProductController {

    public function addProduct($data) {
        $product = new Product();
        $product->sku = $data['sku'];
        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->size = $data['size'];
        $product->save();
    }

    public function getProducts() {
        $query = "SELECT * FROM products ORDER BY id ASC";

        $db = new Database();
        $dbConnection = $db->getConnection();

        if ($dbConnection->connect_error) {
            die("Connection failed: " . $dbConnection->connect_error);
        }

        $result = mysqli_query($dbConnection, $query);

        if($result) {
            if($result->num_rows > 0) {
                $products = array();
                while ($row = $result->fetch_assoc()){
                    extract($row);
                    $product = array(
                        "id" => $row["id"],
                        "sku" => $row["sku"],
                        "name" => $row["name"],
                        "price" => $row["price"],
                        "size" => $row["size"],
                    );
                    array_push($products, $product);
                }

                echo json_encode($products);
            } else {
                echo json_encode();
            }
        }
    }

    
}

?>