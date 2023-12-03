<!DOCTYPE html>
<html lang="en">

<body>
    
<?php

include 'C:\xampp\htdocs\Project\phpFiles\dbConnection.php';

if (isset($_GET['id_patient'])) {

$id_patient= $_GET['id_patient'];

echo $id_patient;
// sql to delete a record
$sql = "DELETE FROM patients WHERE id_patient=$id_patient";

if ($conn->query($sql) === TRUE) {
  header("Location: /Project/phpFiles/hopital.php");
  die;
} else {
  echo "Error deleting record: " . $conn->error;
}

}
$conn->close();


?>
</body>
</html>


         