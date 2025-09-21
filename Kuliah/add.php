<?php
include '../config/db.php';

// ambil data mahasiswa
$mhsResult = $conn->query("SELECT NIM, Nama FROM mhs");
// ambil data dosen
$dosenResult = $conn->query("SELECT NIP, Nama FROM Dosen");
// ambil data mata kuliah
$matkulResult = $conn->query("SELECT KodeMatkul, NamaMatkul FROM MataKuliah");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Class Record - Sebelas Maret University</title>
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
                <h1 class="university-title">Add New Class Record</h1>
                <p class="subtitle">Sebelas Maret University</p>
            </div>
        </div>
    </header>

    <div class="dashboard-container">
        <div class="form-container">
            <div class="card-header">
                <div class="card-icon">
                    <i class="fas fa-calendar-plus"></i>
                </div>
                <h2 class="card-title">Class Record Information</h2>
            </div>

            <form method="POST" action="process_add.php">
                <div class="form-group">
                    <label for="NIM" class="form-label">
                        <i class="fas fa-user-graduate"></i> Student
                    </label>
                    <select name="NIM" id="NIM" class="form-input" required>
                        <option value="">--Select Student--</option>
                        <?php while($mhs = $mhsResult->fetch_assoc()): ?>
                            <option value="<?= $mhs['NIM'] ?>"><?= $mhs['NIM'] ?> - <?= $mhs['Nama'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="NIP" class="form-label">
                        <i class="fas fa-chalkboard-teacher"></i> Lecturer
                    </label>
                    <select name="NIP" id="NIP" class="form-input" required>
                        <option value="">--Select Lecturer--</option>
                        <?php while($dosen = $dosenResult->fetch_assoc()): ?>
                            <option value="<?= $dosen['NIP'] ?>"><?= $dosen['NIP'] ?> - <?= $dosen['Nama'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="KodeMatkul" class="form-label">
                        <i class="fas fa-book"></i> Subject
                    </label>
                    <select name="KodeMatkul" id="KodeMatkul" class="form-input" required>
                        <option value="">--Select Subject--</option>
                        <?php while($mk = $matkulResult->fetch_assoc()): ?>
                            <option value="<?= $mk['KodeMatkul'] ?>"><?= $mk['KodeMatkul'] ?> - <?= $mk['NamaMatkul'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="Nilai" class="form-label">
                        <i class="fas fa-star"></i> Grade
                    </label>
                    <input type="text" name="Nilai" id="Nilai" class="form-input" placeholder="Enter grade (e.g., A+)" maxlength="2" required>
                </div>

                <div class="form-actions">
                    <button type="button" onclick="window.location.href='index.php'" class="btn btn-cancel">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Class Record
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>