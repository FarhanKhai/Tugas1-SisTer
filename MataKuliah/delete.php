<?php
include '../config/db.php';

// cek apakah Kode Mata Kuliah ada
if (!isset($_GET['KodeMatkul'])) {
    die("Kode Mata Kuliah tidak ditemukan.");
}

$KodeMatkul = $_GET['KodeMatkul'];

// Mulai transaksi
$conn->begin_transaction();

try {
    // 1. Hapus record terkait di tabel Kuliah
    $sql_kuliah = "DELETE FROM Kuliah WHERE KodeMatkul = ?";
    $stmt_kuliah = $conn->prepare($sql_kuliah);
    $stmt_kuliah->bind_param("s", $KodeMatkul);
    $stmt_kuliah->execute();
    $stmt_kuliah->close();

    // 2. Hapus record MataKuliah
    $sql_matkul = "DELETE FROM MataKuliah WHERE KodeMatkul = ?";
    $stmt_matkul = $conn->prepare($sql_matkul);
    $stmt_matkul->bind_param("s", $KodeMatkul);
    $stmt_matkul->execute();

    // Commit jika berhasil
    $conn->commit();
    
    $stmt_matkul->close();
    header("Location: index.php");
    exit;

} catch (mysqli_sql_exception $exception) {
    // Rollback jika gagal
    $conn->rollback();
    echo "Gagal menghapus data Mata Kuliah: " . $exception->getMessage();
}

$conn->close();
?>