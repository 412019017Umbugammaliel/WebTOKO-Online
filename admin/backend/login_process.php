<?php
session_start();
include '../db.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (isset($_POST['username']) && isset($_POST['password'])) {
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    $cek = mysqli_query($conn, "SELECT * FROM tabel_admin WHERE admin_name = '$user' AND password = MD5('$pass')");
    if (mysqli_num_rows($cek) > 0) {
        $d = mysqli_fetch_object($cek);
        $_SESSION['status_login'] = true;
        $_SESSION['a_global'] = $d;
        $_SESSION['id'] = $d->id;
        echo "success";
    } else {
        echo "error";
    }
}

mysqli_close($conn);
?>