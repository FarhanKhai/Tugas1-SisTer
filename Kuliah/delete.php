<?php
include '../config/db.php';

// cek parameter
if (!isset($_GET['nim'], $_GET['nip'], $_GET['kodematkul'])) {
    die("Data tidak lengkap...");
}

$NIM = $_GET['nim'];
$NIP = $_GET['nip'];
$KodeMatkul = $_GET['kodematkul'];

$sql = "DELETE FROM Kuliah WHERE NIM = ? AND NIP = ? AND KodeMatkul = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $NIM, $NIP, $KodeMatkul);

if ($stmt->execute()) {
    header("Location: index.php?status=deleted");
    exit;
} else {
    echo "Gagal menghapus data: " . $stmt->error;
}

$stmt->close();
$conn->close();
