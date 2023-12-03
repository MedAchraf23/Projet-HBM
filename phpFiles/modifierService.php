<?php
include 'C:\xampp\htdocs\Project\phpFiles\dbConnection.php';

if (isset($_GET['id_hopital'])&&isset($_GET['nom_service'])) {
    $id_hopital=$_GET['id_hopital'];
    $current_nom_service=$_GET['nom_service'];
  
  }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../cssFiles/modifierInfos.css">
    
    
</head>
<body>




<div class="box">

<p id="erreur">Service existent déjà*</p>

<h4>Modifier nom du service sélectionné :</h4>
<label id="warning">* champ obligatoire</label>
<br>
<br>

<form action="dbConfiguration.php" method="post" enctype="multipart/form-data">

<input type="hidden" name="id_hopital" value="<?php echo $id_hopital ;?>">
<input type="hidden" name="current_nom_service" value="<?php echo $current_nom_service ;?>">

<label id="Nom">Nouveau nom du service</label>
<br>
<input type="txt" name="nom_service" placeholder="  Tapez le nom du service..." required size="35">
<input  class="btn" type="submit" name="modifyServiceData" value="Modifier">
</form>
<br>
<br>
</div>
</body>
</html>  


