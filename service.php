<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CODE-WITH-HIRAJAT | SERVICE-PAGE</title>
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


.service
{
    background-image: linear-gradient(rgba(0,0,0,.9),rgba(0,0,0,.9)),
    url("assets/images/service.jpg");
    background-position: center center;
    background-size: cover;
    background-repeat: no-repeat;

}

.service_container .section_header
{
    color: var(--white);
}

.service_container .section_description
{
    max-width: 600px;
    margin-inline: auto;
    color: var(--text-light)
}

.service_grid
{
    margin-top: 4rem;
    display: grid;
    gap: 2rem;
}

.service_card
{
    text-align: center;
}

.service_card h4
{
    position: relative;
    isolation: isolate;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    font-size: 1.75rem;
    font-weight: 400;
    font-family: var(--header-font);
    color: var(--white);
}

.service_card h4::after
{
    position: absolute;
    content: "~";
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    font-size: 2rem;
    line-height: 0;
}

.service_card p{
    color: white;
    line-height: 1.75rem;
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
  
  .client_container
{
    padding-bottom: 2rem;
   
}

.swiper
{
    margin-top: 2rem;
    padding-bottom: 3rem;
    width: 100%;
}


.client_card
{
    max-width: 900px;
    margin-inline: auto;
    text-align: center;

}


.client_card img
{
    max-width: 250px;
    margin-inline: auto;
    margin-bottom: 2rem;
    border-radius: 10px;
    box-shadow: 5px 5px 20px rgba(0.2, 0.2, 0.2, 0.2);
}





.client_card h4
{
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--text-dark);
}


