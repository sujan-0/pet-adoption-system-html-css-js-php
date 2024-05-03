    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        // Database connection code
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "addproducts"; // Corrected database name

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Process form data
        $itemName = $_POST['itemName'];
        $itemDescription = $_POST['itemDescription'];
        $itemType = $_POST['itemType'];
        $price = $_POST['price'];
        $availableQuantity = $_POST['availableQuantity'];

        // Handle image upload
        if(isset($_FILES['itemImage'])) {
            $imageName = $_FILES['itemImage']['name'];
            $imageTmpName = $_FILES['itemImage']['tmp_name'];
            $imageType = $_FILES['itemImage']['type'];

            $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
            $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

            // Create "uploads" directory if it doesn't exist
            $uploadDirectory = 'uploads/';
            if (!file_exists($uploadDirectory)) {
                mkdir($uploadDirectory, 0777, true); // Create directory with full permissions
            }

            if (in_array($imageExtension, $allowedExtensions)) {
                $imageDestination = $uploadDirectory . $imageName;
                move_uploaded_file($imageTmpName, $imageDestination);
            } else {
                echo "<script>alert('Invalid file format. Only JPG, JPEG, PNG, and GIF images are allowed.');</script>";
            }
        }
        // Insert data into database
        if(isset($imageDestination)) {
            $sql = "INSERT INTO pet_items (itemName, itemDescription, itemType, price, available_quantity, itemImage)
                    VALUES ('$itemName', '$itemDescription', '$itemType', $price, $availableQuantity, '$imageDestination')";

            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Item added successfully.');</script>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

        // Close database connection
        mysqli_close($conn);
    }
    ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Add Items</title>
    <style>
      body {
          margin: 0;
          font-family: Arial, sans-serif;
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

     
        .container {
            width: 60%;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        textarea,
        select,
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"],
        input[type="reset"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }
        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #45a049;
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
    
    <div class="desktop-2">
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
                        <a href="add_item.php">Add Product</a>
                        <a href="view_petitemsadmin.php">Edit Product</a>
                    </div>
                </li>
                    <li><a href="orders.php">Orders</a></li>
                    <li><a href="Adminacc.php">Admin Account</a></li>
                    <li><a href="Inquiries.php">Inquires</a></li>
                    <li style="float:right"><a href="index.html">Logout</a></li>
                </ul>
            </nav>


            <div class="container">
                <h2>Add Pet Items</h2>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                        <label for="itemName">Item Name:</label>
                        <input type="text" id="itemName" name="itemName" required>

                        <label for="itemDescription">Item Description:</label>
                        <textarea id="itemDescription" name="itemDescription" required></textarea>

                        <label for="itemType">Item Type:</label>
                        <select id="itemType" name="itemType" required>
                            <option value="food">Food</option>
                            <option value="accessory">Accessory</option>
                            <option value="medical">Medical</option>
                        </select>

                        <label for="price">Price:</label>
                        <input type="text" id="price" name="price" required>

                        <label for="availableQuantity">Available Quantity:</label>
                        <input type="text" id="availableQuantity" name="availableQuantity" required>

                        <label for="itemImage">Item Image:</label>
                        <input type="file" id="itemImage" name="itemImage" accept="image/*">

                        <input type="submit" name="submit" value="Add Item">
                        <input type="reset" value="Cancel">
                    </form>
            </div>

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
      




        </header>

        
      
      </main>
    </div>
  </body>
</html>





