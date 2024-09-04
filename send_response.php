<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer Autoloader
require 'vendor/autoload.php';

// Set SMTP configuration
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'jefin0290@gmail.com';
$mail->Password = 'Jefin@123';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if inquiry ID and response are set
    if (isset($_POST['inquiry_id']) && isset($_POST['response'])) {
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "bloodbank";
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Escape user inputs for security
        $inquiry_id = $_POST['inquiry_id'];
        $response = $conn->real_escape_string($_POST['response']);

        // Update the inquiry status and add response to the database
        $sql = "UPDATE contact_us SET status = 'responded', response = '$response' WHERE id = $inquiry_id";

        if ($conn->query($sql) === TRUE) {
            // If update successful, send email response if required
            // Fetch inquiry details including email address
            $inquiry_details_sql = "SELECT email FROM contact_us WHERE id = $inquiry_id";
            $inquiry_details_result = $conn->query($inquiry_details_sql);

            if ($inquiry_details_result->num_rows > 0) {
                $row = $inquiry_details_result->fetch_assoc();
                $to = $row['email']; // Recipient email address
                $subject = "Response to your inquiry";
                $message = "Your inquiry has been responded to. Here is the response:\n\n" . $response;

                // Set email content
                $mail->setFrom('your_email@gmail.com', 'Your Name');
                $mail->addAddress($to);
                $mail->Subject = $subject;
                $mail->Body = $message;

                // Send email
                try {
                    $mail->send();
                    echo "Response sent successfully to $to.";
                } catch (Exception $e) {
                    echo "Error sending email: {$mail->ErrorInfo}";
                }
            } else {
                echo "Inquiry details not found.";
            }
        } else {
            echo "Error updating record: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Missing inquiry ID or response.";
    }
} else {
    echo "Invalid request method.";
}
?>
