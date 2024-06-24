<?php
    namespace user\comercial\model;
try {
    $pdo = new PDO('mysql:host=localhost;dbname=product_list', 'root', '456852', [
        // PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    die('Erro: ' . htmlspecialchars($e->getMessage()));
}
?>
