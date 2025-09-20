<?php
include '../config/db.php';

$NIP = $_POST['NIP'];
$Nama = $_POST['Nama'];
$Alamat = $_POST['Alamat'];

$stmt = $conn->prepare("INSERT INTO dosen (NIP, Nama, Alamat) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $NIP, $Nama, $Alamat);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Error: " . "<br>" . $stmt->error;
}
?>