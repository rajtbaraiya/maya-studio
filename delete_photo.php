<?php
$conn = new mysqli("localhost", "root", "", "mayastudio");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);
$photo_id = $conn->real_escape_string($data['photo_id']);

// Fetch the photo to get the file path
$result = $conn->query("SELECT img_url FROM gallery WHERE photo_id = '$photo_id'");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $file_path = "gallery/" . $row['img_url'];
    if (file_exists($file_path)) {
        unlink($file_path); // Delete the file from the server
    }
}

$sql = "DELETE FROM gallery WHERE photo_id = '$photo_id'";
$response = ['success' => false, 'message' => ''];

if ($conn->query($sql) === TRUE) {
    $response['success'] = true;
} else {
    $response['message'] = $conn->error;
}

header('Content-Type: application/json');
echo json_encode($response);
$conn->close();
?>