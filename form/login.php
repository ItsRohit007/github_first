<?php
session_start();

// Retrieve form data
$username = $_POST['username'];
$password = $_POST['password'];

// Database connection configuration
$servername = "localhost"; // Replace with your own database server name
$usernameDB = "root"; // Replace with your own database username
$passwordDB = ""; // Replace with your own database password
$dbname = "mydatabase"; // Replace with your preferred database name

// Create a new database connection
$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user information from the database
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $hashedPassword = $row['password'];

    // Verify the password
    if (password_verify($password, $hashedPassword)) {
        // Password is correct, set session variables
        $_SESSION["username"] = $row['username'];
        $_SESSION["email"] = $row['email'];

        // Redirect to the profile page
        $username = $_SESSION["username"];
        $email = $_SESSION["email"];

        ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.25">
    <title>User Profile</title>
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/index_stars.css">
</head>
<body>
    <div id='stars'></div>
    <div id='stars2'></div>
    <div id='stars3'></div>

    <h1>User Profile</h1>
    <div class="profile">
        <img src="../assets/images/profile.png" alt="Profile Picture">
        <p class="user-info"><span>Username : </span> <?php echo $_SESSION["username"]; ?></p>
        <p class="user-info"><span>Email : </span> <?php echo $email; ?> </p>
        <!-- <form action="" method="POST">
            <input type="submit" name="logout" value="Logout">
        </form> -->
        <a href="../index.html"> Back </a>
    </div>
</body>
</html>



<?php




        // header("Location: ../pages/profile.html");
        exit();
    } else {
        echo "Incorrect password. Please try again.";
    }
} else {
    echo "User not found. Please try again.";
}

// Close the database connection
$conn->close();
?>
