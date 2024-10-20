<?php

include_once './database/Database.php';
include_once './models/Product.php';

// //
// include '../models/Book.php';
// include '../models/Disk.php';
// include '../models/Furniture.php';
//

abstract class Product2 {
    protected $id;
    protected $sku;
    protected $name;
    protected $price;
    protected $type;

    public function setId($value) {
        $this->id = $value;
    }

    public function setSku($value) {
        $this->sku = $value;
    }

    public function setName($value) {
        $this->name = $value;
    }

    public function setPrice($value) {
        $this->price = $value;
    }

    public function setType($value) {
        $this->type = $value;
    }

    public function getId(): Int {
        return $this->id;
    }

    public function getSku(): String {
        return $this->sku;
    }

    public function getName(): String {
        return $this->name;
    }

    public function getPrice(): Float {
        return $this->price;
    }

    public function getType(): String {
        return $this->type;
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

    abstract public function create();

    abstract public function validate(): String;

    abstract public function getJsonData(): String;
}

class Disk extends Product {
    private $size;

    public function __construct($data, $id){
        $this->setId($id);
        $this->setSku(trim($data['sku']));
        $this->setName(trim($data['name']));
        $this->setPrice(trim($data['price']));
        $this->setType(trim($data['type']));
        $this->setSize(trim($data['size']));
    }

    public function setSize($value) {
        $this->size = $value;
    }

    public function getSize(): Int {
        return $this->size;
    }

    public function validate(): String {
        $valid = "true";
        $controller = new ProductController;
        $uniqueSku = $controller->checkUniqueSku($this->sku);
        if ($this->sku === "") {
            $valid = "emptySku";
        } elseif ($this->name === "") {
            $valid = "emptyName";
        } elseif ($this->price === "") {
            $valid = "emptyPrice";
        } elseif ($this->size === "") {
            $valid = "emptySize";
        } elseif (!is_numeric($this->price)) {
            $valid = "priceTypeError";
        } elseif (!is_numeric($this->size)) {
            $valid = "sizeTypeError";
        } elseif (strlen($this->sku) > 12) {
            $valid = "skuSizeError";
        } elseif ($uniqueSku === false) {
            $valid = "uniqueSkuError";
        }
        return $valid;
    }

    public function create() {
        $valid = $this->validate();
        if ($valid === "true") {
            $query = "INSERT INTO products(sku, name, price, size, type) 
            VALUES ('$this->sku', '$this->name', '$this->price', '$this->size', '$this->type')";
            $this->save($query);
        } else {
            echo $valid;
        }
    }

    public function getJsonData(): String {
        $disk = array(
            "id" => $this->getId(),
            "sku" => $this->getSku(),
            "name" => $this->getName(),
            "price" => $this->getPrice(),
            "size" => $this->getSize(),
        );

        return serialize($disk);
    }
}

class Book extends Product {
    private $weight;

    public function __construct($data, $id){
        $this->setId($id);
        $this->setSku($data['sku']);
        $this->setName($data['name']);
        $this->setPrice($data['price']);
        $this->setType($data['type']);
        $this->setWeight($data['weight']);
    }

    public function setWeight($value) {
        $this->weight = $value;
    }

    public function getWeight(): Int {
        return $this->weight;
    }

    public function validate(): String {
        $valid = "true";
        $controller = new ProductController;
        $uniqueSku = $controller->checkUniqueSku($this->sku);
        if ($this->sku === "") {
            $valid = "emptySku";
        } elseif ($this->name === "") {
            $valid = "emptyName";
        } elseif ($this->price === "") {
            $valid = "emptyPrice";
        } elseif ($this->weight === "") {
            $valid = "emptyWeight";
        } elseif (!is_numeric($this->price)) {
            $valid = "priceTypeError";
        } elseif (!is_numeric($this->weight)) {
            $valid = "weightTypeError";
        } elseif (strlen($this->sku) > 12) {
            $valid = "skuSizeError";
        } elseif ($uniqueSku === false) {
            $valid = "uniqueSkuError";
        }
        return $valid;
    }

