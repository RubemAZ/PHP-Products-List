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

                <form action="../action.php" method="post">
                    <div class="row mx-5">
                        <label for="name">Name: </label>
                        <input name="name" id="name" type="text">
                    </div>

                    <div class="row mx-5">
                        <label for="category">Category: </label>
                        <input name="category" id="category" type="text">
                    </div>

                    <div class="row mx-5">
                        <label for="description">Description: </label>
                        <input name="description" id="description" type="text">
                    </div>

                    <div class="row mx-5">
                        <label for="ean">EAN :</label>
                        <input name="ean" id="ean" type="text">
                    </div>

                    <div class="row mx-5">
                        <label for="price">Price:</label>
                        <input name="price" id="price" type="number">
                    </div>

                    <div class="row mt-5 mx-5 ">
                        <button type="submit">Submit</button>
                    </div>

                </form>
            </div>


        </div>

    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>