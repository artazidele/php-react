<?php

include_once 'Product.php';

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

?>