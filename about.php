<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CODE-WITH-HIRAJAT | ABOUT-PAGE</title>
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
    rel="stylesheet"
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
   
  height:  100px;
   
   background-color: black;
   background-position: center ;
   background-size: cover;
   
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

.a-img-text
{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 600px;
    background-image: radial-gradient(rgba(255,255,255,0), rgba(0,0,0,.9)),
    url(assets/images/service.jpg);
    background-position: center center;
    background-size: cover;
    background-repeat: no-repeat;
    
}

.abox
{
    
    background-color: #ffffff;
    height: 150px;
    width: 300px;
   border-radius: 10px 10px 10px 10px;
} 
.ah2
{
  margin-top: 15px;
  font-style: italic;
    font-family: cursive;
    text-align: center;
}

.ah1{
  margin-top: 15px;
  font-style: var(--max-width);
  font-family: sans-serif;
  text-align: center;
}

.ap
{
  text-align: center;
  font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
  margin-top: 15px;
}

.about_container .section_description
{
    max-width: 900px;
    margin-inline: auto;
    margin-bottom: 2rem;
}

.about_container .section_descriptions
{
    max-width: 900px;
    margin-inline: auto;
    margin-bottom: 2rem;
}

.about_container img
{
    max-width: 170px;
    margin-inline: auto; 
}

.wbody
{
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background-color: rgb(217, 210, 200);
}

.wbodys
{
  margin-top: 5px;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background-color: rgb(217, 210, 200);
}

.about_container img{
  max-width: 320px;
  float: right;
  border: 3px solid #525252;
  border-radius: 10px;
  margin-left: 15px;

}

.about_container{
  margin:  auto;
  width: 70%;
}

.about_containers{
  margin:  auto;
  width: 70%;
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
    <header class="header" >
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
                
                <li><a href="service.php">Services</a></li>
               
                <li><a href="portfolio.php">Portfolio</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="bookk.php">Booking</a></li>
                <li><a href="../login system with avatar/home.php">Sign In</a></li>
               
            </ul>
        </nav>
        
        
    </header>
    
    <div class="a-img-text">
        <div class="a1">
     <div class="abox">
      <h2 class="ah2">About Me</h2>
      <h1 class="ah1">Uday Parmar</h1>
      <h3 class="ap">Wedding Photographer</h3>
    </div>
    </div>
    </div>


      <div class="wbody">
      <div class="section_container about_container" id="about">
        <img src="./assets/images/up.jpg" alt="logo" />
        <p class="section_description">
          I am Uday Parmar an exclusive Indian wedding photographer 
              specialized in wedding, Prewedding and Fashion Shoot.
               As a photographer, I usually work throughout Gujrat, Delhi, 
               Udaipur , Mumbai and also available for destination 
               wedding photography anywhere in the world. 
               Through my ten years of journey, 
               I learned that photography is an art of capturing
               emotions and love that are confined within us.
               With recognition over time and experience,
               we became a team of a well versed and qualified team
               of professional photographers, 
               and I named it Maya Studio.
        </p>
        <p class="section_description">
          Based in Gujrat, India Maya Studio is a team of creative 
          and versatile photographers specialized in covering exuberant
          events like weddings, pre weddings, fashion shoots, festivals,
          fashion shows, and other national and international events
          across India and beyond. We believe in creating memories 
          through the skills of photography that help us to relive 
          those memories as we age. With the experience of over six years,
          Maya Studio has successfully covered national fashion events, 
          big fat weddings, creative pre weddings, etc. We are a team of 
          creative photographers that has a cult to break the monotony 
          to capture pictures, we endeavour to capture these events
          candidly and supremely.
        </p>
      

      </div>
      
    </div>
    <div class="wbodys">
      <div class="section_container about_containers" id="about">
        <h1 class="section_header">
          What Maya Studio Is All About
        </h1>
        <p class="section_descriptions">
          Whenever we think of a wedding, we picture a blissful picture filled with 
          rituals, colors, traditions, emotions, music, dance and endless joy.
          Maya Studio has been turning these thoughts into soulful photos for more than three decades. 
          Known for its photography expertise and use of updated technology, Maya Studio is setting 
          new milestones in the world of photography and cinematography. Our quality, artistry, 
          and creativity are unmatched. Maya Studio is regarded as a top wedding photographer in Gujrat . 
          Their goal is to capture wedding moments and create beautiful memories that can be cherished for a lifetime.</p>
        <p  class="section_descriptions">The team consists of a group of passionate photographers, cinematographers, 
          and designers who put their heart and soul into every project they work on. 
          A Maya Studio wedding photographer specializes in pre-wedding, post-wedding, engagement, 
          family, birthday, and anniversary photography in Gujrat.</p>

        <p  class="section_descriptions">The Maya Studio is one of the best wedding photographers in Gujrat . 
          They have been doing this for 10 years, and their team of experts can capture every moment.</p>

        <p  class="section_descriptions">A top 10 wedding photographer in Gujrat , Maya Studio has been ranked by Wedding Sutra .
           Several TV shows, magazines, and newspapers have also featured them, including APN News, 
           Hindustan Times, and others. Additionally, the company has added videography services that 
           capture the precious moments of your wedding day in a cinematic and editing manner. 
           Maya Studio has also been featured on several online portals.
        </p>
        

      </div>
      
    </div>
    <hr />
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
            <li><a href="#home">HOME</a></li>
                  <li><a href="./about.php">ABOUT US</a></li>
                  <li><a href="./service.php">SERVICES</a></li>
                  <li><a href="./portfolio.php">PORTFOLIO</a></li>
                  <!-- <li><a href="#blog">BLOG</a></li> -->
                  <li><a href="./contact.php">CONTACT US</a></li>
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

ScrollReveal().reveal(".about_container img", {
    ...scrollRevealOption,  
  });

ScrollReveal().reveal(".about_container .section_description", {
    ...scrollRevealOption,
    delay: 550,
    interval: 750,
});

ScrollReveal().reveal(".about_containers .section_header", {
  ...scrollRevealOption,
});
ScrollReveal().reveal(".about_containers .section_descriptions", {
  ...scrollRevealOption,
  delay: 550,
  interval: 750,
});

    </script>
</body>
</html>