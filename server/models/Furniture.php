<?php

include_once 'Product.php';
include_once './controllers/ProductController.php';

class Furniture extends Product {
    private $length;
    private $width;
    private $height;

    public function __construct($data, $id){
        $this->setId($id);
        $this->setSku(trim($data['sku']));
        $this->setName(trim($data['name']));
        $this->setPrice(str_replace(",", ".", trim($data['price'])));
        $this->setType(trim($data['type']));
        $this->setLength(trim($data['length']));
        $this->setWidth(trim($data['width']));
        $this->setHeight(trim($data['height']));
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
        } elseif (!ctype_digit($this->width)) {
            $valid = "widthTypeError";
        }  elseif (!ctype_digit($this->length)) {
            $valid = "lengthTypeError";
        }  elseif (!ctype_digit($this->height)) {
            $valid = "heightTypeError";
        } elseif (strlen($this->sku) > 12) {
            $valid = "skuSizeError";
        } elseif ($uniqueSku == 0) {
            $valid = "uniqueSkuError";
        } elseif (str_contains($this->price, '.')) {
            if (strlen(substr(strrchr($this->price, "."), 1)) > 2) {
                $valid = "priceDecimal";
            }
        }
        return $valid;
    }

    public function create() {
        $valid = $this->validate();
        if ($valid == "true") {
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


?>