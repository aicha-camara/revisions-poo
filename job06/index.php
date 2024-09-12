<?php
require_once 'config.php';

require_once 'Boutique.php';

$categoryId = 3; 
$stmt = $pdo->prepare('SELECT * FROM Category WHERE id = :id');
$stmt->execute(['id' => $categoryId]);
$categoryData = $stmt->fetch(PDO::FETCH_ASSOC);

if ($categoryData) {
   
    $category = new Category(
        $categoryData['id'],
        $categoryData['name'],
        $categoryData['description'],
        new DateTime($categoryData['createdAt']),
        new DateTime($categoryData['updatedAt'])
    );

    $products = $category->getProducts();

    foreach ($products as $product) {
        echo "Product ID: " . $product->getId() . "<br>";
        echo "Product Name: " . $product->getName() . "<br>";
        echo "Product Photos: " . implode(', ', $product->getPhotos()) . "<br>";
        echo "Product Price: " . $product->getPrice() . "<br>";
        echo "Product Description: " . $product->getDescription() . "<br>";
        echo "Product Quantity: " . $product->getQuantity() . "<br>";
        echo "Product Created At: " . $product->getCreatedAt()->format('Y-m-d H:i:s') . "<br>";
        echo "Product Updated At: " . $product->getUpdatedAt()->format('Y-m-d H:i:s') . "<br>";
        echo "<hr>";
    }
} else {
     echo "Product ID: "  . "<br>";
    echo "Product Name: " . "<br>";
    echo "Product Photos: " .  "<br>";
    echo "Product Price: "  ."<br>";
    echo "Product Description: " . "<br>";
    echo "Product Quantity: " . "<br>";
    echo "Product Created At: " ."<br>";
    echo "Product Updated At: ". "<br>";
    echo "<hr>";
}
?>
