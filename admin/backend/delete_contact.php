<?php
require_once "../db.php";

// Kode untuk menghapus pesan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Menghapus pesan dari database
    $stmt = $conn->prepare("DELETE FROM contact WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Mengembalikan respons dalam format JSON
    $response = array('status' => 'success', 'message' => 'Pesan berhasil dihapus');
    echo json_encode($response);
    exit;
}
?>