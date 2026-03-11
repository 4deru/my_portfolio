<style>
/* Navigation CSS */
nav {
    font-size: 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 60px;
    background: #D4D4ED;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    z-index: 1;
    position: relative; 
    overflow: hidden; 
}

/* Starssss */
.star {
    position: absolute;
    width: 6px;
    height: 6px;
    background-color: #fff;
    border-radius: 2px; 
    box-shadow: 0 0 8px #e0218a;
    animation: twinkle 0.5s infinite ease-in-out;
    z-index: -1; 
}

/* Individual star positions */
.star:nth-child(1) {
    top: 10px;
    left: 20px;
    animation-delay: 0s;
}

.star:nth-child(2) {
    top: 30px;
    right: 40px;
    animation-delay: 0.5s;
}

.star:nth-child(3) {
    bottom: 15px;
    left: 50%;
    transform: translateX(-50%);
    animation-delay: 1s;
}

.star:nth-child(4) {
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
    animation-delay: 1.5s;
}

.star:nth-child(5) {
    top: 5%;
    left: 10%;
    animation-delay: 0.2s;
}

.star:nth-child(6) {
    bottom: 10%;
    right: 15%;
    animation-delay: 0.8s;
}

.star:nth-child(7) {
    top: 25%;
    left: 70%;
    animation-delay: 1.2s;
}

.star:nth-child(8) {
    bottom: 20%;
    right: 50%;
    animation-delay: 0.4s;
}

.star:nth-child(9) {
    top: 15%;
    left: 85%;
    animation-delay: 1.6s;
}

.star:nth-child(10) {
    bottom: 5%;
    right: 5%;
    animation-delay: 0.6s;
}

.star:nth-child(11) {
    top: 40%;
    left: 30%;
    animation-delay: 0.3s;
}

.star:nth-child(12) {
    bottom: 35%;
    right: 25%;
    animation-delay: 1.1s;
}

.star:nth-child(13) {
    top: 60%;
    left: 15%;
    animation-delay: 0.7s;
}

.star:nth-child(14) {
    bottom: 50%;
    right: 10%;
    animation-delay: 1.4s;
}

.star:nth-child(15) {
    top: 20%;
    left: 90%;
    animation-delay: 0.9s;
}

/* Twinkling animation */
@keyframes twinkle {
    0%, 100% {
        opacity: 0.8;
        transform: scale(1);
    }
    50% {
        opacity: 0.3;
        transform: scale(1.2);
    }
}

.nav-center {
    font-size: 24px;
    font-weight: bold;
    font-family: 'PixelifySans-VariableFont_wght';
    color: #55276C;
    text-align: center;
}

.nav-login {
    color: #AF5A97;
}

.nav-login:hover {
    color: #55276C;
}

.nav-buttons, .nav-right {
    display: flex;
    align-items: center;
    gap: 30px;
}

.nav-buttons a {
    text-decoration: none;
    color: #AF5A97; 
    position: relative;
}

.nav-buttons a:hover {
    color: #55276C;
}

 a {
      text-decoration: none;
      color: #333;
      position: relative;
    }

    a::after {
      content: '';
      position: absolute;
      left: 0;
      bottom: -4px;
      width: 100%;
      height: 2px;
      background: #55276C;
      transform: scaleX(0);
      transition: transform 0.3s ease;
    }
    
    a:hover::after {
      transform: scaleX(1);
    }

    .contact-btn::after {
      content: '';
      position: absolute;
      left: 1.99px;
      bottom: 0px;
      width: 98%;
      height: 3px;
      background: #55276C;
      transform: scaleX(0);
      transform-origin: middle;
      transition: transform 0.3s ease;
    }


    .contact-btn {
    color: #AF5A97;
    padding: 10px 20px;
    border-radius: 8px;
    border: 5px solid #AF5A97;
    border-bottom: none;
    }

    .contact-btn:hover {
        color: #55276C;
        border: 5px solid #55276C;
        border-bottom: none;
    }
</style>

<nav>
    <div class="nav-buttons">
        <!-- Anchor lnks -->
        <a href="#professional-experience" class="nav-buttons" id="hover-portfolio">About Me</a>
        <a href="#projects-section" class="nav-buttons" id="hover-projects">Projects</a>
    </div>
    <a href="login.php" class="nav-login" id="hover-login"> --> START <--</a>
    <div class="nav-right">
        <a href="#contact-section" class="contact-btn" id="hover-contact">Contact</a>
    </div>

    <!-- Starzs -->
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
    <div class="star"></div>
</nav>
