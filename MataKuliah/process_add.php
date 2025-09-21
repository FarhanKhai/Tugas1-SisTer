<?php
session_start();
include '../config/db.php';

$KodeMatkul = $_POST['KodeMatkul'];
$NamaMatkul = $_POST['NamaMatkul'];
$SKS = $_POST['SKS'];
$Semester = $_POST['Semester'];

// --- DUPLICATE CHECK ---
$check_sql = "SELECT KodeMatkul FROM MataKuliah WHERE KodeMatkul = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("s", $KodeMatkul);
$check_stmt->execute();
$check_stmt->store_result();

if ($check_stmt->num_rows > 0) {
    $_SESSION['error'] = "Error: Subject with code <strong>" . htmlspecialchars($KodeMatkul) . "</strong> already exists.";
    header("Location: add.php");
    exit;
}
$check_stmt->close();
// --- END DUPLICATE CHECK ---

$stmt = $conn->prepare("INSERT INTO MataKuliah (KodeMatkul, NamaMatkul, SKS, Semester) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssii", $KodeMatkul, $NamaMatkul, $SKS, $Semester);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    $_SESSION['error'] = "Error inserting record: " . $stmt->error;
    header("Location: add.php");
    exit;
}
?>