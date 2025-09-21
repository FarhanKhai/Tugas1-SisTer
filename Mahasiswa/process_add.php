<?php
// Start the session to use session variables
session_start();
include '../config/db.php';

$NIM = $_POST['NIM'];
$Nama = $_POST['Nama'];
$Alamat = $_POST['Alamat'];

// --- DUPLICATE CHECK ---
$check_sql = "SELECT NIM FROM mhs WHERE NIM = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("s", $NIM);
$check_stmt->execute();
$check_stmt->store_result(); 

if ($check_stmt->num_rows > 0) {
    // NIM already exists. Set an error message and redirect.
    $_SESSION['error'] = "Error: Student with NIM <strong>" . htmlspecialchars($NIM) . "</strong> already exists.";
    header("Location: add.php");
    exit; 
}
$check_stmt->close();
// --- END DUPLICATE CHECK ---

$stmt = $conn->prepare("INSERT INTO mhs (NIM, Nama, Alamat) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $NIM, $Nama, $Alamat);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    $_SESSION['error'] = "Error inserting record: " . $stmt->error;
    header("Location: add.php");
    exit;
}
?>