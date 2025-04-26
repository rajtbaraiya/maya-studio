<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CODE WITH HIRAJAT | MAYA STUDIO</title>
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
    rel="stylesheet"
    />
    <link
    rel="stylesheet"
     href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

.btn
{
    padding: 0.75rem 1.5rem;
    outline: none;
    border: none;
    font-size: 1rem;
    font-weight: 500;
    color: var(--white);
    background-color: var(--text-dark);
    border-radius: 5px;
    transition: 0.3s;
    cursor: pointer;
}

.btn:hover
{
    background-color: var(--text-light);
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
    min-height: 600px;
    background-image: radial-gradient(rgba(255,255,255,0), rgba(0,0,0,.9)),
    url(assets/images/mainlogo.jpg);
    background-position: center center;
    background-size: cover;
    background-attachment: fixed;
}

nav
{
    position: fixed;
    isolation: isolate;
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
    border-bottom: 1px solid transparent;
}


.nav_links a:hover
{
    border-color: var(--white);
}


.about_container .section_description
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
    content: "PORTRAITS";
}

.portfolio_card:nth-child(2)::after
{
    content: "WEDDINGS";
}

.portfolio_card:nth-child(3)::after
{
    content: "MATERNITY";
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
    max-width: 120px;
    margin-inline: auto;
    margin-bottom: 2rem;
    border-radius: 100%;
    box-shadow: 5px 5px 20px rgba(0.2, 0.2, 0.2, 0.2);
}


.client_card p
{
    margin-bottom: 1rem;
    color: var(--text-light);
    line-height: 1.75rem;

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


  .gallery_grid {
    margin-block: 2rem;
    display: grid;
    gap: 1rem;
    grid-template-columns: repeat(2, 1fr);
  }
  
  .gallery_grid img {
    transition: 0.3s;
  }
  
  .gallery_grid:hover img:not(:hover) {
    opacity: 0.5;
  }
  
  .gallery_btn {
    text-align: center;
  }
  

.blog
{
    background-image: linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,.6)),
    url("assets/images/bbblog.jpg");
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
}

.blog_container
{
    padding-block: 8rem;
    display: grid;
}

.blog_content
{
    text-align: center;
}


.blog_content .section_header
{
    margin-bottom: 2rem;
    color: var(--white);
}

.blog_content h4
{
    margin-bottom: 1rem;
    font-size: 1.25rem;
    font-weight: 400;
    font-family: var(--header-font);
    color: var(--white);
}

.blog_content p
{
    margin-bottom: 2rem;
    line-height: 1.75rem;
    color: var(--white);
}

.blog_content .btn
{
    background-color: transparent;
    border: 1px solid var(--white);
}


.instagram_container
{
    overflow: hidden ;
}

.instagram_flex
{
    margin-top: 2rem;
    width: max-content;
    display: flex;
    align-items: center;
    gap: 1rem;


    animation: scroll 45s linear infinite;
}

.instagram_flex img
{
    max-width: 135px;
}


