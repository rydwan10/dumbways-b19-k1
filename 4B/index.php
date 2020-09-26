<?php
require 'product_function.php';
$products = query("SELECT p.id, p.name, i.name AS importir_name, p.Photo, p.qty, p.price FROM produk_tb p LEFT JOIN importir_tb i ON p.importir_id = i.id");

if (isset($_POST["search"])) {
    $keyword = $_POST["keyword"];
    $products = search($keyword);
}

// var_dump($products); die;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DumbCycle | Indonesian Bicycle Seller</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
</head>

<body>
    <!-- Navigation Bar -->
    <?php include 'template/navbar.php'; ?>
    <!-- End of Navigation Bar -->

    <!--  -->
    <div class="container mt-5">
        <h2>List of DumbCycle's Products</h2>
        <?php if (isset($_SESSION["message"])) :  ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <?= $_SESSION["message"]; ?>
            </div>
        <?php endif; ?>
        <div class="row justify-content-between mt-5">
            <div class="col">
                <a href="add_product.php" class="btn btn-primary">Add Product</a>
                <a href="add_importir.php" class="btn btn-primary">Add Importir</a>
            </div>
            <div class="col">
                <form action="" method="POST">
                    <div class="input-group">
                        <input autocomplete="off" autofocus placeholder="Search here..." type="text" name="keyword" id="keyword" class="form-control">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" name="search">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-3">
            <?php foreach ($products as $product) : ?>
                <div class="col-md-3 col-sm-12 mb-5">
                    <div class="card">
                        <img src="img/<?= $product["Photo"]; ?>" class="card-img-top"  style="width: auto; height: 200px; object-fit: cover;" alt="<?= $product["name"]; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product["name"]; ?></h5>
                            <p class="font-weight-bold">Rp. <?= number_format($product["price"], 2, ',', '.') ?></p>
                            <hr>
                            <p class="text-muted"><?= $product["importir_name"] == null ?  '<i class="text-danger">Importer deleted</i>' : $product["importir_name"]; ?></p>
                            <p><b>Stock: </b><?= $product["qty"]; ?></p>
                            <!-- button -->
                            <a href="detail_product.php?id=<?= $product["id"]; ?>" class="btn btn-primary btn-block">Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
    <!--  -->

    <script src="jquery/jquery.js"></script>
    <script src="popper/popper.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
</body>

</html>