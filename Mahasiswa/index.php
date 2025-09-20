<?php
include '../config/db.php';
$result = $conn->query("SELECT * FROM mhs");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
</head>

<body>
    <h1>Data Mahasiswa</h1>
    <a href="add.php">Tambah Mahasiswa</a>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Action</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['NIM']; ?></td>
            <td><?php echo $row['Nama']; ?></td>
            <td><?php echo $row['Alamat']; ?></td>
            <td>
                <a href="edit.php?NIM=<?php echo $row['NIM']; ?>">Edit</a> |
                <a href="delete.php?NIM=<?php echo $row['NIM']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        <tr>
        <?php endwhile; ?>
    </table>
</body>
</html>