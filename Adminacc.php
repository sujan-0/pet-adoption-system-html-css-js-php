<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch admin information by ID
function getAdminInfo($conn, $id) {
    $adminInfo = []; // Initialize adminInfo as an array
    $sql = "SELECT id, username, name, email, phone FROM admin_credentials WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch admin information
        $adminInfo = $result->fetch_assoc();
    }
    return $adminInfo;
}

// Function to fetch all admins
function getAllAdmins($conn) {
    $allAdmins = []; // Initialize allAdmins as an array
    $sql = "SELECT id, username, email, phone FROM admin_credentials";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Fetch all admins
        while ($row = $result->fetch_assoc()) {
            $allAdmins[] = $row;
        }
    }
    return $allAdmins;
}

// Function to register a new admin
function registerAdmin($conn, $formData) {
    // Extract form data
    $username = $formData['username'];
    $password = $formData['password'];
    $name = $formData['name'];
    $email = $formData['email'];
    $phone = $formData['phone'];
    $confirm_password = $formData['confirm_password'];

    // Check if password matches confirm password
    if ($password !== $confirm_password) {
        echo "Error: Passwords do not match";
        return;
    }

    // Check if username already exists
    $check_username_query = "SELECT * FROM admin_credentials WHERE username=? LIMIT 1";
    $stmt = $conn->prepare($check_username_query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "Error: Username already exists";
        return;
    }

    // Hash the password before storing in the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert new admin information into the database
    $sql = "INSERT INTO admin_credentials (username, password, name, email, phone) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $username, $hashed_password, $name, $email, $phone);

    if ($stmt->execute()) {
        echo "New admin registered successfully";
    } else {
        echo "Error registering admin: " . $stmt->error;
    }
}


// Function to delete admin by ID
function deleteAdmin($conn, $id) {
    $sql = "DELETE FROM admin_credentials WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Admin deleted successfully";
    } else {
        echo "Error deleting admin: " . $stmt->error;
    }
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['edit'])) {
        editAdminInfo($conn, $_POST);
    } elseif (isset($_POST['register'])) {
        registerAdmin($conn, $_POST);
    } elseif (isset($_POST['delete'])) {
        $idToDelete = $_POST['id'];
        deleteAdmin($conn, $idToDelete);
        // Redirect to refresh the page after deletion
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
    }
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['edit'])) {
        editAdminInfo($conn, $_POST);
    } elseif (isset($_POST['register'])) {
        registerAdmin($conn, $_POST);
    }
}

// Fetch admin information for ID 1
$adminInfo = getAdminInfo($conn, 1);

