<?php
// Assuming database connection is established
$conn = mysqli_connect("localhost", "root", "", "bloodbank");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if username already exists
    $check_query = "SELECT * FROM users WHERE username='$username'";
    $check_result = mysqli_query($conn, $check_query);

    if(mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Username already exists. Please choose a different username.');window.location.href = 'register.html';</script>";
    } else {
        // Validate password match
        if ($password != $confirmPassword) {
            echo "<script>alert('Passwords do not match.');window.location.href = 'register.html';</script>";
        } else {
            // Insert new user into the database
            $insert_query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
            if(mysqli_query($conn, $insert_query)) {
                echo "<script>alert('User registered successfully. You can now login.');window.location.href = 'login.html';</script>";
            } else {
                echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
            }
        }
    }
}

$conn->close();
?>
