<?php
session_start();
include("config.php");

// Check if user is logged in
if (!isset($_SESSION['uid'])) {
    header("Location: ../login system with avatar/login.php");
    exit();
}

$user_id = $_SESSION['uid'];

// Get user's shared photos with admin info and date
$photos = [];
$sql = "SELECT g.*, ua.sent_date, a.username as shared_by 
        FROM user_albums ua 
        JOIN gallery g ON ua.image_id = g.id 
        JOIN admin a ON ua.sent_by_admin_id = a.id 
        WHERE ua.user_id = ? 
        ORDER BY ua.sent_date DESC";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Database error. Please try again later.");
}

$stmt->bind_param("i", $user_id);
if (!$stmt->execute()) {
    die("Database error. Please try again later.");
}

$result = $stmt->get_result();
if (!$result) {
    die("Database error. Please try again later.");
}

while ($row = $result->fetch_assoc()) {
    $photos[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Photos | Maya Studio</title>
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
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        h1 {
            margin-bottom: 30px;
            color: #333;
            text-align: center;
        }

        .no-photos {
            text-align: center;
            padding: 50px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }

        .photo-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .photo-card:hover {
            transform: translateY(-5px);
        }

        .photo-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .photo-info {
            padding: 15px;
        }

        .photo-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .photo-meta {
            font-size: 14px;
            color: #666;
        }

        .photo-meta i {
            margin-right: 5px;
            vertical-align: middle;
        }

        .meta-item {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            background: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
            transition: background 0.3s ease;
        }

        .back-button:hover {
            background: #444;
        }

        .back-button i {
            margin-right: 8px;
        }

        @media (max-width: 768px) {
            .gallery {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 20px;
            }

            .photo-card img {
                height: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="album.php" class="back-button">
            <i class="ri-arrow-left-line"></i> Back to Album
        </a>
        
        <h1>My Shared Photos</h1>

        <?php if (empty($photos)): ?>
            <div class="no-photos">
                <h2>No photos shared with you yet</h2>
                <p>When an admin shares photos with you, they will appear here.</p>
            </div>
        <?php else: ?>
            <div class="gallery">
                <?php foreach ($photos as $photo): ?>
                    <div class="photo-card">
                        <img src="<?php echo htmlspecialchars($photo['image_path']); ?>" alt="<?php echo htmlspecialchars($photo['title']); ?>">
                        <div class="photo-info">
                            <div class="photo-title"><?php echo htmlspecialchars($photo['title']); ?></div>
                            <div class="photo-meta">
                                <div class="meta-item">
                                    <i class="ri-user-line"></i>
                                    Shared by: <?php echo htmlspecialchars($photo['shared_by']); ?>
                                </div>
                                <div class="meta-item">
                                    <i class="ri-time-line"></i>
                                    Date: <?php echo date('F j, Y', strtotime($photo['sent_date'])); ?>
                                </div>
                                <?php if (!empty($photo['category'])): ?>
                                <div class="meta-item">
                                    <i class="ri-folder-line"></i>
                                    Category: <?php echo htmlspecialchars($photo['category']); ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
