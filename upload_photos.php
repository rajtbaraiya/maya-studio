<?php
$conn = new mysqli("localhost", "root", "", "mayastudio");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$response = ['success' => false, 'message' => ''];

if (isset($_POST['event_id']) && !empty($_FILES['photo_files'])) {
    $event_id = $conn->real_escape_string($_POST['event_id']);
    $upload_dir = 'gallery/';
    
    // Create gallery directory if it doesn't exist
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $files = $_FILES['photo_files'];
    $uploaded_files = [];
    $errors = [];

    for ($i = 0; $i < count($files['name']); $i++) {
        $file_name = $files['name'][$i];
        $file_tmp = $files['tmp_name'][$i];
        $file_error = $files['error'][$i];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];

        if ($file_error === UPLOAD_ERR_OK) {
            if (in_array($file_ext, $allowed_exts)) {
                $new_file_name = uniqid() . '.' . $file_ext;
                $dest_path = $upload_dir . $new_file_name;

                if (move_uploaded_file($file_tmp, $dest_path)) {
                    // Insert into database
                    $sql = "INSERT INTO gallery (E_ID, img_url) VALUES ('$event_id', '$new_file_name')";
                    if ($conn->query($sql) === TRUE) {
                        $uploaded_files[] = $file_name;
                    } else {
                        $errors[] = "Failed to save $file_name to database: " . $conn->error;
                        unlink($dest_path); // Remove file if database insert fails
                    }
                } else {
                    $errors[] = "Failed to upload $file_name.";
                }
            } else {
                $errors[] = "$file_name has an invalid file extension.";
            }
        } else {
            $errors[] = "Error uploading $file_name: " . $file_error;
        }
    }

    if (count($errors) === 0) {
        $response['success'] = true;
        $response['message'] = 'Successfully uploaded ' . count($uploaded_files) . ' photo(s).';
    } else {
        $response['message'] = implode(' ', $errors);
    }
} else {
    $response['message'] = 'Event ID and photos are required.';
}

header('Content-Type: application/json');
echo json_encode($response);
$conn->close();
?>