<?php 

require 'importir_function.php';
$importir = query("SELECT * FROM importir_tb");

if (isset($_POST["search"])) {
    $keyword = $_POST["keyword"];
    $importir = search($keyword);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importir List</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
</head>
<body>
    
    <?php include('template/navbar.php') ?>
    <div class="container mt-5">

        <h2>List of DumbCycle's Importer Partners</h2>
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
                <a href="add_importir.php" class="btn btn-primary">Add Importer</a>
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
        <div class="col-sm-12 table-responsive mt-2">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($importir as $imp) : ?>
                            <tr>
                                <td scope="row"><?= $i; ?></td>
                                <td><?= $imp["name"]; ?></td>
                                <td><?= $imp["address"]; ?></td>
                                <td><?= $imp["phone"]; ?></td>
                                <td>
                                    <a href="edit_importir.php?id=<?= $imp["id"]; ?>" class="btn btn-primary">Edit</a>
                                    <a href="delete_importir.php?id=<?= $imp["id"]; ?>" class="btn btn-danger" onclick="return confirm('Delete this data?')">Delete</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="jquery/jquery.js"></script>
    <script src="popper/popper.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
</body>
</html>