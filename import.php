<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "impexp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM register";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Data Exported Succesfully";
  // output data of each row
$file = fopen("contacts.csv","w");

foreach ($result as $line) {
  fputcsv($file, $line);
}

fclose($file);
  
} else {
  echo "Error Occured";
}
$conn->close();
?>