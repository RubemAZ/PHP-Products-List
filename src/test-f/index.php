<?php
require './model/db.php';
require './model/functions.php';
require './model/view.php';

use user\comercial\model\db;
use user\comercial\model\functions;
use user\comercial\model\view;

// Deletar Produto
if (isset($_GET['delete'])) {
    $id = filter_input(INPUT_GET, 'delete', FILTER_VALIDATE_INT);
    if ($id !== false) {
        if (deleteProduct($pdo, $id)) {
            echo 'Produto deletado com sucesso: ' . htmlspecialchars($id);
        } else {
            echo 'Erro ao deletar o produto.';
        }
    } else {
        echo 'ID inválido.';
    }
}

// Atualizar Produto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $gtin = filter_input(INPUT_POST, 'gtin', FILTER_SANITIZE_STRING);
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

    if ($id !== false && $name && $category && $description && $gtin && $price !== false) {
        if (updateProduct($pdo, $id, $name, $category, $description, $gtin, $price)) {
            echo 'Produto atualizado com sucesso!';
        } else {
            echo 'Erro ao atualizar o produto.';
        }
    } else {
        echo 'Dados inválidos no formulário.';
    }
}

// Registrar Produto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && !isset($_POST['update'])) {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $gtin = filter_input(INPUT_POST, 'gtin', FILTER_SANITIZE_STRING);
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

    if ($name && $category && $description && $gtin && $price !== false) {
        if (createProduct($pdo, $name, $category, $description, $gtin, $price)) {
            echo 'Produto registrado com sucesso!';
        } else {
            echo 'Erro ao registrar o produto.';
        }
    } else {
        echo 'Dados inválidos no formulário.';
    }
}

// Buscar Produto para Atualização
$product = null;
if (isset($_GET['edit'])) {
    $id = filter_input(INPUT_GET, 'edit', FILTER_VALIDATE_INT);
    if ($id !== false) {
        $product = getProduct($pdo, $id);
    }
}

$products = getAllProducts($pdo);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Registro de Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <?php renderForm($product); ?>
        <?php renderProductList($products); ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
