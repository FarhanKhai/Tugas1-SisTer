<?php
include '../config/db.php';

// Ambil data form POST
$oldNIP = $_POST['oldNIP'];
$NIP = $_POST['NIP'];
$Nama = $_POST['Nama'];
$Alamat = $_POST['Alamat'];

// Validasi sederhana
if (empty($NIP) || empty($Nama) || empty($Alamat) || empty($oldNIP)) {
    die("Data tidak lengkap!");
}

// Update data Dosen
$sql = "UPDATE Dosen SET NIP = ?, Nama = ?, Alamat = ? WHERE NIP = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $NIP, $Nama, $Alamat, $oldNIP);

if ($stmt->execute()) {
    header("Location: index.php?status=success");
    exit;
} else {
    echo "Gagal mengupdate data Dosen: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>