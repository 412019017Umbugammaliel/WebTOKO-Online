<?php

require_once '../db.php';

// Tangkap data dari form
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Query untuk menambahkan data ke tabel contact
$sql = "INSERT INTO contact (name, email, message) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $message);

$response = array();

if ($stmt->execute()) {
    $response['status'] = 'success';
    $response['message'] = 'Data berhasil ditambahkan';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Terjadi kesalahan: ' . $conn->error;
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>