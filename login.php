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
      font-family: 'Epilogue', sans-serif;
      background-color: #f4f4f4;
    }
    .container {
      max-width: 400px;
      margin: 100px auto;
      padding: 20px;
      background: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .form-control {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
    .btn-primary {
      background-color: #008080;
      color: white;
      padding: 14px 20px;
      margin: 10px 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
    }
   
    input[type="submit"]:hover {
            background-color: #006666; /* Darken the hover color */
    }
    .login-heading {
            text-align: center;
            font-size: 24px;
            color: #008080;
            margin-bottom: 20px;
            font-weight: bold;
        }
  </style>
</head>
<body>
  <div class="navbar-container" id="nav">
    <nav class="navbar1" id="navbar">
    <a href="index.html">
    <div class="home1">Home</div>
</a>
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
    <h1 class="login-heading">Admin Login</h1> <!-- Added heading for admin login -->
    <form action="" method="post">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <div class="mb-3">
        <button type="submit" class="btn btn-primary" name="login">Login</button>
      </div>
    </form>
    <?php
    if(isset($_POST['login'])) {
        // Database connection
        $servername = "localhost"; // Change this if your database server is different
        $username = "root"; // Change this if your database username is different
        $password = ""; // Change this if your database password is different
        $dbname = "admin"; // Change this if your database name is different

        // Attempt to establish connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve username and password from the form
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM admin_credentials WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if there is a match
        if ($result && $result->num_rows > 0) {
            // Redirect to admin panel
            header("Location: admin.php");
            exit(); // Ensure script stops execution after redirection
        } else {
            // Display JavaScript alert for incorrect credentials
            echo '<script>alert("Incorrect username or password");</script>';
            // Redirect to login.php
            echo '<script>window.location.href = "login.php";</script>';
            exit(); // Ensure script stops execution after redirection
        }

        $conn->close();
    }
    ?>
  </div>

</body>
</html>
