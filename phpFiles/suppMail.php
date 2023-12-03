<?php

session_start();
include 'C:\xampp\htdocs\Project\phpFiles\dbConfiguration.php';


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
<?php
if (isset($_POST['validerSupp'])) {
  

if (isset($_SESSION['id_hopital'])) {
$id_hopital=$_SESSION["id_hopital"];
}

if (isset($_GET['id_patient'])) {
    $id_patient=$_GET['id_patient'];
}

$sql="SELECT * FROM patients WHERE id_patient=$id_patient";
$res=$conn->query($sql);
$row=$res->fetch_assoc();

$nom = $row['nom'];
$prenom = $row['prenom'];
$email = $row['email'];


$req="SELECT nom_hopital FROM hopitaux WHERE id_hopital=$id_hopital";
$res=$conn->query($req);
$row1=$res->fetch_assoc();
$nom_hopital = $row1['nom_hopital'];

$message = "
<html>
<head>
</head>
<body>
<h2>".$nom_hopital."</h2>
<br>
<h4>Salut ".$nom . " ".$prenom."<h4>
<br>
<br>
<p>Désolé de dire que votre demande de réservation a été refusé , savoir pourquoi ci-dessous : </p>
<br>
<label>Cause : </label>".$_POST['cause'].".
<br>
<br>
<h4>Merci</h4>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <hbmwebmaster@gmail.com>' . "\r\n";

$receiver = "$email";
$subject = "Refus de la demande de réservation";

if(mail($receiver, $subject, $message, $headers)){

?>
<div class="box">
<h3 id="message">Vous avez juste supprimé une demande du patient! , un email contenant la cause du refus a été envoyé à l'addresse <a href="mailto:<?php echo $receiver ; ?>"><?php echo $receiver ; ?></a> pour lui informer</h3>
<a id="button" href="hopital.php"><button class="btn">Retourner à lacceuil</button></a><br><br>
</div>
<?php


}else{ ?>
<div class="box">
<h3 id="message">Impossible d'envoyer un mail au patient!, un probléme a été détecté</h3>

<a href="hopital.php"><button class="btn" >Retourner à lacceuil</button></a><br><br>
</div>
<?php }

deleteRecord("patients","id_patient","$id_patient");
exit();
}


?>
<div class="box">
<h3>Validation de la suppression</h3>
<p>Saisir la cause du refus de la demande du patient sélectionné </p><br>
<label id="warning">* champ obligatoire</label><br><br>

<form action="" method="post" enctype="multipart/form-data">
    <label>Description de la cause</label><span>*</span><br><br>
    <textarea name="cause" placeholder="  Saisir la cause du refus ..." rows="6" cols="60" required></textarea><br>
    <p>Aprés valider la suppression un email sera transmettre au patient refusé pour lui informer 
    le refus de sa demande ainsi que la cause que vous venez de citer</p>
    <input type="submit" name="validerSupp" value="Valider la suppression" class="btn1">
    <br>
    <br>
</form>

</div>

    
</body>
</html>