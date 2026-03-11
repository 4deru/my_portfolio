<?php
session_start();

// Redirect to dashboard if already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
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
      font-family: 'PixelifySans-VariableFont_wght', sans-serif;
      background: #fff;
      color: #112244;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      overflow: hidden;
      position: relative;
    }

    .pixel {
      position: absolute;
      width: 12px;
      height: 12px;
      background: #112244;
      opacity: 0.8;
      animation: fall 10s linear infinite;
      z-index: -1;
    }

    @keyframes fall {
      0% {
        transform: translateY(-100vh) rotate(0deg);
      }
      100% {
        transform: translateY(100vh) rotate(360deg);
      }
    }

    .login-box {
      position: absolute;
      background: #fff;
      color: #112244;
      width: 300px;
      height: 400px;
      justify-items: center;
      padding: 20px;
      padding-bottom: 100px;
      border-radius: 8px;
      box-shadow: 0 5px 15px rgba(17,34,68,0.08);
      border-bottom: 3px solid #112244;
    }
    .login-box h2 {
      color: #112244;
      font-size: 2rem;
    }

    .login-box h2, .login-box label, .login-box input, .login-box button {
      position: relative;
      bottom: 50px;
    }

    .login-box label, .login-box input  {
      font-family: 'PixelifySans-VariableFont_wght', sans-serif;
    }

    .login-box input {
      border-top: 1px solid #112244;
      border-bottom: 1px solid #112244;
      border-left: none;
      border-right: none;
      border-radius: 4px;
      color: #112244;
      background: #fff;
    }
    

    .submit{
      font-family: 'PixelifySans-VariableFont_wght', sans-serif;
      background-color: #112244;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
      transition: background 0.3s, color 0.3s;
    }

    .submit:hover {
      background-color: #fff;
      color: #112244;
      border: 1px solid #112244;
    }

    .login-box label, .login-box input, .submit {
      position: relative;
      left: 0px;
    }

    .cherry {
      position: relative;
      bottom: 20px;
      right: 20px;
      border-radius: 8px;
      border-bottom: 3px solid #112244;
    }
    
  </style>
</head>
<body>
  <a href="index.php" style="
    position: absolute;
    top: 20px;
    left: 20px;
    font-family: '3Dventure', sans-serif;
    font-size: 1.2rem;
    color: #112244;
    text-decoration: none;
    background-color: #fff;
    padding: 10px 20px;
    border: 2px solid #112244;
    border-radius: 5px;
    transition: background 0.3s, color 0.3s, transform 0.2s;
    z-index: 10;
  " class="back-button"><- Back</a>
  <div class="login-box">
    <img src="assets/snowynight.png" alt="Logo" class="cherry" style="width: 113%; height: auto; margin-bottom: 20px;">
    <h2>Welcome Back!</h2>
    <form method="post" action="login_process.php">
      <label for="username">Username:</label><br>
      <input type="text" name="username" placeholder="Username" required><br><br>
      <label for="password">Password:</label><br>
      <input type="password" name="password" placeholder="Password" required><br><br>
      <button type="submit" class="submit">Login</button>
    </form>
  </div>
  <audio id="login-audio" src="assets/pixel-sound-effect.mp3"></audio>
  <audio id="button-audio" src="assets/pixel-sound-effect.mp3"></audio>
  <script src="pixel_anim.js"></script>
  <script src="audio.js"></script>
  <script>
    const backButton = document.querySelector('.back-button');
    backButton.addEventListener('mouseenter', () => {
      backButton.style.backgroundColor = '#112244';
      backButton.style.color = '#fff';
    });
    backButton.addEventListener('mouseleave', () => {
      backButton.style.backgroundColor = '#fff';
      backButton.style.color = '#112244';
    });
  </script>
</body>
</html>
