<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("config.php");

// Create gallery table first
$create_gallery = "CREATE TABLE IF NOT EXISTS `gallery` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `image_path` varchar(255) NOT NULL,
    `category` varchar(50) NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

if ($conn->query($create_gallery) === TRUE) {
    echo "gallery table created successfully<br>";
} else {
    echo "Error creating gallery table: " . $conn->error . "<br>";
}

// Create user_albums table
$create_user_albums = "CREATE TABLE IF NOT EXISTS user_albums (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    image_id INT NOT NULL,
    sent_by_admin_id INT NOT NULL,
    sent_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user_form(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (image_id) REFERENCES gallery(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (sent_by_admin_id) REFERENCES admin(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

if ($conn->query($create_user_albums) === TRUE) {
    echo "user_albums table created successfully<br>";
} else {
    echo "Error creating user_albums table: " . $conn->error . "<br>";
}

// Show all tables in the database
$result = $conn->query("SHOW TABLES");
echo "<br>Tables in database:<br>";
while ($row = $result->fetch_array()) {
    echo $row[0] . "<br>";
}

// Show structure of important tables
$tables = ["user_form", "gallery", "admin", "user_albums"];
foreach ($tables as $table) {
    $result = $conn->query("DESCRIBE $table");
    if ($result) {
        echo "<br>Structure of $table table:<br>";
        echo "<table border='1'>";
        echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $key => $value) {
                echo "<td>" . ($value ?? "NULL") . "</td>";
            }
            echo "</tr>";
        }
        echo "</table><br>";
    } else {
        echo "Error getting structure of $table: " . $conn->error . "<br>";
    }
}

// Show foreign key relationships
$tables = ["user_albums"];
foreach ($tables as $table) {
    $result = $conn->query("
        SELECT 
            CONSTRAINT_NAME,
            COLUMN_NAME,
            REFERENCED_TABLE_NAME,
            REFERENCED_COLUMN_NAME
        FROM information_schema.KEY_COLUMN_USAGE
        WHERE 
            TABLE_NAME = '$table' 
            AND REFERENCED_TABLE_NAME IS NOT NULL
            AND TABLE_SCHEMA = 'mayastudio'
    ");
    
    if ($result) {
        echo "<br>Foreign keys in $table table:<br>";
        echo "<table border='1'>";
        echo "<tr><th>Constraint</th><th>Column</th><th>References Table</th><th>References Column</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . ($value ?? "NULL") . "</td>";
            }
            echo "</tr>";
        }
        echo "</table><br>";
    }
}
?>
