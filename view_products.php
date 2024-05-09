<?php
session_start();

// Function to add product to cart
function addToCart($productId) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]++;
    } else {
        $_SESSION['cart'][$productId] = 1;
    }
    // Redirect to prevent form resubmission on refresh
    header("Location: {$_SERVER['REQUEST_URI']}");
    exit();
}

// Function to remove product from cart
function removeFromCart($productId) {
    unset($_SESSION['cart'][$productId]);
    // Redirect to prevent form resubmission on refresh
    header("Location: {$_SERVER['REQUEST_URI']}");
    exit();
}

// Include your database connection code here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "addproducts";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch all products from the database
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_to_cart'])) {
        addToCart($_POST['product_id']);
    } elseif (isset($_POST['remove_from_cart'])) {
        removeFromCart($_POST['remove_product_id']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 30px;
        }

        .card h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 20px;
        }

        .card img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .adopt-btn {
            background-color: #4169e1;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .adopt-btn:hover {
            background-color: #1e90ff;
        }

        .buy-now-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            width: 100%;
        }

        .buy-now-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Our Pets</h2>

    <div class="container">
        <?php
        // Display products and their images
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='card'>";
            echo "<h3>" . $row['productName'] . "</h3>";
            echo "<p>Pet Description: " . $row['productDescription'] . "</p>";
            echo "<p>Pet Category: " . $row['productCategory'] . "</p>";
            echo "<p>Gender: " . $row['gender'] . "</p>";
            echo "<p>Weight: " . $row['itemsWeight'] . "</p>";
            echo "<p>Pet Price: $" . $row['price'] . "</p>";
            echo "<p>Compare Price: $" . $row['comparePrice'] . "</p>";
            echo "<img src='http://localhost/pet-adoption-system-html-css-js-php/images/" . $row['image'] . "' alt='Product Image'>";
            // Modify the button to include an onclick event passing the product name
            echo "<button onclick='redirectToPayment(\"" . $row['productName'] . "\", " . $row['price'] . ")' class='adopt-btn'>Adopt Now!!!</button>";
            echo "</div>";
            
        }
        ?>
    </div>
    <script>
        function redirectToPayment(productName, price) {
            // Redirect to payment.php with the product name and price as query parameters
            window.location.href = "payment.php?productName=" + encodeURIComponent(productName) + "&price=" + encodeURIComponent(price);
        }
    </script>
</body>
</html>
