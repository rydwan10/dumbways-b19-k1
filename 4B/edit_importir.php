<?php
require 'db.php';
require 'importir_function.php';

$id = $_GET["id"];

$importir = query("SELECT * FROM importir_tb WHERE id = $id")[0];

if (isset($_POST["submit"])) {

    // - form validation
    // var_dump($_POST); die;
    if ($_POST["name"] == "" || $_POST["address"] == "" || $_POST["phone"] == "") {
        $error = true;
    } else {
        try {
            update($_POST);
        } catch (\Throwable $th) {
            mysqli_error($conn);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Importer</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">

</head>

<body>
    <?php include 'template/navbar.php'; ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-7">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Importer : <?= $importir["name"]; ?></h3>
                        <a href="importir_list.php" class="btn btn-warning">Cancel Editing</a>
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

                        <form action="" method="POST">
                            <input type="hidden" name="id" value="<?= $importir["id"]; ?>">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input autocomplete="false" autofocus type="text" name="name" id="name" class="form-control" placeholder="Enter importer name here..." value="<?= $importir["name"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" class="form-control" placeholder="Importer address here..." value="<?= $importir["address"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter phone number here..." value="<?= $importir["phone"]; ?>">
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