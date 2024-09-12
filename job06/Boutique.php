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

    public function __construct(int $id, string $name, array $photos, int $price, string $description, int $quantity, DateTime $createdAt, DateTime $updatedAt, int $categoryId) {
        $this->id = $id;
        $this->name = $name;
        $this->photos = $photos;
        $this->price = $price;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->categoryId = $categoryId; // Stocker l'objet Category
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

    public function getCategory(): Category {
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
            throw new Exception('Category not found.');
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
        global $pdo; // Assurez-vous que la variable de connexion est accessible

        $stmt = $pdo->prepare('SELECT * FROM Product WHERE categoryId = :id');
        $stmt->execute(['id' => $this->id]);
        $productData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $products = [];
        foreach ($productData as $data) {
            $products[] = new Product(
                $data['id'],
                $data['name'],
                json_decode($data['photos'], true),  // Supposons que les photos sont stockées sous forme de JSON
                $data['price'],
                $data['description'],
                $data['quantity'],
                new DateTime($data['createdAt']),
                new DateTime($data['updatedAt']),
                $data['categoryId']  // Passer l'ID de la catégorie
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

