<?php
include("../config.php");

// Get all images
$sql = "SELECT id, image_path FROM gallery";
$result = $conn->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $currentPath = $row['image_path'];
        
        // Fix path if it starts with ./
        if (strpos($currentPath, './') === 0) {
            $newPath = substr($currentPath, 2); // Remove ./
            
            // Update in database
            $updateSql = "UPDATE gallery SET image_path = ? WHERE id = ?";
            $stmt = $conn->prepare($updateSql);
            $stmt->bind_param("si", $newPath, $row['id']);
            $stmt->execute();
            $stmt->close();
            
            echo "Fixed path for ID {$row['id']}: {$currentPath} -> {$newPath}<br>";
        }
    }
    echo "Path fixing complete!";
} else {
    echo "Error getting images: " . $conn->error;
}

$conn->close();
?>
