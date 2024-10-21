<?php
header('Access-Control-Allow-Origin: *');

include_once './controllers/ProductController.php';

$productController = new ProductController();
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    echo $productController->addProduct($_POST);
}

?>