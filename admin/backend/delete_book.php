<?php

require_once "../db.php";

$response = array('status' => '', 'message' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $delete_id = $_POST['delete_id'];

    // Perform book deletion
    $query = "DELETE FROM tabel_product WHERE product_id = '$delete_id'";

    if (mysqli_query($conn, $query)) {
        $response = [
            'status' => 'success',
            'message' => 'Buku berhasil dihapus.'
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Terjadi kesalahan. Buku gagal dihapus.'
        ];
    }

    echo json_encode($response);
}
?>