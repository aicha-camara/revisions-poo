<?php
// Inclure le fichier de connexion à la base de données
require_once 'config.php';

// Inclure les définitions des classes
require_once 'Boutique.php';

// Préparer et exécuter la requête pour récupérer le produit avec l'ID 7
$productId = 7; // ID du produit à récupérer
$stmt = $pdo->prepare('SELECT * FROM Product WHERE id = :id');
$stmt->execute(['id' => $productId]);
$productData = $stmt->fetch(PDO::FETCH_ASSOC);

if ($productData) {
    // Créer une nouvelle instance de la classe Product et l'hydrater avec les données récupérées
    $product = new Product(
        $productData['id'],
        $productData['name'],
        json_decode($productData['photos'], true),  // Supposons que les photos sont stockées sous forme de JSON
        $productData['price'],
        $productData['description'],
        $productData['quantity'],
        new DateTime($productData['createdAt']),
        new DateTime($productData['updatedAt']),
        $productData['categoryId'] // Passer l'ID de la catégorie
    );

    // Afficher les détails du produit pour vérification
    echo "Product ID: " . $product->getId() . "<br>";
    echo "Product Name: " . $product->getName() . "<br>";
    echo "Product Photos: " . implode(', ', $product->getPhotos()) . "<br>";
    echo "Product Price: " . $product->getPrice() . "<br>";
    echo "Product Description: " . $product->getDescription() . "<br>";
    echo "Product Quantity: " . $product->getQuantity() . "<br>";
    echo "Product Created At: " . $product->getCreatedAt()->format('Y-m-d H:i:s') . "<br>";
    echo "Product Updated At: " . $product->getUpdatedAt()->format('Y-m-d H:i:s') . "<br>";

    // Récupérer et afficher les détails de la catégorie associée
    try {
        $category = $product->getCategory();
        echo "Product Category Name: " . $category->getName() . "<br>";
        echo "Product Category Description: " . $category->getDescription() . "<br>";
        echo "Product Category Created At: " . $category->getCreatedAt()->format('Y-m-d H:i:s') . "<br>";
        echo "Product Category Updated At: " . $category->getUpdatedAt()->format('Y-m-d H:i:s') . "<br>";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Product not found.";
}
?>
