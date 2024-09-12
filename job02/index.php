<?php
// Inclure le fichier de connexion à la base de données
require_once 'config.php';

// Inclure les définitions des classes
require_once 'Boutique.php';

// Préparer et exécuter la requête pour récupérer le produit avec l'ID 7
$sql = "SELECT * FROM Product WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => 2]);
$productData = $stmt->fetch(PDO::FETCH_ASSOC);

if ($productData) {
    // Convertir la date de `createdAt` et `updatedAt` en objets DateTime
    $productData['createdAt'] = new DateTime($productData['createdAt']);
    $productData['updatedAt'] = new DateTime($productData['updatedAt']);
    
    // Créer une nouvelle instance de la classe Product et l'hydrater avec les données récupérées
    $product = new Product(
        $productData['id'],
        $productData['name'],
        json_decode($productData['photos']),  // Supposons que les photos sont stockées sous forme de JSON
        $productData['price'],
        $productData['description'],
        $productData['quantity'],
        $productData['createdAt'],
        $productData['updatedAt'],
        $productData['categoryId']
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
    echo "Product Category ID: " . $product->getCategoryId() . "<br>";
} else {
    echo "Product not found.";
}
?>
