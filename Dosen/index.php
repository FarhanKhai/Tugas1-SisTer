<?php
include '../config/db.php';
$result = $conn->query("SELECT * FROM Dosen");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Dosen</title>
</head>

<body>
    <h1>Data Dosen</h1>
    <a href="add.php">Tambah Dosen</a>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>NIP</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Action</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['NIP']; ?></td>
            <td><?php echo $row['Nama']; ?></td>
            <td><?php echo $row['Alamat']; ?></td>
            <td>
                <a href="edit.php?NIP=<?php echo $row['NIP']; ?>">Edit</a> |
                <a href="delete.php?NIP=<?php echo $row['NIP']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        <tr>
        <?php endwhile; ?>
    </table>
</body>
</html>