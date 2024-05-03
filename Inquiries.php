<!DOCTYPE html>
<html>
  <head>
    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .form-container, .contact-container {
            margin-bottom: 20px;
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
            padding: 10px 20px;
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
            padding: 20px;
            text-align: center;
        }

        p {
            margin: 10px 0;
            color: #666;
        }

        .contact-info {
            font-size: 18px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            border-radius: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
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
                    <a href="view_products2.php">Edit Product</a>
                </div>
            </li>
                <li><a href="orders.php">Orders</a></li>
                <li><a href="Adminacc.php">Admin Account</a></li>
                <li><a href="Inquiries.php">Inquires</a></li>
                <li style="float:right"><a href="index.html">Logout</a></li>
            </ul>
        </nav>

        <div class="container">
        <h2>User Inquiries</h2>
        <table>
            <tr>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Queries</th>
                <th>Action</th>
            </tr>
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
            
            // Fetch inquiries from the database
            $sql = "SELECT * FROM inquiries";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    
                echo "<td>" . $row["firstname"] . " " . $row["lastname"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["phone"] . "</td>";
                echo "<td>" . $row["query"] . "</td>";
                echo "<td><button onclick='viewInquiry(\"" . $row["id"] . "\", \"" . $row["firstname"] . " " . $row["lastname"] . "\", \"" . $row["email"] . "\", \"" . $row["phone"] . "\", \"" . $row["query"] . "\")'>View</button></td>";
                
                echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No inquiries found</td></tr>";
            }


            $conn->close();
            ?>
        </table>


        
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="inquiryDetails"></p>
        </div>
    </div>

    <script>
        // JavaScript to handle modal and view button
        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        function viewInquiry(id, name, email, phone, query) {
            modal.style.display = "block";
            // Display inquiry details in the modal
            document.getElementById("inquiryDetails").innerHTML =
                "<strong>Customer Name:</strong> " + name + "<br>" +
                "<strong>Email:</strong> " + email + "<br>" +
                "<strong>Phone:</strong> " + phone + "<br>" +
                "<strong>Query:</strong> " + query;
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

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
    <div class="contact-container">
            <h2>Prefer another way to find us?</h2>
            <p class="contact-info">+977 9801022637, +977 01-5970120, +977 9801000078</p>
            <p class="contact-info">info@heraldcollege.edu.np</p>
            <!-- You can embed a Google Map here -->
    </div>
  </body>
</html>
