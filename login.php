<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Login</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      background-image: url('https://example.com/shopping-bg.jpg'); /* Replace with actual image */
      background-size: cover;
      background-position: center;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 400px;
      margin: 80px auto;
      padding: 20px;
      background-color: rgba(255, 255, 255, 0.95);
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
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

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
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

    .message, .error {
      text-align: center;
      margin-top: 20px;
      font-size: 1.2rem;
    }

    .message {
      color: green;
    }

    .error {
      color: red;
    }

    .register-link {
      text-align: center;
      margin-top: 20px;
    }

    .register-link a {
      text-decoration: none;
      color: #ff6600;
      font-weight: bold;
    }

    .register-link a:hover {
      color: #e65100;
    }

    @media screen and (max-width: 480px) {
      .container {
        margin: 30px 20px;
        padding: 15px;
      }

      h2 {
        font-size: 1.5rem;
      }

      button {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>User Login</h2>

    <form method="POST" action="">
      <label>Email:</label>
      <input type="email" name="email" required>

      <label>Password:</label>
      <input type="password" name="password" required>

      <button type="submit" name="login">Login</button>
    </form>

    <div class="register-link">
      <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>

    <?php
    session_start();

    if (isset($_POST['login'])) {
      $conn = new mysqli('localhost', 'root', '12345678', 'TrendZone');

      $email = $_POST['email'];
      $password = md5($_POST['password']);
      

      $result = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$password'");

      if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        echo "<div class='message'>✅ Login successful! Redirecting...</div>";
        echo "<script>setTimeout(() => window.location.href='index.php', 1500);</script>";
      } else {
        echo "<div class='error'>❌ Invalid email or password!</div>";
      }
      session_start(); // sabse upar ho
$_SESSION['user_id'] = $user['id']; // yahi se user track hoga


      $conn->close();
    }
    ?>
  </div>

</body>
</html>
