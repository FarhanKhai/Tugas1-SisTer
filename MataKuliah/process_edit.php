<?php
session_start();
include '../config/db.php';

$oldKodeMatkul = $_POST['oldKodeMatkul'];
$KodeMatkul = $_POST['KodeMatkul'];
$NamaMatkul = $_POST['NamaMatkul'];
$SKS = $_POST['SKS'];
$Semester = $_POST['Semester'];

// --- DUPLICATE CHECK ---
if ($KodeMatkul !== $oldKodeMatkul) {
    $check_sql = "SELECT KodeMatkul FROM MataKuliah WHERE KodeMatkul = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $KodeMatkul);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        $_SESSION['error'] = "Error: Subject with code <strong>" . htmlspecialchars($KodeMatkul) . "</strong> already exists.";
        header("Location: edit.php?KodeMatkul=" . urlencode($oldKodeMatkul));
        exit;
    }
    $check_stmt->close();
}
// --- END DUPLICATE CHECK ---

$sql = "UPDATE MataKuliah SET KodeMatkul = ?, NamaMatkul = ?, SKS = ?, Semester = ? WHERE KodeMatkul = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssiis", $KodeMatkul, $NamaMatkul, $SKS, $Semester, $oldKodeMatkul);

if ($stmt->execute()) {
    header("Location: index.php?status=success");
    exit;
} else {
    $_SESSION['error'] = "Failed to update subject data: " . $stmt->error;
    header("Location: edit.php?KodeMatkul=" . urlencode($oldKodeMatkul));
    exit;
}
?>