<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photography Packages</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
</head>
<style>
    /* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Header Styling */
header {
    text-align: center;
    padding: 20px 0;
    background-color: #f5f5f5;
}

/* Packages Container */
.packages-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    padding: 20px;
    gap: 20px;
}

/* Package Styling */
.package {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    width: 300px;
    padding: 20px;
    text-align: center;
    transition: transform 0.3s, box-shadow 0.3s;
}

.package:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 12px rgba(0,0,0,0.2);
}

.package img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    margin-bottom: 15px;
}

.package h2 {
    font-size: 1.5rem;
    margin-bottom: 10px;
}

.package p {
    margin-bottom: 10px;
    color: #555;
}

.package button {
    background-color: #007bff;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1rem;
}

.package button:hover {
    background-color: #0056b3;
}

</style>
<body>

    <header>
        <h1>Our Photography Packages</h1>
    </header>

    <section class="packages-container">
        <div class="package">
            <img src="./assets/images/wed2.jpg" alt="Package 1">
            <h2>Package 1</h2>
            <p>Description of Package 1</p>
            <p><strong>Price:</strong> $500</p>
            <button>Book Now</button>
        </div>
        
        <div class="package">
            <img src="path/to/image2.jpg" alt="Package 2">
            <h2>Package 2</h2>
            <p>Description of Package 2</p>
            <p><strong>Price:</strong> $700</p>
            <button>Book Now</button>
        </div>
        
        <div class="package">
            <img src="path/to/image3.jpg" alt="Package 3">
            <h2>Package 3</h2>
            <p>Description of Package 3</p>
            <p><strong>Price:</strong> $900</p>
            <button>Book Now</button>
        </div>
    </section>

</body>
</html>
