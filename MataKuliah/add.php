<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Mata Kuliah</title>
    <meta charset="UTF-8">
<head>

<body></body>
    <h1>Tambah Data Mata Kuliah</h1>
    <form action="process_add.php" method="POST">
        <label for="KodeMatkul">Kode Mata Kuliah:</label>
        <input type="text" id="KodeMatkul" name="KodeMatkul" required><br>

        <label for="NamaMatkul">Nama Mata Kuliah:</label>
        <input type="text" id="NamaMatkul" name="NamaMatkul" required><br>

        <label for="SKS">SKS:</label>
        <input type="number" id="SKS" name="SKS" required><br>

        <label for="Semester">Semester:</label>
        <input type="number" id="Semester" name="Semester" required><br>

        <button type="submit">Simpan</button>
        <button type="button" onclick="window.location.href='index.php'">Batal</button>
    </form>
</body>
</html>