<?php
include '../config/db.php';

// cek apakah NIP ada
if (!isset($_GET['NIP'])) {
    die("NIP tidak ditemukan.");
}

$NIP = $_GET['NIP'];

// Mulai transaksi
$conn->begin_transaction();

try {
    // 1. Hapus record terkait di tabel Kuliah
    $sql_kuliah = "DELETE FROM Kuliah WHERE NIP = ?";
    $stmt_kuliah = $conn->prepare($sql_kuliah);
    $stmt_kuliah->bind_param("s", $NIP);
    $stmt_kuliah->execute();
    $stmt_kuliah->close();

    // 2. Hapus record Dosen
    $sql_dosen = "DELETE FROM Dosen WHERE NIP = ?";
    $stmt_dosen = $conn->prepare($sql_dosen);
    $stmt_dosen->bind_param("s", $NIP);
    $stmt_dosen->execute();

    // Commit transaksi jika berhasil
    $conn->commit();

    $stmt_dosen->close();
    header("Location: index.php");
    exit;

} catch (mysqli_sql_exception $exception) {
    // Rollback jika gagal
    $conn->rollback();
    echo "Gagal menghapus data Dosen: " . $exception->getMessage();
}

$conn->close();
?>