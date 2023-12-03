<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../cssFiles/modifierInfos.css">
   
</head>
<body>

<?php 

//$id_patient=$conn->insert_id;

$sql="SELECT * FROM patients WHERE id_patient=$id_patient";
$res=$conn->query($sql);
$row=$res->fetch_assoc();

$nom = $row['nom'];
$prenom = $row['prenom'];
$dateDeNaissance = $row['dateDeNaissance'];
$email = $row['email'];
$numtlp = $row['numtlp'];
$dateDeReservation=$row['dateDeReservation'];
$dateHospitalisation=$row['dateHospitalisation'];

$req="SELECT nom_hopital FROM hopitaux WHERE id_hopital=$id_hopital";
$res=$conn->query($req);
$row1=$res->fetch_assoc();
$nom_hopital = $row1['nom_hopital'];

$message = "
<html>
<head>
</head>
<body>
<h2>Fiche d'entrée à ".$nom_hopital." </h2>
<br>
<h4>Salut ".$nom . " ".$prenom."</h4>
<p>Votre réservation a été accepté , vérifier les informations ci-dessous : </p>
<br>
<label>Nom :</label> ".$nom."
<br>
<label>Prenom :</label> ".$prenom."
<br>
<label>Date de naissance :</label> ".$dateDeNaissance."
<br>
<label>Service affécté :</label> ".$nom_service."
<br>
<label>Demande envoyé à</label> ".$dateDeReservation."
<br>
<label>Date d'hospitalisation :</label> ".$dateHospitalisation."
<br>
<label>Code patient :</label> 2022".$id_patient."
<br>
<br>
<h3>Attention : cette piece avec la piece d'identité sont indisponsable pour les présenter au jour de votre hospitalisation</h3>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <hbmwebmaster@gmail.com>' . "\r\n";

$receiver = "$email";
$subject = "Acceptation de la demande de réservation";

if(mail($receiver, $subject, $message, $headers)){
?>
<div class="box">
<h3 id="message">Vous avez juste réservé un lit au patient! , un email contenant tous les informations nécessaire a été envoyé à l'addresse <a href="mailto:<?php echo $receiver ; ?>"><?php echo $receiver ; ?></a>pour permettre au patient admis d'entrer</h3>

<a href="hopital.php"><button class="btn" >Retourner à lacceuil</button></a><br><br> 

</div>

<?php

}else{
?>
<div class="box">
<h3 id="message">Impossible d'envoyer un mail au patient!, un probléme a été détecté</h3>

<a href="hopital.php"><button class="btn" >Retourner à lacceuil</button></a><br><br>
</div>
<?php

}?>

</body>
</html>


