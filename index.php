<?php
try {
    // Conectando ao banco de dados.
    $pdo = new PDO('mysql:host=localhost;dbname=product_list', 'root', '456852', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    // Deletar Produto
    if (isset($_GET['delete'])) {
        $id = filter_input(INPUT_GET, 'delete', FILTER_VALIDATE_INT);
        if ($id !== false) {
            $stmt = $pdo->prepare("DELETE FROM products WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
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
            $stmt = $pdo->prepare("UPDATE products SET name = ?, category = ?, description = ?, gtin = ?, price = ? WHERE id = ?");
            if ($stmt->execute([$name, $category, $description, $gtin, $price, $id])) {
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
            $stmt = $pdo->prepare("INSERT INTO products (name, category, description, gtin, price) VALUES (?, ?, ?, ?, ?)");
            if ($stmt->execute([$name, $category, $description, $gtin, $price])) {
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
            $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $product = $stmt->fetch();
            }
        }
    }

} catch (PDOException $e) {
    // Capturando e exibindo erros de conexão ou execução de consultas.
    echo 'Erro: ' . htmlspecialchars($e->getMessage());
}
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
        <div class="card shadow-lg p-5 m-5">
            <h1><?php echo $product ? 'Atualizar Produto' : 'Registrar Produto'; ?></h1>
            <form method="post">
                <?php if ($product): ?>
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">
                <?php endif; ?>
                <div class="row mx-5">
                    <label for="name">Name: </label>
                    <input name="name" type="text" value="<?php echo htmlspecialchars($product['name'] ?? ''); ?>" required>
                </div>
                <div class="row mx-5">
                    <label for="category">Category: </label>
                    <input name="category" type="text" value="<?php echo htmlspecialchars($product['category'] ?? ''); ?>" required>
                </div>
                <div class="row mx-5">
                    <label for="description">Description: </label>
                    <input name="description" type="text" value="<?php echo htmlspecialchars($product['description'] ?? ''); ?>" required>
                </div>
                <div class="row mx-5">
                    <label for="gtin">GTIN/EAN :</label>
                    <input name="gtin" type="text" value="<?php echo htmlspecialchars($product['gtin'] ?? ''); ?>" required>
                </div>
                <div class="row mx-5">
                    <label for="price">Price:</label>
                    <input name="price" type="number" step="0.01" value="<?php echo htmlspecialchars($product['price'] ?? ''); ?>" required>
                </div>
                <div class="row mt-5 mx-5">
                    <button type="submit" name="<?php echo $product ? 'update' : 'register'; ?>">
                        <?php echo $product ? 'Atualizar' : 'Registrar'; ?>
                    </button>
                </div>
            </form>
        </div>
        <div class="card shadow-lg p-5 m-5">
            <h1>Lista de Produtos</h1>
            <?php
            $sql = $pdo->prepare("SELECT * FROM products");
            $sql->execute();
            $fetchProducts = $sql->fetchAll();

            foreach ($fetchProducts as $value){
                echo '<a href="?edit=' . htmlspecialchars($value['id']) . '">(Editar)</a> ';
                echo '<a href="?delete=' . htmlspecialchars($value['id']) . '">(Apagar)</a> ';
                echo htmlspecialchars($value['name']) . ' | ' . htmlspecialchars($value['category']) . ' | ' . htmlspecialchars($value['description']) . ' | ' . htmlspecialchars($value['gtin']) . ' | ' . htmlspecialchars($value['price']);
                echo '<hr>';
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
