<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Maya Studio Gallery</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Arial', sans-serif;
      /* background: linear-gradient(135deg, #000428, #004e92); */
      background: #131010;
      min-height: 100vh;
      padding: 40px 20px;
    }

    .container {
      max-width: 1400px;
      margin: 0 auto;
    }

    h1 {
      text-align: center;
      margin-bottom: 40px;
      color: white;
      font-size: 2.5em;
      position: relative;
      padding-bottom: 15px;
      text-transform: uppercase;
      letter-spacing: 2px;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    h1::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 100px;
      height: 3px;
      background: linear-gradient(90deg, transparent, #f39c12, transparent);
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

    .filter-buttons {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-bottom: 30px;
      flex-wrap: wrap;
    }

    .filter-button {
      padding: 10px 25px;
      border: none;
      border-radius: 25px;
      background: rgba(255, 255, 255, 0.1);
      color: white;
      cursor: pointer;
      transition: all 0.3s ease;
      font-size: 0.9em;
      text-transform: uppercase;
      letter-spacing: 1px;
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .filter-button:hover,
    .filter-button.active {
      background: #f39c12;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 768px) {
      .gallery {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 15px;
        padding: 10px;
      }

      .gallery-item {
        height: 250px;
      }

      h1 {
        font-size: 2em;
        margin-bottom: 30px;
      }

      .filter-buttons {
        gap: 10px;
      }

      .filter-button {
        padding: 8px 20px;
        font-size: 0.8em;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Our Studio Collection</h1>
    
    <div class="filter-buttons">
      <button class="filter-button active">All</button>
      <button class="filter-button">Portraits</button>
      <button class="filter-button">Wedding</button>
      <button class="filter-button">Fashion</button>
      <button class="filter-button">Events</button>
    </div>

   
    <div class="gallery">
      <div class="gallery-item">
      <a href="./assets/images/eng1.jpg"><img src="./assets/images/eng1.jpg" alt=""></a>
        
      </div>
      <div class="gallery-item">
      <a href="./assets/images/wed1.jpg"><img src="./assets/images/wed1.jpg" alt=""></a>
        
      </div>
      <div class="gallery-item">
      <a href="./assets/images/pre1.jpg"><img src="./assets/images/pre1.jpg" alt=""></a>
        
      </div>
      <div class="gallery-item">
      <a href="./assets/images/wed2.jpg"><img src="./assets/images/wed2.jpg" alt=""></a>
        
      </div>
      <div class="gallery-item">
      <a href="./assets/images/pre2.jpg"><img src="./assets/images/pre2.jpg" alt=""></a>
        
      </div>
      <div class="gallery-item">
      <a href="./assets/images/wed5.jpg"><img src="./assets/images/wed5.jpg" alt=""></a>
        
      </div>
      <div class="gallery-item">
      <a href="./assets/images/eng2.jpg"><img src="./assets/images/eng2.jpg" alt=""></a>
        
      </div>
      <div class="gallery-item">
         <a href="./assets/images/eng3.jpg"><img src="./assets/images/eng3.jpg" alt=""></a>
        
      </div>
      <div class="gallery-item">
      <a href="./assets/images/wed4.jpg"><img src="./assets/images/wed4.jpg" alt=""></a>
        
      </div>
      <div class="gallery-item">
      <a href="./assets/images/pre4.jpg"><img src="./assets/images/pre4.jpg" alt=""></a>
        
      </div>
      <div class="gallery-item">
      <a href="./assets/images/pre7.jpg"><img src="./assets/images/pre7.jpg" alt=""></a>
        
      </div>
      <div class="gallery-item">
      <a href="./assets/images/eng4.jpg"><img src="./assets/images/eng4.jpg" alt=""></a>
        
`       </div>
<div class="gallery-item">
      <a href="./assets/images/wed7.jpg"><img src="./assets/images/wed7.jpg" alt=""></a>
        
      </div>
      <div class="gallery-item">
      <a href="./assets/images/pre7.jpg"><img src="./assets/images/pre7.jpg" alt=""></a>
        
      </div>
      <div class="gallery-item">
      <a href="./assets/images/eng5.jpg"><img src="./assets/images/eng5.jpg" alt=""></a>
        
      </div>
      <div class="gallery-item">
      <a href="./assets/images/eng6.jpg"><img src="./assets/images/eng6.jpg" alt=""></a>
        
      </div>
      <div class="gallery-item">
      <a href="./assets/images/1.jpg"><img src="./assets/images/1.jpg" alt=""></a>
        
      </div>
      <div class="gallery-item">
      <a href="./assets/images/mat1.jpg"><img src="./assets/images/mat1.jpg" alt=""></a>
        
      </div>
      <div class="gallery-item">
      <a href="./assets/images/wed9.jpg"><img src="./assets/images/wed9.jpg" alt=""></a>
        
      </div>
      <div class="gallery-item">
      <a href="./assets/images/wed3.jpg"> <img src="./assets/images/wed3.jpg" alt="Image 1"></a>
        
      </div>
      <div class="gallery-item">
      <a href="./assets/images/eng7.jpg"><img src="./assets/images/eng7.jpg" alt=""></a>
        
      </div>
      <div class="gallery-item">
      <a href="./assets/images/mat3.jpg"><img src="./assets/images/mat3.jpg" alt=""></a>
        
      </div>
      <div class="gallery-item">
      <a href="./assets/images/eng8.jpg"><img src="./assets/images/eng8.jpg" alt=""></a>
        
      </div>
      <div class="gallery-item">
      <a href="./assets/images/wed12.jpg"><img src="./assets/images/wed12.jpg" alt=""></a>
        
      </div>
      <div class="gallery-item">
      <a href="./assets/images/englogo.JPG"><img src="./assets/images/englogo.JPG" alt=""></a>
        
      </div>
      <div class="gallery-item">
      <a href="./assets/images/eng13.jpg"><img src="./assets/images/eng13.jpg" alt=""></a>
        
      </div>

      <div class="gallery-item">
      <a href="./assets/images/pre1.jpg"><img src="./assets/images/pre1.jpg" alt=""></a>
        
      </div>

      <div class="gallery-item">
      <a href="./assets/images/eng15.jpg"><img src="./assets/images/eng11.jpg" alt=""></a>
        
      </div>
      <div class="gallery-item">
      <a href="./assets/images/eng14.jpg"><img src="./assets/images/eng14.jpg" alt=""></a>
        
      </div>
      <div class="gallery-item">
      <a href="./assets/images/englogo.JPG"><img src="./assets/images/englogo.JPG" alt=""></a>
        
      </div>
      <div class="gallery-item">
      <a href="./assets/images/eng15.jpg"><img src="./assets/images/eng3.jpg" alt=""></a>
        
      </div>
      <div class="gallery-item">
      <a href="./assets/images/eng6.jpg"><img src="./assets/images/eng6.jpg" alt=""></a>
        
      </div>
      <div class="gallery-item">
      <a href="./assets/images/eng15.jpg"><img src="./assets/images/eng1.jpg" alt=""></a>
        
      </div>
    </div>
  </div>

  <script>
    // Add filter functionality
    const filterButtons = document.querySelectorAll('.filter-button');
    
    filterButtons.forEach(button => {
      button.addEventListener('click', () => {
        // Remove active class from all buttons
        filterButtons.forEach(btn => btn.classList.remove('active'));
        // Add active class to clicked button
        button.classList.add('active');
      });
    });
  </script>
</body>
</html>