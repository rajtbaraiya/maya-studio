<?php
session_start();
include("../config.php");

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$admin_id = $_SESSION['admin_id'];

// Handle multiple image uploads
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['images'])) {
    $title = $_POST['title'] ?? '';
    $category = $_POST['category'] ?? '';
    $files = $_FILES['images'];
    $totalFiles = count($files['name']);
    $successCount = 0;
    $errors = [];
    
    // Create uploads directory if it doesn't exist
    if (!file_exists('../uploads')) {
        mkdir('../uploads', 0777, true);
    }
    
    // Process each uploaded file
    for($i = 0; $i < $totalFiles; $i++) {
        $filename = $files['name'][$i];
        $tmpName = $files['tmp_name'][$i];
        $fileError = $files['error'][$i];
        
        // Skip if no file was uploaded
        if ($fileError === UPLOAD_ERR_NO_FILE) continue;
        
        // Validate file type
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filetype = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (in_array($filetype, $allowed)) {
            // Create unique filename
            $newFilename = uniqid() . '_' . $i . '.' . $filetype;
            $uploadPath = '../uploads/' . $newFilename;
            $dbPath = 'uploads/' . $newFilename;
            
            if (move_uploaded_file($tmpName, $uploadPath)) {
                // Save to database
                $sql = "INSERT INTO gallery (title, image_path, category) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                
                if ($stmt) {
                    // Add number to title if multiple files
                    $fileTitle = $totalFiles > 1 ? $title . ' (' . ($i + 1) . ')' : $title;
                    $stmt->bind_param("sss", $fileTitle, $dbPath, $category);
                    if ($stmt->execute()) {
                        $successCount++;
                    } else {
                        $errors[] = "Failed to save {$filename} to database.";
                    }
                    $stmt->close();
                }
            } else {
                $errors[] = "Failed to upload {$filename}.";
            }
        } else {
            $errors[] = "{$filename} has invalid file type. Allowed: jpg, jpeg, png, gif";
        }
    }
    
    if ($successCount > 0) {
        $_SESSION['success'] = "Successfully uploaded {$successCount} " . ($successCount == 1 ? "image" : "images");
    }
    if (!empty($errors)) {
        $_SESSION['error'] = implode("<br>", $errors);
    }
    
    header("Location: gallery.php");
    exit();
}

// Handle multiple delete
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_photos'])) {
    if (isset($_POST['selected_photos']) && !empty($_POST['selected_photos'])) {
        $photo_ids = $_POST['selected_photos'];
        
        // Begin transaction
        $conn->begin_transaction();
        
        try {
            // First delete from user_albums
            $delete_albums_sql = "DELETE FROM user_albums WHERE image_id = ?";
            $albums_stmt = $conn->prepare($delete_albums_sql);
            
            // Then delete from gallery
            $delete_gallery_sql = "DELETE FROM gallery WHERE id = ?";
            $gallery_stmt = $conn->prepare($delete_gallery_sql);
            
            $success_count = 0;
            $failed_count = 0;
            
            foreach ($photo_ids as $photo_id) {
                // Get image path before deletion
                $sql = "SELECT image_path FROM gallery WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $photo_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $photo = $result->fetch_assoc();
                
                if ($photo) {
                    // Delete from user_albums first
                    $albums_stmt->bind_param("i", $photo_id);
                    $albums_stmt->execute();
                    
                    // Then delete from gallery
                    $gallery_stmt->bind_param("i", $photo_id);
                    if ($gallery_stmt->execute()) {
                        // Delete the actual file
                        $file_path = "../" . $photo['image_path'];
                        if (file_exists($file_path)) {
                            unlink($file_path);
                        }
                        $success_count++;
                    } else {
                        $failed_count++;
                    }
                }
            }
            
            // If all went well, commit the transaction
            $conn->commit();
            $_SESSION['success'] = "Successfully deleted {$success_count} photos." . 
                                 ($failed_count > 0 ? " Failed to delete {$failed_count} photos." : "");
            
        } catch (Exception $e) {
            // If there was an error, rollback the transaction
            $conn->rollback();
            $_SESSION['error'] = "Error deleting photos: " . $e->getMessage();
        }
        
        header("Location: gallery.php");
        exit();
    } else {
        $_SESSION['error'] = "Please select at least one photo to delete.";
    }
}

// Get all photos from gallery
$sql = "SELECT g.*, COUNT(ua.id) as share_count 
        FROM gallery g 
        LEFT JOIN user_albums ua ON g.id = ua.image_id 
        GROUP BY g.id 
        ORDER BY g.created_at DESC";
