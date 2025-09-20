<?php
include '../config/db.php';

$NIM = $_POST['NIM'];
$Nama = $_POST['Nama'];
$Alamat = $_POST['Alamat'];

$stmt = $conn->prepare("INSERT INTO mhs (NIM, Nama, Alamat) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $NIM, $Nama, $Alamat);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Error: " . "<br>" . $stmt->error;
}
?>