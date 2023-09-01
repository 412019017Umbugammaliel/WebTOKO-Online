<?php
session_start();
if (!isset($_SESSION['status_login'])) {
    header("Location: login.php");
    exit;
}

// Memanggil file db.php
require_once "../db.php";

if (isset($_POST['nama']) && isset($_POST['email'])) {
    // Ambil nilai parameter kueri
    $nama = $_POST['nama'];
    $email = $_POST['email'];

    // Validasi data tidak boleh kosong di sisi server
    if (empty($nama) || empty($email)) {
        echo "empty";
        exit;
    }

    // Update database dengan nilai baru
    $update = $conn->query("UPDATE tabel_admin SET
                    admin_name = '" . $nama . "',
                    admin_email = '" . $email . "'
                    WHERE id = '" . $_SESSION['a_global']->id . "' ");
    if ($update) {
        // Update data sesi dengan nilai baru
        $_SESSION['a_global']->admin_name = $nama;
        $_SESSION['a_global']->admin_email = $email;
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "error";
}
?>