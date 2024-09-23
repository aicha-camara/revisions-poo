<?php
// Inclure le fichier de connexion à la base de données
require_once 'config.php';

// Inclure les définitions des classes
require_once 'Boutique.php';

// Créer une instance de la classe Product
$product = new Product();

// Appeler la méthode findAll pour récupérer tous les produits
$allProducts = $product->findAll();

// Afficher les détails de chaque produit
if (!empty($allProducts)) {
    foreach ($allProducts as $product) {
        echo "Product ID: " . $product->getId() . "<br>";
        echo "Product Name: " . $product->getName() . "<br>";
        echo "Product Photos: " . implode(', ', $product->getPhotos()) . "<br>";
        echo "Product Price: " . $product->getPrice() . "<br>";
        echo "Product Description: " . $product->getDescription() . "<br>";
        echo "Product Quantity: " . $product->getQuantity() . "<br>";
        echo "Product Created At: " . $product->getCreatedAt()->format('Y-m-d H:i:s') . "<br>";
        echo "Product Updated At: " . $product->getUpdatedAt()->format('Y-m-d H:i:s') . "<br>";

        // Vérifier si la catégorie est définie avant d'afficher ses informations
        if ($product->getCategory()) {
            echo "Product Category Name: " . $product->getCategory()->getName() . "<br>";
            echo "Category Description: " . $product->getCategory()->getDescription() . "<br>";
        } else {
            echo "No category found for this product.<br>";
        }

        echo "<hr>"; // Séparation entre les produits
    }
} else {
    // Aucun produit trouvé
    echo "No products found.";
}

?>
