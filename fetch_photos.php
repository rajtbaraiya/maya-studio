<?php
$conn = new mysqli("localhost", "root", "", "mayastudio");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT photo_id, E_ID, img_url FROM gallery");
$photos = [];
while ($row = $result->fetch_assoc()) {
    $photos[] = $row;
}

header('Content-Type: application/json');
echo json_encode($photos);
$conn->close();
?>