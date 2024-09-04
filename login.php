<?php
// Assuming database connection is established
// Replace 'your_db_username', 'your_db_password', 'your_db_name' with actual values
$conn = mysqli_connect("localhost", "root", "", "bloodbank");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM users WHERE BINARY username='$username' AND BINARY password='$password'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        // Redirect to dashboard or homepage after successful login
        header("Location: dashboard.html");
        exit();
    } else {
        // Set error message for invalid username or password
        echo "<script>alert('Invalid username or password'); window.location.href = 'login.html';</script>";
        exit();
    }
}

$conn->close();
?>
