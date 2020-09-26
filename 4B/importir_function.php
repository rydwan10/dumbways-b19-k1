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
        $query = "SELECT * FROM importir_tb WHERE name LIKE '%$keyword%' OR address LIKE '%$keyword%' OR phone LIKE '%$keyword%'";
        // var_dump($conn); die;
        $result = mysqli_query($conn, $query);
        $importir = [];
        while ($row = mysqli_fetch_assoc($result)){
            $importir[] = $row;
        }
        return $importir;
    }

    function delete ($id) {
        global $conn;
        try {
            mysqli_query($conn, "DELETE FROM importir_tb WHERE id = '$id'");

            $_SESSION["message"] = "Data deleted successfully!";

            header('Location: importir_list.php');
            exit();
        } catch (\Throwable $th) {
            return mysqli_error($conn);
        }
    }

    function save ($data) {
        global $conn;
        $name = htmlspecialchars($data["name"]);
        $address = htmlspecialchars($data["address"]);
        $phone = htmlspecialchars($data["phone"]);

        $query = "INSERT INTO importir_tb VALUES ('', '$name', '$address', '$phone')";


        try {
            mysqli_query($conn, $query);
            $_SESSION["message"] = "Data added successfully!";
            // var_dump($_SESSION["message"]); die;
            header('Location: importir_list.php');
            exit();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function update ($data) {
        global $conn;
        $id = htmlspecialchars($data["id"]);
        $name = htmlspecialchars($data["name"]);
        $address = htmlspecialchars($data["address"]);
        $phone = htmlspecialchars($data["phone"]);

        $query = "UPDATE importir_tb SET name = '$name', address = '$address', phone = '$phone' WHERE id = $id";

        try {
            mysqli_query($conn, $query);
            $_SESSION["message"] = "Data edited successfully!";
            // var_dump($_SESSION["message"]); die;
            header('Location: importir_list.php');
            exit();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

?>