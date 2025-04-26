<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <!--font awesome cdn link-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
    font-family: 'Poppins', sans-serif;
    margin: 0; padding: 0;
    box-sizing: border-box;
    outline: none; border: none;
    text-decoration: none;
    transition: .2s linear;
   /* text-transform: capitalize;*/

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
</head>
<body>
    <!--pricing plan section starts-->
    
    <!-- <section class="plann" id="plann">

        <h1 class="headings">Membership plan</h1>

        <div class="boxx-container">

            <div class="boxx" data-aos="zoom-in-up" data-aos-delay="150">
            <h3 class="titlee">Basic</h3>
            <h3 class="pricee">999<span>$</span></h3>
            <h3 class="months">Per Event</h3>
            <ul>
                <li><i class="fas fa-check"></i>Photography</li>
                <li><i class="fas fa-check"></i>Consultation</li>
                <li><i class="fas fa-check"></i>Full Assistance</li>
                <li><i class="fas fa-times"></i>Vendor referrals</li>
                <li><i class="fas fa-times"></i>Find Place</li>

            </ul>
            <a href="#"><button class="btnn">Buy now</button></a>
            </div>

            <div class="boxx" data-aos="zoom-in-up" data-aos-delay="300">
                <h3 class="titlee">Standard</h3>
                <h3 class="pricee">1799<span>$</span></h3>
                <h3 class="months">Per Event</h3>
                <ul>
                    <li><i class="fas fa-check"></i>Photography</li>
                    <li><i class="fas fa-check"></i>Consultation</li>
                    <li><i class="fas fa-check"></i>Full Assistance</li>
                    <li><i class="fas fa-check"></i>Vendor referrals</li>
                    <li><i class="fas fa-times"></i>Find Place</li>

                </ul>
                <a href="#"><button class="btnn">Buy now</button></a>
                </div>

                <div class="boxx" data-aos="zoom-in-up" data-aos-delay="450">
                    <h3 class="titlee">Premium</h3>
                    <h3 class="pricee">2999<spna>$</spna></h3>
                    <h3 class="months">Per Event</h3>
                    <ul>
                        <li><i class="fas fa-check"></i>Photography</li>
                        <li><i class="fas fa-check"></i>Consultation</li>
                        <li><i class="fas fa-check"></i>Full Assistance</li>
                        <li><i class="fas fa-check"></i>Vendor referrals</li>
                        <li><i class="fas fa-check"></i>Find Place</li>
    
                    </ul>
                    <a href="#"><button class="btnn">Buy now</button></a>
                    </div>
        </div>

       

    </section> -->

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
<script>
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

</script>
</body>
</html>