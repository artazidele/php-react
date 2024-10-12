<?php
header('Access-Control-Allow-Origin: *');

include_once 'controllers/ProductController.php';

$productController = new ProductController();

if ($_SERVER['REQUEST_METHOD'] == 'GET') 
{
    echo $productController->getProducts();
}

?>