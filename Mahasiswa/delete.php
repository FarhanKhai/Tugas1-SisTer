<?php
include '../config/db.php';

// cek apakah NIM ada
if (!isset($_GET['NIM'])) {
    die("NIM tidak ditemukan.");
}

$NIM = $_GET['NIM'];

// Mulai transaksi untuk memastikan kedua operasi berhasil
$conn->begin_transaction();

try {
    // 1. Hapus record terkait di tabel Kuliah
    $sql_kuliah = "DELETE FROM Kuliah WHERE NIM = ?";
    $stmt_kuliah = $conn->prepare($sql_kuliah);
    $stmt_kuliah->bind_param("s", $NIM);
    $stmt_kuliah->execute();
    $stmt_kuliah->close();

    // 2. Hapus record Mahasiswa dari tabel mhs
    $sql_mhs = "DELETE FROM mhs WHERE NIM = ?";
    $stmt_mhs = $conn->prepare($sql_mhs);
    $stmt_mhs->bind_param("s", $NIM);
    $stmt_mhs->execute();
    
    // Jika semua berhasil, commit transaksi
    $conn->commit();
    
    $stmt_mhs->close();
    header("Location: index.php");
    exit;

} catch (mysqli_sql_exception $exception) {
    // Jika ada error, batalkan semua perubahan
    $conn->rollback();
    echo "Gagal menghapus data Mahasiswa: " . $exception->getMessage();
}

$conn->close();
?>