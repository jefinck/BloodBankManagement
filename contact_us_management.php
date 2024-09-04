<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us Management</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <style>
        /* Add additional CSS styling as needed */
        table {
            width: 10%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .response-form {
            display: none;
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

    <div class="dashboard-container">
        <h2>Contact Us Management</h2>
        <div class="contact-inquiries">
            <?php
            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "bloodbank";
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve contact inquiries
            $sql = "SELECT * FROM contact_us";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                echo "<table>";
                echo "<tr><th>Name</th><th>Email</th><th>Message</th><th>Date/Time</th><th>Action</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["subject"] . "</td>";
                    echo "<td>" . $row["message"] . "</td>";
                    echo "<td>" . $row["datetime"] . "</td>";
                    echo "<td><button onclick='toggleResponseForm(" . $row["id"] . ")'>Respond</button></td>";
                    echo "</tr>";
                    // Response form/modal for each inquiry
                    echo "<div class='response-form' id='response-form-" . $row["id"] . "'>";
                    echo "<form action='send_response.php' method='post'>";
                    echo "<input type='hidden' name='inquiry_id' value='" . $row["id"] . "'>";
                    echo "<textarea name='response' placeholder='Compose your response...' required></textarea><br>";
                    echo "<input type='submit' value='Send Response'>";
                    echo "</form>";
                    echo "</div>";
                }
                echo "</table>";
            } else {
                echo "No contact inquiries found.";
            }

            $conn->close();
            ?>
        </div>
    </div>

    <script>
        function toggleResponseForm(inquiryId) {
            var form = document.getElementById("response-form-" + inquiryId);
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }
    </script>
</body>
</html>
