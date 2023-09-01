<?php

require_once "../db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $categoryName = $_POST['category_name'];

    // Query untuk menambahkan kategori buku ke database
    $query = "INSERT INTO tabel_category (name_category) VALUES ('$categoryName')";

    if (mysqli_query($conn, $query)) {
        $response = [
            'status' => 'success',
            'message' => 'Kategori berhasil ditambahkan.'
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Terjadi kesalahan. Kategori gagal ditambahkan.'
        ];
    }

    echo json_encode($response);
}
?>