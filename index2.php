<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <h3>IIST University Admission form</h3>
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

$sql = "SELECT studentname, department, roll, gpa FROM studentinfo";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  echo '<table class="table">
  <thead>
    <tr>
      <th>student name</th>
      <th>department</th>
      <th>roll</th>
      <th>gpa</th>
    </tr>
  </thead>
  <tbody>';
  while($row = $result->fetch_assoc()) {
      echo '<tr>
        <td>'.$row["studentname"].'</td>
        <td>'.$row["department"].'</td>
        <td>'.$row["roll"].'</td>
        <td>'.$row["gpa"].'</td>
      </tr>';
  }
  echo '</tbody>
  </table>';
} else {
  echo "0 results";
}
$conn->close();
?>

</body>
</html>
