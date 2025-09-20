<?php
include '../config/db.php';

$oldNIM = $_POST['oldNIM'];
$oldNIP = $_POST['oldNIP'];
$oldKodeMatkul = $_POST['oldKodeMatkul'];

$NIM = $_POST['NIM'];
$NIP = $_POST['NIP'];
$KodeMatkul = $_POST['KodeMatkul'];
$Nilai = $_POST['Nilai'];

$sql = "UPDATE Kuliah 
        SET NIM = ?, NIP = ?, KodeMatkul = ?, Nilai = ?
        WHERE NIM = ? AND NIP = ? AND KodeMatkul = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $NIM, $NIP, $KodeMatkul, $Nilai, $oldNIM, $oldNIP, $oldKodeMatkul);

if ($stmt->execute()) {
    header("Location: index.php?status=updated");
    exit;
} else {
    echo "Gagal update data: " . $stmt->error;
}

$stmt->close();
$conn->close();
