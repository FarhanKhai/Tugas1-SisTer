<?php
include '../config/db.php';

// Cek apakah Kode Mata Kuliah ada
if (!isset($_GET['KodeMatkul']))
    die("Kode Mata Kuliah tidak ditemukan.");

$KodeMatkul = $_GET['KodeMatkul'];

// Mengambil data Mata Kuliah by KodeMatkul
$sql = "SELECT * FROM MataKuliah WHERE KodeMatkul = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $KodeMatkul);
$stmt->execute();
$result = $stmt->get_result();
$MataKuliah = $result->fetch_assoc();

if (!$MataKuliah) {
    die("Data Mata Kuliah tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Subject - Sebelas Maret University</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Added modern header with navigation matching Mahasiswa edit page -->
    <header class="header">
        <div class="logo-section">
            <a href="index.php" class="btn btn-back">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="university-title">Edit Subject</h1>
                <p class="subtitle">Sebelas Maret University</p>
            </div>
        </div>
    </header>

    <div class="dashboard-container">
        <!-- Added modern form container with styling matching Mahasiswa edit page -->
        <div class="form-container">
            <div class="card-header">
                <div class="card-icon">
                    <i class="fas fa-book-open"></i>
                </div>
                <h2 class="card-title">Edit Subject Information</h2>
            </div>

            <form method="POST" action="process_edit.php">
                <input type="hidden" name="KodeMatkul" value="<?= htmlspecialchars($MataKuliah['KodeMatkul']) ?>">

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-file-alt"></i> Subject Code
                    </label>
                    <input type="text" class="form-input" value="<?= htmlspecialchars($MataKuliah['KodeMatkul']) ?>" disabled>
                    <small style="color: var(--text-light); font-size: 0.85rem;">Subject code cannot be changed</small>
                </div>

                <div class="form-group">
                    <label for="NamaMatkul" class="form-label">
                        <i class="fas fa-book-open"></i> Subject Name
                    </label>
                    <input type="text" id="NamaMatkul" name="NamaMatkul" class="form-input" 
                           value="<?= htmlspecialchars($MataKuliah['NamaMatkul']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="SKS" class="form-label">
                        <i class="fas fa-star"></i> Credits (SKS)
                    </label>
                    <input type="number" id="SKS" name="SKS" class="form-input" 
                           value="<?= htmlspecialchars($MataKuliah['SKS']) ?>" min="1" max="6" required>
                </div>

                <div class="form-group">
                    <label for="Semester" class="form-label">
                        <i class="fas fa-calendar"></i> Semester
                    </label>
                    <input type="number" id="Semester" name="Semester" class="form-input" 
                           value="<?= htmlspecialchars($MataKuliah['Semester']) ?>" min="1" max="8" required>
                </div>

                <!-- Added modern form actions with cancel button matching Mahasiswa edit page -->
                <div class="form-actions">
                    <button type="button" onclick="window.location.href='index.php'" class="btn btn-cancel">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Subject
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
