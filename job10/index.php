<?php
require_once 'config.php';

require_once 'Boutique.php';

$product = new Product();
$product = $product->findOneById(7);

if ($product !== false) {
    $product->setName('Pant')->setQuantity(10000);
    $updateResult = $product->update();

    if ($updateResult) {
        echo "Product ID: " . $product->getId() . "<br>";
        echo "Product Name: " . $product->getName() . "<br>";
        echo "Product Photos: " . implode(', ', $product->getPhotos()) . "<br>";
        echo "Product Price: " . $product->getPrice() . "<br>";
        echo "Product Description: " . $product->getDescription() . "<br>";
        echo "Product Quantity: " . $product->getQuantity() . "<br>";
        echo "Product Created At: " . $product->getCreatedAt()->format('Y-m-d H:i:s') . "<br>";
        echo "Product Updated At: " . $product->getUpdatedAt()->format('Y-m-d H:i:s') . "<br>";
        echo "<hr>";
    } else {
        echo "Product update failed.";
    }
} else {
    echo "Product not found.";
}
?>
