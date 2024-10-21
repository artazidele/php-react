<?php

include_once './database/Database.php';
include_once './models/Product.php';

include './models/Book.php';
include './models/Disk.php';
include './models/Furniture.php';

class ProductController {

    public function addProduct($data) {
        $product = new $data['type']($data, NULL);
        $product->create();
    }

    public function deleteProduct($data) {
        $db = new Database();
        $dbConnection = $db->getConnection();

        if ($dbConnection->connect_error) {
            die("Connection failed: " . $dbConnection->connect_error);
        }

        $query = "DELETE FROM products WHERE id=".$data['id'];

        if (mysqli_query($dbConnection, $query)) {
            echo "Success";
        } else {
            echo $dbConnection->error;
        }
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
                    $product = new $row['type']($row, $row["id"]);
                    array_push($products, unserialize($product->getJsonData()));
                }
                echo json_encode($products);
            } else {
                echo json_encode();
            }
        }
    }

    public function checkUniqueSku($newSku): Int {
        $query = "SELECT * FROM products ORDER BY id ASC";

        $db = new Database();
        $dbConnection = $db->getConnection();

        if ($dbConnection->connect_error) {
            die("Connection failed: " . $dbConnection->connect_error);
        }

        $result = mysqli_query($dbConnection, $query);
        if($result) {
            if($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()){
                    extract($row);
                    if ($row['sku'] == $newSku) {
                        return 0;
                    }
                }
            }
        }
        return 1;
    }
}

?>