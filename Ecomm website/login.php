<?php
session_start();

// Initialize error variables
$usernameError = "";
$passwordError = "";

// Database connection
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "login";  // Database name

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and validate form input
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username)) {
        $usernameError = "Username is required.";
    }

    if (empty($password)) {
        $passwordError = "Password is required.";
    }

    // If no errors, proceed to login
    if (empty($usernameError) && empty($passwordError)) {
        // Query to check credentials
        $sql = "SELECT * FROM ecom WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Credentials are correct, start the session and redirect
            $_SESSION["username"] = $username;
            header("Location: index.html");  // Redirect to index.html
            exit();
        } else {
            header("Location: try.html");
        }

        $stmt->close();
    }
}

$conn->close();
?>
