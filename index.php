<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="container">    
    <form action="login.php" method="POST">
    <h2>Login</h2>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
      <p class="message">Don't have an account? <a href="register.php">Register</a></p>
    </form>    
  </div>
</body>
</html>
