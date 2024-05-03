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
    $sql = "SELECT id, username, name, email, phone, password FROM admin_credentials WHERE id = ?";
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

// Function to edit admin information
function editAdminInfo($conn, $formData) {
    // Extract form data
    $id = $formData['id'];
    $username = $formData['username'];
    $name = $formData['name'];
    $email = $formData['email'];
    $phone = $formData['phone'];

    // Update admin information in the database
    $sql = "UPDATE admin_credentials SET username=?, name=?, email=?, phone=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $username, $name, $email, $phone, $id);

    if ($stmt->execute()) {
        echo "Admin information updated successfully";
    } else {
        echo "Error updating admin information: " . $stmt->error;
    }
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['edit'])) {
        // Check if username and password match
        $id = 1; // Assuming the admin ID is 1
        $username = $_POST['username'];
        $password = $_POST['password'];

        $adminInfo = getAdminInfo($conn, $id);
        if ($adminInfo && password_verify($password, $adminInfo['password'])) {
            // Password matches, allow editing
            // Here, you can display the edit form and allow the user to make changes
            // For simplicity, I'll directly call the editAdminInfo function
            editAdminInfo($conn, $_POST);
        } else {
            // Invalid username or password
            echo "Invalid username or password";
        }
    }
}

// Fetch admin information for ID 1
$adminInfo = getAdminInfo($conn, 1);

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin Information</title>
</head>

<body>
    <h1>Edit Admin Information</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="id" value="<?php echo $adminInfo['id']; ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br>
        <input type="submit" name="edit" value="Authenticate">
    </form>

    <!-- Display admin information form for editing -->
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])): ?>
        <?php if (isset($adminInfo) && password_verify($_POST['password'], $adminInfo['password'])): ?>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="id" value="<?php echo $adminInfo['id']; ?>">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo $adminInfo['username']; ?>"><br>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $adminInfo['name']; ?>"><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $adminInfo['email']; ?>"><br>
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" value="<?php echo $adminInfo['phone']; ?>"><br>
                <input type="submit" name="save" value="Save Changes">
            </form>
        <?php endif; ?>
    <?php endif; ?>
</body>

</html>
