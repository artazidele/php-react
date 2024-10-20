<?php

include_once './database/Database.php';

abstract class Product {
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

?>