<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
<?php  
include 'C:\xampp\htdocs\Project\phpFiles\dbConnection.php';

$sql="SELECT id_hopital , nom_hopital from hopitaux ";
$sql1="SELECT max(id_hopital) as max_id_hopital from hopitaux ";


if ($conn->query($sql)==true&&$conn->query($sql1)==true) {

  $res=$conn->query($sql);
  while($row=$res->fetch_assoc()){
    
    $id_hopital[]= $row['id_hopital'] ;
    //echo $row['nom_hopital'] ;     
    
    }

    echo $id_hopital[1];
/*
    $res1=$conn->query($sql1);
    $row1=$res1->fetch_assoc();
    echo $row1['max_id_hopital'] ;*/
    
}else {
  echo"error";
}




?>
<a href=".php">h</a>
<a href=".php">h</a>

</body>
</html>

