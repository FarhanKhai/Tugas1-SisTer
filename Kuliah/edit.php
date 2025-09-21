<?php
include '../config/db.php';

// cek parameter
if (!isset($_GET['nim'], $_GET['nip'], $_GET['kodematkul'])) {
    die("Data tidak lengkap...");
}

$NIM = $_GET['nim'];
$NIP = $_GET['nip'];
$KodeMatkul = $_GET['kodematkul'];

// ambil data kuliah
$sql = "SELECT * FROM Kuliah WHERE NIM = ? AND NIP = ? AND KodeMatkul = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $NIM, $NIP, $KodeMatkul);
$stmt->execute();
$result = $stmt->get_result();
$kuliah = $result->fetch_assoc();

if (!$kuliah) {
    die("Data Kuliah tidak ditemukan");
}

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
    <title>Edit Class Record - Sebelas Maret University</title>
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
                <h1 class="university-title">Edit Class Record</h1>
                <p class="subtitle">Sebelas Maret University</p>
            </div>
        </div>
    </header>

    <div class="dashboard-container">
        <!-- Added modern form container with styling matching Mahasiswa edit page -->
        <div class="form-container">
            <div class="card-header">
                <div class="card-icon">
                    <i class="fas fa-edit"></i>
                </div>
                <h2 class="card-title">Edit Class Record Information</h2>
            </div>

            <form method="POST" action="process_edit.php">
                <input type="hidden" name="oldNIM" value="<?= htmlspecialchars($kuliah['NIM']) ?>">
                <input type="hidden" name="oldNIP" value="<?= htmlspecialchars($kuliah['NIP']) ?>">
                <input type="hidden" name="oldKodeMatkul" value="<?= htmlspecialchars($kuliah['KodeMatkul']) ?>">

                <div class="form-group">
                    <label for="NIM" class="form-label">
                        <i class="fas fa-user-graduate"></i> Student
                    </label>
                    <select name="NIM" id="NIM" class="form-input" required>
                        <?php while($mhs = $mhsResult->fetch_assoc()): ?>
                            <option value="<?= $mhs['NIM'] ?>" <?= $kuliah['NIM']==$mhs['NIM'] ? 'selected' : '' ?>>
                                <?= $mhs['NIM'] ?> - <?= $mhs['Nama'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="NIP" class="form-label">
                        <i class="fas fa-chalkboard-teacher"></i> Lecturer
                    </label>
                    <select name="NIP" id="NIP" class="form-input" required>
                        <?php while($dosen = $dosenResult->fetch_assoc()): ?>
                            <option value="<?= $dosen['NIP'] ?>" <?= $kuliah['NIP']==$dosen['NIP'] ? 'selected' : '' ?>>
                                <?= $dosen['NIP'] ?> - <?= $dosen['Nama'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="KodeMatkul" class="form-label">
                        <i class="fas fa-book"></i> Subject
                    </label>
                    <select name="KodeMatkul" id="KodeMatkul" class="form-input" required>
                        <?php while($mk = $matkulResult->fetch_assoc()): ?>
                            <option value="<?= $mk['KodeMatkul'] ?>" <?= $kuliah['KodeMatkul']==$mk['KodeMatkul'] ? 'selected' : '' ?>>
                                <?= $mk['KodeMatkul'] ?> - <?= $mk['NamaMatkul'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="Nilai" class="form-label">
                        <i class="fas fa-star"></i> Grade
                    </label>
                    <!-- Changed from number input to select dropdown for letter grades -->
                    <select name="Nilai" id="Nilai" class="form-input" required>
                        <option value="">--Select Grade--</option>
                        <option value="A+" <?= $kuliah['Nilai']=='A+' ? 'selected' : '' ?>>A+ (Excellent)</option>
                        <option value="A" <?= $kuliah['Nilai']=='A' ? 'selected' : '' ?>>A (Very Good)</option>
                        <option value="A-" <?= $kuliah['Nilai']=='A-' ? 'selected' : '' ?>>A- (Good Plus)</option>
                        <option value="B+" <?= $kuliah['Nilai']=='B+' ? 'selected' : '' ?>>B+ (Good)</option>
                        <option value="B" <?= $kuliah['Nilai']=='B' ? 'selected' : '' ?>>B (Above Average)</option>
                        <option value="B-" <?= $kuliah['Nilai']=='B-' ? 'selected' : '' ?>>B- (Average Plus)</option>
                        <option value="C+" <?= $kuliah['Nilai']=='C+' ? 'selected' : '' ?>>C+ (Average)</option>
                        <option value="C" <?= $kuliah['Nilai']=='C' ? 'selected' : '' ?>>C (Below Average)</option>
                        <option value="D" <?= $kuliah['Nilai']=='D' ? 'selected' : '' ?>>D (Poor)</option>
                        <option value="E" <?= $kuliah['Nilai']=='E' ? 'selected' : '' ?>>E (Fail)</option>
                    </select>
                </div>

                <!-- Added modern form actions with cancel button matching Mahasiswa edit page -->
                <div class="form-actions">
                    <button type="button" onclick="window.location.href='index.php'" class="btn btn-cancel">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Class Record
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
