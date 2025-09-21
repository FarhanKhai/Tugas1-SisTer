<?php
session_start();
include '../config/db.php';

$NIP = $_POST['NIP'];
$Nama = $_POST['Nama'];
$Alamat = $_POST['Alamat'];

// --- DUPLICATE CHECK ---
$check_sql = "SELECT NIP FROM Dosen WHERE NIP = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("s", $NIP);
$check_stmt->execute();
$check_stmt->store_result();

if ($check_stmt->num_rows > 0) {
    $_SESSION['error'] = "Error: Lecturer with NIP <strong>" . htmlspecialchars($NIP) . "</strong> already exists.";
    header("Location: add.php");
    exit;
}
$check_stmt->close();
// --- END DUPLICATE CHECK ---

$stmt = $conn->prepare("INSERT INTO Dosen (NIP, Nama, Alamat) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $NIP, $Nama, $Alamat);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    $_SESSION['error'] = "Error inserting record: " . $stmt->error;
    header("Location: add.php");
    exit;
}
?>