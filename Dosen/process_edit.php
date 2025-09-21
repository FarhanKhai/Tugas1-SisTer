<?php
session_start();
include '../config/db.php';

$oldNIP = $_POST['oldNIP'];
$NIP = $_POST['NIP'];
$Nama = $_POST['Nama'];
$Alamat = $_POST['Alamat'];

// --- DUPLICATE CHECK ---
if ($NIP !== $oldNIP) {
    $check_sql = "SELECT NIP FROM Dosen WHERE NIP = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $NIP);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        $_SESSION['error'] = "Error: Lecturer with NIP <strong>" . htmlspecialchars($NIP) . "</strong> already exists.";
        header("Location: edit.php?NIP=" . urlencode($oldNIP));
        exit;
    }
    $check_stmt->close();
}
// --- END DUPLICATE CHECK ---

$sql = "UPDATE Dosen SET NIP = ?, Nama = ?, Alamat = ? WHERE NIP = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $NIP, $Nama, $Alamat, $oldNIP);

if ($stmt->execute()) {
    header("Location: index.php?status=success");
    exit;
} else {
    $_SESSION['error'] = "Failed to update lecturer data: " . $stmt->error;
    header("Location: edit.php?NIP=" . urlencode($oldNIP));
    exit;
}
?>