.swiper-pagin.swiper-pagination-bullet-active {
    background-color: var(--text-dark);
  }


  @keyframes scroll
{
    to
    {
        transform: translateX(calc(-50% - 0.5rem));
    }
}
  
  @media (width > 540px)
  {
    .service_grid{
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
    .service_grid
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
                </div>portfolio
                <div class="nav_menu_btn" id="menu-btn">
                    <i class="ri-menu-line"></i>
                </div>
            </div>
            <ul class="nav_links" id="nav-links">
            <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
               
                <li><a href="portfolio.php">Portfolio</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="bookk.php">Booking</a></li>
                <li><a href="../login system with avatar/home.php">Sign In</a></li>
            </ul>
        </nav>
        
        
    </header>

    <section class="service" id="service">
        <div class="section_container service_container">
            <h2 class="section_header">
                ~ SERVICES ~
            </h2>
            <p class="section_description">
                At Capturer, we offer a range of professional photography services
                tailored to meet your unique needs. With a commitment to excellence
                and creativity, we strive to exceed your expectations, delivering
                captivating visuals that tell your story with authenticity and
                passion.
            </p>
            <div class="service_grid">
                <div class="service_card">
                    <h4>
                        Portrait Sessions
                    </h4>
                    <p>
                        Our portrait sessions are designed to showcase your personality
          and style in stunning imagery.
                    </p>
                </div>

                <div class="service_card">
                    <h4>
                        Maternity Sessions
                    </h4>
                    <p>
                        Embrace the beauty and miracle of new life with our maternity and
          newborn photography sessions.
                    </p>
                </div>

                <div class="service_card">
                    <h4>
                        Family Sessions
                    </h4>
                    <p>
                        Cherish the bond of family with our custom-designed playful candid
          moments and portrait sessions.
                    </p>
                </div>
            </div>

            <div class="service_grid">
                <div class="service_card">
                    <h4>
                        Wedding
                    </h4>
                    <p>
                        Our portrait sessions are designed to showcase your personality
          and style in stunning imagery.
                    </p>
                </div>

                <div class="service_card">
                    <h4>
                        Engagement 
                    </h4>
                    <p>
                        Embrace the beauty and miracle of new life with our maternity and
          newborn photography sessions.
                    </p>
                </div>

                <div class="service_card">
                    <h4>
                        New Baby Born
                    </h4>
                    <p>
                        Cherish the bond of family with our custom-designed playful candid
          moments and portrait sessions.
                    </p>
                </div>
            </div>

            <div class="service_grid">
                <div class="service_card">
                    <h4>
                        Modeling
                    </h4>
                    <p>
                        Our portrait sessions are designed to showcase your personality
          and style in stunning imagery.
                    </p>
                </div>

                <div class="service_card">
                    <h4>
                        Wild Life
                    </h4>
                    <p>
                        Embrace the beauty and miracle of new life with our maternity and
          newborn photography sessions.
                    </p>
                </div>

                <div class="service_card">
                    <h4>
                        Product Photography
                    </h4>
                    <p>
                        Cherish the bond of family with our custom-designed playful candid
          moments and portrait sessions.
                    </p>
                </div>
            </div>

        </div>
    </section>
   
    <section class="section_container client_container" >
        <h2 class="section_header">~ Tools Use For Photography ~</h2>
        <h2 class="section_header">~ Cameras ~</h2>

        <!-- Slider main container -->
        <div class="swiper">
          <!-- Additional required wrapper -->
          <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide">
              <div class="client_card">
                <img src="./assets/images/canon-eos-r3.jpg" alt="client" />
                
                <h4>Canon Eos R3</h4>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="client_card">
                <img src="./assets/images/eos-r5-mark2.jpg" alt="client" />
               
                <h4>Canon EoS R5 Mark||</h4>
              </div>
            </div>

            <div class="swiper-slide">
                <div class="client_card">
                  <img src="./assets/images/eos-r5.jpg " alt="client" />
                 
                  <h4>Canon EoS R5 </h4>
                </div>
              </div>

              <div class="swiper-slide">
                <div class="client_card">
                  <img src="./assets/images/eos-r6.webp" alt="client" />
                 
                  <h4>Canon EoS R6</h4>
                </div>
              </div>

              <div class="swiper-slide">
                <div class="client_card">
                  <img src="./assets/images/eos-r6-mark2.jpg" alt="client" />
                 
                  <h4>Canon EoS R6 Mark||</h4>
                </div>
              </div>

              <div class="swiper-slide">
                <div class="client_card">
                  <img src="./assets/images/eos-5d-mark4.jpg" alt="client" />
                 
                  <h4>Canon EoS 5D Mark4</h4>
                </div>
              </div>

              <div class="swiper-slide">
                <div class="client_card">
                  <img src="./assets/images/eos-6d-mark2.jpg" alt="client" />
                 
                  <h4>Canon EoS 6D Mark2</h4>
                </div>
              </div>

              <div class="swiper-slide">
                <div class="client_card">
                  <img src="./assets/images/sony-a7-mark3.jpg" alt="client" />
                 
                  <h4>Sony A7 Mark3</h4>
                </div>
              </div>

              <div class="swiper-slide">
                <div class="client_card">
                  <img src="./assets/images/insta-360-1x4.jpg" alt="client" />
                 
                  <h4>Insta 360 1X4</h4>
                </div>
              </div>

            <div class="swiper-slide">
              <div class="client_card">
                <img src="./assets/images/hero9-black.jpg" alt="client" />
                
                <h4>Gopro Hero 9 Black</h4>
              </div>
            </div>
          </div>
          <!-- If we need pagination -->
          <div class="swiper-pagination"></div>
        </div>

        <div class="swiper">
            <!-- Additional required wrapper -->
            <h2 class="section_header">~ Drone ~</h2>
            <div class="swiper-wrapper">
              <!-- Slides -->
              <div class="swiper-slide">
                <div class="client_card">
                  <img src="./assets/images/dron1.jpg" alt="client" />
                  
                  <h4>DJI Avata FPV</h4>
                </div>
              </div>

              <div class="swiper-slide">
                <div class="client_card">
                  <img src="./assets/images/dron2.jpg" alt="client" />
                 
                  <h4>DJI phantom 4Pro</h4>
                </div>
              </div>
              <div class="swiper-pagination"></div>
            </div>
            </div>
      </section>

      


    <hr />
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


ScrollReveal().reveal(".service_container .section_header", {
    ...scrollRevealOption,
  });
  ScrollReveal().reveal(".service_container .section_description", {
    ...scrollRevealOption,
    delay: 500,
  });
  ScrollReveal().reveal(".service_card", {
    duration: 1000,
    delay: 1000,
    interval: 500,
  });

  const swiper = new Swiper(".swiper", {
    loop: true,
    pagination: {
      el: ".swiper-pagination",
    },
  });
   </script>
</body>
</html>