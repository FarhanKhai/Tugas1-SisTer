<?php
include '../config/db.php';

// cek apakah Kode Mata Kuliah ada
if (!isset($_GET['KodeMatkul'])) {
    die("Kode Mata Kuliah tidak ditemukan.");
}

$KodeMatkul = $_GET['KodeMatkul'];

// Menghapus data by Kode Mata Kuliah
$sql = "DELETE FROM MataKuliah WHERE KodeMatkul = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $KodeMatkul);

if ($stmt->execute()) {
    header("Location: index.php?status=deleted");
    exit;
} else {
    echo "Gagal menghapus data Mata Kuliah: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>