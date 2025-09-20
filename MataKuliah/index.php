<?php
include '../config/db.php';
$result = $conn->query("SELECT * FROM MataKuliah");
?>

<DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mata Kuliah</title>
</head>

<body>
    <h1>Data Mata Kuliah</h1>
    <a href="add.php">Tambah Mata Kuliah</a>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Kode</th>
            <th>Nama Mata Kuliah</th>
            <th>SKS</th>
            <th>Semester</th>
            <th>Action</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['KodeMatkul']; ?></td>
            <td><?php echo $row['NamaMatkul']; ?></td>
            <td><?php echo $row['SKS']; ?></td>
            <td><?php echo $row['Semester']; ?></td>
            <td>
                <a href="edit.php?KodeMatkul=<?php echo $row['KodeMatkul']; ?>">Edit</a> |
                <a href="delete.php?KodeMatkul=<?php echo $row['KodeMatkul']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        <tr>
        <?php endwhile; ?>
    </table>