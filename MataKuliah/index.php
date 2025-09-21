<?php
include '../config/db.php';
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'KodeMatkul';

$query = "SELECT * FROM MataKuliah";
if ($search) {
    $query .= " WHERE KodeMatkul LIKE '%$search%' OR NamaMatkul LIKE '%$search%'";
}
$query .= " ORDER BY $sort";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject Management - Sebelas Maret University</title>
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
                <h1 class="university-title">Subject Management</h1>
                <p class="subtitle">Sebelas Maret University</p>
            </div>
        </div>
    </header>

    <div class="dashboard-container">
        <!-- Modern table container with search and sort -->
        <div class="table-container">
            <div class="table-header">
                <h2 class="table-title">
                    <i class="fas fa-book"></i> Subject Records
                </h2>
                <a href="add.php" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Subject
                </a>
            </div>

            <!-- Search and Sort Controls -->
            <div class="table-controls">
                <form method="GET" style="display: flex; gap: 1rem; flex: 1;">
                    <input type="text" name="search" class="search-box" 
                           placeholder="Search by Subject Code or Name..." 
                           value="<?php echo htmlspecialchars($search); ?>">
                    
                    <select name="sort" class="sort-select" onchange="this.form.submit()">
                        <option value="KodeMatkul" <?php echo $sort == 'KodeMatkul' ? 'selected' : ''; ?>>Sort by Code</option>
                        <option value="NamaMatkul" <?php echo $sort == 'NamaMatkul' ? 'selected' : ''; ?>>Sort by Name</option>
                        <option value="SKS" <?php echo $sort == 'SKS' ? 'selected' : ''; ?>>Sort by Credits</option>
                        <option value="Semester" <?php echo $sort == 'Semester' ? 'selected' : ''; ?>>Sort by Semester</option>
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
                        <!-- Changed Subject Code icon to file-alt (paper stack icon) -->
                        <th><i class="fas fa-file-alt"></i> Subject Code</th>
                        <th><i class="fas fa-book-open"></i> Subject Name</th>
                        <th><i class="fas fa-star"></i> Credits (SKS)</th>
                        <th><i class="fas fa-calendar"></i> Semester</th>
                        <th><i class="fas fa-cogs"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($row['KodeMatkul']); ?></strong></td>
                            <td><?php echo htmlspecialchars($row['NamaMatkul']); ?></td>
                            <!-- Removed yellowish background and centered SKS numbers -->
                            <td style="text-align: center;">
                                <?php echo htmlspecialchars($row['SKS']); ?>
                            </td>
                            <!-- Centered semester column data -->
                            <td style="text-align: center;"><?php echo htmlspecialchars($row['Semester']); ?></td>
                            <td>
                                <!-- Icon-based action buttons -->
                                <div class="action-buttons">
                                    <a href="edit.php?KodeMatkul=<?php echo $row['KodeMatkul']; ?>" 
                                       class="btn-icon btn-edit" title="Edit Subject">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <button onclick="confirmDelete('<?php echo $row['KodeMatkul']; ?>', '<?php echo htmlspecialchars($row['NamaMatkul']); ?>')" 
                                            class="btn-icon btn-delete" title="Delete Subject">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center" style="padding: 2rem; color: var(--text-light);">
                                <i class="fas fa-inbox" style="font-size: 2rem; margin-bottom: 1rem; display: block;"></i>
                                No subjects found. <a href="add.php">Add the first subject</a>
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
                <p class="modal-message">Are you sure you want to delete this subject? This action cannot be undone.</p>
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
        function confirmDelete(kodeMatkul, namaMatkul) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('confirmDeleteBtn').href = `delete.php?KodeMatkul=${kodeMatkul}`;
            document.querySelector('.modal-message').innerHTML = 
                `Are you sure you want to delete subject <strong>${namaMatkul}</strong> (Code: ${kodeMatkul})? This action cannot be undone.`;
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
