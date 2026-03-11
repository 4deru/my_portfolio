<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="style.css"> 
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
      background: #C8BDDB;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .register-box {
      background: #D4D4ED;
      width: 300px;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      border-bottom: 3px solid #55276C;
    }
    h2 {
      color: #55276C;
      text-align: center;
    }
    input {
      width: 100%;
      padding: 8px;
      margin: 10px 0;
      border-top: 1px solid #55276C;
      border-bottom: 1px solid #55276C;
      border-left: none;
      border-right: none;
      border-radius: 4px;
    }
    .submit {
      background-color: #fa879a;
      font-family: 'PixelifySans-VariableFont_wght', sans-serif;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      width: 100%;
    }
    .submit:hover {
      background-color: #e26e80;
    }
  </style>
</head>
<body>
  <div class="register-box">
    <h2>Create Account</h2>
    <form method="POST" action="register_process.php">
      <label>Username</label>
      <input type="text" name="username" required>
      <label>Password</label>
      <input type="password" name="password" required>
      <button class="submit" type="submit">Register</button>
    </form>
  </div>
</body>
</html>
