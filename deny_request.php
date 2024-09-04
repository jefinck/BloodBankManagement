<?php
// Check if the blood request ID is provided in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $requestId = $_GET['id'];

    // Connect to the database
    $conn = mysqli_connect("localhost", "root", "", "bloodbank");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Update the blood request status to 'Denied'
    $sql = "UPDATE blood_requests SET status = 'Denied' WHERE id = $requestId";

    if (mysqli_query($conn, $sql)) {
        echo "Blood request denied successfully.";
    } else {
        echo "Error updating blood request: " . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
} else {
    echo "Invalid blood request ID.";
}
?>
