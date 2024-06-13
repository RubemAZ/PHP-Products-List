<?php
try {
    // Connecting to the database.
    $pdo = new PDO('mysql:host=localhost;dbname=product_list', 'root', '456852');
    //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Checking if the form has been submitted.
    if (isset($_POST['name'])) {
        // Preparing the SQL query.
        $sql = $pdo->prepare("INSERT INTO products (name, category, description, gtin, price) VALUES (?,?,?,?,?)");
        
        // Executing the SQL query with the form data.
        $sql->execute(array($_POST['name'], $_POST['category'], $_POST['description'], $_POST['gtin'], $_POST['price']));
        
        echo 'Produto registrado com sucesso!';
    }
} catch (PDOException $e) {
    // Capturing and displaying connection or query execution errors.
    echo 'Erro: ' . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Title</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>

    <body>
        <div class="container mt-5">

            <div class="card shadow-lg p-5 m-5">
                <h1>Registro de Produto</h1>

                <form method="post">
                    <div class="row mx-5">
                        <label for="name">Name: </label>
                        <input name="name" type="text">
                    </div>

                    <div class="row mx-5">
                        <label for="category">Category: </label>
                        <input name="category" type="text">
                    </div>

                    <div class="row mx-5">
                        <label for="description">Description: </label>
                        <input name="description"  type="text">
                    </div>

                    <div class="row mx-5">
                        <label for="gtin">GTIN/EAN :</label>
                        <input name="gtin"  type="text">
                    </div>

                    <div class="row mx-5">
                        <label for="price">Price:</label>
                        <input name="price" type="number">
                    </div>

                    <div class="row mt-5 mx-5 ">
                        <button type="submit">Registrar</button>
                    </div>

                </form>
            </div>



        </div>


    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>