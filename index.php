<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'my_portfolio');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch hero section content
$result = $conn->query("SELECT * FROM hero_section WHERE id = 1");
$hero = $result->fetch_assoc();

// Fetch resume section content
$resume_result = $conn->query("SELECT * FROM resume_section");

// Fetch projects section content
$projects_result = $conn->query("SELECT * FROM projects_section");

// Fetch contact info content
$contact_info_result = $conn->query("SELECT * FROM contact_info");

// Fetch contact links content
$contact_links_result = $conn->query("SELECT * FROM contact_links");

include 'nav.php';
include 'hero_section.php';
include 'resume_section.php';
include 'projects_section.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
</head>
<style>
 @font-face {
  font-family: '3Dventure';
  src: url('assets/3Dventure.ttf') format('truetype');
}
  
    @font-face {
    font-family: 'PixelifySans-VariableFont_wght';
    src: url('assets/PixelifySans-VariableFont_wght.ttf') format('truetype');
  }

body {
    margin: 0;
    font-family: '3Dventure', sans-serif;
    background: #C8BDDB;
    color: #333;
    overflow-x: hidden; 
    overflow-y: auto;
    position: relative;
    scrollbar-color: #AF5A97 #E5E5F4; 
}

    .hero {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 40px;
      padding: 60px;
      position: relative;
    }

    .hero-content {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 20px;
    }

    .hero img {
      width: 400px;
      border-radius: 12px;
      max-width: 300px;
      height: auto;
    }

    .hero-text {
      height: 350px;
      width: 100%;
      max-width: 100%; 
      min-height: 100%; 
      text-align: left;
      background-color: #E5E5F4;
      border-top: 4px solid #C087BD;
      border-bottom: 4px solid #C087BD;
      border-radius: 12px;
      padding: 20px;
    
    }

    .hero-text h1 {
      font-size: 36px;
      margin-bottom: 20x;
      color: #55276C;
      border-radius:4px;
      border-bottom:3px solid #AF5A97
      
    }

    .hero-text p {
      padding: 15px;
      font-size: 18px;
      max-height: 200px;
      max-width: 400px;
      background-color: #E5E5F4;
      border-left:3px solid #AF5A97;
      border-right:3px solid #AF5A97;
      text-align: center;
      margin: auto;
      letter-spacing: 2px;
      word-spacing: 5px;
      max-width: none;
      font-size: 1.5rem;
      white-space: normal;
      overflow-y: auto;
      font-family: 'PixelifySans-VariableFont_wght';
      
    }

    .resume-container {
        display: flex;
        overflow: hidden; 
        gap: 30px;
        margin-top: 40px;
        padding: 0 40px;
        position: relative;
        width: calc(100% - 50px); 
        box-sizing: border-box; 
    }

    .resume-box {
        flex: 0 0 calc(31.5% - 35px);
        background: #E5E5F4;
        border-top: 4px solid #AF5A97;
        border-bottom: 4px solid #AF5A97;
        padding: 20px;
        border-radius: 15px;
        transition: transform 0.5s ease; 
        overflow: hidden; 
        text-overflow: ellipsis; 
        word-wrap: break-word; 
        overflow-wrap: break-word;
    }

    .resume-box p {
        font-family: 'PixelifySans-VariableFont_wght';
        max-height: 250px; 
        overflow-y: auto; 
        word-wrap: break-word; 
        overflow-wrap: break-word; 
    }

    .carousel-dots {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }

    .carousel-dot {
        width: 12px;
        height: 12px;
        background-color: #AF5A97;
        border-radius: 50%;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.3s;
    }

    .carousel-dot.active {
        background-color: #55276C;
        transform: scale(1.2); 
    }

    .carousel-dot:hover {
        background-color: #55276C;
        transform: scale(1.2); 
    }

    .carousel-dot:not(.active):hover {
        background-color: #AF5A97;
        transform: scale(1.2); 
    }


    html {
        scroll-behavior: smooth;
    }

    .projects-container {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        justify-content: center;
        margin-top: 40px;
    }

    .project-card {
        background: #E5E5F4;
        border: 4px solid #AF5A97;
        border-bottom: none;
        border-radius: 15px;
        overflow: hidden;
        width: 300px;
        position: relative;
        transition: transform 0.3s steps(4, end), box-shadow 0.3s steps(4, end);
        cursor: pointer;
    }

    .project-card img, .project-card video {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .project-card div {
        padding: 20px;
        max-height: 150px; 
        overflow-y: auto; 
    }

    .project-card h3 {
        color: #55276C;
        font-family: 'PixelifySans-VariableFont_wght';
        margin-bottom: 10px;
    }

    .project-card p {
        font-family: 'PixelifySans-VariableFont_wght';
        font-size: 1rem;
        color: #333;
        word-wrap: break-word; 
    }

    .project-card:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        animation: colorShift 0.5s infinite alternate;
    }

    @keyframes colorShift {
        0% {
            filter: hue-rotate(0deg);
        }
        50% {
            filter: hue-rotate(45deg);
        }
        100% {
            filter: hue-rotate(90deg);
        }
    }

   .back-to-top {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 48px;
    height: 48px;
    background-color: #AF5A97;
    color: #fff;
    border: 3px solid #55276C;
    box-shadow: 4px 4px 0 #55276C;
    font-family: 'Press Start 2P', monospace;
    font-size: 16px;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
    image-rendering: pixelated;
    transition: transform 0.2s steps(3), opacity 0.3s steps(4);
    opacity: 0;
    visibility: hidden;
    z-index: 1000;
    text-shadow: 1px 1px #3c1361;
    animation: none;
}

