<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Donor</title>
    <link rel="stylesheet" href="styles.css"/>
    <style>
        body {
            /* background-image: url('45.png'); */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
            margin: 0px;
            padding: 0;
        }
        .content {
            background-color: rgba(255, 255, 255, 0.8); /* Transparent white background */
            padding: 20px;
            border-radius: 10px;
            margin: 30px auto;
            max-width: 300px;
            text-align: center; /* Center align the content */
        }
        .input-group {
            margin-bottom: 10px; /* Adjust the margin-bottom value to your preference */
            text-align: left; /* Align the input labels to the left */
        }
        input[type="text"], input[type="tel"], input[type="date"] {
            width: calc(100% - 20px); /* Adjust the width as needed */
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 5px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            width: calc(100% - 20px); /* Adjust the width as needed */
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="content">
        <h2>Edit Donors</h2>
        <?php
        // Include database connection file
        $conn = mysqli_connect("localhost", "root", "", "bloodbank");

        // Check if the ID parameter is set in the URL
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Check if the form has been submitted
            if (isset($_POST['submit'])) {
                // Get form data
                $id = $_POST['id'];
                $name = $_POST['name'];
                $sex = $_POST['sex'];
                $date_of_birth = $_POST['date_of_birth'];
                $bloodgroup = $_POST['bloodgroup'];
                $city = $_POST['city'];
                $phoneno = $_POST['phoneno'];

                // Prepare the update query
                $query = "UPDATE donors SET id ='$id', Name = '$name', sex = '$sex', date_of_birth = '$date_of_birth', bloodgroup = '$bloodgroup', city = '$city', phoneno = '$phoneno' WHERE ID = $id";

                // Execute the query
                if (mysqli_query($conn, $query)) {
                    // Redirect to the index page if the query is successful
                    header("Location: manage_donors.php?msg=Record updated successfully");
                    exit();
                } else {
                    echo "Error updating record: " . mysqli_error($conn);
                }
            }

            // Fetch the data of the row with the given ID
            $query = "SELECT * FROM donors WHERE ID = $id";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);

            // Display the edit form with the data of the row
        ?>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="input-group">
                <label for="id">ID:</label>
                <input type="text" name="id" value="<?php echo $row['id']; ?>" disabled>
            </div>
            <div class="input-group">
                <label for="name">Name:</label>
                <input type="text" name="name" value="<?php echo $row['name']; ?>">
            </div>
            <div class="input-group">
                <label for="sex">Sex:</label>
                <select id="sex" name="sex" required>
                    <option value="male" <?php if ($row['sex'] == 'male') echo 'selected'; ?>>Male</option>
                    <option value="female" <?php if ($row['sex'] == 'female') echo 'selected'; ?>>Female</option>
                    <option value="other" <?php if ($row['sex'] == 'other') echo 'selected'; ?>>Other</option>
                </select>
            </div>
            <div class="input-group">
                <label for="date_of_birth">Date of Birth:</label>
                <input type="text" name="date_of_birth" value="<?php echo $row['date_of_birth']; ?>">
            </div>
            <div class="input-group">
                <label for="bloodgroup">Blood Group:</label>
                <select id="bloodgroup" name="bloodgroup" required>
                    <option value="A+" <?php if ($row['bloodgroup'] == 'A+') echo 'selected'; ?>>A+</option>
                    <option value="A-" <?php if ($row['bloodgroup'] == 'A-') echo 'selected'; ?>>A-</option>
                    <option value="B+" <?php if ($row['bloodgroup'] == 'B+') echo 'selected'; ?>>B+</option>
                    <option value="B-" <?php if ($row['bloodgroup'] == 'B-') echo 'selected'; ?>>B-</option>
                    <option value="O+" <?php if ($row['bloodgroup'] == 'O+') echo 'selected'; ?>>O+</option>
                    <option value="O-" <?php if ($row['bloodgroup'] == 'O-') echo 'selected'; ?>>O-</option>
                    <option value="AB+" <?php if ($row['bloodgroup'] == 'AB+') echo 'selected'; ?>>AB+</option>
                    <option value="AB-" <?php if ($row['bloodgroup'] == 'AB-') echo 'selected'; ?>>AB-</option>
                </select>
            </div>
            <div class="input-group">
                <label for="city">City:</label>
                <select id="city" name="city" required>
                    <option value="Ahmedabad" <?php if ($row['city'] == 'Ahmedabad') echo 'selected'; ?>>Ahmedabad</option>
                    <option value="Amreli" <?php if ($row['city'] == 'Amreli') echo 'selected'; ?>>Amreli</option>
                    <option value="Anand" <?php if ($row['city'] == 'Anand') echo 'selected'; ?>>Anand</option>
                    <option value="Aravalli" <?php if ($row['city'] == 'Aravalli') echo 'selected'; ?>>Aravalli</option>
                    <option value="Banaskantha" <?php if ($row['city'] == 'Banaskantha') echo 'selected'; ?>>Banaskantha</option>
                    <option value="Bharuch" <?php if ($row['city'] == 'Bharuch') echo 'selected'; ?>>Bharuch</option>
                    <option value="Bhavnagar" <?php if ($row['city'] == 'Bhavnagar') echo 'selected'; ?>>Bhavnagar</option>
                    <option value="Botad" <?php if ($row['city'] == 'Botad') echo 'selected'; ?>>Botad</option>
                    <option value="Chhota Udepur" <?php if ($row['city'] == 'Chhota Udepur') echo 'selected'; ?>>Chhota Udepur</option>
                    <option value="Dahod" <?php if ($row['city'] == 'Dahod') echo 'selected'; ?>>Dahod</option>
                    <option value="Dang" <?php if ($row['city'] == 'Dang') echo 'selected'; ?>>Dang</option>
                    <option value="Devbhoomi Dwarka" <?php if ($row['city'] == 'Devbhoomi Dwarka') echo 'selected'; ?>>Devbhoomi Dwarka</option>
                    <option value="Gandhinagar" <?php if ($row['city'] == 'Gandhinagar') echo 'selected'; ?>>Gandhinagar</option>
                    <option value="Gir Somnath" <?php if ($row['city'] == 'Gir Somnath') echo 'selected'; ?>>Gir Somnath</option>
                    <option value="Jamnagar" <?php if ($row['city'] == 'Jamnagar') echo 'selected'; ?>>Jamnagar</option>
                    <option value="Junagadh" <?php if ($row['city'] == 'Junagadh') echo 'selected'; ?>>Junagadh</option>
                    <option value="Kutch" <?php if ($row['city'] == 'Kutch') echo 'selected'; ?>>Kutch</option>
                    <option value="Kheda" <?php if ($row['city'] == 'Kheda') echo 'selected'; ?>>Kheda</option>
                    <option value="Mahisagar" <?php if ($row['city'] == 'Mahisagar') echo 'selected'; ?>>Mahisagar</option>
                    <option value="Mahesana" <?php if ($row['city'] == 'Mahesana') echo 'selected'; ?>>Mahesana</option>
                    <option value="Morbi" <?php if ($row['city'] == 'Morbi') echo 'selected'; ?>>Morbi</option>
                    <option value="Narmada" <?php if ($row['city'] == 'Narmada') echo 'selected'; ?>>Narmada</option>
                    <option value="Navsari" <?php if ($row['city'] == 'Navsari') echo 'selected'; ?>>Navsari</option>
                    <option value="Panchmahal" <?php if ($row['city'] == 'Panchmahal') echo 'selected'; ?>>Panchmahal</option>
                    <option value="Patan" <?php if ($row['city'] == 'Patan') echo 'selected'; ?>>Patan</option>
                    <option value="Porbandar" <?php if ($row['city'] == 'Porbandar') echo 'selected'; ?>>Porbandar</option>
                    <option value="Rajkot" <?php if ($row['city'] == 'Rajkot') echo 'selected'; ?>>Rajkot</option>
                    <option value="Sabarkantha" <?php if ($row['city'] == 'Sabarkantha') echo 'selected'; ?>>Sabarkantha</option>
                    <option value="Surat" <?php if ($row['city'] == 'Surat') echo 'selected'; ?>>Surat</option>
                    <option value="Surendranagar" <?php if ($row['city'] == 'Surendranagar') echo 'selected'; ?>>Surendranagar</option>
                    <option value="Tapi" <?php if ($row['city'] == 'Tapi') echo 'selected'; ?>>Tapi</option>
                    <option value="Vadodara" <?php if ($row['city'] == 'Vadodara') echo 'selected'; ?>>Vadodara</option>
                    <option value="Valsad" <?php if ($row['city'] == 'Valsad') echo 'selected'; ?>>Valsad</option>
                </select>
            </div>

            <div class="input-group">
                <label for="phoneno">Phone Number:</label>
                <input type="text" name="phoneno" value="<?php echo $row['phoneno']; ?>">
            </div>
            <input type="submit" name="submit" value="Save">
        </form>
        <?php
        } else {
            // Redirect to the index page if the ID parameter is not set
            header("Location: Admin.php");
            exit();
        }
        ?>
    </div>
</body>
</html>
