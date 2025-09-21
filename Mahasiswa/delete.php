<?php
include '../config/db.php';

// cek apakah NIM ada
if (!isset($_GET['NIM'])) {
    die("NIM tidak ditemukan.");
}

$NIM = $_GET['NIM'];

// Menghapus data by NIM
$sql = "DELETE FROM mhs WHERE NIM = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $NIM);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Gagal menghapus data Mahasiswa: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>