.back-to-top::before {
    content: "↑";
    transform: scale(1);
}

.back-to-top.show {
    opacity: 1;
    visibility: visible;
    animation: pixelPop 0.4s steps(4) forwards;
}

.back-to-top:hover {
    background-color: #55276C;
    transform: translate(-2px, -2px);
    box-shadow: 6px 6px 0 #AF5A97;
}

@keyframes pixelPop {
    0% { transform: scale(0.8); opacity: 0; }
    50% { transform: scale(1.1); opacity: 1; }
    100% { transform: scale(1); }
}

#contact-links {
    padding: 60px;
    text-align: center; 
    color: #fff;
    font-family: '3dventure', sans-serif;
}

#contact-links h2 {
    font-size: 2rem;
    color: #55276C;
    margin-bottom: 40px;
}

#contact-links div {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center; 
    align-items: center; 
    
}

#contact-links a {
    display: block;
    width: 100px;
    height: 100px;
    background-size: contain;
    border: 3px solid #AF5A97;;
    border-radius: 16px; /* Changed from 50% to 8px for box shape */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    
}

#contact-links a:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
}

/* Pixel-themed scroll-triggered animation styles */
.scroll-animate {
    opacity: 0;
    transform: translateY(50px);
    filter: contrast(0.5) saturate(0.5);
    transition: opacity 0.6s steps(5, end), transform 0.6s steps(5, end), filter 0.6s steps(5, end);
}

.scroll-animate.visible {
    opacity: 1;
    transform: translateY(0);
    filter: contrast(1) saturate(1);
}

/* Pixelated effect */
.pixelated {
    image-rendering: pixelated;
    image-rendering: crisp-edges;
}

/* Enhanced Animations */
@keyframes pixelPop {
    0% {
        transform: translateY(40px) scale(0.8);
        opacity: 0;
    }
    100% {
        transform: translateY(0) scale(1);
        opacity: 1;
    }
}

@keyframes glitchyText {
    0%, 100% {
        text-shadow: 4px 4px 0 #fff, -4px -4px 0 #AF5A97;
    }
    50% {
        text-shadow: -4px -4px 0 #fff, 4px 4px 0 #AF5A97;
    }
}

/* Modal styles */
#mediaModal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.9);
    z-index: 1000;
    justify-content: center;
    align-items: center;
}

#modalContent {
    position: relative;
    max-width: 80%;
    max-height: 80%;
    background: #fff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    padding: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}

#mediaModal span {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 30px;
    color: #AF5A97;
    cursor: pointer;
    font-weight: bold;
    z-index: 1001;
}

#mediaModal span:hover {
    color: #55276C;
}
</style>

