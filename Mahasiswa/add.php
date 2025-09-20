<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Mahasiswa</title>
    <meta charset="UTF-8">
<head>

<body></body>
    <h1>Tambah Data Mahasiswa</h1>
    <form action="process_add.php" method="POST">
        <label for="NIM">NIM:</label>
        <input type="text" id="NIM" name="NIM" required><br>

        <label for="Nama">Nama:</label>
        <input type="text" id="Nama" name="Nama" required><br>

        <label for="Alamat">Alamat:</label>
        <input type="text" id="Alamat" name="Alamat" required><br>

        <button type="submit">Simpan</button>
        <button type="button" onclick="window.location.href='index.php'">Batal</button>
    </form>
</body>
</html>


