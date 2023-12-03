
<?php 
session_start();
include 'C:\xampp\htdocs\Project\phpFiles\dbConnection.php';

 $username=$_POST['uname'];
 $password=$_POST['psw'];
 
 $sql = "SELECT id_hopital  FROM hopitaux WHERE username='$username' AND password='$password' ";
 if($conn->query($sql)==true){
 
   $res= $conn->query($sql);

   if ($res->num_rows>0) {

    $row=$res->fetch_assoc();
    $id_hopital = $row['id_hopital'];
    $_SESSION["id_hopital"]=$id_hopital;
    header("Location: /Project/phpFiles/hopital.php");
    die;

   }else {
     if ($username=='controleur' && $password=='controleur') {
       header("Location: /Project/phpFiles/controleur.php");
     }else{
      include 'C:\xampp\htdocs\Project\phpFiles\login.php';
      
     }
  ?>
  <script>
  document.getElementById('erreur').style.display="block";
  </script> 
  <?php
  }
   
}else {
   echo "Error" . $conn->error;
 } 
?>