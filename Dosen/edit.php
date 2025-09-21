<?php
session_start();
include '../config/db.php';

if (!isset($_GET['NIP'])) die("NIP not found.");
$NIP = $_GET['NIP'];

$sql = "SELECT * FROM Dosen WHERE NIP = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $NIP);
$stmt->execute();
$result = $stmt->get_result();
$Dosen = $result->fetch_assoc();

if (!$Dosen) die("Lecturer data not found.");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lecturer - Sebelas Maret University</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="header">
        <div class="logo-section">
            <a href="index.php" class="btn btn-back"><i class="fas fa-arrow-left"></i></a>
            <div>
                <h1 class="university-title">Edit Lecturer</h1>
                <p class="subtitle">Sebelas Maret University</p>
            </div>
        </div>
    </header>
    <div class="dashboard-container">
        <div class="form-container">
            <div class="card-header">
                <div class="card-icon"><i class="fas fa-user-edit"></i></div>
                <h2 class="card-title">Edit Lecturer Information</h2>
            </div>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="form-group" style="background-color: var(--danger); color: white; padding: 1rem; border-radius: 8px;">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="process_edit.php">
                <input type="hidden" name="oldNIP" value="<?= htmlspecialchars($Dosen['NIP']) ?>">
                <div class="form-group">
                    <label for="NIP" class="form-label"><i class="fas fa-id-card"></i> Lecturer ID (NIP)</label>
                    <input type="text" id="NIP" name="NIP" class="form-input" value="<?= htmlspecialchars($Dosen['NIP']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="Nama" class="form-label"><i class="fas fa-user"></i> Full Name</label>
                    <input type="text" id="Nama" name="Nama" class="form-input" value="<?= htmlspecialchars($Dosen['Nama']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="Alamat" class="form-label"><i class="fas fa-map-marker-alt"></i> Address</label>
                    <input type="text" id="Alamat" name="Alamat" class="form-input" value="<?= htmlspecialchars($Dosen['Alamat']) ?>" required>
                </div>
                <div class="form-actions">
                    <button type="button" onclick="window.location.href='index.php'" class="btn btn-cancel"><i class="fas fa-times"></i> Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Lecturer</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>