.youtube_container
{
  display: grid;
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

@keyframes scroll
{
    to
    {
        transform: translateX(calc(-50% - 0.5rem));
    }
}


@media (width > 540px)
{
   .portfolio_grid
   {
    grid-template-columns: repeat(2, 1fr);

   }

   .service_grid{
    grid-template-columns: repeat(2, 1fr);
   }

   .gallery_grid
   {
    grid-template-columns: repeat(3, 1fr);
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
        min-height: 650px;
    }

   

    nav
    {
        padding: 2rem 1rem;
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

    .service_grid
    {
        grid-template-columns: repeat(3, 1fr);
    }

    .gallery_grid
    {
     grid-template-columns: repeat(4, 1fr);
    }

    .blog_container
    {
        grid-template-columns: repeat(2, 1fr);
    }

    .blog_content
    {
    grid-column: 2/3;
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
        min-height: 700px;

    }

    .portfolio_grid
    {
        gap: 2rem;
    }

   
    
}

</style>
<body>
    <header class="header" id="#home">
        <nav>
            <div class="nav_header">
                <div class="nav_logo">
                    <a href="index.php">
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
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="bookk.php">Booking</a></li>
                <li><a href="../login system with avatar/login.php">Sign In</a></li>
                <li> <a href="../login system with avatar/home.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30" height="30" fill="currentColor"><path d="M12 2C17.52 2 22 6.48 22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2ZM6.02332 15.4163C7.49083 17.6069 9.69511 19 12.1597 19C14.6243 19 16.8286 17.6069 18.2961 15.4163C16.6885 13.9172 14.5312 13 12.1597 13C9.78821 13 7.63095 13.9172 6.02332 15.4163ZM12 11C13.6569 11 15 9.65685 15 8C15 6.34315 13.6569 5 12 5C10.3431 5 9 6.34315 9 8C9 9.65685 10.3431 11 12 11Z"></path></svg></a></li>
            </ul>
            <div class="profile">
             
            </div>
        </nav>
       
    </header>

    
    <div class="section_container about_container" id="about">
        <h2 class="section_header">WE CAPTURE THE MOMENTS</h2>
        <p class="section_description">
          At Capturer, we specialize in freezing those fleeting moments in time
          that hold immense significance for you. With our passion for photography
          and keen eye for detail, we transform ordinary moments into
          extraordinary memories.
        </p>
        <p class="section_description">
          Whether it's a milestone event, a candid portrait, or the breathtaking
          beauty of nature, we strive to encapsulate the essence of every moment,
          ensuring that your cherished memories last a lifetime. Trust us to
          capture the magic of your life's journey, one frame at a time.
        </p>
        <img src="./assets/images/blacklogomaya.png" alt="logo" />
      </div>

      


        <div class="section_container portfolio_container">
          <h2 class="section_header">
             ~ COLLECTION ~
          </h2>
          <div class="portfolio_grid">
              <div class="portfolio_card">
                  <img src="./assets/images/portraitsplogo.jpg" alt="portfolio1">
                  <div class="portfolio_content">
                    <a href="./portraits.php">
                      <button class="btn">
                          VIEW PORTFOLIO
                      </button></a>
                  </div>
              </div>
  
                  <div class="portfolio_card">
                      <img src="./assets/images/wed6.jpg" alt="portfolio2">
                      <div class="portfolio_content">
                        <a href="./wedding.php">
                          <button class="btn">
                              VIEW PORTFOLIO
                          </button></a>
                      </div>
                  </div>
  
                      <div class="portfolio_card">
                          <img src="./assets/images/mat12.jpg" alt="portfolio3">
                          <div class="portfolio_content">
                            <a href="./maternity.php">
                              <button class="btn">
                                  VIEW PORTFOLIO
                              </button></a>
                          </div>
                      </div>       
              </div>
          </div>
     
        

        <section class="section_container client_container" id="client">
            <h2 class="section_header">~ TESTIMONIALS ~</h2>
            <!-- Slider main container -->
            <div class="swiper">
              <!-- Additional required wrapper -->
              <div class="swiper-wrapper">
                <!-- Slides -->
                <div class="swiper-slide">
                  <div class="client_card">
                    <img src="./assets/images/wed3.jpg" alt="client" />
                    <p>
                      Capturer exceeded all our expectations! Their attention to
                      detail and ability to capture the essence of our special day was
                      truly remarkable. Every time we look at our wedding photos,
                      we're transported back to those magical moments. Thank you for
                      preserving our memories so beautifully!
                    </p>
                    <h4>Akruti And Mohit</h4>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="client_card">
                    <img src="./assets/images/wed7.jpg" alt="client" />
                    <p>
                      We couldn't be happier with our family portrait session with
                      Capturer. They made us feel relaxed and comfortable throughout
                      the entire shoot, resulting in natural and candid photos that
                      perfectly reflect our family dynamic. These images will be
                      cherished for years to come!
                    </p>
                    <h4> Riddhi And Milan </h4>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="client_card">
                    <img src="./assets/images/wed16.jpg" alt="client" />
                    <p>
                      Capturer's maternity and newborn sessions captured the most
                      precious moments of our lives with such tenderness and care.
                      From the anticipation of pregnancy to the joy of welcoming our
                      little one, every photo tells a story that we'll cherish
                      forever. Thank you for creating beautiful memories for our
                      family!
                    </p>
                    <h4> MAITRI AND VATSAL</h4>
                  </div>
                </div>
              </div>
              <!-- If we need pagination -->
              <div class="swiper-pagination"></div>
            </div>
          </section>
          <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600&display=swap");

:root{
    --main-color:#f45866;
   
    --primary-color:#404068;
    --white:#fff;
    --bg:#f7f0ed;
    --light-black:#333;
    --box-shadow: 0 .5rem 1rem rgba(0,0,0,1);
}

*{
    font-size:1.5rem;
}
html{
    font-size: 62.5%;
    overflow-x: hidden;
    scroll-behavior: smooth;
    scroll-padding-top: 6rem;
}

html::-webkit-scrollbar{
    width: .8rem;

}

html::-webkit-scrollbar-track{
    background: var(--white);
}

html::-webkit-scrollbar-thumb{
    background: var(--primary-color);
    border-radius: 5rem;
}
.headings{
    text-align: center;
    color: var(--primary-color);
    text-transform: uppercase;
    margin-bottom: 4rem;
    font-size: 4rem;
    margin-top: 2rem;
}
.btnn{
    display: inline-block;
    margin-top: 1rem;
    padding: .8rem 2.8rem;
    border-radius: 5rem;
    border-top-left-radius: 0;
    border: .2rem solid var(--main-color);
    cursor: pointer;
    color: var(--main-color);
    
    font-size: 1.7rem;
    overflow: hidden;
    z-index: 0;
    position: relative;
}

.btnn::before{
    content: '';
    position: absolute;
    top: 0; left: 0;
    height: 100%;
    width: 100%;
    background: var(--main-color);
    z-index: -1;
    transition: .2s linear;
    clip-path: circle(0% at 0% 5%);
}

.btnn:hover::before{
    clip-path: circle(100%);
}

.btnn:hover{
    color: var(--white);
}

#menu{
    display: none;
}
/* pricing plan */

.plann .boxx-container{
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    justify-content: center;
    gap: 6rem;
}

.plann .boxx-container .boxx{
    background: var(--white);
    width: 30rem;
    height: 38rem;
    text-align: center;
    box-shadow: var(--box-shadow);
    position: relative;
}

.plann .boxx-container .boxx:hover{
    transform: scale(1.05);
}

.plann .boxx-container .boxx .titlee{
    font-size: 2.5rem;
    background: var(--main-color);
    color: var(--white);
    padding: 1rem 0;
    clip-path: polygon(0 0, 100% 0, 100% 70%, 50% 100%, 0 70%);

}

.plann .boxx-container .boxx .pricee{
    font-size: 4rem;
    color: var(--light-black);
    padding-top: 1rem;
}

.plann .boxx-container .boxx .pricee span{
    font-size: 2.5rem;
}

.plann .boxx-container .boxx .month{
    font-size: 1.4rem;
    color: var(--light-black);
}

.plann .boxx-container .boxx ul{
    margin: 2rem 6rem;
    list-style: none;
}

.plann .boxx-container .boxx ul li{
    text-align: left;
    padding: .5rem;
    font-size: 1.5rem;
    color: var(--light-black);

}

.plann .boxx-container .boxx ul li i{
    color: var(--white);
    padding: .5rem;
    margin-right: 1rem;
    background: var(--main-color);
    border-radius: 50%;
}

.plann .boxx-container .boxx ul li i.fa-times{
    padding: .5rem .7rem;
}

.plann .boxx-container .boxx .btn{
    position: absolute;
    bottom: -2rem;
    right: 2rem;
    background: var(--white);
}

/* end */
    </style>
    <!--pricing plan section starts-->
    
    <section class="plann" id="plann">

<h1 class="headings">Package plan</h1>

<div class="boxx-container">

    <div class="boxx" data-aos="zoom-in-up" data-aos-delay="150">
    <h3 class="titlee">Basic</h3>
    <h3 class="pricee">999<span>$</span></h3>
    <h3 class="months">Per Event</h3>
    <ul>
        <li><i class="fas fa-check"></i>30 Min Session</li>
        <li><i class="fas fa-check"></i>50 Edited Pics</li>
        <li><i class="fas fa-check"></i>Online Access</li>
        <li><i class="fas fa-times"></i>Videography</li>
        <li><i class="fas fa-times"></i>Drone shoot</li>

    </ul>
    <a href="#"><button class="btnn">Buy now</button></a>
    </div>

    <div class="boxx" data-aos="zoom-in-up" data-aos-delay="450">
            <h3 class="titlee">Premium</h3>
            <h3 class="pricee">2999<spna>$</spna></h3>
            <h3 class="months">Per Event</h3>
            <ul>
                <li><i class="fas fa-check"></i>2+ hour Session</li>
                <li><i class="fas fa-check"></i>25 Edited Pics</li>
                <li><i class="fas fa-check"></i>Online Access</li>
                <li><i class="fas fa-check"></i>Videography</li>
                <li><i class="fas fa-check"></i>Drone shoot</li>

            </ul>
            <a href="#"><button class="btnn">Buy now</button></a>
            </div>

    <div class="boxx" data-aos="zoom-in-up" data-aos-delay="300">
        <h3 class="titlee">Standard</h3>
        <h3 class="pricee">1799<span>$</span></h3>
        <h3 class="months">Per Event</h3>
        <ul>
            <li><i class="fas fa-check"></i>1 hour Session</li>
            <li><i class="fas fa-check"></i>10 Edited Pics</li>
            <li><i class="fas fa-check"></i>Online Access</li>
            <li><i class="fas fa-check"></i>Videography</li>
            <li><i class="fas fa-times"></i>Drone shoot</li>

        </ul>
        <a href="#"><button class="btnn">Buy now</button></a>
        </div>

       
</div>



</section>

<!--pricing plan section ends-->
<!-- <script>
    let navbar = document.querySelector('.header .navbar');
let menuBtn = document.querySelector('#menu');

menuBtn.onclick = () =>{
    menuBtn.classList.toggle('fa-times');
    navbar.classList.toggle('active');
}

window.onscroll = () =>{
    menuBtn.classList.remove('fa-times');
    navbar.classList.remove('active');
}

let themeBtn = document.querySelector('#theme-btn');

themeBtn.onclick = () =>{
    themeBtn.classList.toggle('fa-sun');

    if(themeBtn.classList.contains('fa-sun')){
        document.body.classList.add('active');
    }

    else{
        document.body.classList.remove('active');
    }
};
AOS.init({
    duration: 800,
    delay: 400,
})
</script> -->

          <section class="section_container gallery_container">
            <h2 class="section_header">
                ~ GALLERY ~
            </h2>
            <div class="gallery_grid">
               <a href="./assets/images/wed2.jpg"> <img src="./assets/images/wed2.jpg" alt="image"></a>
               <a href="./assets/images/wed3.jpg"> <img src="./assets/images/wed3.jpg" alt="image"></a>
               <a href="./assets/images/wed17.jpg"> <img src="./assets/images/wed17.jpg" alt="image"></a>
               <a href="./assets/images/wed5.jpg"> <img src="./assets/images/wed5.jpg" alt="image"></a>
               <a href="./assets/images/wed12.jpg"> <img src="./assets/images/wed12.jpg" alt="image"></a>
               <a href="./assets/images/eng5.jpg"> <img src="./assets/images/eng5.jpg" alt="image"></a>
               <a href="./assets/images/mat12.jpg"> <img src="./assets/images/mat12.jpg" alt="image"></a>
                <a href="./assets/images/eng11.jpg"><img src="./assets/images/eng11.jpg" alt="image"></a>
            </div>
            <div class="gallery_btn"><a href="./galleryimage.php">
                <button class="btn">VIEW GALLERY</button></a>
            </div>
          </section>

         <section class="blog" id="blog">
            <div class="section_container blog_container">
                <div class="blog_content">
                    <h2 class="section_header">
                        ~ LATEST BLOG ~
                    </h2>
                    <h4>Capturing Emotion in Every Frame</h4>
                    <p>This blog post delves into the importance of storytelling in
                        photography and how Capturer approaches capturing emotion and
                        narrative in their work. Readers will discover the techniques and
                        strategies used by professional photographers to evoke emotion,
                        convey meaning, and create compelling visual narratives that
                        resonate with viewers on a deep level.
                    </p>
                   
                </div>
            </div>
         </section> 
         <section class="section_container youtube_container">
         <h2 class="section_header">~ YOUTUBE ~</h2>

          <style>
          /* Responsive container */
          .video-container {
              position: relative;
              width: 100%;
              max-width: 800px; /* Set maximum width */
              margin: 0 auto;   /* Center align */
              aspect-ratio: 16 / 9; /* Maintain 16:9 ratio */
          }

          .video-container iframe {
              position: absolute;
              top: 10;
              left: 0;
              width: 100%;
              height: 100%;
              border: 10; /* Remove border */
          }
      </style>
      <div class="video-container">
          <iframe 
              width="560" 
              height="315" 
              src="https://www.youtube.com/embed/UvUgtvgp8sc?si=z9b823UqeFdn1qI3" 
              title="YouTube video player" 
              frameborder="5" 
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
              allowfullscreen>
          </iframe>
          </div>
          </section>

         <section class="section_container instagram_container">
            <h2 class="section_header">~ INSTAGRAM ~</h2>
            <div class="instagram_flex">
              <img src="./assets/images/portraits1.jpg" alt="">
              <img src="./assets/images/portraits2.jpg" alt="">
              <img src="./assets/images/portraits3.jpg" alt="">
              <img src="./assets/images/portraits4.jpg" alt="">
              <img src="./assets/images/mat1.jpg" alt="">
              <img src="./assets/images/mat2.jpg" alt="">
              <img src="./assets/images/mat3.jpg" alt="">
              <img src="./assets/images/mat4.jpg" alt="">
              <img src="./assets/images/portraits5.jpg" alt="">
              <img src="./assets/images/portraits6.jpg" alt="">
              <img src="./assets/images/portraits7.jpg" alt="">
              <img src="./assets/images/portraits8.jpg" alt="">
              <img src="./assets/images/mat5.jpg" alt="">
              <img src="./assets/images/mat6.jpg" alt="">
              <img src="./assets/images/mat7.jpg" alt="">
              <img src="./assets/images/mat8.jpg" alt="">
              <img src="./assets/images/wed1.jpg" alt="">
              <img src="./assets/images/wed2.jpg" alt="">
              <img src="./assets/images/wed3.jpg" alt="">
              <img src="./assets/images/wed5.jpg" alt="">
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
                  <li><a href="#home">HOME</a></li>
                  <li><a href="./about.php">ABOUT US</a></li>
                  <li><a href="./service.php">SERVICES</a></li>
                  <li><a href="./portfolio.php">PORTFOLIO</a></li>
                  <li><a href="#blog">BLOG</a></li>
                  <li><a href="./contact.php">CONTACT US</a></li>
                  <li><a href="bookk.php">Booking</a></li>
                <li><a href="sign.php">Sign In</a></li>
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
