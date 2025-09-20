<?php
include '../config/db.php';


// Cek apakah NIM ada
if (!isset($_GET['NIP']))
    die("NIP tidak ditemukan.");

$NIP = $_GET['NIP'];

// Mengambil data Dosen by NIP
$sql = "SELECT * FROM Dosen WHERE NIP = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $NIP);
$stmt->execute();
$result = $stmt->get_result();
$Dosen = $result->fetch_assoc();

if (!$Dosen) {
    die("Data Dosen tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html>
<head>  
    <title>Edit Data Dosen</title>
</head>
<body>
    <h2>Edit Data Dosen</h2>
    <form method="POST" action="process_edit.php">
        <input type="hidden" name="NIP" value="<?= $Dosen['NIP'] ?>">

        Nama: <br>
        <input type="text" name="Nama" value="<?= $Dosen['Nama'] ?>" required><br><br>

        Alamat: <br>
        <input type="text" name="Alamat" value="<?= $Dosen['Alamat'] ?>" required><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>