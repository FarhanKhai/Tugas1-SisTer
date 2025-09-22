<?php
session_start();
include '../config/db.php';

if (!isset($_GET['KodeMatkul'])) die("Kode Mata Kuliah tidak ditemukan.");
$KodeMatkul = $_GET['KodeMatkul'];

// Mengambil data Mata Kuliah by KodeMatkul
$sql_matkul = "SELECT * FROM MataKuliah WHERE KodeMatkul = ?";
$stmt_matkul = $conn->prepare($sql_matkul);
$stmt_matkul->bind_param("s", $KodeMatkul);
$stmt_matkul->execute();
$result_matkul = $stmt_matkul->get_result();
$MataKuliah = $result_matkul->fetch_assoc();

if (!$MataKuliah) die("Data Mata Kuliah tidak ditemukan.");

// --- PENGECEKAN KE TABEL KULIAH ---
$is_in_transaction = false;
$sql_check = "SELECT KodeMatkul FROM Kuliah WHERE KodeMatkul = ? LIMIT 1";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $KodeMatkul);
$stmt_check->execute();
$stmt_check->store_result();
if ($stmt_check->num_rows > 0) {
    $is_in_transaction = true;
}
$stmt_check->close();
// --- AKHIR PENGECEKAN ---
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mata Kuliah - Universitas Sebelas Maret</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="header">
        <div class="logo-section">
            <a href="index.php" class="btn btn-back"><i class="fas fa-arrow-left"></i></a>
            <div>
                <h1 class="university-title">Edit Mata Kuliah</h1>
                <p class="subtitle">Universitas Sebelas Maret</p>
            </div>
        </div>
    </header>
    <div class="dashboard-container">
        <div class="form-container">
            <div class="card-header">
                <div class="card-icon"><i class="fas fa-book-open"></i></div>
                <h2 class="card-title">Informasi Mata Kuliah</h2>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="form-group" style="background-color: var(--danger); color: white; padding: 1rem; border-radius: 8px;">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <?php if ($is_in_transaction): ?>
                <div class="form-group" style="background-color: var(--warning); color: var(--text-dark); padding: 1rem; border-radius: 8px;">
                    <i class="fas fa-lock"></i> <strong>Data Terkunci</strong>: Data mata kuliah ini tidak dapat diubah karena sudah digunakan dalam data perkuliahan.
                </div>
            <?php endif; ?>

            <form method="POST" action="process_edit.php">
                <input type="hidden" name="oldKodeMatkul" value="<?= htmlspecialchars($MataKuliah['KodeMatkul']) ?>">
                
                <div class="form-group">
                    <label for="KodeMatkul" class="form-label"><i class="fas fa-file-alt"></i> Kode Mata Kuliah</label>
                    <input type="text" id="KodeMatkul" name="KodeMatkul" class="form-input" value="<?= htmlspecialchars($MataKuliah['KodeMatkul']) ?>" required <?php if ($is_in_transaction) echo 'disabled'; ?>>
                </div>

                <div class="form-group">
                    <label for="NamaMatkul" class="form-label"><i class="fas fa-book-open"></i> Nama Mata Kuliah</label>
                    <input type="text" id="NamaMatkul" name="NamaMatkul" class="form-input" value="<?= htmlspecialchars($MataKuliah['NamaMatkul']) ?>" required <?php if ($is_in_transaction) echo 'disabled'; ?>>
                </div>

                <div class="form-group">
                    <label for="SKS" class="form-label"><i class="fas fa-star"></i> SKS</label>
                    <input type="number" id="SKS" name="SKS" class="form-input" value="<?= htmlspecialchars($MataKuliah['SKS']) ?>" min="1" max="6" required <?php if ($is_in_transaction) echo 'disabled'; ?>>
                </div>

                <div class="form-group">
                    <label for="Semester" class="form-label"><i class="fas fa-calendar"></i> Semester</label>
                    <input type="number" id="Semester" name="Semester" class="form-input" value="<?= htmlspecialchars($MataKuliah['Semester']) ?>" min="1" max="8" required <?php if ($is_in_transaction) echo 'disabled'; ?>>
                </div>
                
                <div class="form-actions">
                    <button type="button" onclick="window.location.href='index.php'" class="btn btn-cancel"><i class="fas fa-times"></i> Kembali</button>
                    <button type="submit" class="btn btn-primary" <?php if ($is_in_transaction) echo 'disabled'; ?>><i class="fas fa-save"></i> Perbarui Mata Kuliah</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>