<?php
session_start();
include("../config.php");

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login system with avatar/admin/login.php");
    exit();
}

$admin_id = $_SESSION['admin_id'];

// Handle request approval/rejection
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['request_id']) && isset($_POST['action'])) {
        $request_id = $_POST['request_id'];
        $action = $_POST['action'];
        $status = ($action == 'approve') ? 'approved' : 'rejected';
        
        // Update request status
        $sql = "UPDATE photo_requests SET status = ?, updated_at = NOW() WHERE id = ?";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param("si", $status, $request_id);
            if ($stmt->execute()) {
                // If approved, add photos to user_albums
                if ($action == 'approve') {
                    // Get request details
                    $sql = "SELECT user_id, photo_paths FROM photo_requests WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $request_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $request = $result->fetch_assoc();
                    
                    if ($request) {
                        $photo_ids = json_decode($request['photo_paths']);
                        $user_id = $request['user_id'];
                        
                        // Insert each photo into user_albums
                        $sql = "INSERT INTO user_albums (user_id, image_id, sent_by_admin_id) VALUES (?, ?, ?)";
                        $stmt = $conn->prepare($sql);
                        
                        foreach ($photo_ids as $photo_id) {
                            $stmt->bind_param("iii", $user_id, $photo_id, $admin_id);
                            $stmt->execute();
                        }
                    }
                }
                $_SESSION['success'] = "Request has been " . $status;
                header("Location: view_requests.php");
                exit();
            }
        }
    }
}

// Function to get photo details
function getPhotoDetails($conn, $photo_id) {
    $sql = "SELECT * FROM gallery WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $photo_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Get all pending requests with user details
$sql = "SELECT pr.*, uf.name as user_name, uf.email as user_email 
        FROM photo_requests pr 
        JOIN user_form uf ON pr.user_id = uf.id 
        ORDER BY pr.created_at DESC";
$result = $conn->query($sql);
$requests = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $requests[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Album Requests | Admin</title>
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

        .back-btn {
            background: #6c757d;
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 5px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 14px;
        }

        .back-btn:hover {
            background: #5a6268;
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

        .requests-grid {
            display: grid;
            gap: 20px;
        }

        .request-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .request-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .user-info h3 {
            font-size: 18px;
            color: #333;
            margin-bottom: 5px;
        }

        .user-info p {
            color: #666;
            font-size: 14px;
        }

        .request-status {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 14px;
            font-weight: 500;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-approved {
            background: #d4edda;
            color: #155724;
        }

        .status-rejected {
            background: #f8d7da;
            color: #721c24;
        }

        .request-message {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .request-message p {
            margin: 0;
            color: #666;
        }

        .photo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
            margin: 15px 0;
        }

        .photo-item {
            position: relative;
            border-radius: 5px;
            overflow: hidden;
            aspect-ratio: 1;
        }

        .photo-item img {
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
            color: white;
            transition: opacity 0.3s;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn-approve {
            background: #28a745;
        }

        .btn-reject {
            background: #dc3545;
        }

        .request-date {
            color: #666;
            font-size: 14px;
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            .photo-grid {
                grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Album Creation Requests</h1>
            <a href="dashboard.php" class="back-btn">
                <i class="ri-arrow-left-line"></i> Back to Dashboard
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

        <div class="requests-grid">
            <?php if (empty($requests)): ?>
                <div class="request-card">
                    <p>No album requests found.</p>
                </div>
            <?php else: ?>
                <?php foreach ($requests as $request): ?>
                    <div class="request-card">
                        <div class="request-header">
                            <div class="user-info">
                                <h3><?php echo htmlspecialchars($request['user_name']); ?></h3>
                                <p><?php echo htmlspecialchars($request['user_email']); ?></p>
                            </div>
                            <span class="request-status status-<?php echo $request['status']; ?>">
                                <?php echo ucfirst($request['status']); ?>
                            </span>
                        </div>

                        <?php if ($request['message']): ?>
                            <div class="request-message">
                                <p><?php echo htmlspecialchars($request['message']); ?></p>
                            </div>
                        <?php endif; ?>

                        <!-- Debug info -->
                        <div style="background: #f8f9fa; padding: 10px; margin: 10px 0; font-family: monospace; font-size: 12px;">
                            Photo IDs: <?php echo htmlspecialchars($request['photo_paths']); ?>
                        </div>

                        <div class="photo-grid">
                            <?php 
                            $photo_ids = json_decode($request['photo_paths']);
                            if ($photo_ids):
                                foreach ($photo_ids as $photo_id):
                                    $photo = getPhotoDetails($conn, $photo_id);
                                    if ($photo):
                                        // Debug info
                                        echo '<div style="background: #f8f9fa; padding: 10px; margin: 10px 0; font-family: monospace; font-size: 12px;">';
                                        echo 'Photo ID: ' . $photo_id . '<br>';
                                        echo 'Image Path: ' . $photo['image_path'] . '<br>';
                                        echo 'Full Path: ' . '../' . $photo['image_path'];
                                        echo '</div>';
                            ?>
                                <div class="photo-item">
                                    <img src="<?php echo htmlspecialchars('../' . $photo['image_path']); ?>" 
                                         alt="<?php echo htmlspecialchars($photo['title']); ?>"
                                         onerror="this.src='../assets/images/placeholder.jpg'">
                                </div>
                            <?php 
                                    endif;
                                endforeach; 
                            endif;
                            ?>
                        </div>

                        <?php if ($request['status'] == 'pending'): ?>
                            <form method="POST" action="" class="request-actions">
                                <input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
                                <button type="submit" name="action" value="approve" class="btn btn-approve">
                                    <i class="ri-check-line"></i> Approve
                                </button>
                                <button type="submit" name="action" value="reject" class="btn btn-reject">
                                    <i class="ri-close-line"></i> Reject
                                </button>
                            </form>
                        <?php endif; ?>

                        <div class="request-date">
                            Requested on: <?php echo date('F j, Y g:i A', strtotime($request['created_at'])); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
