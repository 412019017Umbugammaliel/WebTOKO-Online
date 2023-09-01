<?php

require_once "../db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $categoryId = $_POST['id'];

    // Query untuk menghapus kategori buku dari database
    $query = "DELETE FROM tabel_category WHERE id_category = $categoryId";

    if (mysqli_query($conn, $query)) {
        $response = [
            'status' => 'success',
            'message' => 'Kategori berhasil dihapus.'
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Terjadi kesalahan. Kategori gagal dihapus.'
        ];
    }

    echo json_encode($response);
}
?>