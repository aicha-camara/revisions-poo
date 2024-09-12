<?php
// Inclure le fichier de connexion à la base de données
require_once 'config.php';

// Inclure les définitions des classes
require_once 'Boutique.php';

// Créer une instance de la classe Product
$product = new Product();

// Appeler la méthode findOneById pour récupérer le produit avec l'ID 7
$product = $product->findOneById(5);

if ($product !== false) {
    // Le produit a été trouvé, afficher les détails
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
} else {
    // Le produit n'a pas été trouvé
    echo "Product not found.";
}
?>