<body>
    
  <section class="hero">
    
        <div class="hero-content">
            <?php if (!empty($hero['image_path'])): ?>
                <img src="<?php echo htmlspecialchars($hero['image_path']); ?>" alt="Profile" style="border-left: 10px solid #AF5A97;">
            <?php endif; ?>
            <div class="nav-center"><?php echo htmlspecialchars($hero['name'] ?? ''); ?></div>
        </div>
        <div class="hero-text">
            <h1><?php echo htmlspecialchars($hero['heading'] ?? ''); ?></h1>
            <p><?php echo htmlspecialchars($hero['description'] ?? ''); ?></p>
        </div>
    </section>

    <!-- Resume Section -->
    <section id="professional-experience" class="scroll-animate pixelated" style="padding: 60px; background-color: #D4D4ED; border-top: 5px dashed #AF5A97;">
        <h2 style="font-family: '3dventure'; font-size: 2rem; color: #55276C; text-align:center;">About Me</h2>

        <div class="resume-container" id="resume-container">
            <?php while ($resume = $resume_result->fetch_assoc()): ?>
                <div class="resume-box">
                    <h3 style="color:#55276C; font-family:'PixelifySans-VariableFont_wght'; margin-bottom: 10px;"><?php echo htmlspecialchars($resume['icon'] . ' ' . $resume['title']); ?></h3>
                    <p style="font-size:1rem;"><?php echo nl2br(htmlspecialchars($resume['content'])); ?></p>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Carousel Dots -->
        <div class="carousel-dots" id="carousel-dots"></div>


    </section>

    <!-- Projects Section -->
    <section id="projects-section" class="scroll-animate pixelated" style="padding: 60px; background-color: #C8BDDB; border-top: 5px dashed #AF5A97;">
        <h2 style="font-family: '3dventure'; font-size: 2rem; color: #55276C; text-align:center;">My Projects</h2>

        <div class="projects-container">
            <?php while ($project = $projects_result->fetch_assoc()): ?>
                <div class="project-card" onclick="openModal('<?php echo htmlspecialchars($project['media_path']); ?>', '<?php echo htmlspecialchars($project['media_type']); ?>')">
                    <?php if ($project['media_type'] === 'image'): ?>
                        <img src="<?php echo htmlspecialchars($project['media_path']); ?>" alt="Project Image">
                    <?php elseif ($project['media_type'] === 'video'): ?>
                        <video controls>
                            <source src="<?php echo htmlspecialchars($project['media_path']); ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    <?php endif; ?>
                    <div>
                        <h3><?php echo htmlspecialchars($project['title']); ?></h3>
                        <p><?php echo htmlspecialchars($project['description']); ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>



