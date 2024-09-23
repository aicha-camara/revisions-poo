<?php
require_once 'config.php';

require_once 'Boutique.php';

$product = new Product(null,'T-shirt',[],1000,'A T-shirt GREEN',10, new DateTime(),new DateTime());

$createdProduct = $product->create();

if ($createdProduct !== false) {
    echo "Product inserted successfully with ID: " . $createdProduct->getId() . "<br>";
    echo "Product Name: " . $createdProduct->getName() . "<br>";
    echo "Product Price: " . $createdProduct->getPrice() . "<br>";
    echo "Product Description: " . $createdProduct->getDescription() . "<br>";
    echo "Product Quantity: " . $createdProduct->getQuantity() . "<br>";
    echo "Product Created At: " . $createdProduct->getCreatedAt()->format('Y-m-d H:i:s') . "<br>";
    echo "Product Updated At: " . $createdProduct->getUpdatedAt()->format('Y-m-d H:i:s') . "<br>";
} else {
    echo "Product insertion failed.";
}
