<!DOCTYPE html>
<html>
<head>
    <title>Student Records with Grades</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Student Records with Grades</h2>

<?php
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

// SQL query to fetch data from student_information table
$sql = "SELECT first_name, last_name, email, phone_number, marks_subject1, marks_subject2, marks_subject3, marks_subject4 FROM student_information";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Start table
    echo "<table><tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone Number</th><th>Marks Subject 1</th><th>Marks Subject 2</th><th>Marks Subject 3</th><th>Marks Subject 4</th><th>Total Marks</th><th>Percentage</th><th>Grade</th></tr>";

    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $totalMarks = $row["marks_subject1"] + $row["marks_subject2"] + $row["marks_subject3"] + $row["marks_subject4"];
        $percentage = $totalMarks / 4.0;
        $grade = getGrade($percentage);

        echo "<tr><td>" . $row["first_name"]. "</td><td>" . $row["last_name"]. "</td><td>" . $row["email"]. "</td><td>" . $row["phone_number"]. "</td><td>" . $row["marks_subject1"]. "</td><td>" . $row["marks_subject2"]. "</td><td>" . $row["marks_subject3"]. "</td><td>" . $row["marks_subject4"]. "</td><td>" . $totalMarks . "</td><td>" . $percentage . "%</td><td>" . $grade . "</td></tr>";
    }

    // End table
    echo "</table>";
} else {
    echo "0 results";
}

// Function to determine grade based on percentage
function getGrade($percentage) {
    if ($percentage >= 90) return 'A';
    if ($percentage >= 80) return 'B';
    if ($percentage >= 70) return 'C';
    if ($percentage >= 60) return 'D';
    return 'F';
}

$conn->close();
?>

</body>
</html>
