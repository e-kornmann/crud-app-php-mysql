<?php
include("../database/connect.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM employee WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);

    try {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header('Location: ../');
        exit();
    } catch (mysqli_sql_exception $e) {
        echo "Could not delete employee! Error: " . $e->getMessage();
    }
}

mysqli_close($conn);

?>
