<?php 

session_start();
include 'connect.php';

// Check if the request method is POST for Sign In
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Email'])) {
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $Password = md5($Password); // Hashing the password

    // Query to check user credentials
    $sql = "SELECT * FROM users WHERE Email='$Email' AND Password='$Password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['Email'] = $row['Email']; // Set session variable
        echo "Login successful!";
    } else {
        echo "Not Found, Incorrect Email or Password";
    }
}

?>
