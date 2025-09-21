<?php
include '../config/db.php';
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'NIM';

$query = "SELECT * FROM mhs";
if ($search) {
    $query .= " WHERE NIM LIKE '%$search%' OR Nama LIKE '%$search%'";
}
$query .= " ORDER BY $sort";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management - Sebelas Maret University</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <!-- Replaced "Back to Dashboard" text with just arrow icon -->
    <header class="header">
        <div class="logo-section">
            <a href="../index.php" class="btn btn-back">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="university-title">Student Management</h1>
                <p class="subtitle">Sebelas Maret University</p>
            </div>
        </div>
    </header>

    <div class="dashboard-container">
        <!-- Modern table container with search and sort -->
        <div class="table-container">
            <div class="table-header">
                <h2 class="table-title">
                    <i class="fas fa-user-graduate"></i> Student Records
                </h2>
                <a href="add.php" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Student
                </a>
            </div>

            <!-- Search and Sort Controls -->
            <div class="table-controls">
                <form method="GET" style="display: flex; gap: 1rem; flex: 1;">
                    <input type="text" name="search" class="search-box" 
                           placeholder="Search by NIM or Name..." 
                           value="<?php echo htmlspecialchars($search); ?>">
                    
                    <select name="sort" class="sort-select" onchange="this.form.submit()">
                        <option value="NIM" <?php echo $sort == 'NIM' ? 'selected' : ''; ?>>Sort by NIM</option>
                        <option value="Nama" <?php echo $sort == 'Nama' ? 'selected' : ''; ?>>Sort by Name</option>
                        <option value="Alamat" <?php echo $sort == 'Alamat' ? 'selected' : ''; ?>>Sort by Address</option>
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
                        <th><i class="fas fa-user"></i> Name</th>
                        <th><i class="fas fa-map-marker-alt"></i> Address</th>
                        <th><i class="fas fa-cogs"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($row['NIM']); ?></strong></td>
                            <td><?php echo htmlspecialchars($row['Nama']); ?></td>
                            <td><?php echo htmlspecialchars($row['Alamat']); ?></td>
                            <td>
                                <!-- Icon-based action buttons -->
                                <div class="action-buttons">
                                    <a href="edit.php?NIM=<?php echo $row['NIM']; ?>" 
                                       class="btn-icon btn-edit" title="Edit Student">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <button onclick="confirmDelete('<?php echo $row['NIM']; ?>', '<?php echo htmlspecialchars($row['Nama']); ?>')" 
                                            class="btn-icon btn-delete" title="Delete Student">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center" style="padding: 2rem; color: var(--text-light);">
                                <i class="fas fa-inbox" style="font-size: 2rem; margin-bottom: 1rem; display: block;"></i>
                                No students found. <a href="add.php">Add the first student</a>
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
                <p class="modal-message">Are you sure you want to delete this student? This action cannot be undone.</p>
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
        function confirmDelete(nim, nama) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('confirmDeleteBtn').href = `delete.php?NIM=${nim}`;
            document.querySelector('.modal-message').innerHTML = 
                `Are you sure you want to delete student <strong>${nama}</strong> (NIM: ${nim})? This action cannot be undone.`;
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
