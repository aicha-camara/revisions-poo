<?php
class Product {
    private $id;
    private $name;
    private $photos;
    private $price;
    private $description;
    private $quantity;
    private $createdAt;
    private $updatedAt;
    private $categoryId;  // Changer categoryId en category pour stocker l'objet Category

    public function __construct(int $id = null, string $name = '', array $photos = [], int $price = 0, string $description = '', int $quantity = 0, DateTime $createdAt = null, DateTime $updatedAt = null, int $categoryId = null) {
        $this->id = $id;
        $this->name = $name;
        $this->photos = $photos;
        $this->price = $price;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->createdAt = $createdAt ?: new DateTime();
        $this->updatedAt = $updatedAt ?: new DateTime();
        $this->categoryId = $categoryId;
    }
    

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getPhotos(): array {
        return $this->photos;
    }

    public function getPrice(): int {
        return $this->price;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getQuantity(): int {
        return $this->quantity;
    }

    public function getCreatedAt(): DateTime {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime {
        return $this->updatedAt;
    }

    public function getCategory(): ?Category {
        global $pdo; // Assurez-vous que la variable de connexion est accessible
    
        // Préparer et exécuter la requête pour récupérer la catégorie associée
        $stmt = $pdo->prepare('SELECT * FROM Category WHERE id = :id');
        $stmt->execute(['id' => $this->categoryId]);
        $categoryData = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($categoryData) {
            return new Category(
                $categoryData['id'],
                $categoryData['name'],
                $categoryData['description'],
                new DateTime($categoryData['createdAt']),
                new DateTime($categoryData['updatedAt'])
            );
        } else {
            return null; // Retourner null si aucune catégorie n'est trouvée
        }
    }
    


    // Setters
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setPhotos(array $photos): void {
        $this->photos = $photos;
    }

    public function setPrice(int $price): void {
        $this->price = $price;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setQuantity(int $quantity): void {
        $this->quantity = $quantity;
    }

    public function setCreatedAt(DateTime $createdAt): void {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): void {
        $this->updatedAt = $updatedAt;
    }

    public function setCategory(Category $category): void { // Setter pour l'objet Category
        $this->category = $category;
    }
    public function findOneById(int $id) {
        global $pdo; // Assurez-vous que la variable de connexion PDO est accessible
    
        $stmt = $pdo->prepare('SELECT * FROM Product WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $productData = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($productData) {
            // Hydrater et retourner une nouvelle instance de Product avec les données récupérées
            return new Product(
                $productData['id'],
                $productData['name'],
                json_decode($productData['photos'], true),  // Supposons que les photos sont stockées sous forme de JSON
                $productData['price'],
                $productData['description'],
                $productData['quantity'],
                new DateTime($productData['createdAt']),
                new DateTime($productData['updatedAt']),
                $productData['categoryId']
            );
        } else {
            return false; // Retourner false si le produit n'est pas trouvé
        }
    }

    public function findAll() {
        global $pdo; // Assurez-vous que la variable de connexion PDO est accessible
    
        // Préparer et exécuter la requête pour récupérer toutes les lignes de la table Product
        $stmt = $pdo->query('SELECT * FROM Product');
        $productsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Initialiser un tableau pour stocker les instances de Product
        $products = [];
    
        // Parcourir chaque ligne de données et créer une instance de Product
        foreach ($productsData as $data) {
            $products[] = new Product(
                $data['id'],
                $data['name'],
                json_decode($data['photos'], true),  // Supposons que les photos sont stockées sous forme de JSON
                $data['price'],
                $data['description'],
                $data['quantity'],
                new DateTime($data['createdAt']),
                new DateTime($data['updatedAt']),
                $data['categoryId']  // Associez la catégorie si nécessaire
            );
        }
    
        // Retourner le tableau d'instances de Product
        return $products;
    }
    
    

    
}



class Category {
    private $id;
    private $name;
    private $description;
    private $createdAt;
    private $updatedAt;
    

    public function __construct(int $id, string $name, string $description, DateTime $createdAt, DateTime $updatedAt) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getCreatedAt(): DateTime {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime {
        return $this->updatedAt;
    }

    public function getProducts(): array {
        global $pdo;

        $stmt = $pdo->prepare('SELECT * FROM Product WHERE categoryId = :id');
        $stmt->execute(['id' => $this->id]);
        $productData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $products = [];
        foreach ($productData as $data) {
            $products[] = new Product(
                $data['id'],
                $data['name'],
                json_decode($data['photos'], true),
                $data['price'],
                $data['description'],
                $data['quantity'],
                new DateTime($data['createdAt']),
                new DateTime($data['updatedAt']),
                $data['categoryId']  
            );
        }
        return $products;
    }

    // Setters
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setCreatedAt(DateTime $createdAt): void {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): void {
        $this->updatedAt = $updatedAt;
    }
}

