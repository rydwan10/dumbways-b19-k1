<?php
require 'db.php';
require 'product_function.php';

if (isset($_POST["submit"])) {

    // - form validation
    if ($_POST["name"] == "" || $_POST["importir_id"] == "" || $_FILES["Photo"] == "" || $_POST["qty"] == "" || $_POST["price"] == "") {
        $error = true;
    } else {
        try {
            save($_POST);
        } catch (\Throwable $th) {
            mysqli_error($conn);
        }
    }
}

$importir = query("SELECT * FROM importir_tb");
// var_dump($importir); die;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">

</head>

<body>
    <?php include 'template/navbar.php'; ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-7">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add Product</h3>
                    </div>
                    <div class="card-body">

                        <?php if (isset($error)) :  ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                Fill out all fields!
                            </div>
                        <?php endif  ?>

                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input autocomplete="false" autofocus type="text" name="name" id="name" class="form-control" placeholder="Enter product name here...">
                            </div>
                            <div class="form-group">
                                <label for="importir_id">Importir</label>
                                <select class="form-control" name="importir_id" id="importir_id">
                                    <?php foreach($importir as $imp) : ?>
                                        <option value="<?= $imp["id"]; ?>"><?= $imp["name"]; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Photo">Photo</label>
                                <input type="file" name="Photo" id="Photo" class="form-control">
                            </div>
                            <div class="form-group">
                              <label for="qty">Quantity</label>
                              <input type="number" name="qty" id="qty" class="form-control" >
                            </div>
                            <div class="form-group">
                              <label for="price">Price</label>
                              <input type="number" name="price" id="price" class="form-control" >
                            </div>
                            <button name="submit" type="submit" class="btn btn-primary btn-block mt-5">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="jquery/jquery.js"></script>
    <script src="popper/popper.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
</body>

</html>