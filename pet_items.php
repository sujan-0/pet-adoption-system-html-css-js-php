<?php
session_start();

// Function to add product to cart
function addToCart($productId, $quantity = 1) {
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
  }

  if (isset($_SESSION['cart'][$productId])) {
    $_SESSION['cart'][$productId]['quantity'] += $quantity;
  } else {
    $_SESSION['cart'][$productId] = [
      'id' => $productId, // Add product ID for easier reference
      'quantity' => $quantity,
    ];
  }
}

// Function to remove product from cart
function removeFromCart($productId) {
  if (isset($_SESSION['cart'][$productId])) {
    unset($_SESSION['cart'][$productId]);
  }
}

// Function to calculate total cart price
function calculateTotalPrice() {
  $totalPrice = 0;
  if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
      $totalPrice += $item['quantity'] * getItemPrice($item['id']); // Use getItemPrice function
    }
  }
  return $totalPrice;
}

// Function to get product price from database
function getItemPrice($productId) {
  // Database connection details
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "addproducts";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Fetch price from database
  $sql = "SELECT price FROM pet_items WHERE itemID = $productId";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $price = $row['price'];
  } else {
    $price = 0; // Return 0 if price is not found
  }

  $conn->close(); // Close connection after fetching price
  return $price;
}

// Function to get product name from database
function getItemName($productId) {
  // Database connection details
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "addproducts";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Fetch name from database
  $sql = "SELECT itemName FROM pet_items WHERE itemID = $productId";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $itemName = $row['itemName'];
  } else {
    $itemName = "Unknown"; // Default to "Unknown" if name is not found
  }

  $conn->close(); // Close connection after fetching name
  return $itemName;
}

// Function to get product image from database
function getItemImage($productId) {
  // Database connection details
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "addproducts";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Fetch image URL from database
  $sql = "SELECT itemImage FROM pet_items WHERE itemID = $productId";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $itemImage = $row['itemImage'];
  } else {
    $itemImage = "placeholder_image.jpg"; // Default image if not found
  }

  $conn->close(); // Close connection after fetching image
  return $itemImage;
}

// Handle actions (add, remove, cancel) when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['add_to_cart'])) {
    addToCart($_POST['item_id']);
  } elseif (isset($_POST['remove_quantity'])) {
    removeFromCart($_POST['item_id']);
  } elseif (isset($_POST['cancel_order'])) {
    unset($_SESSION['cart']); // Clear the cart
    echo "<div class='cart-cleared'>Cart Cleared</div>"; // Display Cart Cleared message
    header("refresh:2;url=pet_items.php"); // Reload the page after 2 seconds
    exit;
  }
}

// Database connection (replace with your actual connection details)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "addproducts";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM pet_items";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pet Items</title>
  <style>
    /* General Styles */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
    }
    .container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }
    .card {
      flex: 0 0 calc(33.33% - 20px); /* Three cards in a row with gap */
      background-color: #f5f5f5;
      padding: 10px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }
    .card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 5px;
    }
    .card h3 {
      margin-top: 0;
    }
    .card p {
      margin-bottom: 5px;
    }
    .cart-container {
      position: fixed;
      top: 20px;
      right: 20px;
      width: 300px;
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 5px;
      padding: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      display: none; /* Initially hidden */
    }
    .cart-container.show {
      display: block; /* Show when cart is not empty */
    }
    .cart-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }
    .cart-item img {
      width: 50px;
      height: auto;
      border-radius: 5px;
    }
    .cart-item .quantity {
      display: flex;
      align-items: center;
    }
    .cart-item .quantity button {
      padding: 5px;
      border: none;
      background-color: #ddd;
      cursor: pointer;
    }
    .cart-item .remove-button {
      padding: 5px;
      background-color: #ff6347;
      color: #fff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }
    .cart-total {
      font-weight: bold;
      margin-top: 10px;
    }
    .cart-buttons {
      margin-top: 20px;
      display: flex;
      justify-content: space-between;
    }
    .cart-buttons button {
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .cart-cleared {
      color: green;
      margin-top: 10px;
    }
  </style>
</head>
<body>

  <h2>Pet Items</h2>

  <div class="container">
    <?php
    $counter = 0; // Counter for displaying three products in a row
    while ($row = mysqli_fetch_assoc($result)) {
      if ($counter % 3 == 0) {
        echo "<div class='row'>";
      }
      echo "<div class='card'>";
      echo "<h3>" . $row['itemName'] . "</h3>";
      echo "<img src='" . $row['itemImage'] . "' alt='Item Image'>";
      echo "<p>Description: " . $row['itemDescription'] . "</p>";
      echo "<p>Type: " . $row['itemType'] . "</p>";
      echo "<p>Price: $" . $row['price'] . "</p>";
      echo "<p>Available Quantity: " . $row['available_quantity'] . "</p>";
      echo "<form method='post'>";
      echo "<input type='hidden' name='item_id' value='" . $row['itemID'] . "'>";
      echo "<button type='submit' name='add_to_cart'>Add to Cart</button>";
      echo "</form>";
      echo "</div>";
      $counter++;
      if ($counter % 3 == 0) {
        echo "</div>";
      }
    }
    ?>
  </div>

  <!-- Cart Section -->
  <div class="cart-container<?php echo (!empty($_SESSION['cart']) ? ' show' : ''); ?>">
    <h3>Shopping Cart</h3>
    <div class="cart-items">
      <?php
      if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $cartItem) {
          echo "<div class='cart-item'>";
          echo "<img src='" . getItemImage($cartItem['id']) . "' alt='Cart Item Image'>";
          echo "<p>" . getItemName($cartItem['id']) . "</p>";
          echo "<form method='post'>";
          echo "<input type='hidden' name='item_id' value='" . $cartItem['id'] . "'>";
          echo "<button type='submit' name='remove_quantity' class='remove-button'>Remove</button>"; // Change to Remove button
          echo "<span>" . $cartItem['quantity'] . "</span>";
          echo "</form>";
          echo "</div>";
        }
        echo "<div class='cart-total'>Total: $" . calculateTotalPrice() . "</div>";
        echo "<div class='cart-buttons'>";
        echo "<form method='post' action='payment.php'>";
        echo "<button type='submit' name='proceed_payment'>Proceed Payment</button>";
        echo "</form>";
        echo "<form method='post'>";
        echo "<button type='submit' name='cancel_order'>Cancel</button>";
        echo "</form>";
        echo "</div>";
      } else {
        echo "<p>Your cart is empty.</p>";
      }
      ?>
    </div>
  </div>

  <?php
  // Handle Cancel Order button action
  if (isset($_POST['cancel_order'])) {
    unset($_SESSION['cart']); // Clear the cart
    echo "<div class='cart-cleared'>Cart Cleared</div>"; // Display Cart Cleared message
    header("refresh:2;url=pet_items.php"); // Reload the page after 2 seconds
    exit;
  }
  ?>

  <script>
    // Toggle cart container visibility based on cart items
    document.addEventListener("DOMContentLoaded", function() {
      const cartContainer = document.querySelector('.cart-container');
      if (cartContainer && cartContainer.classList.contains('show')) {
        cartContainer.style.display = 'block';
      }
    });
  </script>

</body>
</html>
