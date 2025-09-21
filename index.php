<!-- Complete redesign as modern university dashboard -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sebelas Maret University - Student Information System</title>
    <link rel="stylesheet" href="assets/style.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header Section -->
    <header class="header">
        <div class="logo-section">
            <div class="logo-placeholder">
                <span>LOGO</span>
            </div>
            <div>
                <h1 class="university-title">Sebelas Maret University</h1>
                <p class="subtitle">Student Information System</p>
            </div>
        </div>
        <!-- Removed navigation icons from header as requested -->
    </header>

    <!-- Dashboard Container -->
    <div class="dashboard-container">
        <div class="text-center mb-2">
            <h2 style="color: var(--university-blue); font-size: 2rem; margin-bottom: 0.5rem;">Dashboard Overview</h2>
            <p style="color: var(--text-light);">Manage your university data efficiently</p>
        </div>

        <!-- Data Cards Grid -->
        <div class="dashboard-grid">
            <!-- Students Card -->
            <div class="data-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h3 class="card-title">Mahasiswa</h3>
                </div>
                <p class="card-description">
                    Manage student records, including personal information, academic status, and enrollment details.
                </p>
                <div class="card-actions">
                    <a href="Mahasiswa/index.php" class="btn btn-primary">
                        <i class="fas fa-eye"></i> View Students
                    </a>
                    <a href="Mahasiswa/add.php" class="btn btn-secondary">
                        <i class="fas fa-plus"></i> Add New
                    </a>
                </div>
            </div>

            <!-- Lecturers Card -->
            <div class="data-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3 class="card-title">Dosen</h3>
                </div>
                <p class="card-description">
                    Manage lecturer profiles, academic credentials, and teaching assignments within the university.
                </p>
                <div class="card-actions">
                    <a href="Dosen/index.php" class="btn btn-primary">
                        <i class="fas fa-eye"></i> View Lecturers
                    </a>
                    <a href="Dosen/add.php" class="btn btn-secondary">
                        <i class="fas fa-plus"></i> Add New
                    </a>
                </div>
            </div>

            <!-- Subjects Card -->
            <div class="data-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <h3 class="card-title">Mata Kuliah</h3>
                </div>
                <p class="card-description">
                    Manage course catalog, subject codes, credit hours, and curriculum requirements.
                </p>
                <div class="card-actions">
                    <a href="MataKuliah/index.php" class="btn btn-primary">
                        <i class="fas fa-eye"></i> View Subjects
                    </a>
                    <a href="MataKuliah/add.php" class="btn btn-secondary">
                        <i class="fas fa-plus"></i> Add New
                    </a>
                </div>
            </div>

            <!-- Classes Card -->
            <div class="data-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h3 class="card-title">Kuliah</h3>
                </div>
                <p class="card-description">
                    Manage class schedules, enrollment transactions, and academic session planning.
                </p>
                <div class="card-actions">
                    <a href="Kuliah/index.php" class="btn btn-primary">
                        <i class="fas fa-eye"></i> View Classes
                    </a>
                    <a href="Kuliah/add.php" class="btn btn-secondary">
                        <i class="fas fa-plus"></i> Add New
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add smooth hover effects and interactions
        document.querySelectorAll('.data-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(-5px)';
            });
        });
    </script>
</body>
</html>
