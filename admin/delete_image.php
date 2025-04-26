<?php
include("../config.php");
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

// Check if image_id is provided
if (!isset($_POST['image_id'])) {
    echo json_encode(['success' => false, 'message' => 'No image specified']);
    exit();
}

$image_id = (int)$_POST['image_id'];

// Get image path before deleting
$sql = "SELECT image_path FROM gallery WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $image_id);
$stmt->execute();
$result = $stmt->get_result();
$image = $result->fetch_assoc();
$stmt->close();

if ($image) {
    // Delete the image file
    $image_path = $image['image_path'];
    if (file_exists($image_path)) {
        unlink($image_path);
    }

    // Delete from database
    $sql = "DELETE FROM gallery WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $image_id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete from database']);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Image not found']);
}

$conn->close();
?>
