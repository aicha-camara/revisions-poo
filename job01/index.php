<?php
require_once 'Boutique.php';

var_dump($product->getId());
var_dump($product->getName());
var_dump($product->getPhotos());
var_dump($product->getPrice());
var_dump($product->getDescription());
var_dump($product->getQuantity());
var_dump($product->getCreatedAt());
var_dump($product->getUpdatedAt());


$product->setQuantity(1000000);
var_dump($product->getQuantity());


?>
