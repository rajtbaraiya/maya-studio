<?php
session_start();
include("config.php");

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login system with avatar/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Get user's album photos
$images = [];
$sql = "SELECT g.*, ua.sent_date, a.username as admin_name 
        FROM user_albums ua 
        JOIN gallery g ON ua.image_id = g.id 
        JOIN admin a ON ua.sent_by_admin_id = a.id
        WHERE ua.user_id = ? 
        ORDER BY ua.sent_date DESC";

$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $images[] = $row;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Album | Maya Studio</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: #f5f5f5;
        }

        .header {
            background: #fff;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            padding: 20px;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            background: #fff;
        }

        .gallery-item img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .image-info {
            padding: 15px;
            background: #fff;
        }

        .image-info h3 {
            margin: 0;
            font-size: 1.1em;
            color: #333;
        }

        .image-info p {
            margin: 5px 0 0;
            font-size: 0.9em;
            color: #666;
        }

        .no-images {
            text-align: center;
            padding: 50px;
            color: #666;
        }

        .no-images p {
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .gallery {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 15px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container">
            <h1>My Album</h1>
        </div>
    </div>

    <div class="container">
        <div class="gallery">
            <?php if (empty($images)): ?>
                <div class="no-images">
                    <p>No photos in your album yet.</p>
                    <p>The admin will share photos with you after your photoshoot.</p>
                </div>
            <?php else: ?>
                <?php foreach ($images as $image): ?>
                    <div class="gallery-item">
                        <a href="<?php echo $image['image_path']; ?>" target="_blank">
                            <img src="<?php echo $image['image_path']; ?>" alt="<?php echo htmlspecialchars($image['title']); ?>">
                        </a>
                        <div class="image-info">
                            <h3><?php echo htmlspecialchars($image['title']); ?></h3>
                            <p>Shared by: <?php echo htmlspecialchars($image['admin_name']); ?></p>
                            <p>Date: <?php echo date('d M Y', strtotime($image['sent_date'])); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
