<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the input data from the form
    $student_id = $_POST['student_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $marks1 = $_POST['marks1'];
    $marks2 = $_POST['marks2'];
    $marks3 = $_POST['marks3'];
    $marks4 = $_POST['marks4'];

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gcd";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL to update a record
    $sql = "UPDATE student_information SET first_name=?, last_name=?, email=?, phone_number=?, marks_subject1=?, marks_subject2=?, marks_subject3=?, marks_subject4=? WHERE id=?";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ssssiiiii", $fname, $lname, $email, $phone, $marks1, $marks2, $marks3, $marks4, $student_id);

    // Execute the query
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Record updated successfully";
    } else {
        echo "No record found with ID: $student_id or no changes made.";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
