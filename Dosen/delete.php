<?php
include '../config/db.php';

// cek apakah NIP ada
if (!isset($_GET['NIP'])) {
    die("NIP tidak ditemukan.");
}

$NIP = $_GET['NIP'];

// Menghapus data by NIP
$sql = "DELETE FROM Dosen WHERE NIP = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $NIP);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Gagal menghapus data Mahasiswa: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>