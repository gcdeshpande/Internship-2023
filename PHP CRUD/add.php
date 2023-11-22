<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connection parameters
    $servername = "localhost"; // usually localhost
    $username = "root";
    $password = "";
    $dbname = "rcd";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

// Set parameters and execute
$firstname = $_POST['fname'];
$lastname = $_POST['lname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$marks1 = $_POST['marks1'];
$marks2 = $_POST['marks2'];
$marks3 = $_POST['marks3'];
$marks4 = $_POST['marks4'];

    $emailQuery = "SELECT email FROM student_information WHERE email = '$email'";
    $emailResult = $conn->query($emailQuery);

    if ($emailResult->num_rows > 0) {
        echo "This email is already registered.";
    } else {
        // Check if phone number exists
        $phoneQuery = "SELECT phone_number FROM student_information WHERE phone_number = '$phone'";
        $phoneResult = $conn->query($phoneQuery);

        if ($phoneResult->num_rows > 0) {
            echo "This phone number is already registered.";
        } else {

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO student_information (first_name, last_name, email, phone_number, marks_subject1, marks_subject2, marks_subject3, marks_subject4) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiiii", $firstname, $lastname, $email, $phone, $marks1, $marks2, $marks3, $marks4);

    

    $stmt->execute();
    
    
    echo "New records created successfully";
        
    
        
    $stmt->close();
        }
    }
    $conn->close();
}
?>
