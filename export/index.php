<?php
namespace Phppot;

use \Phppot\Product;
require_once __DIR__ . './class/Product.php';

$product = new Product();
$productResult = $product->getAllProduct();

if (isset($_POST["export"])) {
    $product->exportProductDatabase($productResult);
}

require_once "./view/product-list.php";
?>