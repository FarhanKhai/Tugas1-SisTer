<?php
include '../config/db.php';

$NIM = $_POST['NIM'];
$NIP = $_POST['NIP'];
$KodeMatkul = $_POST['KodeMatkul'];
$Nilai = $_POST['Nilai'];

$sql = "INSERT INTO Kuliah (NIM, NIP, KodeMatkul, Nilai) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $NIM, $NIP, $KodeMatkul, $Nilai);

if ($stmt->execute()) {
    header("Location: index.php?status=added");
    exit;
} else {
    echo "Gagal menambah data: " . $stmt->error;
}

$stmt->close();
$conn->close();