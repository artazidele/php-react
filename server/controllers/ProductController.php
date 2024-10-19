<?php

include_once './database/Database.php';
// include_once '../models/Product.php';

// //
// include '../models/Book.php';
// include '../models/Disk.php';
// include '../models/Furniture.php';
//

abstract class Product {
    protected $id;
    protected $sku;
    protected $name;
    protected $price;
    protected $type;

    public function __construct($sku, $name, $price, $type, $id) {
        $this->id = $id;
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->type = $type;
    }

    public function save($query) {

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

class Disk extends Product {
    private $size;

    public function __construct($data, $id){
        parent::__construct($data['sku'], $data['name'], $data['price'], 'Disk', $id);
        $this->size = $data['size'];

        if ($id === NULL) {
            $query = "INSERT INTO products(sku, name, price, size, type) 
            VALUES ('$this->sku', '$this->name', '$this->price', '$this->size', '$this->type')";
            $this->save($query);
        }
    }
}

class Book extends Product {
    private $weight;

    public function __construct($data, $id){
        parent::__construct($data['sku'], $data['name'], $data['price'], $data['type'], $id);
        $this->weight = $data['weight'];

        if ($id === NULL) {
            $query = "INSERT INTO products(sku, name, price, weight, type) 
            VALUES ('$this->sku', '$this->name', '$this->price', '$this->weight', '$this->type')";
            $this->save($query);
        }
    }
}

class Furniture extends Product {
    private $length;
    private $width;
    private $height;

    public function __construct($data, $id){
        parent::__construct($data['sku'], $data['name'], $data['price'], $data['type'], $id);
        $this->length = $data['length'];
        $this->width = $data['width'];
        $this->height = $data['height'];

        if ($id === NULL) {
            $query = "INSERT INTO products(sku, name, price, length, width, height, type) 
            VALUES ('$this->sku', '$this->name', '$this->price', '$this->length', '$this->width', '$this->height', '$this->type')";
            $this->save($query);
        }
    }

}

class ProductController {

    public function addProduct($data) {
        $product = new $data['type']($data, NULL);
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
                    // $product = new $row['type']($row, $row["id"]);
                    $product = array(
                        "id" => $row["id"],
                        "sku" => $row["sku"],
                        "name" => $row["name"],
                        "price" => $row["price"],
                        "size" => $row["size"],
                        "weight" => $row["weight"],
                        "height" => $row["height"],
                        "length" => $row["length"],
                        "width" => $row["width"],
                    );
                    // echo $product;
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