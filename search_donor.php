<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS file -->
    <style>
        .result-container {
            margin-top: 20px;
            padding: 50px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border-bottom: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="content">
        <h2>Search Results</h2>
        <div class="result-container">
            <?php
            // Assuming database connection is established
            $conn = mysqli_connect("localhost", "root", "", "bloodbank");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if(isset($_GET['submit'])) {
                $city = $_GET['city'];
                $bloodgroup = $_GET['bloodgroup'];

                // Search for donors based on city and blood group
                $search_query = "SELECT * FROM donors WHERE city='$city' AND bloodgroup='$bloodgroup'";
                $result = mysqli_query($conn, $search_query);

                if(mysqli_num_rows($result) > 0) {
                    echo "<table>";
                    echo "<tr><th>Name</th><th>Sex</th><th>Date of Birth</th><th>Blood Group</th><th>City</th><th>Phone Number</th></tr>";
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr><td>".$row["name"]."</td><td>".$row["sex"]."</td><td>".$row["date_of_birth"]."</td><td>".$row["bloodgroup"]."</td><td>".$row["city"]."</td><td>".$row["phoneno"]."</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No donors found with the specified criteria.";
                }
            }

            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
