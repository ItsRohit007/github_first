<?php
// Retrieve form data
$username = $_POST['username'];
$password = $_POST['password'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];


// Database connection configuration
$servername = "localhost"; // Replace with your own database server name
$usernameDB = "root"; // Replace with your own database username
$passwordDB = ""; // Replace with your own database password
$dbname = "mydatabase"; // Replace with your preferred database name

// Create a new database connection
$conn = new mysqli($servername, $usernameDB, $passwordDB);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === false) {
    die("Error creating database: " . $conn->error);
}

// Select the created database
$conn->select_db($dbname);

// Create a table to store user information
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    email VARCHAR(30) NOT NULL
)";

if ($conn->query($sql) === false) {
    die("Error creating table: " . $conn->error);
}

// Hash the password for security
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert user information into the table
$sql = "INSERT INTO users (username, password,first_name,last_name,email) VALUES ('$username', '$hashedPassword','$first_name','$last_name','$email')";

if ($conn->query($sql) === true) {
    echo "Registration successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>