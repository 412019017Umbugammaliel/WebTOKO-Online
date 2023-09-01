<?php
session_start();
include '../db.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    $checkQuery = "SELECT * FROM tabel_admin WHERE admin_name = '$user' OR admin_email = '$email'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        echo "exists";
    } else {
        $insertQuery = "INSERT INTO tabel_admin (admin_name, admin_email, password) VALUES ('$user', '$email', MD5('$pass'))";
        $insertResult = mysqli_query($conn, $insertQuery);

        if ($insertResult) {
            echo "success";
        } else {
            echo "error";
        }
    }
}

mysqli_close($conn);
?>
