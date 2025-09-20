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
<html>
<head>
    <title>Edit Data Mahasiswa</title>
</head>
<body>
    <h2>Edit Data Mahasiswa</h2>
    <form method="POST" action="process_edit.php">
        <input type="hidden" name="NIM" value="<?= $mhs['NIM'] ?>">

        Nama: <br>
        <input type="text" name="Nama" value="<?= $mhs['Nama'] ?>" required><br><br>

        Alamat: <br>
        <input type="text" name="Alamat" value="<?= $mhs['Alamat'] ?>" required><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>