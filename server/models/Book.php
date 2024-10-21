<?php

include_once 'Product.php';
include_once './controllers/ProductController.php';

class Book extends Product {
    private $weight;

    public function __construct($data, $id){
        $this->setId($id);
        $this->setSku(trim($data['sku']));
        $this->setName(trim($data['name']));
        $this->setPrice(str_replace(",", ".", trim($data['price'])));
        $this->setType(trim($data['type']));
        $this->setWeight(str_replace(",", ".", trim($data['weight'])));
    }

    public function setWeight($value) {
        $this->weight = $value;
    }

    public function getWeight(): Float {
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
        } elseif ($uniqueSku == 0) {
            $valid = "uniqueSkuError";
            echo "here";
        } elseif (str_contains($this->price, '.')) {
            if (strlen(substr(strrchr($this->price, "."), 1)) > 2) {
                $valid = "priceDecimal";
            }
        } elseif (str_contains($this->weight, '.')) {
            if (strlen(substr(strrchr($this->weight, "."), 1)) > 3) {
                $valid = "weightDecimal";
            }
        } 
        return $valid;
    }

    public function create() {
        $valid = $this->validate();
        if ($valid == "true") {
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

?>