$result = $conn->query($sql);
$photos = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $photos[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Management | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f4f4f4;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: white;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            color: #333;
            font-size: 24px;
        }

        .upload-section {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: 500;
        }

        .form-group input[type="text"],
        .form-group select {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-group input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 2px dashed #ddd;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 5px;
        }

        .selected-files {
            margin-top: 10px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
            display: none;
        }

        .selected-files ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .selected-files li {
            padding: 5px 0;
            color: #666;
            font-size: 14px;
        }

        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: white;
            text-decoration: none;
            transition: opacity 0.3s;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn-primary {
            background: #007bff;
        }

        .btn-danger {
            background: #dc3545;
        }

        .btn-secondary {
            background: #6c757d;
        }

        .alert {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .photo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .photo-item {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: relative;
        }

        .photo-container {
            position: relative;
            padding-top: 75%;
        }

        .photo-container img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .photo-info {
            padding: 15px;
        }

        .photo-info h3 {
            margin: 0;
            color: #333;
            font-size: 16px;
        }

        .photo-info p {
            margin: 5px 0 0;
            color: #666;
            font-size: 14px;
        }

        .checkbox-wrapper {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 2;
        }

        .photo-checkbox {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }

        .select-controls {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .share-count {
            background: #e9ecef;
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 12px;
            color: #666;
        }

        @media (max-width: 768px) {
            .photo-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }

            .header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .header-actions {
                flex-wrap: wrap;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Gallery Management</h1>
            <div class="header-actions">
                <a href="dashboard.php" class="btn btn-secondary">
                    <i class="ri-dashboard-line"></i> Dashboard
                </a>
            </div>
        </div>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php 
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?php 
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <div class="upload-section">
            <h2>Upload New Photos</h2>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Photo Title (Common title for all photos)</label>
                    <input type="text" id="title" name="title" required>
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select id="category" name="category" required>
                        <option value="">Select category</option>
                        <option value="Portraits">Portraits</option>
                        <option value="Maternity">Maternity</option>
                        <option value="Wedding">Wedding</option>
                        <option value="Engagement">Engagement</option>
                        <option value="Pre-Wedding">Pre-Wedding</option>
                        <option value="Modeling">Modeling</option>
                        <option value="Child">Child</option>
                        <option value="Product">Product</option>
                        <option value="Family">Family</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="images">Choose Photos (Multiple photos allowed)</label>
                    <input type="file" id="images" name="images[]" accept="image/*" multiple required>
                    <div class="selected-files">
                        <p>Selected files:</p>
                        <ul id="fileList"></ul>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="ri-upload-2-line"></i> Upload Photos
                </button>
            </form>
        </div>

        <form method="POST" action="" id="galleryForm">
            <div class="select-controls">
                <button type="button" class="btn btn-secondary" onclick="selectAll()">
                    <i class="ri-checkbox-multiple-line"></i> Select All
                </button>
                <button type="button" class="btn btn-secondary" onclick="deselectAll()">
                    <i class="ri-checkbox-blank-line"></i> Deselect All
                </button>
                <button type="submit" name="delete_photos" class="btn btn-danger" id="deleteBtn" disabled>
                    <i class="ri-delete-bin-line"></i> Delete Selected
                </button>
            </div>

            <div class="photo-grid">
                <?php if (empty($photos)): ?>
                    <div class="alert alert-error" style="grid-column: 1/-1;">
                        No photos found in the gallery.
                    </div>
                <?php else: ?>
                    <?php foreach ($photos as $photo): ?>
                        <div class="photo-item">
                            <div class="checkbox-wrapper">
                                <input type="checkbox" 
                                       name="selected_photos[]" 
                                       value="<?php echo $photo['id']; ?>" 
                                       class="photo-checkbox"
                                       onchange="updateDeleteButton()">
                            </div>
                            <div class="photo-container">
                                <img src="<?php echo htmlspecialchars('../' . $photo['image_path']); ?>" 
                                     alt="<?php echo htmlspecialchars($photo['title']); ?>"
                                     onerror="this.src='../assets/images/placeholder.jpg'">
                            </div>
                            <div class="photo-info">
                                <h3><?php echo htmlspecialchars($photo['title']); ?></h3>
                                <p>Category: <?php echo htmlspecialchars($photo['category']); ?></p>
                                <p>Added: <?php echo date('M j, Y', strtotime($photo['created_at'])); ?></p>
                                <span class="share-count">
                                    <i class="ri-share-line"></i> Shared: <?php echo $photo['share_count']; ?> times
                                </span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <script>
    // Show selected files
    document.getElementById('images').addEventListener('change', function(e) {
        const fileList = document.getElementById('fileList');
        const selectedFiles = document.querySelector('.selected-files');
        fileList.innerHTML = '';
        
        if (this.files.length > 0) {
            selectedFiles.style.display = 'block';
            Array.from(this.files).forEach(file => {
                const li = document.createElement('li');
                li.textContent = file.name;
                fileList.appendChild(li);
            });
        } else {
            selectedFiles.style.display = 'none';
        }
    });

    function updateDeleteButton() {
        const checkedBoxes = document.querySelectorAll('.photo-checkbox:checked');
        const deleteBtn = document.getElementById('deleteBtn');
        deleteBtn.disabled = checkedBoxes.length === 0;
    }

    function selectAll() {
        document.querySelectorAll('.photo-checkbox').forEach(checkbox => {
            checkbox.checked = true;
        });
        updateDeleteButton();
    }

    function deselectAll() {
        document.querySelectorAll('.photo-checkbox').forEach(checkbox => {
            checkbox.checked = false;
        });
        updateDeleteButton();
    }

    // Confirm delete
    document.getElementById('galleryForm').addEventListener('submit', function(e) {
        if (!confirm('Are you sure you want to delete the selected photos? This action cannot be undone.')) {
            e.preventDefault();
        }
    });
    </script>
</body>
</html>
