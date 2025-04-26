<?php
session_start();
include("../config.php");

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$success = $error = '';

// Handle image upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upload'])) {
    if (!isset($_FILES['images']) || empty($_FILES['images']['name'][0])) {
        $error = "Please select at least one image to upload.";
    } else {
        $title = $_POST['title'];
        $category = $_POST['category'];
        
        // Create uploads directory if it doesn't exist
        $target_dir = "../assets/images/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        // Handle multiple file uploads
        $total = count($_FILES['images']['name']);
        $success_count = 0;
        $error_count = 0;
        
        for($i = 0; $i < $total; $i++) {
            if ($_FILES['images']['error'][$i] === UPLOAD_ERR_OK) {
                $file_name = basename($_FILES['images']['name'][$i]);
                $file_tmp = $_FILES['images']['tmp_name'][$i];
                $target_file = $target_dir . time() . '_' . $file_name;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                
                // Check if image file is actual image
                $check = getimagesize($file_tmp);
                if($check !== false && 
                   in_array($imageFileType, ["jpg", "jpeg", "png", "gif"]) && 
                   $_FILES['images']['size'][$i] <= 5000000) {
                    
                    if (move_uploaded_file($file_tmp, $target_file)) {
                        // Save to database with correct path for your structure
                        $image_path = "./assets/images/" . basename($target_file);
                        $sql = "INSERT INTO gallery (title, image_path, category) VALUES (?, ?, ?)";
                        $stmt = $conn->prepare($sql);
                        if ($stmt) {
                            $image_title = $title . ($total > 1 ? " (" . ($i + 1) . ")" : "");
                            $stmt->bind_param("sss", $image_title, $image_path, $category);
                            if ($stmt->execute()) {
                                $success_count++;
                            } else {
                                $error_count++;
                                unlink($target_file);
                            }
                            $stmt->close();
                        }
                    } else {
                        $error_count++;
                    }
                } else {
                    $error_count++;
                }
            } else {
                $error_count++;
            }
        }
        
        if ($success_count > 0) {
            $success = "$success_count images uploaded successfully!";
        }
        if ($error_count > 0) {
            $error = "$error_count images failed to upload.";
        }
    }
}

// Handle deletion
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    handleImageDeletion($id, $conn);
} elseif (isset($_POST['delete_multiple']) && isset($_POST['selected_images'])) {
    $success_count = 0;
    $error_count = 0;
    foreach ($_POST['selected_images'] as $id) {
        if (handleImageDeletion($id, $conn)) {
            $success_count++;
        } else {
            $error_count++;
        }
    }
    if ($success_count > 0) {
        $success = "$success_count images deleted successfully!";
    }
    if ($error_count > 0) {
        $error = "$error_count images failed to delete.";
    }
}

// Function to handle image deletion
function handleImageDeletion($id, $conn) {
    // Get image path before deleting
    $sql = "SELECT image_path FROM gallery WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $image_path = $row['image_path'];
            // Delete from database
            $delete_sql = "DELETE FROM gallery WHERE id = ?";
            $delete_stmt = $conn->prepare($delete_sql);
            if ($delete_stmt) {
                $delete_stmt->bind_param("i", $id);
                if ($delete_stmt->execute()) {
                    // Delete file - convert URL path to file system path
                    $file_path = ".." . str_replace(".", "", $image_path);
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                    $delete_stmt->close();
                    return true;
                }
                $delete_stmt->close();
            }
        }
        $stmt->close();
    }
    return false;
}

