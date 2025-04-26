<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CODE-WITH-HIRAJAT | CONTACT-PAGE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

    :root{
        --text-dark: #171717;
        --text-light: #525252;
        --extra-large: #a3a3a3;
        --white: #ffffff;
        --max-width: 1200px;
        --header-font: "Merriweather", serif;
    }

    *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    .section_container
    {
        max-width: var(--max-width);
        margin: auto;
        padding: 5rem 1rem ;
    }

    .section_header
    {
        margin-bottom: 1rem;
        font-size: 2rem;
        font-weight: 400;
        font-family: var(--header-font);
        color: var(--text-dark);
        text-align: center;
    }

    .section_description
    {
        color: var(--text-light);
        line-height: 1.75rem;
        text-align: center;
    }

    .section_descriptions
    {
        color: var(--text-light);
        line-height: 1.75rem;
        text-align: center;
    }

    img
    {
        display: flex;
        width: 100%;
    }

    a{
        text-decoration: none;
        transition: 0.3s;
    }

    html,
    body
    {
        scroll-behavior: smooth;
    }

    body
    {
        font-family: "Montserrat", serif;
    }

    .header
    {
        background-color: #171717;
        height: 100px;
        background-position: center center;
        background-size: cover;
        background-repeat: no-repeat;
    }

    nav
    {
        position: fixed;
        isolation: isolate;
        padding-bottom: 50px;
        top: 0;
        width: 100%;
        max-width: var(--max-width);
        margin: auto;
        z-index: 9;
    }

    .nav_header
    {
        padding: 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        background-color: var(--text-dark);
    }

    .nav_logo img
    {
        max-width: 70px;
    }

    .nav_menu_btn
    {
        font-size: 1.5rem;
        color: var(--white);
        cursor: pointer;
    }

    .nav_links
    {
        list-style: none;
        position: absolute;
        width: 100%;
        padding: 2rem;
        display: flex;
        align-items: center;
        flex-direction: column;
        gap: 2rem;
        background-color: var(--text-dark);
        transform: translateY(-100%); 
        transition: 0.5s;
        z-index: -1;
    }

    .nav_links.open
    {
        transform: translateY(0);
    }

    .nav_links .nav_logo
    {
        display: none;
    }

    .nav_links a
    {
        padding-bottom: 5px;
        font-weight: 500;
        color: var(--white);
        border-bottom: 2px solid transparent;
    }

    .nav_links a:hover
    {
        border-color: var(--white);
    }

    .footer_container {
        display: grid;
        gap: 4rem 0;
        align-items: center;
    }
    
    .footer_col {
        padding-inline: 2rem;
    }
    
    .footer_container img {
        max-width: 170px;
        margin-inline: auto;
        margin-bottom: 2rem;
    }
    
    .footer_socials {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
    }
    
    .footer_socials a {
        font-size: 1.5rem;
        color: var(--text-dark);
    }
    
    .footer_socials a:hover {
        color: var(--text-light);
    }
    
    .footer_links {
        list-style: none;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem;
    }
    
    .footer_links a {
        display: block;
        font-weight: 600;
        color: var(--text-dark);
        text-align: center;
    }
    
    .footer_links a:hover {
        color: var(--text-light);
    }
    
    .footer_col h4 {
        margin-bottom: 1rem;
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--text-dark);
        text-align: center;
    }
    
    .footer_col p {
        color: var(--text-light);
        line-height: 1.75rem;
        text-align: center;
    }
    
    .footer_bar
    {
        padding: 1rem;
        font-size: 0.9rem;
        color: var(--text-light);
        background-color: var(--text-dark);
        text-align: center;
    }

    .container{
        align-items: center;
        text-align: center;
        padding: 20px;
    }

    .contact h1{
        margin-bottom: 50px;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }

    .bh1{
        color:black;
        font-weight: 500;
    }

    .bh4{
        color:black;
        font-size: 1.3rem;
    }

    .contact .info{
        width: 100%;
        background: #ffffff;
    }
    
    .contact .info h4{
        padding: 0 0 0 60px;
        font-size: 1.6em;
        font-weight: 600;
        margin-bottom: 6px;
        color: #171717;
    }

    .contact .info p{
        padding: 0 0 0 60px;
        font-size: 0.9em;
        font-weight: 300;
        margin-bottom: 0;
        color: #171717;
    }

    .contact .info .email,
    .contact .info .phone{
        margin-top: 40px;
    }

    .contact form{
        width: 100%;
        background: #ffffff;
    }

    .contact form .form-group{
        padding-bottom: 8px;
    }

    .contact form input,
    .contact form textarea{
        border-radius: 0;
        box-shadow: none !important;
        outline: none;
        font-size: 15px;
    }

    .contact form input:focus,
    .contact form textarea:focus{
        border-color: var(--text-light);
        outline: none;
    }

    .contact form input{
        height: 45px;
    }

    .contact form textarea{
        padding: 10px 12px;
    }

    .contact form button[type='submit']{
        background-color: #e80a84;
        border: 1px solid #e80a84;
        padding: 10px 25px;
        color: #ffffff;
        transition: 0.3s;
        margin-top: 20px;
    }

    .contact form button[type='submit']:hover
    {
        background: #ffffff;
        color: #171717;
    }

    @media (width > 540px)
    {
        .footer_container {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .footer_col:nth-child(1) {
            grid-area: 1/1/2/3;
        }
        
        .footer_col:nth-child(3) {
            border-left: 2px solid var(--text-dark);
        }
    }

    @media (width > 768px)
    {
        .header
        {
            height: 100px;
        }

        nav
        {
            height: 100px;
            padding: 2rem 2rem;
            position: static;
            max-width: 900px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav_header
        {
            display: none;
        }

        .nav_links
        {
            padding: 0;
            width: 100%;
            position: static;
            transform: none;
            flex-direction: row;
            justify-content: space-between;
            background-color: transparent;
        }

        .nav_links .nav_logo
        {
            display: block;
        }

        .nav_links .nav_logo img
        {
            max-width: 150px;
        }
        
        .footer_container {
            grid-template-columns: repeat(3, 1fr);
        }
        
        .footer_col:nth-child(1) {
            grid-area: 1/2/2/3;
            border-left: 2px solid var(--text-dark);
            border-right: 2px solid var(--text-dark);
        }
        
        .footer_col:nth-child(3) {
            border: none;
        }
    }

    @media (width > 1024px)
    {
        .header
        {
            height: 100px;
        }
    }
</style>
<body>
    <?php
    // Database connection
    $conn = new mysqli("localhost", "root", "", "mayastudio");
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Form submission handling
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $conn->real_escape_string($_POST['name']);
        $email = $conn->real_escape_string($_POST['email']);
        $subject = $conn->real_escape_string($_POST['subject']);
        $message = $conn->real_escape_string($_POST['message']);
        
        $sql = "INSERT INTO contact (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
        
        if ($conn->query($sql) === TRUE) {
            // Generate a unique token to prevent resubmission
            $token = bin2hex(random_bytes(16));
            
            $_SESSION['form_token'] = $token;
            
            // Redirect to success page
            echo "<script>window.location.href = 'success.php?token=" . $token . "';</script>";
            exit();
        } else {
            echo "<div class='alert alert-danger text-center'>Error: " . $conn->error . "</div>";
        }
    }
    ?>

    <header class="header" id="service">
        <nav>
            <div class="nav_header">
                <div class="nav_logo">
                    <a href="./index.php">
                        <img src="./assets/images/logo.jpg" alt="logo" />
                    </a>
                </div>
                <div class="nav_menu_btn" id="menu-btn">
                    <i class="ri-menu-line"></i>
                </div>
            </div>
            <ul class="nav_links" id="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="service.php">Services</a></li>
                <li><a href="portfolio.php">Portfolio</a></li>
                <li><a href="bookk.php">Booking</a></li>
                <li><a href="../login system with avatar/home.php">Sign In</a></li>
            </ul>
        </nav>
    </header>

    <section id="contact" class="contact">
        <div class="container">
            <div class="row">
                <h1> ~ Contact Us ~ </h1>
            </div>

            <div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3523.264389799213!2d71.95714967505164!3d21.715645180111174!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395f5350c5143e55%3A0x934b0e3ff9c5bd10!2sMaya%20Studio!5e1!3m2!1sen!2sin!4v1734918318291!5m2!1sen!2sin" 
                    width="100%" height="320px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            
            <h1 class="bh1"> ~ Get Call Back ~ </h1>
            <h4 class="bh4">I’d love to hear from you! Please fill out the form below to request my availability and to receive information of my wedding collections</h4>
            
            <div class="row mt-5">
                <div class="col-lg-4">
                    <div class="info">
                        <div class="address">
                            <h4>Location: </h4>
                            <p>SMain Bazar, 
                                nr. shubh laxmi mall, 
                                Gayatri Nagar,
                                Sihor, 
                                Gujarat 364240</p>
                        </div>
                        <div class="email">
                            <h4>Email:</h4>
                            <p>mayastudio@gmail.com</p>
                        </div>
                        <div class="phone">
                            <h4>Phone</h4>
                            <p>+91 9426624284</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 mt-5 mt-lg-0">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" id="message" rows="5" 
                                placeholder="Enter your message here. I would love to hear as much details about your day as possible, and other vendors you might be working with!" required></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer id="contact">
        <div class="section_container footer_container">
            <div class="footer_col">
                <a href="./index.php"><img src="./assets/images/logo.jpg" alt="logo" /></a>
                <div class="footer_socials">
                    <a href="#"><i class="ri-facebook-fill"></i></a>
                    <a href="https://www.instagram.com/_maya_studio/profilecard/?igsh=YWxpbGtzc25sOWtk"><i class="ri-instagram-line"></i></a>
                    <a href="#"><i class="ri-twitter-fill"></i></a>
                    <a href="https://youtube.com/@mayastudiosihor?si=FL2PgF2Ur0C-N1OH"><i class="ri-youtube-fill"></i></a>
                    <a href="#"><i class="ri-pinterest-line"></i></a>
                </div>
            </div>
            <div class="footer_col">
                <ul class="footer_links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="service.php">Services</a></li>
                    <li><a href="portfolio.php">Portfolio</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="bookk.php">Booking</a></li>
                    <li><a href="../login system with avatar/login.php">Sign In</a></li>
                </ul>
            </div>
            <div class="footer_col">
                <h4>STAY IN TOUCH</h4>
                <p>
                    Keep up-to-date with all things Capturer! Join our community and
                    never miss a moment!
                </p>
            </div>
        </div>
        <div class="footer_bar">
            Copyright © HIRAJAT 2024. All rights reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const menuBtn = document.getElementById("menu-btn");
        const navLinks = document.getElementById("nav-links");
        const menuBtnIcon = menuBtn.querySelector("i");

        menuBtn.addEventListener("click", (e) => {
            navLinks.classList.toggle("open");
            const isOpen = navLinks.classList.contains("open");
            menuBtnIcon.setAttribute("class", isOpen ? "ri-close-line" : "ri-menu-line");
        });

        navLinks.addEventListener("click", (e) => {
            navLinks.classList.remove("open");
            menuBtnIcon.setAttribute("class", "ri-menu-line");
        });

        const scrollRevealOption = {
            distance: "50px",
            origin: "bottom",
            duration: 1000,
        };

        ScrollReveal().reveal(".about_container .section_header", {
            ...scrollRevealOption,
        });
        ScrollReveal().reveal(".about_container .section_description", {
            ...scrollRevealOption,
            delay: 500,
            interval: 500,
        });
        ScrollReveal().reveal(".about_container img", {
            ...scrollRevealOption,
            delay: 1500,
        });

        const swiper = new Swiper(".swiper", {
            loop: true,
            pagination: {
                el: ".swiper-pagination",
            },
        });

        ScrollReveal().reveal(".blog_content .section_header", {
            ...scrollRevealOption,
        });
        ScrollReveal().reveal(".blog_content h4", {
            ...scrollRevealOption,
            delay: 500,
        });
        ScrollReveal().reveal(".blog_content p", {
            ...scrollRevealOption,
            delay: 1000,
        });
        ScrollReveal().reveal(".blog_content .blog_btn", {
            ...scrollRevealOption,
            delay: 1500,
        });

        const instagram = document.querySelector(".instagram_flex");

        Array.from(instagram.children).forEach((item) => {
            const duplicateNode = item.cloneNode(true);
            duplicateNode.setAttribute("aria-hidden", true);
            instagram.appendChild(duplicateNode);
        });
    </script>
</body>
</html>
<?php $conn->close(); ?>