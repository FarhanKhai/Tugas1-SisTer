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
<html>
<head>
    <title>Edit Kuliah</title>
</head>
<body>
    <h2>Edit Data Kuliah</h2>
    <form method="POST" action="process_edit.php">
        <input type="hidden" name="oldNIM" value="<?= $kuliah['NIM'] ?>">
        <input type="hidden" name="oldNIP" value="<?= $kuliah['NIP'] ?>">
        <input type="hidden" name="oldKodeMatkul" value="<?= $kuliah['KodeMatkul'] ?>">

        <label>Mahasiswa:</label><br>
        <select name="NIM" required>
            <?php while($mhs = $mhsResult->fetch_assoc()): ?>
                <option value="<?= $mhs['NIM'] ?>" <?= $kuliah['NIM']==$mhs['NIM'] ? 'selected' : '' ?>>
                    <?= $mhs['NIM'] ?> - <?= $mhs['Nama'] ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Dosen:</label><br>
        <select name="NIP" required>
            <?php while($dosen = $dosenResult->fetch_assoc()): ?>
                <option value="<?= $dosen['NIP'] ?>" <?= $kuliah['NIP']==$dosen['NIP'] ? 'selected' : '' ?>>
                    <?= $dosen['NIP'] ?> - <?= $dosen['Nama'] ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Mata Kuliah:</label><br>
        <select name="KodeMatkul" required>
            <?php while($mk = $matkulResult->fetch_assoc()): ?>
                <option value="<?= $mk['KodeMatkul'] ?>" <?= $kuliah['KodeMatkul']==$mk['KodeMatkul'] ? 'selected' : '' ?>>
                    <?= $mk['KodeMatkul'] ?> - <?= $mk['NamaMatkul'] ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Nilai:</label><br>
        <input type="text" name="Nilai" value="<?= $kuliah['Nilai'] ?>" maxlength="2" required><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
