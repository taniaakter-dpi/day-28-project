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
  <p>Try to submit the form.</p>



  <?php
// define variables and set to empty values
$nameErr = $departmentErr = $rollErr = $gpaErr = "";
$name = $department = $roll = $gpa = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["department"])) {
    $departmentErr = "Department is required";
  } else {
      $department = $_POST["department"];
  }
    
  if (empty($_POST["roll"])) {
    $rollErr = "Roll is required";
  } else {
    if(!is_numeric($_POST["roll"])){
        $rollErr = "Roll must be number";
    }else{
        $roll = (int)$_POST["roll"];
    }
  }

  if (empty($_POST["gpa"])) {
    $gpaErr = "GPA is required";
  } else {
    if(!is_numeric($_POST["gpa"])){
        $rollErr = "GPA must be number";
    }else{
        $gpa = $_POST["gpa"];
    }
  }


// data insert in database
if($nameErr == "" AND $departmentErr == "" AND $rollErr == "" AND $gpaErr == ""){
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
    VALUES ('$name', '$department', '$roll', '$gpa')";

    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    }
}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


  <form action="/day-28-project/index.php" class="was-validated" method="post">
    <div class="mb-3 mt-3">
      <label for="name" class="form-label">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name" required value="<?php echo $name; ?>">
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="mb-3 mt-3">
      <label for="department" class="form-label">Department:</label>
      <select class="form-select" id="department" name="department">
        <option value="CSE">CSE</option>
        <option value="ETE">ETE</option>
        <option value="EEE">EEE</option>
        <option value="CIVIL">CIVIL</option>
      </select>
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="mb-3 mt-3">
      <label for="roll" class="form-label">Roll:</label>
      <input type="number" class="form-control" id="roll" placeholder="Enter your roll number" name="roll" required value="<?php echo $roll; ?>">
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="mb-3 mt-3">
      <label for="gpa" class="form-label">GPA:</label>
      <input type="text" class="form-control" id="gpa" placeholder="Enter your GPA" name="gpa" required value="<?php echo $gpa; ?>">
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</body>
</html>
