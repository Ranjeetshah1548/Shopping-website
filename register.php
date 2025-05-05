<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Registration</title>
  <style>
    /* Global Styles */
    
    
    body {
      font-family: 'Arial', sans-serif;
      background-image: url('images/logo1.png'); /* Add a shopping-related background image */
      background-size: cover;
      background-position: center;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 400px; /* Reduced width for smaller card */
      margin: 50px auto;
      padding: 20px;
      background-color: rgba(255, 255, 255, 0.9);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      border: 1px solid #ddd;
    }

    h2 {
      text-align: center;
      color: #333;
      font-size: 2rem;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
      color: #333;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 8px;
      margin: 10px 0;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 1rem;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #ff6600;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 1.1rem;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #e65100;
    }

    .message {
      text-align: center;
      margin-top: 20px;
      color: green;
      font-size: 1.2rem;
    }

    .error {
      color: red;
      font-size: 1.2rem;
      text-align: center;
    }

    .login-link {
      text-align: center;
      margin-top: 20px;
    }

    .login-link a {
      text-decoration: none;
      color: #ff6600;
      font-weight: bold;
    }

    .login-link a:hover {
      color: #e65100;
    }

    /* Responsive Design */
    @media screen and (max-width: 768px) {
      .container {
        margin: 20px;
        padding: 15px;
      }

      h2 {
        font-size: 1.5rem;
      }

      button {
        font-size: 1rem;
      }

      input[type="text"],
      input[type="email"],
      input[type="password"] {
        padding: 8px;
        font-size: 0.95rem;
      }
    }

    @media screen and (max-width: 480px) {
      .container {
        padding: 10px;
      }

      h2 {
        font-size: 1.3rem;
      }

      button {
        font-size: 0.95rem;
      }

      input[type="text"],
      input[type="email"],
      input[type="password"] {
        padding: 8px;
        font-size: 0.9rem;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>User Registration</h2>

    <form method="POST" action="">
      <label>Name:</label>
      <input type="text" name="name" required>

      <label>Email:</label>
      <input type="email" name="email" required>

      <label>Password:</label>
      <input type="password" name="password" required>

      <button type="submit" name="register">Register</button>
    </form>

    <div class="login-link">
      <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>

    <?php
    if (isset($_POST['register'])) {
      $conn = new mysqli('localhost', 'root', '12345678', 'TrendZone');

      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = md5($_POST['password']); // Simple hashing for now

      // Check if user already exists
      $check = $conn->query("SELECT * FROM users WHERE email = '$email'");
      if ($check->num_rows > 0) {
        echo "<div class='error'>❌ User already exists!</div>";
      } else {
        $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
        if ($conn->query($query)) {
          echo "<div class='message'>✅ Registered Successfully!</div>";
        } else {
          echo "<div class='error'>❌ Error: " . $conn->error . "</div>";
        }
      }

      $conn->close();
    }
    ?>
  </div>

</body>
</html>
