<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css"> 
    <style>
        /* Style for statistic items */
        .statistic {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }
        
        .statistic-item {
            background-color: #f5f5f5;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 200px;
        }
        
        .statistic-label {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 10px;
        }
        
        .statistic-value {
            font-size: 24px;
            color: #333;
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
            <!-- <li><a href="view_statistics.php">View Statistics</a></li>
            <li><a href="admin_profile.php">Admin Profile</a></li> -->
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <div class="dashboard-container">
        <h2>Admin Dashboard</h2>
        <div class="statistic">
            <div class="statistic-item">
                <div class="statistic-label">Total Number of Donors</div>
                <div class="statistic-value">
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "bloodbank";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT COUNT(*) AS total_donors FROM donors";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo $row["total_donors"];
                        }
                    } else {
                        echo "0";
                    }

                    $conn->close();
                    ?>
                </div>
            </div>
            <div class="statistic-item">
                <div class="statistic-label">Total Number of Contact Inquiries</div>
                <div class="statistic-value">
                    <?php
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT COUNT(*) AS total_inquiries FROM contact_us";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo $row["total_inquiries"];
                        }
                    } else {
                        echo "0";
                    }

                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
