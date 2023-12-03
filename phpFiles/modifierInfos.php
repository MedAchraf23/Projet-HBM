<?php 
include 'C:\xampp\htdocs\Project\phpFiles\dbConnection.php';

if(isset($_GET['id_hopital'])){
  $id_hopital=$_GET['id_hopital'];
}


$sql="SELECT * FROM hopitaux WHERE id_hopital=$id_hopital";
$res=$conn->query($sql);
  while($row=$res->fetch_assoc()){
    $nom_hopital=$row['nom_hopital'];
    $username=$row['username'];
    $password=$row['password'];
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

<div id="formulaire">


<div class="box">

<div class="data">

<h3>Coordonnées actuelles de <?php echo $nom_hopital ;?>:</h3>
<label>Nom hopital : </label><?php echo $nom_hopital ;?>.<br>
<label>Nom d'utilisateur du compte : </label><?php echo $username ;?><br>
<label>Mot de pass du compte : </label><?php echo $password ;?>
<br><br><br>

</div>
<p id="erreur">Données hopital existent déjà*</p>

<h4>Insérer les nouveaux coordonnées ici  :</h4>
<label id="warning">* champ obligatoire</label>
<br>
<br>

<form action="dbConfiguration.php" method="post" enctype="multipart/form-data">


<input type="hidden" name="id_hopital" value="<?php echo $id_hopital ;?>">
<label id="Nom">Nouveau nom de l'hopital</label>
<br>
<input type="txt" name="nom_hopital" placeholder="  Tapez le nom de ce nouveau hopital..." required size="35">
<input  class="btn" type="submit" name="modifyHospitalName" value="Modifier">
</form>

<br>

<form action="dbConfiguration.php" method="post" enctype="multipart/form-data">

<input type="hidden" name="id_hopital" value="<?php echo $id_hopital ;?>">
<label>Nouveau nom d'utilisateur du compte de l'hopital</label>
<br>
<input type="txt" name="username" placeholder="  Tapez le nom d'utilisateur de ce nouveau compte hopital ..." required size="35">
<input  class="btn" type="submit" name="modifyHospitalUname" value="Modifier">
</form>

<br>

<form action="dbConfiguration.php" method="post" enctype="multipart/form-data">

<input type="hidden" name="id_hopital" value="<?php echo $id_hopital ;?>">
<label>Nouveau mot de pass du compte de l'hopital</label>
<br>
<br>
<input type="password" name="prepassword" placeholder="  Tapez le mot de pass de ce nouveau compte hopital ..." required size="35">
<br>
<br>
<label> Confirmation du mot de pass<span>*</span></label>
<br>
<input type="password" name="password" placeholder="  Confirmer le mot de pass de ce nouveau compte hopital ..." required size="35">
<input  class="btn" type="submit" name="modifyHospitalPsw" value="Modifier">
<br>

<p id="erreur2">Mot de pass n'est pas bien confirmé</p>
</form>
<br>


<a href="controleur.php">- Retourner à la page des hopitaux</a>
<br>
<br>
   
</div>
</div>


</body>
</html>