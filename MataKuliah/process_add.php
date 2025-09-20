<?php
include '../config/db.php';

$KodeMatkul = $_POST['KodeMatkul'];
$NamaMatkul = $_POST['NamaMatkul'];
$SKS = $_POST['SKS'];
$Semester = $_POST['Semester'];

$stmt = $conn->prepare("INSERT INTO MataKuliah (KodeMatkul, NamaMatkul, SKS, Semester) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssii", $KodeMatkul, $NamaMatkul, $SKS, $Semester);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Error: " . "<br>" . $stmt->error;
}
?>