<?php
session_start();
include '../config/db.php';

if (!isset($_GET['KodeMatkul'])) die("Kode Mata Kuliah not found.");
$KodeMatkul = $_GET['KodeMatkul'];

$sql = "SELECT * FROM MataKuliah WHERE KodeMatkul = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $KodeMatkul);
$stmt->execute();
$result = $stmt->get_result();
$MataKuliah = $result->fetch_assoc();

if (!$MataKuliah) die("Subject data not found.");
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
    <header class="header">
        <div class="logo-section">
            <a href="index.php" class="btn btn-back"><i class="fas fa-arrow-left"></i></a>
            <div>
                <h1 class="university-title">Edit Subject</h1>
                <p class="subtitle">Sebelas Maret University</p>
            </div>
        </div>
    </header>
    <div class="dashboard-container">
        <div class="form-container">
            <div class="card-header">
                <div class="card-icon"><i class="fas fa-book-open"></i></div>
                <h2 class="card-title">Edit Subject Information</h2>
            </div>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="form-group" style="background-color: var(--danger); color: white; padding: 1rem; border-radius: 8px;">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="process_edit.php">
                <input type="hidden" name="oldKodeMatkul" value="<?= htmlspecialchars($MataKuliah['KodeMatkul']) ?>">
                <div class="form-group">
                    <label for="KodeMatkul" class="form-label"><i class="fas fa-file-alt"></i> Subject Code</label>
                    <input type="text" id="KodeMatkul" name="KodeMatkul" class="form-input" value="<?= htmlspecialchars($MataKuliah['KodeMatkul']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="NamaMatkul" class="form-label"><i class="fas fa-book-open"></i> Subject Name</label>
                    <input type="text" id="NamaMatkul" name="NamaMatkul" class="form-input" value="<?= htmlspecialchars($MataKuliah['NamaMatkul']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="SKS" class="form-label"><i class="fas fa-star"></i> Credits (SKS)</label>
                    <input type="number" id="SKS" name="SKS" class="form-input" value="<?= htmlspecialchars($MataKuliah['SKS']) ?>" min="1" max="6" required>
                </div>
                <div class="form-group">
                    <label for="Semester" class="form-label"><i class="fas fa-calendar"></i> Semester</label>
                    <input type="number" id="Semester" name="Semester" class="form-input" value="<?= htmlspecialchars($MataKuliah['Semester']) ?>" min="1" max="8" required>
                </div>
                <div class="form-actions">
                    <button type="button" onclick="window.location.href='index.php'" class="btn btn-cancel"><i class="fas fa-times"></i> Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Subject</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>