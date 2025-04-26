<?php
include("config.php");

// Get images for this category
$category = 'Pre-Wedding';
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
    <title>CODE-WITH-HIRAJAT | PRE-WEDDING PAGE</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');


*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}


.container{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    
}

.container .box{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    
}

.container .box .dream {
    display: flex;
    flex-direction: column;
    width: 32.5%;
    gap: 50px;
}

.container .box .dream img {
    width: 100%;
    padding-right: 20px;
    border-radius: 10px;
}

.wh1 {
    flex-grow: 1; /* Allows the heading to take the available space */
    text-align: center; /* Centers the heading text */
    font-family: "Merriweather", serif;
    font-size: 27px; /* Adjust as needed */
}

.ai{
    display: flex;
    align-items: center;
    justify-content: space-between; /* This ensures space between the items */
    width: 100%; /* Ensures the container spans the full width */
    padding: 20px; /* Optional for spacing around the content */
    box-sizing: border-box;
    gap: 10px;

}
.ai img{
    height: 60px;
    width: 60px;
    width: 80%;
    left: 10px;
}
.preheader
{
    min-height: 700px;
    background-image: radial-gradient(rgba(255,255,255,0), rgba(0,0,0,.9)),
    url(assets/images/prel.JPG);
    background-position: center center;
    background-size: cover;
    background-attachment: fixed;
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

    .overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-end;
      padding: 20px;
      color: white;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .gallery-item:hover .overlay {
      opacity: 1;
    }

    .overlay h3 {
      font-size: 1.2em;
      margin-bottom: 5px;
      transform: translateY(20px);
      transition: transform 0.3s ease;
    }

    .overlay p {
      font-size: 0.9em;
      opacity: 0.8;
      transform: translateY(20px);
      transition: transform 0.3s ease 0.1s;
    }

    .gallery-item:hover .overlay h3,
    .gallery-item:hover .overlay p {
      transform: translateY(0);
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
	
	

    @media only screen and (max-width: 769px) {
    .container .box {
        flex-direction: column;
    }

    .container .box .dream {
        width: 100%; /* Full width for smaller screens */
    }
}

@media (width > 540px)
{
    .preheader
    {
        height: 100%;
        width: 100%;
    }
  
}

@media (width > 768px)
{
    .preheader
    {
        height: 100%;
        width: 100%;
    }  
}

@media (width > 1024px)
{
 
    .preheader
    {
       height: 100%;

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
           <img src="./assets/images/logo.jpg" alt="logo"  heigt="90px" width="80px"/>
         </a>
        
    <h1 class="wh1">~ PRE-WEDDING ~</h1>
    </div>
    <header class="preheader">
           

    </header>
    <div class="filter-container">
        <button class="filter-toggle" id="filterToggle">
            <i class="ri-menu-line"></i> 
        </button>
        <div class="filter-buttons" id="filterButtons">
            <a href="./galleryimage.php"><button class="filter-button">All</button></a>
            <a href="./portraits.php"><button class="filter-button">Portraits</button></a>
            <a href="./maternity.php"><button class="filter-button">Maternity</button></a>
            <a href="./wedding.php"><button class="filter-button">Wedding</button></a>
            <a href="./engagment.php"><button class="filter-button">Engagement</button></a>
            <a href="./prewedding.php"><button class="filter-button active">Pre-Wedding</button></a>
            <a href="./modeling.php"><button class="filter-button">Modeling</button></a>
            <a href="./child.php"><button class="filter-button">Child</button></a>
            <a href="./product.php"><button class="filter-button">Product</button></a>
            <a href="./family.php"><button class="filter-button">Family</button></a>
        </div>
    </div>
    <div class="gallery">
        <?php if (empty($images)): ?>
            <div class="no-images">
                <p>No pre-wedding photos available at the moment.</p>
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
    document.addEventListener('DOMContentLoaded', function() {
        // Filter toggle functionality for mobile
        const filterToggle = document.getElementById('filterToggle');
        const filterButtons = document.getElementById('filterButtons');
        
        filterToggle.addEventListener('click', function() {
            filterButtons.classList.toggle('active');
        });
    });
    </script>
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