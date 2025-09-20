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
<html>
<head>
    <title>Edit Data Mata Kuliah</title>
</head>
<body>
    <h2>Edit Data Mata Kuliah</h2>
    <form method="POST" action="process_edit.php">
        <input type="hidden" name="KodeMatkul" value="<?= $MataKuliah['KodeMatkul'] ?>">

        Nama: <br>
        <input type="text" name="NamaMatkul" value="<?= $MataKuliah['NamaMatkul'] ?>" required><br><br>

        SKS: <br>
        <input type="number" name="SKS" value="<?= $MataKuliah['SKS'] ?>" required><br><br>

        Semester: <br>
        <input type="number" name="Semester" value="<?= $MataKuliah['Semester'] ?>" required><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>