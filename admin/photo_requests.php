<?php
session_start();
include('../config.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('location:login.php');
    exit();
}

// Handle request approval/rejection
if (isset($_POST['action']) && isset($_POST['request_id'])) {
    $request_id = $_POST['request_id'];
    $action = $_POST['action'];
    $admin_id = $_SESSION['admin_id'];

    if ($action == 'approve') {
        // Get request details
        $sql = "SELECT * FROM photo_requests WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $request_id);
        $stmt->execute();
        $request = $stmt->get_result()->fetch_assoc();

        if ($request) {
            // Get photo paths
            $photo_paths = json_decode($request['photo_paths'], true);
            $user_id = $request['user_id'];

            // Start transaction
            $conn->begin_transaction();

            try {
                // Insert each photo into user_albums
                foreach ($photo_paths as $photo_path) {
                    // Get the image ID from gallery table using the path
                    $sql = "SELECT id FROM gallery WHERE image_path = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $photo_path);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($row = $result->fetch_assoc()) {
                        $image_id = $row['id'];
                        
                        // Add to user_albums if not already exists
                        $sql = "INSERT IGNORE INTO user_albums (user_id, image_id, sent_by_admin_id) 
                               VALUES (?, ?, ?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("iii", $user_id, $image_id, $admin_id);
                        $stmt->execute();
                    }
                }

                // Update request status
                $sql = "UPDATE photo_requests SET status = 'approved' WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $request_id);
                $stmt->execute();

                $conn->commit();
                $success_msg = "Request approved successfully!";
            } catch (Exception $e) {
                $conn->rollback();
                $error_msg = "Error approving request: " . $e->getMessage();
            }
        }
    } else if ($action == 'reject') {
        // Update request status to rejected
        $sql = "UPDATE photo_requests SET status = 'rejected' WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $request_id);
        if ($stmt->execute()) {
            $success_msg = "Request rejected successfully!";
        } else {
            $error_msg = "Error rejecting request";
        }
    }
}

// Get all photo requests with user information
$sql = "SELECT pr.*, uf.name as user_name, uf.email as user_email 
        FROM photo_requests pr 
        JOIN user_form uf ON pr.user_id = uf.id 
        ORDER BY pr.created_at DESC";
$result = $conn->query($sql);
$requests = [];
while ($row = $result->fetch_assoc()) {
    $requests[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Requests | Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
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
            background: #fff;
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
            font-weight: 600;
        }

        .request-card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .request-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-info i {
            font-size: 24px;
            color: #666;
        }

        .status {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 500;
        }

        .status.pending {
            background: #fff3cd;
            color: #856404;
        }

        .status.approved {
            background: #d4edda;
            color: #155724;
        }

        .status.rejected {
            background: #f8d7da;
            color: #721c24;
        }

        .photo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
            margin: 15px 0;
        }

        .photo-item {
            position: relative;
            padding-top: 75%;
            border-radius: 5px;
            overflow: hidden;
        }

        .photo-item img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .request-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
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
            transition: background 0.3s;
        }

        .btn-approve {
            background: #28a745;
            color: white;
        }

        .btn-approve:hover {
            background: #218838;
        }

        .btn-reject {
            background: #dc3545;
            color: white;
        }

        .btn-reject:hover {
            background: #c82333;
        }

        .btn-back {
            background: #6c757d;
            color: white;
            text-decoration: none;
        }

        .btn-back:hover {
            background: #5a6268;
        }

        .message {
            background: #e9ecef;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
        }

        .message h4 {
            margin-bottom: 5px;
            color: #495057;
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

        .no-requests {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 15px;
            }

            .photo-grid {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Photo Requests</h1>
            <a href="dashboard.php" class="btn btn-back">
                <i class="ri-dashboard-line"></i> Back to Dashboard
            </a>
        </div>

        <?php if (isset($success_msg)): ?>
            <div class="alert alert-success">
                <?php echo $success_msg; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($error_msg)): ?>
            <div class="alert alert-error">
                <?php echo $error_msg; ?>
            </div>
        <?php endif; ?>

        <?php if (empty($requests)): ?>
            <div class="no-requests">
                <h2>No photo requests yet</h2>
                <p>When users submit album requests, they will appear here.</p>
            </div>
        <?php else: ?>
            <?php foreach ($requests as $request): ?>
                <div class="request-card">
                    <div class="request-header">
                        <div class="user-info">
                            <i class="ri-user-line"></i>
                            <div>
                                <h3><?php echo htmlspecialchars($request['user_name']); ?></h3>
                                <p><?php echo htmlspecialchars($request['user_email']); ?></p>
                            </div>
                        </div>
                        <span class="status <?php echo $request['status']; ?>">
                            <?php echo ucfirst($request['status']); ?>
                        </span>
                    </div>

                    <?php if ($request['message']): ?>
                        <div class="message">
                            <h4>User's Message:</h4>
                            <p><?php echo nl2br(htmlspecialchars($request['message'])); ?></p>
                        </div>
                    <?php endif; ?>

                    <div class="photo-grid">
                        <?php 
                        $photo_paths = json_decode($request['photo_paths'], true);
                        if ($photo_paths) {
                            foreach ($photo_paths as $path): 
                                // Fix the path by adding ../ to go up one directory since we're in admin folder
                                $display_path = str_starts_with($path, '/') ? "../$path" : "../$path";
                        ?>
                            <div class="photo-item">
                                <img src="<?php echo htmlspecialchars($display_path); ?>" alt="Requested photo">
                            </div>
                        <?php 
                            endforeach;
                        }
                        ?>
                    </div>

                    <?php if ($request['status'] === 'pending'): ?>
                        <div class="request-actions">
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
                                <input type="hidden" name="action" value="approve">
                                <button type="submit" class="btn btn-approve">
                                    <i class="ri-check-line"></i> Approve Request
                                </button>
                            </form>
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
                                <input type="hidden" name="action" value="reject">
                                <button type="submit" class="btn btn-reject">
                                    <i class="ri-close-line"></i> Reject Request
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
