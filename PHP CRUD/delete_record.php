<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the student ID from the form
    $student_id = isset($_POST['student_id']) ? intval($_POST['student_id']) : 0;

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

    // SQL to delete a record
    $sql = "DELETE FROM student_information WHERE id = ?";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("i", $student_id);

    // Execute the query
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Record deleted successfully";
    } else {
        echo "No record found with ID: $student_id";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
