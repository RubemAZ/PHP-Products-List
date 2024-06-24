<?php
    namespace user\comercial\model;
function deleteProduct($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

function updateProduct($pdo, $id, $name, $category, $description, $gtin, $price) {
    $stmt = $pdo->prepare("UPDATE products SET name = ?, category = ?, description = ?, gtin = ?, price = ? WHERE id = ?");
    return $stmt->execute([$name, $category, $description, $gtin, $price, $id]);
}

function createProduct($pdo, $name, $category, $description, $gtin, $price) {
    $stmt = $pdo->prepare("INSERT INTO products (name, category, description, gtin, price) VALUES (?, ?, ?, ?, ?)");
    return $stmt->execute([$name, $category, $description, $gtin, $price]);
}

function getProduct($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
}

function getAllProducts($pdo) {
    $stmt = $pdo->prepare("SELECT * FROM products");
    $stmt->execute();
    return $stmt->fetchAll();
}
?>
