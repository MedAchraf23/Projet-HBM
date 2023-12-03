<?php 
session_start();
 include 'C:\xampp\htdocs\Project\phpFiles\dbConnection.php';

$id_hopital= $_SESSION["id_hopital"];

$sql1="SELECT nom_hopital  FROM hopitaux WHERE id_hopital=$id_hopital " ;

$sql="SELECT * FROM services WHERE id_hopital=$id_hopital " ;

//requete pour la table des patients en attente
$req = "SELECT * FROM patients where id_hopital=$id_hopital";
$result = $conn->query($req);

    if (!$result) {
die("Invalid query:".$conn->error);
}
//requete pour les patients admis
$req1 = "SELECT * FROM patients_admis where id_hopital=$id_hopital";
$result1 = $conn->query($req1);

    if (!$result1) {
die("Invalid query:".$conn->error);
}

 if($conn->query($sql)==true&&$conn->query($sql1)==true){
  $res1=$conn->query($sql1);
  $row1=$res1->fetch_assoc();
  $nom_hopital=$row1['nom_hopital'];

 $res=$conn->query($sql);
 while($row=$res->fetch_assoc()){

 $nom_service[]=$row['nom_service'];
 $occ[]=$row['nbre_lit_occ'] ;
 $vac[]=$row['nbre_lit_vac'] ;
 $tot[]=$row['nbre_lit_tot'] ;
 }
 

  } else {
  echo "Error".$conn->error;
}

$i=0;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<link rel="stylesheet" type="text/css" href="../cssFiles/hopital.css">

<meta name="viewport" content="width=device-width, initial-scale=1">

<style>



</style>

</head>
<body>

<header id="home">
        <div class="container">
           <div id="logo">
          <h1><a href="#home"><span id="Hlogo">H</span>BM</a></h1>
          </div>
          <nav>
            <ul>
          <li><a href="login.php">DECONNEXION</a></li>
          </ul>
           </nav> 
          

       </div>
       </header>
<br><br>
<section id="notheader"></section>
<h1 id="pageTitle"><?php echo $nom_hopital ; ?></h1>
      


<button class="tablink" onclick="openPage('Gestion-Patients-attente', this, 'rgb(84, 124, 156)')" >Gestion des patients en attente </button>
<button class="tablink" onclick="openPage('Gestion-Patients-admis', this, 'rgb(84, 124, 156)')" >Gestion des patients admis</button>
<button class="tablink" onclick="openPage('Gestion-des-lits', this, 'rgb(84, 124, 156)')" id="defaultOpen"   >Gestion des lits </button>
<button class="tablink" onclick="openPage('Admission', this, 'rgb(84, 124, 156)')">+Admission</button>


<div id="Gestion-Patients-attente" class="tabcontent">  


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
</head>
<body style="margin: 50px;">

<?php
if ($result->num_rows>0) {
?>

    <h2>Liste des patients</h2>
    <br>
    <table class="table">
        <thead>
			<tr>
				<th>ID</th>
				<th>Nom</th>
				<th>Prénom</th>
				<th>date de naissance</th>
				<th>Sexe</th>
				<th>Email</th>
				<th>Téléphone</th>
        <th>date de réservation</th>
        <th>date d'hospitalisation</th>
        <th>Dossier médical</th>
        <th>Opération</th>
        
			</tr>
		</thead>

        <tbody>
        <?php
              
            // read data of each row

while($row = $result->fetch_assoc()) { ?>
  <tr>
  <td><?php echo $row["id_patient"]; ?> </td>
  <td><?php echo $row["nom"] ; ?></td>
  <td><?php echo $row["prenom"] ; ?></td>
  <td><?php echo $row["dateDeNaissance"] ; ?></td>
  <td><?php echo $row["sexe"]; ?></td>
  <td><?php echo $row["email"]; ?></td>
  <td><?php echo $row["numtlp"]; ?></td>
  <td><?php echo $row["dateDeReservation"]; ?></td>
  <td><?php echo $row["dateHospitalisation"]; ?></td>
  <td><a href="../files/<?php echo $row["dossierMed"] ;?> " target="_blank" ><?php echo $row["dossierMed"]; ?></a></td>
  <td><a href="reserverlit.php?id_patient=<?php echo $row['id_patient']; ?>&source=e-admission"><button type='button'   class='btn1'>Approuver</button><a><br>
  <a href="suppMail.php?id_patient=<?php echo $row['id_patient']; ?>"><button type='button' onclick='confirmation()'  class='btn'>Supprimer</button></a></td>  
   
</tr>
<?php }

}else {  ?>

<h2>Aucune demande réçu</h2>
  
<?php  }
      
            ?>
        </tbody>
    </table>


</body>
</html>



</div>



<div id="Gestion-Patients-admis" class="tabcontent">  


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
</head>
<body style="margin: 50px;">

