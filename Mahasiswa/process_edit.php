<?php
include '../config/db.php';

// Ambil data form POST
$NIM = $_POST['NIM'];
$Nama = $_POST['Nama'];
$Alamat = $_POST['Alamat'];

// Validasi sederhana
if (empty($NIM) || empty($Nama) || empty($Alamat)) {
    die("Data tidak lengkap!");
}

// Update data Mahasiswa
$sql = "UPDATE mhs SET Nama = ?, Alamat = ? WHERE NIM = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $Nama, $Alamat, $NIM);

if ($stmt->execute()) {
    header("Location: index.php?status=success");
    exit;
} else {
    echo "Gagal mengupdate data Mahasiswa: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>