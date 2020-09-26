<?php 
    session_start();
    include 'db.php';

    function query ($query) {
        global $conn;
        $result = mysqli_query($conn, $query);
        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }

        return $products;
    }

    function search ($keyword) {
        global $conn;
        $query = "SELECT p.id, p.name, i.name AS importir_name, p.Photo, p.qty, p.price FROM produk_tb p LEFT JOIN importir_tb i ON p.importir_id = i.id WHERE p.name LIKE '%$keyword%'";

        $result = mysqli_query($conn, $query);
        $products = [];
        while ($row = mysqli_fetch_assoc($result)){
            $products[] = $row;
        }
        return $products;
    }

    function delete ($id) {
        global $conn;
        try {
            mysqli_query($conn, "DELETE FROM produk_tb WHERE id = '$id'");

            $_SESSION["message"] = "Data deleted successfully!";

            header('Location: index.php');
            exit();
        } catch (\Throwable $th) {
            return mysqli_error($conn);
        }
    }

    function save ($data) {
        global $conn;
        $name = htmlspecialchars($data["name"]);
        $importir_id = htmlspecialchars($data["importir_id"]);
        $qty = htmlspecialchars($data["qty"]);
        $price = htmlspecialchars($data["price"]);

        $photo = upload();

        if( !$photo ) {
            return false;
        }

        $query = "INSERT INTO produk_tb VALUES ('', '$name', '$importir_id', '$photo', '$qty', '$price')";


        try {
            mysqli_query($conn, $query);
            $_SESSION["message"] = "Data added successfully!";
            header('Location: index.php');
            exit();
        } catch (\Throwable $th) {
            echo "<script>alert('Data failed to save!')</script>";
        }
    }

    function upload () {
        $namaGambar = $_FILES["Photo"]["name"];
        $ukuranFile = $_FILES["Photo"]["size"];
        $error = $_FILES["Photo"]["error"];
        $tmpName = $_FILES["Photo"]["tmp_name"];

        // * cek apakah tidak ada gambar yang diupload
        if ( $error === 4 ) {
            echo "
                <script>alert('Choose image first!')</script>
            ";
            return false;
        }

        // * cek apakah yang diupload adalah gambar
        $ekstensiGambarValid = ['png', 'jpg', 'jpeg'];
        $ekstensiGambar = explode('.', $namaGambar);
        // var_dump($ekstensiGambarValid);
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        if ( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
            echo "
                <script>alert('Your file was not an image!')</script>
            ";
            return false;
        }

        // * cek ukuran file
        if ( $ukuranFile > 4000000 ) {
            echo "
                <script>alert('Your image is too large! max size is 3.8MB')</script>
            ";
            return false;
        }
        // * generate nama file baru
        $namaGambarBaru = uniqid();
        $namaGambarBaru .= '.';
        $namaGambarBaru .= $ekstensiGambar;

        move_uploaded_file($tmpName, 'img/'.$namaGambarBaru);
        return $namaGambarBaru;
    }

    function update ($data) {
        global $conn;
        $id = htmlspecialchars($data["id"]);
        $name = htmlspecialchars($data["name"]);
        $importir_id = htmlspecialchars($data["importir_id"]);
        $qty = htmlspecialchars($data["qty"]);
        $price = htmlspecialchars($data["price"]);
        $oldPhoto = htmlspecialchars($data["oldPhoto"]);
        
        if ( $_FILES["Photo"]["error"] == 4 ) {
            $photo = $oldPhoto;
        } else {
            $photo = upload();
        }

        $query = "UPDATE produk_tb SET name = '$name', importir_id = '$importir_id', qty = '$qty', price = '$price', Photo = '$photo' WHERE id = $id";

        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
?>