// Fetch all admins
$allAdmins = getAllAdmins($conn);

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Settings</title>
    <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f2f2f2;
                margin: 0;
                padding: 0;
            }

            .container {
                width: 50%;
                margin: 50px auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
            }

            h2 {
                text-align: center;
                color: #333;
            }

            form {
                margin-top: 20px;
            }

            label {
                font-weight: bold;
                display: block;
                margin-bottom: 5px;
            }

            input[type="text"],
            input[type="number"],
            select,
            textarea,
            input[type="file"] {
                width: calc(100% - 22px);
                padding: 10px;
                margin-bottom: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            input[type="submit"],
            input[type="reset"] {
                width: 48%;
                background-color: #4CAF50;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                margin-top: 10px; /* Added margin to separate buttons */
                display: inline-block; /* Display buttons inline */
            }

            input[type="submit"]:hover,
            input[type="reset"]:hover {
                background-color: #45a049;
            }

            input[type="reset"] {
                background-color: #f44336;
                margin-left: 4%;
            }

            @media screen and (max-width: 768px) {
                .container {
                    width: 80%;
                }

                input[type="submit"],
                input[type="reset"] {
                    width: 100%;
                    margin-left: 0;
                }
            }
        
    
        header {
            background-color: #295554;
            padding: 20px 0;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        nav ul li {
            display: inline;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 14px 16px;
            display: inline-block;
        }

        nav ul li a:hover {
            background-color: #555;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            z-index: 1;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        }

        .dropdown-content a {
            color: #333;
            padding: 12px 16px;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            max-width: 800px;
            width: 100%;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .admin-info-box {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
            text-align: left;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 0px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 60%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        .hidden {
            display: none;
        }
    </style>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <!-- <link rel="stylesheet" href="./global.css" /> -->
    <link rel="stylesheet" href="./admin.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Epilogue:wght@300;400;500;600&display=swap"
    />


</head>
<body>
<d class="desktop-2">
    <header>
        <nav>
            <ul>
              <li class="dropdown">
                <a href="#" class="dropbtn">Pet</a>
                <div class="dropdown-content">
                    <a href="Addform.php">Add Pet</a>
                    <a href="view_products2.php">Update Pet</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="#" class="dropbtn">Product</a>
                <div class="dropdown-content">
                    <a href="AddProduct.php">Add Product</a>
                    <a href="view_products.php">Edit Product</a>
                </div>
            </li>
                <li><a href="orders.php">Orders</a></li>
                <li><a href="Adminacc.php">Admin Account</a></li>
                <li><a href="Inquiries.php">Inquires</a></li>
                <li style="float:right"><a href="index.html">Logout</a></li>
            </ul>
        </nav>
    </header>
      <nav class="frame-parent" id="sideNav">
        <div class="admin-wrapper">
          <div class="admin">Admin</div>
        </div>
        <div class="petopia-parent" id="logo">
          <div class="petopia">petopia</div>
          <div class="frame-child"></div>
          <div class="frame-item"></div>
          <div class="frame-inner"></div>
          <img class="vector-icon" alt="" src="./public/vector.svg" />

          <img class="vector-icon1" alt="" src="./public/vector.svg" />

          <img class="vector-icon2" alt="" src="./public/vector.svg" />
        </div>
      </nav>









    <div class="container">
        <h1>Admin Settings</h1>

        <div class="admin-info-box">
            <h2>Admin Information</h2>
            <?php if(isset($adminInfo) && !empty($adminInfo)) { ?>
                <p>ID: <?php echo $adminInfo['id']; ?></p>
                <p>Username: <?php echo $adminInfo['username']; ?></p>
                <p>Name: <?php echo $adminInfo['name']; ?></p>
                <p>Email: <?php echo $adminInfo['email']; ?></p>
                <p>Phone: <?php echo $adminInfo['phone']; ?></p>
            <?php } else { ?>
                <p>No admin information available</p>
            <?php } ?>
            <!-- Display a form here for editing admin information -->
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="id" value="<?php echo $adminInfo['id']; ?>">
                <input type="submit" name="edit" value="Edit Information">
            </form>
        </div>

        <h2>All Admins</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
            <?php if(isset($allAdmins) && is_array($allAdmins)) {
                foreach ($allAdmins as $admin) { ?>
                    <tr>
                        <td><?php echo $admin['id']; ?></td>
                        <td><?php echo $admin['username']; ?></td>
                        <td><?php echo $admin['email']; ?></td>
                        <td><?php echo $admin['phone']; ?></td>
                        <td>
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <input type="hidden" name="id" value="<?php echo $admin['id']; ?>">
                                <input type="submit" name="delete" value="Delete">
                            </form>
                        </td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="5">No admins found</td>
                </tr>
            <?php } ?>
        </table>

        <button id="registerBtn">Register Admin</button>
        
        <!-- Display a form here for registering new admin -->
        <form id="registerForm" class="hidden" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h2>Register Admin</h2>
            <?php if(isset($registrationError)) { ?>
                <p class="error"><?php echo $registrationError; ?></p>
            <?php } ?>
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            <input type="text" name="name" placeholder="Name">
            <input type="email" name="email" placeholder="Email">
            <input type="text" name="phone" placeholder="Phone">
            <input type="password" name="confirm_password" placeholder="Confirm Password">
            <input type="submit" name="register" value="Register">
        </form>
    </div>

    <script>
        document.getElementById('registerBtn').addEventListener('click', function() {
            document.getElementById('registerForm').classList.toggle('hidden');
        });
    </script>
</body>
</html>

