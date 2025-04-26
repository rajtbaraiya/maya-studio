<?php
session_start();
include 'config.php';

header('Content-Type: application/json');

// Check if admin is logged in
if(!isset($_SESSION['admin_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit();
}

if(isset($_POST['user_id'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    
    // Start transaction
    mysqli_begin_transaction($conn);
    
    try {
        // First delete from user_albums table
        $delete_albums = mysqli_query($conn, "DELETE FROM `user_albums` WHERE user_id = '$user_id'");
        if(!$delete_albums) {
            throw new Exception("Error deleting user albums: " . mysqli_error($conn));
        }
        
        // Then delete from bookings table if exists
        $delete_bookings = mysqli_query($conn, "DELETE FROM `bookings` WHERE user_id = '$user_id'");
        if(!$delete_bookings) {
            throw new Exception("Error deleting user bookings: " . mysqli_error($conn));
        }
        
        // Finally delete the user
        $delete_user = mysqli_query($conn, "DELETE FROM `user_form` WHERE id = '$user_id'");
        if(!$delete_user) {
            throw new Exception("Error deleting user: " . mysqli_error($conn));
        }
        
        // If everything is successful, commit the transaction
        mysqli_commit($conn);
        echo json_encode(['success' => true, 'message' => 'User and related data deleted successfully']);
        
    } catch (Exception $e) {
        // If there's any error, rollback the changes
        mysqli_rollback($conn);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    
} else {
    echo json_encode(['success' => false, 'message' => 'User ID not provided']);
}
?>
