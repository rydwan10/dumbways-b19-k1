<?php

include("product_function.php");
$id = $_GET["id"];

$product = query("SELECT p.id, p.name, p.importir_id, i.name AS importir_name, p.Photo, p.qty, p.price FROM produk_tb p LEFT JOIN importir_tb i ON p.importir_id = i.id WHERE p.id = $id")[0];

$importir = query("SELECT * FROM importir_tb");

if (isset($_POST["submit"])) {

    // jika ada data  yang kosong
    if ($_POST["name"] == "" || $_POST["importir_id"] == "" || $_POST["qty"] == "" || $_POST["price"] == "") {
        $error = true;
    } else if (update($_POST) >= 0) {
        $_SESSION["message"] = "Data updated!";
        // echo "<script>
        //     alert('Data updated!');
        //     document.location.href = 'index.php';
        // </script>";
        header("Location: index.php");
        exit();
    } else {
        echo mysqli_error($conn);
        $_SESSION["message"] = "Data failed to update!";
        echo "
            <script>
                alert('Error when updated data');
                document.location.href = 'index.php';
            </script>
        ";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">

</head>

<body>
    <?php include 'template/navbar.php'; ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-7">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Product <a href="index.php" class="btn btn-warning float-right">Cancel Editing</a></h3>
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
                            <input type="hidden" name="id" value="<?= $product["id"]; ?>">
                            <input type="hidden" name="oldPhoto" value="<?= $product["Photo"]; ?>">

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input autocomplete="false" autofocus type="text" name="name" id="name" class="form-control" placeholder="Enter product name here..." value="<?= $product["name"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="importir_id">Importir</label>
                                <select class="form-control" name="importir_id" id="importir_id">
                                    <?php if($product["importir_id"] == null) : ?>
                                            <?php foreach ($importir as $imp) : ?>
                                                <option value="<?= $imp["id"]; ?>"><?= $imp["name"]; ?></option>
                                            <?php endforeach ?>

                                            <?php else : ?>

                                            <?php $result = mysqli_query($conn, 'SELECT DISTINCT id, name FROM importir_tb ORDER BY id'); ?>
                                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        
                                                <option value="<?= $row["id"] ?>" <?php if ($row['id'] == $product["importir_id"] ) { ?>selected="selected" <?php } ?>>
                                                    <?php echo htmlspecialchars($row['name']); ?>
                                                </option>
                                            <?php } ?> 

                                    <?php endif ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Photo">Photo</label>
                                <input type="file" name="Photo" id="Photo" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="qty">Quantity</label>
                                <input type="number" name="qty" id="qty" class="form-control" value="<?= $product["qty"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" name="price" id="price" class="form-control" value="<?= $product["price"]; ?>">
                            </div>
                            <button name="submit" type="submit" class="btn btn-primary btn-block mt-5">Save Edited Data</button>
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