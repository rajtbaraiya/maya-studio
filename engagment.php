<?php
include("config.php");

// Get images for this category
$category = 'engagement';
$images = [];
$sql = "SELECT * FROM gallery WHERE category = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("s", $category);
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
    <title>CODE-WITH-HIRAJAT | ENGAGEMENT PAGE</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .image-gallery {
            display: grid;
            gap: 20px;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }

        .image-item {
            position: relative;
            overflow: hidden;
            border-radius: 5px;
        }

        .image-item img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .wh1 {
            flex-grow: 1;
            text-align: center;
            font-family: "Merriweather", serif;
            font-size: 27px;
        }

        .ai {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
            gap: 10px;
        }

        .ai img {
            height: 60px;
            width: 100%;
            max-width: 80px;
        }

        .eheader {
            min-height: 700px;
            background-image: radial-gradient(rgba(255, 255, 255, 0), rgba(0, 0, 0, .9)),
                url(assets/images/engbglogo.JPG);
            background-position: center center;
            background-size: cover;
            background-attachment: fixed;
        }

        /* Filter Buttons Container */
        .filter-container {
            position: sticky;
            top: 0;
            background: #fff;
            padding: 5px 0;
            z-index: 1111;
        }

        .filter-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }

        .filter-button {
            padding: 10px 25px;
            border: none;
            border-radius: 25px;
            background: rgba(255, 255, 255, 0.1);
            color: black;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9em;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .filter-button:hover,
        .filter-button.active {
            background: #E0E7E9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* Toggle Button */
        .filter-toggle {
            display: none;
            padding: 10px 20px;
            background: #E0E7E9;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            margin: 10px auto;
            width: 150px;
            text-align: center;
        }

        .filter-toggle i {
            margin-right: 5px;
        }

        /* Gallery Styles */
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
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            height: 300px;
            background: #fff;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .gallery-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .filter-container {
                padding: 10px;
            }

            .filter-toggle {
                display: block;
            }

            .filter-buttons {
                display: none;
                flex-direction: column;
                gap: 10px;
                padding: 10px;
                background: #fff;
                border-radius: 5px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                position: absolute;
                top: 60px;
                left: 50%;
                transform: translateX(-50%);
                width: 90%;
                max-width: 300px;
            }

            .filter-buttons.active {
                display: flex;
            }

            .filter-button {
                padding: 8px 20px;
                font-size: 0.8em;
                margin-top: 0;
                width: 100%;
                text-align: center;
            }

            .gallery {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 15px;
                padding: 10px;
            }

            .gallery-item {
                height: 250px;
            }

            .wh1 {
                font-size: 20px;
            }

            .ai img {
                height: 50px;
                max-width: 60px;
            }
        }

        @media (max-width: 540px) {
            .image-gallery {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 540px) {
            .gallery {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <div class="ai">
        <a href="./portfolio.php">
            <img src="./assets/images/logo.jpg" alt="logo" />
        </a>
        <h1 class="wh1">~ ENGAGEMENT ~</h1>
    </div>
    <header class="eheader"></header>
    
    <div class="filter-container">
        <button class="filter-toggle" id="filterToggle">
            <i class="ri-menu-line"></i> 
        </button>
        <div class="filter-buttons" id="filterButtons">
            <a href="./galleryimage.php"><button class="filter-button">All</button></a>
            <a href="./portraits.php"><button class="filter-button">Portraits</button></a>
            <a href="./maternity.php"><button class="filter-button">Maternity</button></a>
            <a href="./wedding.php"><button class="filter-button">Wedding</button></a>
            <a href="./engagment.php"><button class="filter-button active">Engagement</button></a>
            <a href="./prewedding.php"><button class="filter-button">Pre-Wedding</button></a>
            <a href="./modeling.php"><button class="filter-button">Modeling</button></a>
            <a href="./child.php"><button class="filter-button">Child</button></a>
            <a href="./product.php"><button class="filter-button">Product</button></a>
            <a href="./family.php"><button class="filter-button">Family</button></a>
        </div>
    </div>

    <div class="gallery">
        <?php if (empty($images)): ?>
            <div class="no-images">
                <p>No engagement photos available at the moment.</p>
            </div>
        <?php else: ?>
            <?php foreach ($images as $image): ?>
            <div class="gallery-item">
                <a href="<?php echo $image['image_path']; ?>">
                    <img src="<?php echo $image['image_path']; ?>" alt="<?php echo htmlspecialchars($image['title']); ?>">
                </a>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <script>
        const filterToggle = document.getElementById('filterToggle');
        const filterButtons = document.getElementById('filterButtons');

        filterToggle.addEventListener('click', () => {
            filterButtons.classList.toggle('active');
            const isOpen = filterButtons.classList.contains('active');
            filterToggle.innerHTML = isOpen 
                ? '<i class="ri-close-line"></i> Close' 
                : '<i class="ri-menu-line"></i> Filters';
        });

        // Close filter menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!filterToggle.contains(e.target) && !filterButtons.contains(e.target)) {
                filterButtons.classList.remove('active');
                filterToggle.innerHTML = '<i class="ri-menu-line"></i> Filters';
            }
        });
    </script>
</body>
</html>