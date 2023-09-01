<?php

require_once "../db.php";

$response = array('status' => '', 'message' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryName = $_POST['kategori'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];
    $product_image = $_FILES['product_image']['name'];
    $product_status = $_POST['product_status'];

    // Menentukan path dan nama file gambar
    $targetDirectory = "../product_images/";
    $targetFile = $targetDirectory . basename($_FILES["product_image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Memindahkan file gambar ke direktori yang ditentukan
    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile)) {
        $query = "INSERT INTO tabel_product (id_category, product_name, product_price, product_description, product_image, product_status) VALUES ('$categoryName', '$product_name', '$product_price', '$product_description', '$targetFile', '$product_status')";

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
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Terjadi kesalahan saat mengunggah gambar.'
        ];
    }

    echo json_encode($response);
}
?>