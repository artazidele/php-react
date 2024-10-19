<?php

include_once './Product.php';
class Furniture extends Product {
    private $length;
    private $width;
    private $height;

    public function __construct($data){
        parent::__construct($data['sku'], $data['name'], $data['price'], $data['type']);
        $this->length = $data['length'];
        $this->width = $data['width'];
        $this->height = $data['height'];

        $query = "INSERT INTO products(sku, name, price, length, width, height, type) 
        VALUES ('$this->sku', '$this->name', '$this->price', '$this->length', '$this->width', '$this->height', '$this->type')";

        $this->save($query);
    }

}
?>