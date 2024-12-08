<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="container">   
    <form action="register.php" method="POST">
    <h2>Register</h2>
      <input type="text" name="first_name" placeholder="First Name" required>
    
      <input type="text" name="last_name" placeholder="Last Name" required>
      
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Register</button>
      <p class="message">Already have an account? <a href="index.php">Login</a></p>
    </form> 
  </div>

  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $conn = new mysqli("localhost", "root", "", "bus_system");
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      $firstName = $_POST['first_name'];
      $lastName = $_POST['last_name'];
      $email = $_POST['email'];
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

      $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssss", $firstName, $lastName, $email, $password);

      if ($stmt->execute()) {
          echo "<p>Registration successful! <a href='index.php'>Login here</a>.</p>";
      } else {
          echo "<p>Error: " . $conn->error . "</p>";
      }

      $stmt->close();
      $conn->close();
  }
  ?>
</body>
</html>
