<?php
session_start();
include '../config/db.php';

if (!isset($_GET['NIP'])) die("NIP tidak ditemukan.");
$NIP = $_GET['NIP'];

// Mengambil data Dosen by NIP
$sql_dosen = "SELECT * FROM Dosen WHERE NIP = ?";
$stmt_dosen = $conn->prepare($sql_dosen);
$stmt_dosen->bind_param("s", $NIP);
$stmt_dosen->execute();
$result_dosen = $stmt_dosen->get_result();
$Dosen = $result_dosen->fetch_assoc();

if (!$Dosen) die("Data Dosen tidak ditemukan.");

// --- PENGECEKAN KE TABEL KULIAH ---
$is_in_transaction = false;
$sql_check = "SELECT NIP FROM Kuliah WHERE NIP = ? LIMIT 1";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $NIP);
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
    <title>Edit Dosen - Universitas Sebelas Maret</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="header">
        <div class="logo-section">
            <a href="index.php" class="btn btn-back"><i class="fas fa-arrow-left"></i></a>
            <div>
                <h1 class="university-title">Edit Dosen</h1>
                <p class="subtitle">Universitas Sebelas Maret</p>
            </div>
        </div>
    </header>
    <div class="dashboard-container">
        <div class="form-container">
            <div class="card-header">
                <div class="card-icon"><i class="fas fa-user-edit"></i></div>
                <h2 class="card-title">Informasi Dosen</h2>
            </div>
            
            <?php if (isset($_SESSION['error'])): ?>
                <div class="form-group" style="background-color: var(--danger); color: white; padding: 1rem; border-radius: 8px;">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <?php if ($is_in_transaction): ?>
                <div class="form-group" style="background-color: var(--warning); color: var(--text-dark); padding: 1rem; border-radius: 8px;">
                    <i class="fas fa-lock"></i> <strong>Data Terkunci</strong>: Data dosen ini tidak dapat diubah karena sudah digunakan dalam data perkuliahan.
                </div>
            <?php endif; ?>

            <form method="POST" action="process_edit.php">
                <input type="hidden" name="oldNIP" value="<?= htmlspecialchars($Dosen['NIP']) ?>">
                
                <div class="form-group">
                    <label for="NIP" class="form-label"><i class="fas fa-id-card"></i> NIP</label>
                    <input type="text" id="NIP" name="NIP" class="form-input" value="<?= htmlspecialchars($Dosen['NIP']) ?>" required <?php if ($is_in_transaction) echo 'disabled'; ?>>
                </div>

                <div class="form-group">
                    <label for="Nama" class="form-label"><i class="fas fa-user"></i> Nama Lengkap</label>
                    <input type="text" id="Nama" name="Nama" class="form-input" value="<?= htmlspecialchars($Dosen['Nama']) ?>" required <?php if ($is_in_transaction) echo 'disabled'; ?>>
                </div>

                <div class="form-group">
                    <label for="Alamat" class="form-label"><i class="fas fa-map-marker-alt"></i> Alamat</label>
                    <input type="text" id="Alamat" name="Alamat" class="form-input" value="<?= htmlspecialchars($Dosen['Alamat']) ?>" required <?php if ($is_in_transaction) echo 'disabled'; ?>>
                </div>

                <div class="form-actions">
                    <button type="button" onclick="window.location.href='index.php'" class="btn btn-cancel"><i class="fas fa-times"></i> Kembali</button>
                    <button type="submit" class="btn btn-primary" <?php if ($is_in_transaction) echo 'disabled'; ?>><i class="fas fa-save"></i> Perbarui Dosen</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>