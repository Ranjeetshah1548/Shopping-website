<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
  // Redirect to login page if not logged in
  header("Location: login.php?msg=Please login to view your cart");
  exit;
}

$conn = new mysqli('localhost', 'root', '12345678', 'TrendZone');
$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM cart WHERE user_id = $user_id");

?>

<!DOCTYPE html>
<html>
<head>
  <title>Your Cart</title>
  <style>
    .product-card {
      border: 1px solid #ccc;
      border-radius: 10px;
      padding: 10px;
      margin: 10px;
      width: 250px;
      display: inline-block;
      vertical-align: top;
      text-align: center;
    }
    img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }
    .product-card h3 {
      font-size: 1.1rem;
      color: #333;
    }
    .product-card p {
      font-size: 1rem;
      color: #888;
    }
  </style>
</head>
<body>
  <h2>Your Shopping Cart</h2>
  
  <?php while ($row = $result->fetch_assoc()): ?>
    <div class="product-card">
      <img src="<?= $row['image'] ?>" alt="<?= $row['product_name'] ?>">
      <h3><?= $row['product_name'] ?></h3>
      <p>₹<?= $row['price'] ?> (<?= $row['discount'] ?>% off)</p>
    </div>
  <?php endwhile; ?>

</body>
</html>

<?php
$conn->close();
?>
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  // If user is not logged in, redirect to login page
  header("Location: login.php?msg=Please login to add to cart");
  exit;
}

$user_id = $_SESSION['user_id'];
$product_name = $_POST['product_name'];
$price = $_POST['price'];
$discount = $_POST['discount'];
$image = $_POST['image'];

$conn = new mysqli('localhost', 'root', '12345678', 'TrendZone');
$sql = "INSERT INTO cart (user_id, product_name, price, discount, image)
        VALUES ('$user_id', '$product_name', '$price', '$discount', '$image')";
$conn->query($sql);
$conn->close();

// Redirect to cart page
header("Location: cart.php");
?>
