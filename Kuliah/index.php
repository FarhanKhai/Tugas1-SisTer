<?php
include '../config/db.php';

// Query JOIN antar tabel
$sql = "SELECT 
            m.NIM,
            m.Nama AS NamaMahasiswa,
            mk.KodeMatkul,
            mk.NamaMatkul,
            d.NIP,
            d.Nama AS NamaDosen,
            k.Nilai
        FROM Kuliah k
        JOIN mhs m ON k.NIM = m.NIM
        JOIN Dosen d ON k.NIP = d.NIP
        JOIN MataKuliah mk ON k.KodeMatkul = mk.KodeMatkul";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kuliah</title>
</head>
<body>
    <h1>Data Kuliah</h1>
    <a href="add.php">Tambah Data Kuliah</a>
    <br><br>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Kode Mata Kuliah</th>
            <th>Nama Mata Kuliah</th>
            <th>NIP</th>
            <th>Nama Dosen</th>
            <th>Nilai</th>
            <th>Action</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['NIM'] ?></td>
            <td><?= $row['NamaMahasiswa'] ?></td>
            <td><?= $row['KodeMatkul'] ?></td>
            <td><?= $row['NamaMatkul'] ?></td>
            <td><?= $row['NIP'] ?></td>
            <td><?= $row['NamaDosen'] ?></td>
            <td><?= $row['Nilai'] ?></td>
            <td>
                <a href="edit.php?nim=<?= $row['NIM'] ?>&kodematkul=<?= $row['KodeMatkul'] ?>&nip=<?= $row['NIP'] ?>">Edit</a> | 
                <a href="delete.php?nim=<?= $row['NIM'] ?>&kodematkul=<?= $row['KodeMatkul'] ?>&nip=<?= $row['NIP'] ?>" onclick="return confirm('Yakin mau hapus?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
