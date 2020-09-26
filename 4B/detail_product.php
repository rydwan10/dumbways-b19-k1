<?php 

include("product_function.php");
$id = $_GET["id"];

$product = query("SELECT p.id, p.name, i.name AS importir_name, p.Photo, p.qty, p.price FROM produk_tb p LEFT JOIN importir_tb i ON p.importir_id = i.id WHERE p.id = $id")[0];


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
</head>

<body>
    <?php include("template/navbar.php") ?>

    <div class="container mt-5">
        <h4><?= $product["name"]; ?></h4>
        <div class="row justify-contents-center">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="img/<?= $product["Photo"]; ?>" class="card-img" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= $product["name"]; ?></h5>
                                <p class="card-text">Importer: <?= $product["importir_name"] == null ? '<i class="text-danger">importer deleted</i>': $product["importir_name"]; ?></p>
                                <p class="card-text text-muted">Stock: <?= $product["qty"]; ?></p>
                                <h5><b>Price: Rp. <?= number_format($product["price"], 2, ',', '.') ?></b></h5>
                                <div class="row mt-5">
                                    <div class="col">
                                        <a href="edit_product.php?id=<?= $product["id"]; ?>" class="btn btn-primary">Edit this product</a>
                                        <a onclick="return confirm('Delete this product?')" href="delete_product.php?id=<?= $product["id"]; ?>" class="btn btn-danger">Delete this product</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>