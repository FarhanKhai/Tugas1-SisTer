<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Subject - Sebelas Maret University</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <header class="header">
        <div class="logo-section">
            <a href="index.php" class="btn btn-back">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="university-title">Add New Subject</h1>
                <p class="subtitle">Sebelas Maret University</p>
            </div>
        </div>
    </header>

    <div class="dashboard-container">
        <div class="form-container">
            <div class="card-header">
                <div class="card-icon">
                    <i class="fas fa-book"></i>
                </div>
                <h2 class="card-title">Subject Information</h2>
            </div>

            <form action="process_add.php" method="POST">
                <div class="form-group">
                    <label for="KodeMatkul" class="form-label">
                        <i class="fas fa-file-alt"></i> Subject Code
                    </label>
                    <input type="text" id="KodeMatkul" name="KodeMatkul" class="form-input" 
                           placeholder="Enter subject code (e.g., CS101)" required>
                </div>

                <div class="form-group">
                    <label for="NamaMatkul" class="form-label">
                        <i class="fas fa-book-open"></i> Subject Name
                    </label>
                    <input type="text" id="NamaMatkul" name="NamaMatkul" class="form-input" 
                           placeholder="Enter subject name" required>
                </div>

                <div class="form-group">
                    <label for="SKS" class="form-label">
                        <i class="fas fa-star"></i> Credits (SKS)
                    </label>
                    <input type="number" id="SKS" name="SKS" class="form-input" 
                           placeholder="Enter credit hours" min="1" max="6" required>
                </div>

                <div class="form-group">
                    <label for="Semester" class="form-label">
                        <i class="fas fa-calendar"></i> Semester
                    </label>
                    <input type="number" id="Semester" name="Semester" class="form-input" 
                           placeholder="Enter semester number" min="1" max="8" required>
                </div>

                <div class="form-actions">
                    <button type="button" onclick="window.location.href='index.php'" class="btn btn-cancel">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Subject
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>