<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sa";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO studentinfo (studentname, department, roll, gpa)
VALUES ('hasan', 'eee', 4567,  4.5)";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>