<!-- Contact Section -->
<section id="contact-section" class="scroll-animate pixelated" style="
    padding: 80px 20px;
    background: linear-gradient(to top left,rgb(224, 115, 175) 0%, #D4D4ED 35%);
    overflow: hidden;
    position: relative;
    border-top: 4px dashed #AF5A97;
    border-bottom: 4px solid #FF69B4;
    display: flex;
    flex-wrap: wrap;
    gap: 40px;
    justify-content: space-between;
">
    <!-- Stars -->
    <div class="star" style="position: absolute; top: 5%; left: 10%;"></div>
    <div class="star" style="position: absolute; top: 10%; left: 20%;"></div>
    <div class="star" style="position: absolute; top: 15%; left: 30%;"></div>
    <div class="star" style="position: absolute; top: 20%; left: 40%;"></div>
    <div class="star" style="position: absolute; top: 25%; left: 50%;"></div>
    <div class="star" style="position: absolute; top: 30%; left: 60%;"></div>
    <div class="star" style="position: absolute; top: 35%; left: 70%;"></div>
    <div class="star" style="position: absolute; top: 40%; left: 80%;"></div>
    <div class="star" style="position: absolute; top: 45%; left: 90%;"></div>
    <div class="star" style="position: absolute; bottom: 5%; right: 10%;"></div>
    <div class="star" style="position: absolute; bottom: 10%; right: 20%;"></div>
    <div class="star" style="position: absolute; bottom: 15%; right: 30%;"></div>
    <div class="star" style="position: absolute; bottom: 20%; right: 40%;"></div>
    <div class="star" style="position: absolute; bottom: 25%; right: 50%;"></div>
    <div class="star" style="position: absolute; bottom: 30%; right: 60%;"></div>
    <div class="star" style="position: absolute; bottom: 35%; right: 70%;"></div>
    <div class="star" style="position: absolute; bottom: 40%; right: 80%;"></div>
    <div class="star" style="position: absolute; bottom: 45%; right: 90%;"></div>
    <div class="star" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></div>
    <div class="star" style="position: absolute; top: 60%; left: 10%;"></div>
    <div class="star" style="position: absolute; top: 70%; left: 20%;"></div>
    <div class="star" style="position: absolute; top: 80%; left: 30%;"></div>
    <div class="star" style="position: absolute; top: 90%; left: 40%;"></div>
    <div class="star" style="position: absolute; bottom: 60%; right: 10%;"></div>
    <div class="star" style="position: absolute; bottom: 70%; right: 20%;"></div>
    <div class="star" style="position: absolute; bottom: 80%; right: 30%;"></div>
    <div class="star" style="position: absolute; bottom: 90%; right: 40%;"></div>

    <!-- Contact Info Section -->
    <div style="
        flex: 1;
        max-width: 35%;
        color: #55276C;
        background: rgba(255,255,255,0.2);
        padding: 30px 40px;
        border-radius: 15px;
        font-size: 1.2rem;
        font-weight: 400;
        text-align: center;
        border: 3px solid #AF5A97;
        font-family: 'PixelifySans-VariableFont_wght', sans-serif;
        box-shadow: 8px 8px 0 #AF5A97;
        margin-left: 150px; /* Added margin to move it slightly to the right */
    ">
         <h2 style="
        font-size: 3.5rem;
        color: #55276C;
        text-align: center;
        margin-bottom: 60px;
        animation: glitchyText 1s steps(4) infinite alternate;
        font-family: '3Dventure', sans-serif;
        letter-spacing: 2px;
        text-shadow: 4px 4px 0 #fff;
    ">
        ✨ GET IN TOUCH
        </h2>
        <?php while ($contact_info = $contact_info_result->fetch_assoc()): ?>
            <div style="margin-bottom: 20px;">
                <h3 style="font-size: 2rem; margin-bottom: 10px;"><?php echo htmlspecialchars($contact_info['section_title']); ?></h3>
                <p><?php echo htmlspecialchars($contact_info['description']); ?></p>
                <p>📥 <strong>Email:</strong> <?php echo htmlspecialchars($contact_info['email']); ?></p>
                <p>🖁 <strong>Phone:</strong> <?php echo htmlspecialchars($contact_info['phone']); ?></p>
                <p>📌 <strong>Location:</strong> <?php echo htmlspecialchars($contact_info['location']); ?></p>
            </div>
        <?php endwhile; ?>
    </div>

    <!-- Contact Links Section -->
    <div id="contact-links" style="
        flex: 1;
        max-width: 48%;
        text-align: center;
        color: #fff;
        font-family: '3Dventure', sans-serif;
    ">
        <h2 style="font-size: 2rem; color: #55276C; margin-bottom: 40px;">You can also find me here:</h2>
        <div style="
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            align-items: center;
        ">
            <!-- Facebook -->
            <a href="https://www.facebook.com/adelkristan.ramirez/" target="_blank" style="
                display: block;
                width: 100px;
                height: 100px;
                background: url('assets/facebook.png') no-repeat center center;
                background-size: contain;
                border: 3px solid #AF5A97;
                border-radius: 16px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s, box-shadow 0.3s;
            "></a>

            <!-- LinkedIn -->
            <a href="https://www.linkedin.com" target="_blank" style="
                display: block;
                width: 100px;
                height: 100px;
                background: url('assets/linkedin.png') no-repeat center center;
                background-size: contain;
                border: 3px solid #AF5A97;
                border-radius: 16px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s, box-shadow 0.3s;
            "></a>

            <!-- GitHub -->
            <a href="https://github.com/4deru" target="_blank" style="
                display: block;
                width: 100px;
                height: 100px;
                background: url('assets/github.png') no-repeat center center;
                background-size: contain;
                border: 3px solid #AF5A97;
                border-radius: 16px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s, box-shadow 0.3s;
            "></a>

            <!-- Discord-->
            <a href="https://discord.gg/csFDVRGV" target="_blank" style="
                display: block;
                width: 100px;
                height: 100px;
                background: url('assets/discord2.png') no-repeat center center;
                background-color: #e0218a;
                background-size: contain;
                border: 3px solid #AF5A97;
                border-radius: 16px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s, box-shadow 0.3s;
            "></a>

            <!-- Telegram -->
            <a href="https://t.me/adelramirez" target="_blank" style="
                display: block;
                width: 100px;
                height: 100px;
                background: url('assets/telegram.png') no-repeat center center;
                background-color: #e0218a;
                background-size: contain;
                border: 3px solid #AF5A97;
                border-radius: 16px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s, box-shadow 0.3s;
            "></a>

            <!-- Twitter -->
            <a href="https://www.Twitter.com" target="_blank" style="
                display: block;
                width: 100px;
                height: 100px;
                background: url('assets/twitter.png') no-repeat center center;
                background-size: contain;
                border: 3px solid #AF5A97;
                border-radius: 16px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s, box-shadow 0.3s;
            "></a>

            <!-- ShareThis -->
            <a href="https://www.github.com" target="_blank" style="
                display: block;
                width: 100px;
                height: 100px;
                background: url('assets/sharethis.png') no-repeat center center;
                background-size: contain;
                border: 3px solid #AF5A97;
                border-radius: 16px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s, box-shadow 0.3s;
            "></a>
        </div>
    </div>
</section>

    <!-- Modal -->
<div id="mediaModal">
    <span onclick="closeModal()">&times;</span>
    <div id="modalContent"></div>
</div>

<!-- Back to Top Button -->
<button class="back-to-top" id="backToTop" title="Back to Top"></button>

<script>
    // Show or hide the Back to Top button
    const backToTopButton = document.getElementById('backToTop');
    const scrollElements = document.querySelectorAll('.scroll-animate');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            backToTopButton.classList.add('show');
        } else {
            backToTopButton.classList.remove('show');
        }
    });

    // Scroll to the top when the Back to Top button is clicked
    backToTopButton.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });

        // Reset scroll-triggered animations
        scrollElements.forEach((el) => el.classList.remove('visible'));
    });

    // Scroll-triggered animation 
    const observerOptions = {
        threshold: 0.2, 
    };

    const scrollObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    scrollElements.forEach((el) => scrollObserver.observe(el));
