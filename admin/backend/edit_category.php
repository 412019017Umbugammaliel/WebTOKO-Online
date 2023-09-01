<?php

require_once "../db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $categoryId = $_POST['update_id'];
    $categoryName = $_POST['edit_category_name'];

    // Query untuk mengupdate kategori buku di database
    $query = "UPDATE tabel_category SET name_category = '$categoryName' WHERE id_category = $categoryId";

    if (mysqli_query($conn, $query)) {
        $response = [
            'status' => 'success',
            'message' => 'Kategori berhasil diupdate.'
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Terjadi kesalahan. Kategori gagal diupdate.'
        ];
    }

    echo json_encode($response);
}
?>