<?php
session_start();
include("../config.php");

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login system with avatar/admin/login.php");
    exit();
}

$admin_id = $_SESSION['admin_id'];

// Handle photo sharing
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['share_photos'])) {
    if (isset($_POST['selected_photos']) && !empty($_POST['selected_photos']) && 
        isset($_POST['selected_users']) && !empty($_POST['selected_users'])) {
        
        $photo_ids = $_POST['selected_photos'];
        $user_ids = $_POST['selected_users'];
        $success_count = 0;
        $error_count = 0;

        // Begin transaction
        $conn->begin_transaction();

        try {
            // Delete existing shares for these photos and users
            $delete_stmt = $conn->prepare("DELETE FROM user_albums WHERE image_id = ? AND user_id = ?");
            
            // Prepare statement for inserting shared photos
            $insert_stmt = $conn->prepare("INSERT INTO user_albums (user_id, image_id, sent_by_admin_id) VALUES (?, ?, ?)");
            
            // For each selected user
            foreach ($user_ids as $user_id) {
                // For each selected photo
                foreach ($photo_ids as $photo_id) {
                    // First delete any existing share
                    $delete_stmt->bind_param("ii", $photo_id, $user_id);
                    $delete_stmt->execute();
                    
                    // Then create the new share
                    $insert_stmt->bind_param("iii", $user_id, $photo_id, $admin_id);
                    if ($insert_stmt->execute()) {
                        $success_count++;
                    } else {
                        $error_count++;
                    }
                }
            }

            // Commit transaction
            $conn->commit();
            
            $_SESSION['success'] = "Successfully shared {$success_count} photos" . 
                                 ($error_count > 0 ? ". Failed to share {$error_count} photos." : ".");
            
        } catch (Exception $e) {
            // Rollback on error
            $conn->rollback();
            $_SESSION['error'] = "Error sharing photos: " . $e->getMessage();
        }
        
        header("Location: share_photos.php");
        exit();
    } else {
        $_SESSION['error'] = "Please select both photos and users to share with.";
    }
}

// Get all photos from gallery with their current share status
$sql = "SELECT g.*, GROUP_CONCAT(ua.user_id) as shared_with
        FROM gallery g 
        LEFT JOIN user_albums ua ON g.id = ua.image_id 
        GROUP BY g.id 
        ORDER BY g.created_at DESC";
$result = $conn->query($sql);
$photos = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $row['shared_with'] = $row['shared_with'] ? explode(',', $row['shared_with']) : [];
        $photos[] = $row;
    }
}

// Get all users
$sql = "SELECT * FROM user_form ORDER BY name ASC";
$result = $conn->query($sql);
$users = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share Photos | Admin</title>
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

        .share-section {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .users-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }

        .user-item {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-checkbox {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }

        .user-info h3 {
            margin: 0;
            font-size: 14px;
            color: #333;
        }

        .user-info p {
            margin: 0;
            font-size: 12px;
            color: #666;
        }

        .photo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
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

        .photo-card {
            position: relative;
            margin: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .shared-with {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .users-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }

            .photo-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }

            .select-controls {
                flex-wrap: wrap;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Share Photos with Users</h1>
            <a href="dashboard.php" class="btn btn-secondary">
                <i class="ri-dashboard-line"></i> Back to Dashboard
            </a>
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

        <form method="POST" action="" id="shareForm">
            <div class="share-section">
                <h2>Step 1: Select Users</h2>
                <div class="select-controls">
                    <button type="button" class="btn btn-secondary" onclick="selectAllUsers()">
                        <i class="ri-checkbox-multiple-line"></i> Select All Users
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="deselectAllUsers()">
                        <i class="ri-checkbox-blank-line"></i> Deselect All Users
                    </button>
                </div>
                <div class="users-grid">
                    <?php foreach ($users as $user): ?>
                        <div class="user-item">
                            <input type="checkbox" 
                                   name="selected_users[]" 
                                   value="<?php echo $user['id']; ?>" 
                                   class="user-checkbox"
                                   onchange="updateShareButton()">
                            <div class="user-info">
                                <h3><?php echo htmlspecialchars($user['name']); ?></h3>
                                <p><?php echo htmlspecialchars($user['email']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="share-section">
                <h2>Step 2: Select Photos to Share</h2>
                <div class="select-controls">
                    <button type="button" class="btn btn-secondary" onclick="selectAllPhotos()">
                        <i class="ri-checkbox-multiple-line"></i> Select All Photos
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="deselectAllPhotos()">
                        <i class="ri-checkbox-blank-line"></i> Deselect All Photos
                    </button>
                    <button type="submit" name="share_photos" class="btn btn-primary" id="shareBtn" disabled>
                        <i class="ri-share-line"></i> Share Selected Photos
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
                                           onchange="updateShareButton()">
                                </div>
                                <div class="photo-container">
                                    <img src="<?php echo htmlspecialchars('../' . $photo['image_path']); ?>" 
                                         alt="<?php echo htmlspecialchars($photo['title']); ?>"
                                         onerror="this.src='../assets/images/placeholder.jpg'">
                                </div>
                                <div class="photo-info">
                                    <h3><?php echo htmlspecialchars($photo['title']); ?></h3>
                                    <p>Category: <?php echo htmlspecialchars($photo['category']); ?></p>
                                    <span class="share-count">
                                        <i class="ri-share-line"></i> Shared: <?php echo count($photo['shared_with']); ?> times
                                    </span>
                                    <div class="shared-with">
                                        <?php
                                        if (!empty($photo['shared_with'])) {
                                            $shared_users = array_filter($users, function($user) use ($photo) {
                                                return in_array($user['id'], $photo['shared_with']);
                                            });
                                            $shared_names = array_map(function($user) {
                                                return $user['name'];
                                            }, $shared_users);
                                            echo "Shared with: " . htmlspecialchars(implode(", ", $shared_names));
                                        } else {
                                            echo "Not shared with any users";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>

    <script>
    function updateShareButton() {
        const checkedUsers = document.querySelectorAll('.user-checkbox:checked');
        const checkedPhotos = document.querySelectorAll('.photo-checkbox:checked');
        const shareBtn = document.getElementById('shareBtn');
        shareBtn.disabled = checkedUsers.length === 0 || checkedPhotos.length === 0;
    }

    function selectAllUsers() {
        document.querySelectorAll('.user-checkbox').forEach(checkbox => {
            checkbox.checked = true;
        });
        updateShareButton();
    }

    function deselectAllUsers() {
        document.querySelectorAll('.user-checkbox').forEach(checkbox => {
            checkbox.checked = false;
        });
        updateShareButton();
    }

    function selectAllPhotos() {
        document.querySelectorAll('.photo-checkbox').forEach(checkbox => {
            checkbox.checked = true;
        });
        updateShareButton();
    }

    function deselectAllPhotos() {
        document.querySelectorAll('.photo-checkbox').forEach(checkbox => {
            checkbox.checked = false;
        });
        updateShareButton();
    }

    // Confirm share
    document.getElementById('shareForm').addEventListener('submit', function(e) {
        if (!confirm('Are you sure you want to share the selected photos with the selected users?')) {
            e.preventDefault();
        }
    });
    </script>
</body>
</html>
