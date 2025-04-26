<?php
include("../config.php");

// Create admin table
$sql = "CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Admin table created successfully<br>";
} else {
    echo "Error creating admin table: " . $conn->error . "<br>";
}

// Create default admin user (username: admin, password: admin123)
$username = "admin";
$password = password_hash("admin123", PASSWORD_DEFAULT);

$sql = "INSERT IGNORE INTO admin (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);

if ($stmt->execute()) {
    echo "Default admin user created successfully<br>";
    echo "Username: admin<br>";
    echo "Password: admin123<br>";
} else {
    echo "Error creating default admin user: " . $stmt->error . "<br>";
}

// Create bookings table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    package_type VARCHAR(50) NOT NULL,
    booking_date DATE NOT NULL,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Bookings table created successfully<br>";
} else {
    echo "Error creating bookings table: " . $conn->error . "<br>";
}

$conn->close();
?>
