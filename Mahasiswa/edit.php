<?php
include '../config/db.php';

// Cek apakah NIM ada
if (!isset($_GET['NIM']))
    die("NIM tidak ditemukan.");

$NIM = $_GET['NIM'];

// Mengambil data Mahasiswa by NIM
$sql = "SELECT * FROM mhs WHERE NIM = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $NIM);
$stmt->execute();
$result = $stmt->get_result();
$mhs = $result->fetch_assoc();

if (!$mhs) {
    die("Data Mahasiswa tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student - Sebelas Maret University</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="header">
        <div class="logo-section">
            <a href="index.php" class="btn btn-back">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="university-title">Edit Student</h1>
                <p class="subtitle">Sebelas Maret University</p>
            </div>
        </div>
    </header>

    <div class="dashboard-container">
        <div class="form-container">
            <div class="card-header">
                <div class="card-icon">
                    <i class="fas fa-user-edit"></i>
                </div>
                <h2 class="card-title">Edit Student Information</h2>
            </div>

            <form method="POST" action="process_edit.php">
                <input type="hidden" name="oldNIM" value="<?= htmlspecialchars($mhs['NIM']) ?>">

                <div class="form-group">
                    <label for="NIM" class="form-label">
                        <i class="fas fa-id-card"></i> Student ID (NIM)
                    </label>
                    <input type="text" id="NIM" name="NIM" class="form-input" value="<?= htmlspecialchars($mhs['NIM']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="Nama" class="form-label">
                        <i class="fas fa-user"></i> Full Name
                    </label>
                    <input type="text" id="Nama" name="Nama" class="form-input" 
                           value="<?= htmlspecialchars($mhs['Nama']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="Alamat" class="form-label">
                        <i class="fas fa-map-marker-alt"></i> Address
                    </label>
                    <input type="text" id="Alamat" name="Alamat" class="form-input" 
                           value="<?= htmlspecialchars($mhs['Alamat']) ?>" required>
                </div>

                <div class="form-actions">
                    <button type="button" onclick="window.location.href='index.php'" class="btn btn-cancel">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Student
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>