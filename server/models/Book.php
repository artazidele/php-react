<?php

include_once './Product.php';
class Book extends Product {
    private $weight;

    public function __construct($data){
        parent::__construct($data['sku'], $data['name'], $data['price'], $data['type']);
        $this->weight = $data['weight'];

        $query = "INSERT INTO products(sku, name, price, weight, type) 
        VALUES ('$this->sku', '$this->name', '$this->price', '$this->weight', '$this->type')";

        $this->save($query);
    }

}
?>