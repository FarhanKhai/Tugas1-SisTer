<?php
include '../config/db.php';

// Ambil data form POST
$oldKodeMatkul = $_POST['oldKodeMatkul'];
$KodeMatkul = $_POST['KodeMatkul'];
$NamaMatkul = $_POST['NamaMatkul'];
$SKS = $_POST['SKS'];
$Semester = $_POST['Semester'];

// Validasi sederhana
if (empty($KodeMatkul) || empty($NamaMatkul) || empty($SKS) || empty($Semester) || empty($oldKodeMatkul)) {
    die("Data tidak lengkap!");
}

// Update data Mata Kuliah
$sql = "UPDATE MataKuliah SET KodeMatkul = ?, NamaMatkul = ?, SKS = ?, Semester = ? WHERE KodeMatkul = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssiis", $KodeMatkul, $NamaMatkul, $SKS, $Semester, $oldKodeMatkul);

if ($stmt->execute()) {
    header("Location: index.php?status=success");
    exit;
} else {
    echo "Gagal mengupdate data Mata Kuliah: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>