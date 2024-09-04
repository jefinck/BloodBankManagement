<?php
// Check if donor ID is provided
if (isset($_GET['id'])) {
    $donor_id = $_GET['id'];

    // Connect to the database
    $conn = mysqli_connect("localhost", "root", "", "bloodbank");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Delete donor from the database
    $sql = "DELETE FROM donors WHERE id = $donor_id";

    if (mysqli_query($conn, $sql)) {
        echo "Donor deleted successfully.";
    } else {
        echo "Error deleting donor: " . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
} else {
    echo "Donor ID not provided.";
}
?>
