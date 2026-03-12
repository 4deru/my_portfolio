<style>
/* Navigation CSS */
nav {
    font-size: 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 60px;
    background: #f5f8fd;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    border-bottom: 5px inset #000206;
    z-index: 1;
    position: relative; 
    overflow: hidden; 
}


.star {
    position: absolute;
    width: 6px;
    height: 6px;
    background-color: #fff;
    border-radius: 2px; 
    box-shadow: 0 0 8px #ffffff;
    animation: twinkle 0.5s infinite ease-in-out;
    z-index: -1; 
}



.nav-center {
    font-size: 24px;
    font-weight: bold;
    font-family: 'AxiformaMed';
    color: #112244;
    text-align: center;
}

.nav-login {
    color: #1a2a4f;
}

.nav-login:hover {
    color: #112244;
}

.nav-buttons, .nav-right {
    display: flex;
    align-items: center;
    gap: 30px;
}

.nav-buttons a {
    text-decoration: none;
    color: #1a2a4f;
    position: relative;
}

.nav-buttons a:hover {
    color: #112244;
}


 a {
            text-decoration: none;
            color: #112244;
            position: relative;
        }

        a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -4px;
            width: 100%;
            height: 2px;
            background: #1a2a4f;
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
            background: #1a2a4f;
            transform: scaleX(0);
            transform-origin: middle;
            transition: transform 0.3s ease;
        }


    .contact-btn {
    color: #1a2a4f;
    padding: 5px 20px;
    border-radius: 8px;
    border: 5px solid #1a2a4f;
    border-bottom: none;
    }

    .contact-btn:hover {
        color: #112244;
        border: 5px solid #112244;
        border-bottom: none;
    }
</style>

<nav>
    <div class="nav-buttons">
        <!-- Anchor links -->
        <a href="#professional-experience" class="nav-buttons" id="hover-portfolio">About</a>
        <a href="#projects-section" class="nav-buttons" id="hover-projects">Projects</a>
        <a href="#contact-section" class="nav-buttons" id="hover-contact">Contact</a>
    </div>
    <div class="nav-right">
        <a href="login.php" class="contact-btn" id="hover-login"> CMS Login </a>
    </div>

    
</nav>
