<?php
$conn = new mysqli("localhost", "root", "", "mayastudio");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);
$event_id = $conn->real_escape_string($data['event_id']);

// Fetch all photos for the event to delete files
$result = $conn->query("SELECT img_url FROM gallery WHERE E_ID = '$event_id'");
while ($row = $result->fetch_assoc()) {
    $file_path = "gallery/" . $row['img_url'];
    if (file_exists($file_path)) {
        unlink($file_path); // Delete the file from the server
    }
}

$sql = "DELETE FROM gallery WHERE E_ID = '$event_id'";
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