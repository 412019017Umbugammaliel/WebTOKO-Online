<?php

require_once "../db.php";

$response = array('status' => '', 'message' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $update_id = $_POST['update_id'];
    $edit_kategori = $_POST['edit_kategori'];
    $edit_product_name = $_POST['edit_product_name'];
    $edit_product_price = $_POST['edit_product_price'];
    $edit_product_description = $_POST['edit_product_description'];
    $edit_product_image = $_FILES['edit_product_image']['name'];
    $edit_product_status = $_POST['edit_product_status'];

    // Proses update buku dalam database
    if ($_FILES["edit_product_image"]["name"]) {
        // Upload gambar jika ada file yang diunggah
        $target_dir = "../product_images/"; // Ubah direktori sesuai dengan lokasi penyimpanan gambar
        $target_file = $target_dir . basename($_FILES["edit_product_image"]["name"]);

        // Pindahkan file gambar ke direktori yang dituju
        if (move_uploaded_file($_FILES["edit_product_image"]["tmp_name"], $target_file)) {
            $edit_product_image = basename($_FILES["edit_product_image"]["name"]);

            $query = "UPDATE tabel_product SET
                        id_category = '$edit_kategori',
                        product_name = '$edit_product_name',
                        product_price = '$edit_product_price',
                        product_description = '$edit_product_description',
                        product_image = '$edit_product_image',
                        product_status = '$edit_product_status'
                      WHERE product_id = '$update_id'";
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengunggah gambar.'
            ];
            echo json_encode($response);
            exit;
        }
    } else {
        $query = "UPDATE tabel_product SET
                    id_category = '$edit_kategori',
                    product_name = '$edit_product_name',
                    product_price = '$edit_product_price',
                    product_description = '$edit_product_description',
                    product_status = '$edit_product_status'
                  WHERE product_id = '$update_id'";
    }

    if (mysqli_query($conn, $query)) {
        $response = [
            'status' => 'success',
            'message' => 'Buku berhasil diubah.'
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Terjadi kesalahan. Buku gagal diubah.'
        ];
    }

    echo json_encode($response);
}
?>