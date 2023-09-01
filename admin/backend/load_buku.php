<?php
require_once "../db.php";

// Query untuk mengambil data buku
$dataBuku = mysqli_query($conn, "SELECT * FROM tabel_product LEFT JOIN tabel_category USING (id_category)ORDER BY product_id DESC");
$data = array();

// Membaca data buku menjadi array
while ($row = mysqli_fetch_assoc($dataBuku)) {
    $data[] = $row;
}

// Mengembalikan data dalam format JSON
echo json_encode($data);
?>