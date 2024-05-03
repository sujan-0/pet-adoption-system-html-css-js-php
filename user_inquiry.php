<?php
// Database connection parameters
$servername = "localhost"; // Change this if your database is on a different server
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "addproducts"; // Name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO inquiries (firstname, lastname, email, phone, query) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $firstname, $lastname, $email, $phone, $query);

    // Set parameters and execute
    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $query = $_POST['query'] ?? '';

    if ($stmt->execute()) {
        $message = "Thank You For Your Queries! We will contact you as soon as possible.";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="./global.css" />
  <link rel="stylesheet" href="./login.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Epilogue:wght@300;400;500;600;700;800&display=swap" />
  <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
    }

    .container {
        display: flex;
        justify-content: space-around;
        align-items: flex-start;
        margin: 50px auto;
        max-width: 1000px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        padding: 30px;
    }

    .form-container, .contact-container {
        width: 45%;
        padding: 20px;
    }

    .form-container {
        background-color: #f9f9f9;
        border-radius: 10px;
    }

    h2 {
        text-align: center;
        color: #333;
    }

    label {
        font-weight: bold;
        color: #555;
    }

    input[type=text], input[type=email], textarea {
        width: calc(100% - 24px);
        padding: 12px;
        margin: 6px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    textarea {
        height: 120px;
    }

    button {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #45a049;
    }

    .contact-container {
        background-color: #f2f2f2;
        border-radius: 10px;
    }

    p {
        margin: 10px 0;
        color: #666;
    }

    .contact-info {
        font-size: 18px;
        font-weight: bold;
    }

    footer {
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 10px 0;
        position: fixed;
        bottom: 0;
        width: 100%;
    }

    footer p {
        margin: 0;
    }
  </style>
</head>
<body>
  <div class="navbar-container" id="nav">
    <nav class="navbar1" id="navbar">
      <div class="home1">Home</div>
      <div class="adopt3">Adopt</div>
      <div class="get-involved1">Get Involved</div>
      <div class="blog1">Blog</div>
      <div class="about-us1">About us</div>
      <a class="ellipse-group">
        <div class="frame-child6"></div>
        <img class="vector-icon33" alt="" src="./public/vector.svg" />
      </a>
      <button class="login-container" id="login">
        <div class="login2">Login</div>
      </button>
      <div class="register-container">
        <div class="register">Register</div>
      </div>
    </nav>
  </div>
    
  <div class="container">
    <div class="form-container">
        <?php if (!empty($message)) : ?>
            <div id="popup-message"><?php echo $message; ?></div>
        <?php endif; ?>
        <form action="" method="post">
            <label for="fname">First Name</label>
            <input type="text" id="fname" name="firstname" placeholder="Your name..">

            <label for="lname">Last Name</label>
            <input type="text" id="lname" name="lastname" placeholder="Your last name..">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Your email..">

            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" placeholder="Your phone number..">

            <label for="query">Queries</label>
            <textarea id="query" name="query" placeholder="Write something.."></textarea>

            <button type="submit">SUBMIT</button>
        </form>
    </div>

    <div class="contact-container">
        <h2>Prefer another way to find us?</h2>
        <p class="contact-info">+977 9801022637, +977 01-5970120, +977 9801000078</p>
        <p class="contact-info">info@heraldcollege.edu.np</p>
        <!-- You can embed a Google Map here -->
    </div>
  </div>

  <footer>
    <p>Footer content goes here</p>
  </footer>

</body>
</html>
