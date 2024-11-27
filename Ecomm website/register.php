<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Default for XAMPP; replace if different
$dbname = "login";  // Make sure the database name matches

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password =$_POST['password'];

    // Insert data into the database
    $sql = "INSERT INTO ecom (username, email, contact, password) 
            VALUES ('$username', '$email', '$contact', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
