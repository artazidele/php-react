<?php

// include_once './database/Database.php';
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
}

?>