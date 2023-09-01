<?php
session_start();
if (!isset($_SESSION['status_login'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if (empty($newPassword) || empty($confirmPassword)) {
        echo "empty";
        exit;
    }

    if ($newPassword === $confirmPassword) {
        require_once "../db.php";

        $hashedPassword = md5($newPassword);

        $update = $conn->query("UPDATE tabel_admin SET password = '" . $hashedPassword . "' WHERE id = '" . $_SESSION['a_global']->id . "'");

        if ($update) {
            echo "success";
        } else {
            echo "failed";
        }
    } else {
        echo "mismatch";
    }
}
?>