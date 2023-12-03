<?php 
include 'C:\xampp\htdocs\Project\phpFiles\dbConnection.php';

if (isset($_GET['id_hopital'])) {
    $id_hopital=$_GET['id_hopital'];
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<link rel="stylesheet" type="text/css" href="..\cssFiles\modifierInfos.css">
	<meta charset="utf-8">
	
	
</head>
<body>


<div class="box">
<h4>Ajouter les donnés du service :</h4>
<br>
<label id="warning">* champ obligatoire</label>
<br>
<br>


<form action="dbConfiguration.php" method="post" enctype="multipart/form-data">

<input type="hidden" name="id_hopital" value="<?php echo $id_hopital ; ?>">
<label id="Nom">Nom du service </label><span>*</span>
<br>
<input type="txt" name="nom_service" placeholder="  Tapez le nouveau nom du service ..." required size="35">
<br>
<br>
<label id="Nom">Nombre de lits </label><span>*</span>
<br>
<input type="number" name="nbre_lit_tot" placeholder="  Tapez le nombre de lits ..." min="0" required size="5">
<br>
<br>
<p id="erreur">Service existe déjà*</p>
<br>
<input  class="btn" type="submit" name="submitServiceData" value="Enregistrer">
<input class="btn1" type="reset" name="reset" value="Réinitialiser">
<br>
<br>


</form>

</div>

</body>
</html>