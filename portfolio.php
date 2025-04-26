<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CODE-WITH-HIRAJAT | CONTACT-PAGE</title>
    
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
    rel="stylesheet"
    />
    <link
    rel="stylesheet"
     href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    
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

.ph1{
    align-items: center;
    text-align: center;
    padding: 10px 10px 20px 50px;
    font-family: "Merriweather", serif;
}

.wh1{
    align-items: center;
    text-align: center;
    padding: 10px 10px 20px 50px;
    font-family: "Merriweather", serif;
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
.pheader
{
    min-height: 700px;
    background-image: radial-gradient(rgba(255,255,255,0), rgba(0,0,0,.9)),
    url(assets/images/portraits/1.jpg);
    background-position: center center;
    background-size: cover;
    background-attachment: fixed;
}

.wheader
{
    min-height: 700px;
    background-image: radial-gradient(rgba(255,255,255,0), rgba(0,0,0,.9)),
    url(assets/images/wedding/4.jpg);
    background-position: center center;
    background-size: cover;
    background-attachment: fixed;
}

.wimg{
    max-width: 100%;
    height: 100%;
    vertical-align: middle;
    display: inline-block;
}
.grid-wrapper > div{
    display: flex;
    justify-content: center;
    align-items: center;
}


.grid-wrapper > div > img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 5px;
}

.grid-wrapper{
    display: grid;
    grid-gap: 10px;
   grid-template-columns:  500px 500px auto;
   grid-template-rows: 400px auto;
   
    
}

.grid-wrapper .wide{
    grid-column: span 2;
}

.grid-wrapper .tall{
    grid-row: span 2;
}
.grid-wrapper .big{
    grid-column: span 2;
    grid-row: span 2;
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

  
  .portfolio_grid
{
    margin-top: 2rem;
    display: grid;
    gap: 1rem;
}

.portfolio_card
{
    position: relative;
    isolation: isolate;
}

.portfolio_card::after
{
    position: absolute;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%);
    font-size: 2rem;
    font-family: var(--header-font);
    color: var(--white);
}

.portfolio_card:nth-child(1)::after
{
    content: "portraits";
}

.portfolio_card:nth-child(2)::after
{
    content: "Maternitys";
}

.portfolio_card:nth-child(3)::after
{
    content: "Wedding";
}

.portfolio_card:nth-child(4)::after
{
    content: "Engagement";
}

.portfolio_card:nth-child(5)::after
{
    content: "Pre-Wedding";
}

.portfolio_card:nth-child(6)::after
{
    content: "Modeling";
}

.portfolio_card:nth-child(7)::after
{
    content: "Child";
}

.portfolio_card:nth-child(8)::after
{
    content: "Product";
}

.portfolio_card:nth-child(9)::after
{
    content: "Family";
}

.portfolio_content
{
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(0, 0, 0, 0.5);
    opacity: 0;
    transition: 0.3s;
    z-index: 1;
}

