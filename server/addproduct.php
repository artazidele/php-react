<?php
header('Access-Control-Allow-Origin: *');

include_once './controllers/ProductController.php';

$productController = new ProductController();
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    // echo $_POST['type'];
    // echo "here";
    echo $productController->addProduct($_POST);
}

?>