<?php
session_start();
include("config.php");

if (!isset($_SESSION['uid'])) {
    header("Location: ../login system with avatar/login.php");
    exit();
}

$user_id = $_SESSION['uid'];
$show_selected = isset($_GET['show_selected']) ? $_GET['show_selected'] : false;

// Handle album request submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['selected_photos'])) {
    $selected_photos = $_POST['selected_photos'];
    $message = isset($_POST['message']) ? $_POST['message'] : '';
    
    // Convert array to JSON for storage
    $photo_paths = json_encode($selected_photos);
    
    // Insert into photo_requests table
    $sql = "INSERT INTO photo_requests (user_id, photo_paths, message, status) VALUES (?, ?, ?, 'pending')";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("iss", $user_id, $photo_paths, $message);
        if ($stmt->execute()) {
            $_SESSION['success'] = "Your album request has been sent to admin!";
            header("Location: album.php");
            exit();
        }
    }
}

// Get existing requests
$request_sql = "SELECT * FROM photo_requests WHERE user_id = ? ORDER BY created_at DESC LIMIT 1";
$request_stmt = $conn->prepare($request_sql);
$request_stmt->bind_param("i", $user_id);
$request_stmt->execute();
$latest_request = $request_stmt->get_result()->fetch_assoc();

// Get all photos shared with the current user
$sql = "SELECT DISTINCT g.* FROM gallery g 
        INNER JOIN user_albums ua ON g.id = ua.image_id 
        WHERE ua.user_id = ? 
        ORDER BY g.created_at DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
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
    <title>My Shared Photos</title>
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

        .header-buttons {
            display: flex;
            gap: 10px;
            align-items: center;
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

        .photo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .photo-item {
            position: relative;
            background: white;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .photo-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 4px;
        }

        .photo-checkbox {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 20px;
            height: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            resize: vertical;
            min-height: 100px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }

        .btn-primary {
            background: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background: #0056b3;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
            text-decoration: none;
        }

        .btn-secondary:hover {
            background: #545b62;
        }

        .request-status {
            background: #e9ecef;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .no-photos {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .selected-photos-section {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .selected-photos-section h2 {
            margin-bottom: 15px;
            color: #333;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 14px;
            font-weight: 500;
            background: #e9ecef;
            color: #495057;
            margin-bottom: 15px;
        }

        .request-message {
            margin-top: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 5px;
        }

        .request-message strong {
            display: block;
            margin-bottom: 5px;
            color: #495057;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>My Shared Photos</h1>
            <div class="header-buttons">
                <?php if ($latest_request): ?>
                    <a href="?show_selected=1" class="btn btn-primary">View Selected Photos</a>
                <?php endif; ?>
                <a href="index.php" class="btn btn-secondary">Back to Home</a>
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

        <!-- Display Latest Selected Photos Section -->
        <?php if ($latest_request && $show_selected): ?>
            <div class="selected-photos-section">
                <h2>Your Latest Selected Photos</h2>
                <p>Request Status: <span class="status-badge"><?php echo ucfirst($latest_request['status']); ?></span></p>
                <div class="photo-grid">
                    <?php 
                    $selected_photos = json_decode($latest_request['photo_paths'], true);
                    if ($selected_photos): 
                        foreach ($selected_photos as $photo): ?>
                            <div class="photo-item">
                                <img src="<?php echo $photo; ?>" alt="Selected photo">
                            </div>
                        <?php endforeach; 
                    else: ?>
                        <div class="no-photos">
                            <p>No photos selected yet.</p>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if (!empty($latest_request['message'])): ?>
                    <div class="request-message">
                        <strong>Your Message:</strong>
                        <p><?php echo htmlspecialchars($latest_request['message']); ?></p>
                    </div>
                <?php endif; ?>
                <a href="?" class="btn btn-secondary">Back to All Photos</a>
            </div>
        <?php endif; ?>

        <?php if (!$show_selected): ?>
            <form action="" method="POST" id="albumForm">
                <div class="photo-grid">
                    <?php if (empty($photos)): ?>
                        <div class="no-photos">
                            <p>No photos have been shared with you yet.</p>
                        </div>
                    <?php else: 
                        foreach ($photos as $photo): ?>
                            <div class="photo-item">
                                <img src="<?php echo $photo['image_path']; ?>" alt="Gallery photo">
                                <input type="checkbox" name="selected_photos[]" value="<?php echo $photo['image_path']; ?>" class="photo-checkbox">
                            </div>
                        <?php endforeach;
                    endif; ?>
                </div>
                <?php if (!empty($photos)): ?>
                    <div class="form-group">
                        <label for="message">Message for Admin (Optional):</label>
                        <textarea name="message" id="message" rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Selected Photos to Admin</button>
                <?php endif; ?>
            </form>
        <?php endif; ?>
    </div>

    <script>
        // Enable submit button only when at least one photo is selected
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const checkboxes = document.querySelectorAll('.photo-checkbox');
            const submitBtn = document.querySelector('button[type="submit"]');

            if (form && checkboxes.length > 0) {
                function updateSubmitButton() {
                    const checked = Array.from(checkboxes).some(cb => cb.checked);
                    submitBtn.disabled = !checked;
                    submitBtn.style.opacity = checked ? '1' : '0.5';
                }

                checkboxes.forEach(cb => cb.addEventListener('change', updateSubmitButton));
                updateSubmitButton();
            }
        });
    </script>
</body>
</html>
