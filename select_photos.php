<?php
include("config.php");
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle photo request submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['selected_photos'])) {
    $selected_photos = $_POST['selected_photos'];
    $message = $_POST['message'] ?? '';
    
    // Convert array to JSON string for storage
    $photo_paths = json_encode($selected_photos);
    
    // Insert request into database
    $sql = "INSERT INTO photo_requests (user_id, photo_paths, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("iss", $user_id, $photo_paths, $message);
        if ($stmt->execute()) {
            $success = "Your photo request has been submitted successfully! We'll notify you once it's approved.";
        } else {
            $error = "Failed to submit request. Please try again.";
        }
        $stmt->close();
    }
}

// Get all shared photos for this user
$sql = "SELECT g.* FROM gallery g 
        INNER JOIN user_albums ua ON g.id = ua.image_id 
        WHERE ua.user_id = ? 
        ORDER BY g.created_at DESC";
$stmt = $conn->prepare($sql);
$images = [];

if ($stmt) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $images[] = $row;
    }
    $stmt->close();
}

// Get pending requests
$sql = "SELECT * FROM photo_requests WHERE user_id = ? AND status = 'pending' ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$pending_requests = [];

if ($stmt) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $row['photo_paths'] = json_decode($row['photo_paths'], true);
        $pending_requests[] = $row;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Photos - Maya Studio</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background: #f4f4f4;
        }

        .header {
            background: white;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .alert {
            padding: 15px;
            border-radius: 4px;
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

        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .gallery-item {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: relative;
        }

        .gallery-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .gallery-item .checkbox-wrapper {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(255,255,255,0.9);
            border-radius: 4px;
            padding: 5px;
        }

        .gallery-item .info {
            padding: 15px;
        }

        .gallery-item h3 {
            margin: 0;
            color: #333;
            font-size: 18px;
        }

        .gallery-item p {
            color: #666;
            margin: 5px 0;
        }

        .request-form {
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
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background: #0056b3;
        }

        .btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .pending-requests {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .pending-requests h2 {
            margin-bottom: 15px;
        }

        .request-item {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }

        .request-item:last-child {
            border-bottom: none;
        }

        .request-item p {
            margin: 5px 0;
            color: #666;
        }

        .request-item .status {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 14px;
            background: #fff3cd;
            color: #856404;
        }

        @media (max-width: 768px) {
            .gallery {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container">
            <h1>Select Photos for Album Request</h1>
        </div>
    </div>

    <div class="container">
        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (!empty($pending_requests)): ?>
        <div class="pending-requests">
            <h2>Your Pending Requests</h2>
            <?php foreach ($pending_requests as $request): ?>
            <div class="request-item">
                <p><strong>Requested on:</strong> <?php echo date('M j, Y', strtotime($request['created_at'])); ?></p>
                <p><strong>Number of photos:</strong> <?php echo count($request['photo_paths']); ?></p>
                <?php if ($request['message']): ?>
                    <p><strong>Message:</strong> <?php echo htmlspecialchars($request['message']); ?></p>
                <?php endif; ?>
                <p><span class="status">Pending approval</span></p>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <form method="POST" action="" class="request-form" id="photoRequestForm">
            <div class="form-group">
                <label for="message">Message for Admin (Optional)</label>
                <textarea id="message" name="message" placeholder="Enter any specific requirements or notes for your album..."></textarea>
            </div>

            <button type="submit" class="btn" id="submitBtn" disabled>Request Selected Photos</button>
        </form>

        <?php if (empty($images)): ?>
            <div class="alert alert-error">No photos have been shared with you yet.</div>
        <?php else: ?>
            <div class="gallery">
                <?php foreach ($images as $image): ?>
                <div class="gallery-item">
                    <img src="<?php echo htmlspecialchars($image['image_path']); ?>" 
                         alt="<?php echo htmlspecialchars($image['title']); ?>"
                         onerror="this.src='assets/images/placeholder.jpg'">
                    <div class="checkbox-wrapper">
                        <input type="checkbox" name="selected_photos[]" 
                               value="<?php echo $image['id']; ?>" 
                               class="photo-checkbox"
                               form="photoRequestForm">
                    </div>
                    <div class="info">
                        <h3><?php echo htmlspecialchars($image['title']); ?></h3>
                        <p>Category: <?php echo htmlspecialchars($image['category']); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <script>
    // Enable/disable submit button based on selections
    document.querySelectorAll('.photo-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updateSubmitButton);
    });

    function updateSubmitButton() {
        const checkedBoxes = document.querySelectorAll('.photo-checkbox:checked');
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = checkedBoxes.length === 0;
    }
    </script>
</body>
</html>
