<?php
// Start the session to use session variables
session_start();
include '../config/db.php';

$oldNIM = $_POST['oldNIM'];
$NIM = $_POST['NIM'];
$Nama = $_POST['Nama'];
$Alamat = $_POST['Alamat'];

// --- DUPLICATE CHECK ---
// Only check for a duplicate if the user has changed the NIM.
if ($NIM !== $oldNIM) {
    $check_sql = "SELECT NIM FROM mhs WHERE NIM = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $NIM);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        // The new NIM already exists for another student.
        $_SESSION['error'] = "Error: Student with NIM <strong>" . htmlspecialchars($NIM) . "</strong> already exists.";
        header("Location: edit.php?NIM=" . urlencode($oldNIM));
        exit; // Stop the script
    }
    $check_stmt->close();
}
// --- END DUPLICATE CHECK ---

$sql = "UPDATE mhs SET NIM = ?, Nama = ?, Alamat = ? WHERE NIM = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $NIM, $Nama, $Alamat, $oldNIM);

if ($stmt->execute()) {
    header("Location: index.php?status=success");
    exit;
} else {
    $_SESSION['error'] = "Failed to update student data: " . $stmt->error;
    header("Location: edit.php?NIM=" . urlencode($oldNIM));
    exit;
}
?>