</script>

<script>
        const resumeContainer = document.getElementById('resume-container');
        const carouselDots = document.getElementById('carousel-dots');
        const resumeBoxes = document.querySelectorAll('.resume-box');

        const itemsPerView = 3; 
        const totalItems = resumeBoxes.length;
        const totalDots = Math.ceil(totalItems / itemsPerView); 
        let currentIndex = 0; 

        // Create dots based on the number of sets
        for (let i = 0; i < totalDots; i++) {
            const dot = document.createElement('div');
            dot.classList.add('carousel-dot');
            if (i === 0) dot.classList.add('active'); 
            dot.addEventListener('click', () => {
                currentIndex = i; 
                updateScroll(); 
                updateActiveDot(); 
            });
            carouselDots.appendChild(dot);
        }

        // Update the scroll position
        function updateScroll() {
            const boxWidth = resumeBoxes[0].offsetWidth + 30; 
            const scrollPosition = currentIndex * boxWidth * itemsPerView;
            resumeContainer.scrollTo({
                left: scrollPosition,
                behavior: 'smooth', 
            });
        }

        // Update the active dot
        function updateActiveDot() {
            const dots = document.querySelectorAll('.carousel-dot');
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentIndex);
            });
        }
    </script>
<script>
    // hover sound effect 
    const projectCards = document.querySelectorAll('.project-card');
    const hoverAudio = new Audio('assets/hover.mp3'); 

    projectCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            hoverAudio.currentTime = 0; 
            hoverAudio.play(); 
        });
    });
</script>
<script>
    function openModal(mediaPath, mediaType) {
        const modal = document.getElementById('mediaModal');
        const modalContent = document.getElementById('modalContent');
        modalContent.innerHTML = ''; // Clear previous content

        if (mediaType === 'image') {
            const img = document.createElement('img');
            img.src = mediaPath;
            img.alt = 'Media Content';
            img.style.maxWidth = '100%';
            img.style.maxHeight = '100%';
            img.style.borderRadius = '10px';
            modalContent.appendChild(img);
        } else if (mediaType === 'video') {
            const video = document.createElement('video');
            video.src = mediaPath;
            video.controls = true;
            video.style.maxWidth = '100%';
            video.style.maxHeight = '100%';
            video.style.borderRadius = '10px';
            modalContent.appendChild(video);
        } else {
            const errorText = document.createElement('p');
            errorText.textContent = 'Unsupported media type.';
            errorText.style.color = '#AF5A97';
            errorText.style.fontSize = '1.2rem';
            modalContent.appendChild(errorText);
        }

        modal.style.display = 'flex'; // Show the modal
    }

    function closeModal() {
        const modal = document.getElementById('mediaModal');
        modal.style.display = 'none'; // Hide the modal
    }

    // Close modal when clicking outside the content
    window.addEventListener('click', (event) => {
        const modal = document.getElementById('mediaModal');
        const modalContent = document.getElementById('modalContent');
        if (event.target === modal && !modalContent.contains(event.target)) {
            closeModal();
        }
    });
</script>
<audio id="hover-audio" src="assets/8-bit-game-6.mp3"></audio>
<script src="pixel_anim.js"></script>
<script src="audio.js"></script>
</body>
</html>
