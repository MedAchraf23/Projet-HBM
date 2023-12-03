<!DOCTYPE html>
<html lang="fr">
<head>
	<link rel="stylesheet" type="text/css" href="..\cssFiles\formulaireStyle.css">
	<meta charset="utf-8">
	
	
</head>
<body>


<div class="box">


<?php 

if (!isset($_GET['goal'])) {
	


$id_hopital=$_GET['id_hopital'];

$today=date('y:m:d');
$maxDay=date('Y-m-d', strtotime($today. ' + 3 days'));

?>

<h4>Remplir les coordonées suivants pour réserver un lit :</h4>
<label id="warning">* champ obligatoire</label>
<br>
<br>

<form action="dbConfiguration.php" method="post" enctype="multipart/form-data">

<input type="hidden" name="id_hopital" value="<?php echo $id_hopital ;  ?>">

<label id="Nom">Nom</label><span>*</span>
<br>
<input type="txt" name="nom" placeholder="  Tapez votre nom..." required size="35">
<br>
<br>
<label>Prénom<span>*</span></label>
<br>
<input type="txt" name="prenom" placeholder="  Tapez votre prénom..." required size="35">
<br>
<br>
<label>Date de naissance <span>*</span></label>
<input type="Date" name="dateDeNaissance" required>
<br>
<br>
<label>Sexe<span>*</span></label>
<br>
<label>Homme</label>
<input type="radio" name="sexe" required value="homme">
<label>Femme</label>
<input type="radio" name="sexe"required value="femme">
<br>
<br>
<label>Addresse Email<span>*</span></label>
<br>
<input type="email" name="email" placeholder="  someone@exemple.com" required size="35">
<br>
<br>
<label>Numéro de téléphone<span>*</span></label>
<br>
<input type="tel" name="numtlp" placeholder=" XX-XX-XX-XX" pattern="[0-9]{10}" required size="35">
<br>
<br>
<label>Date d'hospitalisation <span>*</span></label>
<br>
<input type="Date" name="dateHospitalisation" min="<?php echo $today ;?>" max="<?php echo $maxDay ;?>" required>
<br>
<br>
<label>Dossier médicale<span>*</span></label>
<br>
<input type="file" name="dossierMed">
<br>
<br>


<input  class="btn" type="submit" name="submitPatientData" value="Envoyer">
<input class="btn1" type="reset" name="reset" value="Réinitialiser">
<br>
<br>


</form>


<?php 
}else {
	if ($_GET['goal']=="demandDone") {?>
		
<label>Demande bien envoyé. vous recevrez un message sur votre adresse e-mail vous indiquant si vous avez été accepté ou non dans les prochaines heures.</label><br><br>
<a href="accueil.php">Cliquer ici pour revenir à l'accueil</a>
<br><br><br><br><br>

	<?php }
	
	if ($_GET['goal']=="demandNotDone") { ?>

<label> Demande échoué! impossible d'envoyer votre deamande un probléme a été détecté!</label><br><br>
<a href="accueil.php">Cliquer ici pour revenir à l'accueil</a>
<br><br><br><br><br>
	<?php }
}
?>
</div>

</body>
</html>