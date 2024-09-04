<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Donors</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS file -->
    <style>
        table {
            width: 80%;
            margin: 0 auto; /* Center the table */
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f2f2f2;
        }
        nav {
            background-color: #343a40; /* Dark gray navbar background color */
            padding: 10px 0;
            text-align: center; /* Center-align nav links */
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: inline-block; /* Display as block to center */
        }

        nav ul li {
            display: inline;
            margin-right: 10px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        nav ul li a:hover {
            background-color: #495057; /* Darker gray on hover */
        }

    </style>
</head>
<body>
<nav>
        <ul>
            <li><a href="admin_dashboard.php">Dashboard</a></li>
            <li><a href="manage_donors.php">Manage Donors</a></li>
            <li><a href="Contact_Us_Management.php">Contact Us Management</a></li>
            <!-- <li><a href="manage_blood_groups.php">Manage Blood Groups</a></li>
            <li><a href="view_statistics.php">View Statistics</a></li>
            <li><a href="admin_profile.php">Admin Profile</a></li> -->
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <h2>Manage Donors</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Sex</th>
            <th>Blood Group</th>
            <th>City</th>
            <th>PhoneNo</th>
            <th>Actions</th>
        </tr>
        <?php
        // Connect to the database
        $conn = mysqli_connect("localhost", "root", "", "bloodbank");

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Fetch all donors from the database
        $sql = "SELECT * FROM donors";
        $result = mysqli_query($conn, $sql);

        // Check if there are any donors
        if (mysqli_num_rows($result) > 0) {
            // Output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["sex"] . "</td>";
                echo "<td>" . $row["bloodgroup"] . "</td>";
                echo "<td>" . $row["city"] . "</td>";
                echo "<td>" . $row["phoneno"] . "</td>";
                echo '<td><a href="edit_donor.php?id=' . $row["id"] . '">Edit</a> | ';
                echo '<a href="delete_donor.php?id=' . $row["id"] . '">Delete</a></td>';
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No donors found</td></tr>";
        }

        // Close database connection
        mysqli_close($conn);
        ?>
    </table>
</body>
</html>