<?php
if ($result1->num_rows>0) {
?>

    <h2>Liste des patients</h2>
    <br>
  
    <table class="table">
        <thead>
			<tr>
				<th>ID</th>
				<th>Nom</th>
				<th>Prénom</th>
				<th>date de naissance</th>
				<th>Sexe</th>
				<th>Email</th>
				<th>Téléphone</th>
        <th>date de réservation</th>
        <th>date d'hospitalisation</th>
        <th>Service affecté</th>
        <th>Opération</th>
			</tr>
		</thead>

        <tbody>
        <?php


              
            // read data of each row

while($row = $result1->fetch_assoc()) { ?>
  <tr>
  <td><?php echo $row["id_patient"]; ?> </td>
  <td><?php echo $row["nom"] ; ?></td>
  <td><?php echo $row["prenom"] ; ?></td>
  <td><?php echo $row["dateDeNaissance"] ; ?></td>
  <td><?php echo $row["sexe"]; ?></td>
  <td><?php echo $row["email"]; ?></td>
  <td><?php echo $row["numtlp"]; ?></td>
  <td><?php echo $row["dateDeReservation"]; ?></td>
  <td><?php echo $row["dateHospitalisation"]; ?></td>
  <td><?php echo $row["service"]; ?></td>

<form action="configurationLit.php" method=post>
<input type="hidden" name="id_patient" value="<?php echo $row['id_patient']; ?>" >
<input type="hidden" name="id_hopital" value="<?php echo $id_hopital ; ?>" >
<input type="hidden" name="nom_service" value="<?php echo $row["service"]; ; ?>" >


<td><input type="submit" name="libererLit" value="Supprimer" class="btn" onclick="confirmation()"></td>
</form>
   
</tr>
<?php $i++;}

} else { ?>

  <h2>Aucun patient n'est hospitalisé</h2>

<?php }
      
            ?>
        </tbody>
    </table>
</body>
</html>


</div>




<div id="Gestion-des-lits" class="tabcontent">
  
  <!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
 

</style>
</head>

<body>


<h2>Liste des services</h2>

<!-- service generale -->
<?php 
$i=0;
while ($i < count($nom_service)) { ?>

  <button class="accordion"><?php echo $nom_service[$i] ;?></button>
<div class="panel">
<h4>
Nombre de lits occupés = <?php echo $occ[$i] ; ?>  <br><br>
Nombre de lits vacants = <?php echo $vac[$i] ; ?>  <br><br>
Nombre total de lits = <?php echo $tot[$i] ; ?> 
</h4>

<form action="configurationLit.php" method=post>
<input type="hidden" name="id_hopital" value="<?php echo $id_hopital ; ?>" >
<input type="hidden" name="nom_service" value="<?php echo $nom_service[$i] ; ?>" >
<input type="hidden" name="occ" value="<?php echo $occ[$i] ; ?>" >
<input type="hidden" name="vac" value="<?php echo $vac[$i] ; ?>" >
<input type="hidden" name="tot" value="<?php echo $tot[$i] ; ?>" >


<input type="submit" name="ajouterLit" value="Ajouter un lit" class="btn1" onclick="confirmation()">
<br>
<!--
<br>
<input type="submit" name="libererLit" value="libérer un lit" class="btn1" onclick="confirmation()">
<br>
-->
<br>
<input type="submit" name="supprimerLit" value="Supprimer un lit" class="btn" onclick="confirmation()">

</form>

</div>
  
<?php 
$i++ ; }

?>

<script>
    //script des accordions pour les services
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>

</body>
</html>

</div>


<div id="Admission" class="tabcontent">

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Document</title>
<style>

</style>

    </head>
    <body>
        <div class=formulaireAdmission>

<h3>Veuillez remplir les informations du patient </h3>

<form action="reserverlit.php" method="post" enctype="multipart/form-data">

<input type="hidden" name="source" value="admission" >
<input type="hidden" name="id_hopital" value="<?php echo $id_hopital ; ?>" >


<label id="Nom">Nom</label><span>*</span>
<br>
<input type="txt" name="nom" placeholder="  Nom..." required size="35">
<br>
<br>
<label>Prénom<span>*</span></label>
<br>
<input type="txt" name="prenom" placeholder="  Prénom..." required size="35">
<br>
<br>
<label>Date de naissance <span>*</span></label>
<input type="Date" name="dateDeNaissance" required>
<br>
<br>
<label>Sexe<span>*</span></label>
<br>

<input type="radio" name="sexe" value="homme" required>Homme

<input type="radio" name="sexe" value="femme" required>Femme
<br>
<br>
<label>Addresse mail<span>*</span></label>
<br>
<input type="email" name="email" placeholder="  someone@exemple.com" required size="35">
<br>
<br>
<label>Numéro de téléphone<span>*</span></label>
<br>
<input type="tel" name="numtlp" placeholder=" XX-XX-XX-XX" pattern="[0-9]{10}" required size="35">

<br>
<br>

<input  class="btn1" type="submit" name="submit" value="Envoyer">
<input class="btn" type="reset" name="reset" value="Réinitialiser">
<br>
</div>
        
    </body>
    </html>

</div>

</section>
<script>
    //javascript pour les tablinks

function openPage(pageName,elmnt,color) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(pageName).style.display = "block";
  elmnt.style.backgroundColor = color;
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>

<!--<script>
function confirmation() {
  alert("est-ce que tu valides l'opération ?");
}

</script>
-->
<script>
function confirmation() {
  alert("est-ce que tu valides l'opération ?");
}

</script>


</body>
</html>