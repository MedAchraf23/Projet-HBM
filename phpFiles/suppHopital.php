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
<h3>Validation de la suppression</h3>
<p></p><br>
<label id="warning">Attention! Cette opération va supprimer toutes 
    les données d'<?php echo $row['nom_hopital'];?> avec ses services et ses fonctionnalités! </label><br><br>

<label>Est-ce que vous étes sur d'accomplir la suppression d'<?php echo $row['nom_hopital'];?> ! </label><br><br>
<a href="dbConfiguration.php?id_hopital='<?php echo $id_hopital ;?>'&source=suppHopital"><button  class="btn1" type="button" >Valider la suppression</button></a>
<a href="controleur.php?source=suppHopital"><button  class="btn" type="button" >Quitter</button></a>
<br><br>
</div>
    

</body>
</html>