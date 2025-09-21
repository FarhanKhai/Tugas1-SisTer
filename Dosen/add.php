<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Lecturer - Sebelas Maret University</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="header">
        <div class="logo-section">
            <a href="index.php" class="btn btn-back"><i class="fas fa-arrow-left"></i></a>
            <div>
                <h1 class="university-title">Add New Lecturer</h1>
                <p class="subtitle">Sebelas Maret University</p>
            </div>
        </div>
    </header>
    <div class="dashboard-container">
        <div class="form-container">
            <div class="card-header">
                <div class="card-icon"><i class="fas fa-user-plus"></i></div>
                <h2 class="card-title">Lecturer Information</h2>
            </div>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="form-group" style="background-color: var(--danger); color: white; padding: 1rem; border-radius: 8px;">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>
            <form action="process_add.php" method="POST">
                <div class="form-group">
                    <label for="NIP" class="form-label"><i class="fas fa-id-badge"></i> Lecturer ID (NIP)</label>
                    <input type="text" id="NIP" name="NIP" class="form-input" placeholder="Enter lecturer ID number" required>
                </div>
                <div class="form-group">
                    <label for="Nama" class="form-label"><i class="fas fa-user-tie"></i> Full Name</label>
                    <input type="text" id="Nama" name="Nama" class="form-input" placeholder="Enter lecturer full name" required>
                </div>
                <div class="form-group">
                    <label for="Alamat" class="form-label"><i class="fas fa-map-marker-alt"></i> Address</label>
                    <input type="text" id="Alamat" name="Alamat" class="form-input" placeholder="Enter lecturer address" required>
                </div>
                <div class="form-actions">
                    <button type="button" onclick="window.location.href='index.php'" class="btn btn-cancel"><i class="fas fa-times"></i> Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Lecturer</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>