    public function create() {
        $valid = $this->validate();
        if ($valid === "true") {
            $query = "INSERT INTO products(sku, name, price, weight, type) 
            VALUES ('$this->sku', '$this->name', '$this->price', '$this->weight', '$this->type')";
            $this->save($query);
        } else {
            echo $valid;
        }
    }

    public function getJsonData(): String {
        $book = array(
            "id" => $this->getId(),
            "sku" => $this->getSku(),
            "name" => $this->getName(),
            "price" => $this->getPrice(),
            "weight" => $this->getWeight(),
        );

        return serialize($book);
    }
}

class Furniture extends Product {
    private $length;
    private $width;
    private $height;

    public function __construct($data, $id){
        $this->setId($id);
        $this->setSku($data['sku']);
        $this->setName($data['name']);
        $this->setPrice($data['price']);
        $this->setType($data['type']);
        $this->setLength($data['length']);
        $this->setWidth($data['width']);
        $this->setHeight($data['height']);
    }

    public function setLength($value) {
        $this->length = $value;
    }

    public function setWidth($value) {
        $this->width = $value;
    }

    public function setHeight($value) {
        $this->height = $value;
    }

    public function getLength(): Int {
        return $this->length;
    }

    public function getHeight(): Int {
        return $this->height;
    }

    public function getWidth(): Int {
        return $this->width;
    }

    public function validate(): String {
        $valid = "true";
        $controller = new ProductController;
        $uniqueSku = $controller->checkUniqueSku($this->sku);
        if ($this->sku === "") {
            $valid = "emptySku";
        } elseif ($this->name === "") {
            $valid = "emptyName";
        } elseif ($this->price === "") {
            $valid = "emptyPrice";
        } elseif ($this->length === "") {
            $valid = "emptyLength";
        } elseif ($this->height === "") {
            $valid = "emptyHeight";
        } elseif ($this->width === "") {
            $valid = "emptyWidth";
        } elseif (!is_numeric($this->price)) {
            $valid = "priceTypeError";
        } elseif (!is_numeric($this->width)) {
            $valid = "widthTypeError";
        }  elseif (!is_numeric($this->length)) {
            $valid = "lengthTypeError";
        }  elseif (!is_numeric($this->height)) {
            $valid = "heightTypeError";
        } elseif (strlen($this->sku) > 12) {
            $valid = "skuSizeError";
        } elseif ($uniqueSku === false) {
            $valid = "uniqueSkuError";
        }
        return $valid;
    }

    public function create() {
        $valid = $this->validate();
        if ($valid === "true") {
            $query = "INSERT INTO products(sku, name, price, length, width, height, type) 
            VALUES ('$this->sku', '$this->name', '$this->price', '$this->length', '$this->width', '$this->height', '$this->type')";
            $this->save($query);
        } else {
            echo $valid;
        }
    }

    public function getJsonData(): String {
        $furniture = array(
            "id" => $this->getId(),
            "sku" => $this->getSku(),
            "name" => $this->getName(),
            "price" => $this->getPrice(),
            "length" => $this->getLength(),
            "width" => $this->getWidth(),
            "height" => $this->getHeight(),
        );
        return serialize($furniture);
    }
}

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

    public function checkUniqueSku($newSku): Bool {
        $query = "SELECT * FROM products ORDER BY id ASC";

        $db = new Database();
        $dbConnection = $db->getConnection();

        if ($dbConnection->connect_error) {
            die("Connection failed: " . $dbConnection->connect_error);
        }

        $result = mysqli_query($dbConnection, $query);

        $unique = true;

        if($result) {
            if($result->num_rows > 0) {
                $products = array();
                while ($row = $result->fetch_assoc()){
                    extract($row);
                    if ($row['sku'] === $newSku) {
                        $unique = false;
                        // echo $row['sku'];
                        // echo $newSku;
                        break;
                    }
                }
            }
        }

        return $unique;
    }
}

?>