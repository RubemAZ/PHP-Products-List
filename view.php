<?php
// view.php

function renderForm($product = null) {
    ?>
    <div class="card shadow-lg p-5 m-5">
        <h1><?php echo $product ? 'Atualizar Produto' : 'Registrar Produto'; ?></h1>
        <form method="post">
            <?php if ($product): ?>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">
            <?php endif; ?>
            <div class="row mx-5">
                <label for="name">Nome: </label>
                <input name="name" type="text" value="<?php echo htmlspecialchars($product['name'] ?? ''); ?>" required>
            </div>
            <div class="row mx-5">
                <label for="category">Categoria: </label>
                <input name="category" type="text" value="<?php echo htmlspecialchars($product['category'] ?? ''); ?>" required>
            </div>
            <div class="row mx-5">
                <label for="description">Descrição: </label>
                <input name="description" type="text" value="<?php echo htmlspecialchars($product['description'] ?? ''); ?>" required>
            </div>
            <div class="row mx-5">
                <label for="gtin">GTIN/EAN :</label>
                <input name="gtin" type="text" value="<?php echo htmlspecialchars($product['gtin'] ?? ''); ?>" required>
            </div>
            <div class="row mx-5">
                <label for="price">Preço:</label>
                <input name="price" type="number" step="0.01" value="<?php echo htmlspecialchars($product['price'] ?? ''); ?>" required>
            </div>
            <div class="row mt-5 mx-5">
                <button type="submit" name="<?php echo $product ? 'update' : 'register'; ?>">
                    <?php echo $product ? 'Atualizar' : 'Registrar'; ?>
                </button>
            </div>
        </form>
    </div>
    <?php
}

function renderProductList($products) {
    ?>
    <div class="card shadow-lg p-5 m-5">
        <h1>Lista de Produtos</h1>
        <?php
        foreach ($products as $value){
            echo '<a href="?edit=' . htmlspecialchars($value['id']) . '">(Editar)</a> ';
            echo '<a href="?delete=' . htmlspecialchars($value['id']) . '">(Apagar)</a> ';
            echo htmlspecialchars($value['name']) . ' | ' . htmlspecialchars($value['category']) . ' | ' . htmlspecialchars($value['description']) . ' | ' . htmlspecialchars($value['gtin']) . ' | ' . htmlspecialchars($value['price']);
            echo '<hr>';
        }
        ?>
    </div>
    <?php
}
?>
