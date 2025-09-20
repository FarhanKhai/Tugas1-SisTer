<?php
include '../config/db.php';

// Ambil data form POST
$NIP = $_POST['NIP'];
$Nama = $_POST['Nama'];
$Alamat = $_POST['Alamat'];

// Validasi sederhana
if (empty($NIP) || empty($Nama) || empty($Alamat)) {
    die("Data tidak lengkap!");
}

// Update data Dosen
$sql = "UPDATE Dosen SET Nama = ?, Alamat = ? WHERE NIP = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $Nama, $Alamat, $NIP);

if ($stmt->execute()) {
    header("Location: index.php?status=success");
    exit;
} else {
    echo "Gagal mengupdate data Dosen: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>