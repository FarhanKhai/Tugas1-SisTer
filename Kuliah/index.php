<?php
include '../config/db.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'm.NIM';

// Query JOIN antar tabel with search and sort
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

if ($search) {
    $sql .= " WHERE m.NIM LIKE '%$search%' OR m.Nama LIKE '%$search%' OR mk.KodeMatkul LIKE '%$search%' OR mk.NamaMatkul LIKE '%$search%'";
}
$sql .= " ORDER BY $sort";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Management - Sebelas Maret University</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Modern header with back navigation -->
    <header class="header">
        <div class="logo-section">
            <a href="../index.php" class="btn btn-back">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="university-title">Class Management</h1>
                <p class="subtitle">Sebelas Maret University</p>
            </div>
        </div>
    </header>

    <div class="dashboard-container">
        <!-- Modern table container with search and sort -->
        <div class="table-container">
            <div class="table-header">
                <h2 class="table-title">
                    <i class="fas fa-calendar-alt"></i> Class Records & Transactions
                </h2>
                <a href="add.php" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Class Record
                </a>
            </div>

            <!-- Search and Sort Controls -->
            <div class="table-controls">
                <form method="GET" style="display: flex; gap: 1rem; flex: 1;">
                    <input type="text" name="search" class="search-box" 
                           placeholder="Search by NIM, Name, or Subject..." 
                           value="<?php echo htmlspecialchars($search); ?>">
                    
                    <select name="sort" class="sort-select" onchange="this.form.submit()">
                        <option value="m.NIM" <?php echo $sort == 'm.NIM' ? 'selected' : ''; ?>>Sort by NIM</option>
                        <option value="m.Nama" <?php echo $sort == 'm.Nama' ? 'selected' : ''; ?>>Sort by Student Name</option>
                        <option value="mk.KodeMatkul" <?php echo $sort == 'mk.KodeMatkul' ? 'selected' : ''; ?>>Sort by Subject Code</option>
                        <option value="k.Nilai" <?php echo $sort == 'k.Nilai' ? 'selected' : ''; ?>>Sort by Grade</option>
                    </select>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Search
                    </button>
                </form>
            </div>

            <!-- Modern Data Table -->
            <table class="data-table">
                <thead>
                    <tr>
                        <th><i class="fas fa-id-card"></i> NIM</th>
                        <th><i class="fas fa-user-graduate"></i> Student</th>
                        <th><i class="fas fa-book"></i> Subject</th>
                        <th><i class="fas fa-chalkboard-teacher"></i> Lecturer</th>
                        <th><i class="fas fa-star"></i> Grade</th>
                        <th><i class="fas fa-cogs"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($row['NIM']) ?></strong></td>
                            <td><?= htmlspecialchars($row['NamaMahasiswa']) ?></td>
                            <td>
                                <div>
                                    <strong><?= htmlspecialchars($row['KodeMatkul']) ?></strong><br>
                                    <small style="color: var(--text-light);"><?= htmlspecialchars($row['NamaMatkul']) ?></small>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <strong><?= htmlspecialchars($row['NamaDosen']) ?></strong><br>
                                    <small style="color: var(--text-light);">NIP: <?= htmlspecialchars($row['NIP']) ?></small>
                                </div>
                            </td>
                            <!-- Centered grade column data and removed green background -->
                            <td style="text-align: center;">
                                <strong><?= htmlspecialchars($row['Nilai']) ?></strong>
                            </td>
                            <td>
                                <!-- Icon-based action buttons -->
                                <div class="action-buttons">
                                    <a href="edit.php?nim=<?= $row['NIM'] ?>&kodematkul=<?= $row['KodeMatkul'] ?>&nip=<?= $row['NIP'] ?>" 
                                       class="btn-icon btn-edit" title="Edit Class Record">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <button onclick="confirmDelete('<?= $row['NIM'] ?>', '<?= $row['KodeMatkul'] ?>', '<?= $row['NIP'] ?>', '<?= htmlspecialchars($row['NamaMahasiswa']) ?>', '<?= htmlspecialchars($row['NamaMatkul']) ?>')" 
                                            class="btn-icon btn-delete" title="Delete Class Record">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center" style="padding: 2rem; color: var(--text-light);">
                                <i class="fas fa-inbox" style="font-size: 2rem; margin-bottom: 1rem; display: block;"></i>
                                No class records found. <a href="add.php">Add the first class record</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Custom Delete Confirmation Modal -->
    <div id="deleteModal" class="modal-overlay hidden">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h3 class="modal-title">Confirm Deletion</h3>
                <p class="modal-message">Are you sure you want to delete this class record? This action cannot be undone.</p>
            </div>
            <div class="modal-actions">
                <button onclick="closeDeleteModal()" class="btn btn-cancel">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <a id="confirmDeleteBtn" href="#" class="btn btn-confirm">
                    <i class="fas fa-trash"></i> Delete
                </a>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(nim, kodeMatkul, nip, namaMahasiswa, namaMatkul) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('confirmDeleteBtn').href = `delete.php?nim=${nim}&kodematkul=${kodeMatkul}&nip=${nip}`;
            document.querySelector('.modal-message').innerHTML = 
                `Are you sure you want to delete the class record for <strong>${namaMahasiswa}</strong> in <strong>${namaMatkul}</strong>? This action cannot be undone.`;
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
    </script>
</body>
</html>
