<?php
// Assuming database connection is established
$conn = mysqli_connect("localhost", "root", "", "bloodbank");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $sex = $_POST['sex'];
    $dob = $_POST['dob'];
    $bloodgroup = $_POST['bloodgroup'];
    $city = $_POST['city'];
    $phoneno = $_POST['phoneno'];

    // Calculate age based on the provided date of birth
    $today = new DateTime();
    $birthdate = new DateTime($dob);
    $age = $birthdate->diff($today)->y;

    // Check if age is less than 18
    if ($age < 18) {
        echo "<script>alert('You must be at least 18 years old to register.'); window.location.href = 'add_donor.html';</script>";
    } else {
        // Check if donor already exists
        $check_query = "SELECT * FROM donors WHERE name='$name' AND date_of_birth='$dob'";
        $check_result = mysqli_query($conn, $check_query);

        if(mysqli_num_rows($check_result) > 0) {
            echo "<script>alert('Donor with the same name and date of birth already exists'); window.location.href = 'add_donor.html';</script>";
        } else {
            // Insert donor information into the database
            $insert_query = "INSERT INTO donors (name, sex, date_of_birth, bloodgroup, city, phoneno) VALUES ('$name', '$sex', '$dob', '$bloodgroup', '$city', '$phoneno')";
            if(mysqli_query($conn, $insert_query)) {
                echo "<script>alert('Donor added successfully.');window.location.href = 'dashboard.html'; </script>";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
}

$conn->close();
?>