// Get all images
$images = [];
$sql = "SELECT * FROM gallery ORDER BY created_at DESC";
$result = $conn->query($sql);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $images[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Gallery - Maya Studio</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
    <style>
        :root {
            --primary: #2d2d2d;
            --secondary: #4a4a4a;
            --accent: #f4a261;
            --light: #f9f9f9;
            --white: #ffffff;
            --success: #2a9d8f;
            --danger: #e63946;
            --border: #dee2e6;
            --shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            color: var(--primary);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .header h1 {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .upload-form {
            background: var(--white);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-group input[type="text"],
        .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border);
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-group input[type="file"] {
            width: 100%;
            padding: 0.5rem 0;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--accent);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: #f28b4b;
        }

        .btn-danger {
            background-color: var(--danger);
            color: var(--white);
        }

        .btn-danger:hover {
            background-color: #dc2f3c;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .gallery-item {
            background: var(--white);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
        }

        .gallery-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .gallery-item-info {
            padding: 1rem;
        }

        .gallery-item-info h3 {
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .gallery-item-info p {
            color: var(--secondary);
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .success-message {
            background-color: var(--success);
            color: var(--white);
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .error-message {
            background-color: var(--danger);
            color: var(--white);
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .nav-links {
            text-align: center;
            margin-bottom: 2rem;
        }

        .nav-links a {
            color: var(--primary);
            text-decoration: none;
            margin: 0 1rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--accent);
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }
        
        .debug-info {
            background: #f8f9fa;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 5px;
            font-family: monospace;
        }
        
        .form-group small {
            display: block;
            margin-top: 0.25rem;
            color: var(--gray);
        }
        
        .preview-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 1rem;
            margin: 1rem 0;
        }
        
        .preview-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
            box-shadow: var(--shadow);
        }
        
        .drop-zone {
            border: 2px dashed #ccc;
            border-radius: 10px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .drop-zone:hover,
        .drop-zone.dragover {
            border-color: #666;
            background: #f8f9fa;
        }
        
        .drop-zone i {
            font-size: 2rem;
            color: #666;
            margin-bottom: 1rem;
        }
        
        .select-all-container {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .gallery-item .checkbox-container {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 2;
        }
        
        .gallery-item input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }
        
        .bulk-actions {
            margin: 20px 0;
            display: flex;
            gap: 10px;
            align-items: center;
        }
        
        .selected-count {
            font-weight: bold;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav-links">
            <a href="dashboard.php">← Back to Dashboard</a>
        </div>

        <div class="header">
            <h1>Manage Gallery</h1>
            <p>Upload and manage your gallery images</p>
        </div>

        <?php if ($success): ?>
            <div class="success-message"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form class="upload-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="title">Image Title (Base name for multiple images)</label>
                <input type="text" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option value="">Select a category</option>
                    <option value="portraits">Portraits</option>
                    <option value="maternity">Maternity</option>
                    <option value="wedding">Wedding</option>
                    <option value="engagement">Engagement</option>
                    <option value="pre_wedding">Pre-Wedding</option>
                    <option value="modeling">Modeling</option>
                    <option value="child">Child</option>
                    <option value="product">Product</option>
                    <option value="family">Family</option>
                </select>
            </div>

            <div class="form-group">
                <div class="drop-zone" onclick="document.getElementById('images').click()">
                    <i class="ri-upload-cloud-line"></i>
                    <p>Click or drag images here to upload</p>
                    <small>Supported formats: JPG, JPEG, PNG, GIF (Max size per image: 5MB)</small>
                    <input type="file" id="images" name="images[]" accept="image/*" multiple required style="display: none;" onchange="handleFiles(this.files)">
                </div>
                <div id="preview" class="preview-container"></div>
            </div>

            <button type="submit" name="upload" class="btn btn-primary">Upload Images</button>
        </form>

        <form id="gallery-form" method="post" onsubmit="return confirmDelete()">
            <div class="bulk-actions">
                <div class="select-all-container">
                    <input type="checkbox" id="select-all" onchange="toggleSelectAll()">
                    <label for="select-all">Select All</label>
                </div>
                <span class="selected-count" id="selected-count"></span>
                <button type="submit" name="delete_multiple" class="btn btn-danger" id="delete-selected" style="display: none;">
                    Delete Selected
                </button>
            </div>

            <div class="gallery-grid">
                <?php foreach ($images as $image): ?>
                <div class="gallery-item" data-category="<?php echo htmlspecialchars($image['category']); ?>">
                    <div class="checkbox-container">
                        <input type="checkbox" name="selected_images[]" value="<?php echo $image['id']; ?>" class="image-checkbox" onchange="updateSelectedCount()">
                    </div>
                    <img src="<?php echo htmlspecialchars($image['image_path']); ?>" alt="<?php echo htmlspecialchars($image['title']); ?>">
                    <div class="gallery-item-info">
                        <h3><?php echo htmlspecialchars($image['title']); ?></h3>
                        <p>Category: <?php echo htmlspecialchars(ucfirst(str_replace('_', ' ', $image['category']))); ?></p>
                        <button type="submit" name="delete" value="<?php echo $image['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this image?');">Delete</button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </form>
    </div>

    <script>
    function validateForm() {
        const title = document.getElementById('title').value;
        const category = document.getElementById('category').value;
        const images = document.getElementById('images').files;
        
        if (!title || !category || images.length === 0) {
            alert('Please fill all fields and select at least one image.');
            return false;
        }
        
        for (let i = 0; i < images.length; i++) {
            if (images[i].size > 5000000) {
                alert('One or more files are too large. Max size is 5MB per image.');
                return false;
            }
            
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            if (!allowedTypes.includes(images[i].type)) {
                alert('One or more files are not in a supported format. Only JPG, JPEG, PNG & GIF files are allowed.');
                return false;
            }
        }
        
        return true;
    }

    function handleFiles(files) {
        const preview = document.getElementById('preview');
        preview.innerHTML = '';
        
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (!file.type.startsWith('image/')) continue;
            
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'preview-image';
                preview.appendChild(img);
            }
            reader.readAsDataURL(file);
        }
    }

    // Drag and drop functionality
    const dropZone = document.querySelector('.drop-zone');
    
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        dropZone.classList.add('dragover');
    }

    function unhighlight(e) {
        dropZone.classList.remove('dragover');
    }

    dropZone.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        document.getElementById('images').files = files;
        handleFiles(files);
    }

    function toggleSelectAll() {
        const selectAll = document.getElementById('select-all');
        const checkboxes = document.getElementsByClassName('image-checkbox');
        for (let checkbox of checkboxes) {
            checkbox.checked = selectAll.checked;
        }
        updateSelectedCount();
    }

    function updateSelectedCount() {
        const checkboxes = document.getElementsByClassName('image-checkbox');
        const selectedCount = Array.from(checkboxes).filter(cb => cb.checked).length;
        const countDisplay = document.getElementById('selected-count');
        const deleteButton = document.getElementById('delete-selected');
        
        if (selectedCount > 0) {
            countDisplay.textContent = `${selectedCount} image${selectedCount > 1 ? 's' : ''} selected`;
            deleteButton.style.display = 'block';
        } else {
            countDisplay.textContent = '';
            deleteButton.style.display = 'none';
        }
    }

    function confirmDelete() {
        const selectedCount = Array.from(document.getElementsByClassName('image-checkbox')).filter(cb => cb.checked).length;
        if (selectedCount === 0) {
            alert('Please select at least one image to delete.');
            return false;
        }
        return confirm(`Are you sure you want to delete ${selectedCount} selected image${selectedCount > 1 ? 's' : ''}?`);
    }
    </script>
</body>
</html>
