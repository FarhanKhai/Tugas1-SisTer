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
    <title>Tambah Data Kuliah</title>
</head>
<body>
    <h2>Tambah Data Kuliah</h2>
    <form method="POST" action="process_add.php">
        <label>Mahasiswa:</label><br>
        <select name="NIM" required>
            <option value="">--Pilih Mahasiswa--</option>
            <?php while($mhs = $mhsResult->fetch_assoc()): ?>
                <option value="<?= $mhs['NIM'] ?>"><?= $mhs['NIM'] ?> - <?= $mhs['Nama'] ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Dosen:</label><br>
        <select name="NIP" required>
            <option value="">--Pilih Dosen--</option>
            <?php while($dosen = $dosenResult->fetch_assoc()): ?>
                <option value="<?= $dosen['NIP'] ?>"><?= $dosen['NIP'] ?> - <?= $dosen['Nama'] ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Mata Kuliah:</label><br>
        <select name="KodeMatkul" required>
            <option value="">--Pilih Mata Kuliah--</option>
            <?php while($mk = $matkulResult->fetch_assoc()): ?>
                <option value="<?= $mk['KodeMatkul'] ?>"><?= $mk['KodeMatkul'] ?> - <?= $mk['NamaMatkul'] ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Nilai:</label><br>
        <input type="text" name="Nilai" maxlength="2" required><br><br>

        <button type="submit">Simpan</button>
        <button type="button" onclick="window.location.href='index.php'">Batal</button>
    </form>
</body>
</html>
