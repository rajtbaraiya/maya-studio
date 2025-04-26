<?php
session_start();
include("../config.php");

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Delete contact if requested
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM contact WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Contact message deleted successfully";
    } else {
        $_SESSION['error'] = "Error deleting contact message";
    }
    header("Location: view_contacts.php");
    exit();
}

// Get all contact messages
$sql = "SELECT * FROM contact ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Contact Messages | Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
    <style>
        .message-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            padding: 20px;
        }
        .message-header {
            border-bottom: 1px solid #eee;
            margin-bottom: 15px;
            padding-bottom: 15px;
        }
        .message-meta {
            color: #666;
            font-size: 0.9rem;
        }
        .message-content {
            margin: 15px 0;
            white-space: pre-line;
        }
        .btn-delete {
            color: white;
            background-color: #dc3545;
            border: none;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Contact Messages</h2>
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
            <div class="alert alert-danger">
                <?php 
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="message-card">
                    <div class="message-header">
                        <h5 class="mb-1"><?php echo htmlspecialchars($row['subject']); ?></h5>
                        <div class="message-meta">
                            From: <?php echo htmlspecialchars($row['name']); ?> 
                            (<?php echo htmlspecialchars($row['email']); ?>)
                            <br>
                            Date: <?php echo date('F j, Y g:i A', strtotime($row['created_at'])); ?>
                        </div>
                    </div>
                    <div class="message-content">
                        <?php echo nl2br(htmlspecialchars($row['message'])); ?>
                    </div>
                    <div class="text-end">
                        <a href="view_contacts.php?delete=<?php echo $row['id']; ?>" 
                           class="btn btn-delete"
                           onclick="return confirm('Are you sure you want to delete this message?')">
                            <i class="ri-delete-bin-line"></i> Delete
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="alert alert-info">
                No contact messages found.
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
