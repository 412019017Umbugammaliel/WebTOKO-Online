<?php

require_once "../db.php";

// Query untuk mengambil data dari tabel contact
$sql = "SELECT * FROM contact ORDER BY id DESC";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Mengirim data sebagai respons JSON
header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
?>