.portfolio_card:hover .portfolio_content
{
    opacity: 1;
}



  
@media (width > 540px)
{
    .wheader
    {
        height: 100%;
        width: 100%;
    }

    .grid-wrapper
   {
    grid-template-columns: 500px 500px auto;
    grid-template-rows: 400px auto;

   }
   .portfolio_grid
   {
    grid-template-columns: repeat(2, 1fr);

   }

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
    .pheader
    {
        height: 100px;
    }

    .wheader
    {
        height: 100%;
        width: 100%;
    }

    .grid-wrapper
   {
    grid-template-columns: 500px 500px auto;
    grid-template-rows: 400px auto;

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

    .portfolio_grid
    {
        grid-template-columns: repeat(3, 1fr);
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
        width: 100%;
    }
    .pheader
    {
       height: 100px;

    }
    .wheader
    {
       height: 100%;

    }
    .grid-wrapper
   {
    grid-template-columns: 500px 500px auto;
    grid-template-rows: 400px auto;

   }

    .portfolio_grid
    {
        gap: 2rem;
    }
}
@media (max-width: 540px) {
            .portfolio_grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

</style>
<body>

    <header class="header" id="service" >
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
               
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="bookk.php">Booking</a></li>
                <li><a href="../login system with avatar/home.php">Sign In</a></li>
                
            </ul>
        </nav>
    </header>

    <div class="section_container portfolio_container">
        <h2 class="section_header">
           ~ PORTFOLIO ~
        </h2>
        <div class="portfolio_grid">
            <div class="portfolio_card">
                <img src="./assets/images/portraitsplogo.jpg" alt="portfolio1">
                <div class="portfolio_content">
                    <a href="./portraits.php">
                        <button class="btn">
                            VIEW MORE
                        </button></a>
                </div>
            </div>

                <div class="portfolio_card">
                    <img src="./assets/images/mat12.jpg" alt="portfolio2">
                    <div class="portfolio_content">
                        <a href="./maternity.php">
                            <button class="btn">
                                VIEW MORE
                            </button></a>
                    </div>
                </div>

                    <div class="portfolio_card">
                        <img src="./assets/images/wed6.jpg" alt="portfolio3">
                        <div class="portfolio_content">
                            <a href="./wedding.php">
                                <button class="btn">
                                    VIEW MORE
                                </button></a>
                        </div>
                    </div>       
          

        
                <div class="portfolio_card">
                    <img src="./assets/images/eng5.jpg" alt="portfolio1">
                    <div class="portfolio_content">
                        <a href="./engagment.php">
                            <button class="btn">
                                VIEW MORE
                            </button></a>
                    </div>
                </div>
    
                    <div class="portfolio_card">
                        <img src="./assets/images/eng15.jpg" alt="portfolio2">
                        <div class="portfolio_content">
                            <a href="./prewedding.php">
                                <button class="btn">
                                    VIEW MORE
                                </button></a>
                        </div>
                    </div>
    
                        <div class="portfolio_card">
                            <img src="./assets/images/mo11.jpg" alt="portfolio3">
                            <div class="portfolio_content">
                                <a href="./modeling.php">
                                    <button class="btn">
                                        VIEW MORE
                                    </button></a>
                            </div>
                        </div>   

            
                    <div class="portfolio_card">
                        <img src="./assets/images/hiru.jpg" alt="portfolio1">
                        <div class="portfolio_content">
                            <a href="./child.php">
                                <button class="btn">
                                    VIEW MORE
                                </button></a>
                        </div>
                    </div>
        
                        <div class="portfolio_card">
                            <img src="./assets/images/6.jpg" alt="portfolio2">
                            <div class="portfolio_content">
                                <a href="./product.php">
                                    <button class="btn">
                                        VIEW MORE
                                    </button></a>
                            </div>
                        </div>
        
                            <div class="portfolio_card">
                                <img src="./assets/images/falogo.jpg" alt="portfolio3">
                                <div class="portfolio_content">
                                    <a href="./family.php">
                                        <button class="btn">
                                            VIEW MORE
                                        </button></a>
                                </div>
                            </div>       
                    </div>
                </div>

    <footer id="contact">
        <div class="section_container footer_container">
          <div class="footer_col">
          <a href="./index.php"> <img src="./assets/images/logo.jpg" alt="logo" /></a>
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
                <li> <a href="../login system with avatar/home.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30" height="30" fill="currentColor"><path d="M12 2C17.52 2 22 6.48 22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2ZM6.02332 15.4163C7.49083 17.6069 9.69511 19 12.1597 19C14.6243 19 16.8286 17.6069 18.2961 15.4163C16.6885 13.9172 14.5312 13 12.1597 13C9.78821 13 7.63095 13.9172 6.02332 15.4163ZM12 11C13.6569 11 15 9.65685 15 8C15 6.34315 13.6569 5 12 5C10.3431 5 9 6.34315 9 8C9 9.65685 10.3431 11 12 11Z"></path></svg></a></li>
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