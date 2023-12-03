<!DOCTYPE html>
<html lang="fr">
<head>
	<link rel="stylesheet" type="text/css" href="..\cssFiles\modifierInfos.css">
	<meta charset="utf-8">
	
	
</head>
<body>


<div class="box">
<h4>Remplir les coordonées suivants pour créer un nouveau compte hopital :</h4>
<br>
<label id="warning">* champ obligatoire</label>
<br>
<br>


<form action="dbConfiguration.php" method="post" enctype="multipart/form-data">


<label id="Nom">Nom de l'hopital</label><span>*</span>
<br>
<input type="txt" name="nom_hopital" placeholder="  Tapez le nom de ce nouveau hopital..." required size="35">
<br>
<br>

<label>Nom d'utilisateur du compte de l'hopital<span>*</span></label>
<br>
<input type="txt" name="username" placeholder="  Tapez le nom d'utilisateur de ce nouveau compte hopital ..." required size="35">
<br>
<br>
<label>Mot de pass du compte de l'hopital<span>*</span></label>
<br>
<input type="txt" name="prepassword" placeholder="  Tapez le mot de pass de ce nouveau compte hopital ..." required size="35">
<br>
<br>
<label> Confirmation du mot de pass<span>*</span></label>
<br>
<input type="txt" name="password" placeholder="  Confirmer le mot de pass de ce nouveau compte hopital ..." required size="35">
<br>
<br>
<p id="erreur">Données hopital existent déjà*</p>
<p id="erreur2">Mot de pass n'est pas bien confirmé*</p>

<input  class="btn" type="submit" name="submitHospitalData" value="Envoyer">
<input class="btn1" type="reset" name="reset" value="Réinitialiser">
<br>
<br>


</form>

</div>

</body>
</html>