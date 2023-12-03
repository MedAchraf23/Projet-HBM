<?php 
session_start();
include 'C:\xampp\htdocs\Project\phpFiles\dbConnection.php' ;

$id_hopital=$_SESSION["id_hopital"];



//======= Récupération de la var source pour la passer au configurationlit pour générer la page résultante
//======= aprés presser sur réserver lit

if (isset($_GET['source'])) {
  $source=$_GET['source'];
}

if (isset($_POST['source'])) {
  $source=$_POST['source'];
}


if (isset($_GET['id_patient'])) {
  $id_patient=$_GET['id_patient'];
}


$sql="SELECT * FROM services WHERE id_hopital=$id_hopital " ;
$sql2="SELECT count(nom_service) as nombre_services  FROM services WHERE id_hopital=$id_hopital " ;
 if($conn->query($sql)==true&&$conn->query($sql2)==true){
 
$res=$conn->query($sql);

 while($row=$res->fetch_assoc()){
  
 $nom_service[]=$row['nom_service'];
 $occ[]=$row['nbre_lit_occ'] ;
 $vac[]=$row['nbre_lit_vac'] ;
 $tot[]=$row['nbre_lit_tot'] ;
 }
 $res2=$conn->query($sql2);
 $row2=$res2->fetch_assoc();
 $nombre_services=$row2['nombre_services'];

  } else {
  echo "Error " . $conn->error;
}

$i=0;
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="..\cssFiles\controleur.css">
<meta name="viewport" content="width=device-width, initial-scale=1">


</head>

<body>

<!-- on affiche la liste des services sans formulaire et buttons si on a déjà réservé un lit (source=refreshPage) -->

<?php
if ($source=="refreshPage") { ?>

<section id="hospitalslist">

<div class="container">

<h1>Liste des services à choisir</h1>

<?php

 while ($i < $nombre_services) { ?>

<button class="accordion"  ><?php echo $nom_service[$i] ; ?></button>
<div class="details">
<h4>
Lits occupés = <?php echo $occ[$i] ;?>  <br><br>
Lits vacants = <?php echo $vac[$i] ;?> <br><br>
Total = <?php echo $tot[$i] ;?> 

</h4>
</div>

<?php
$i++; }?>
<h3 style="color:green">Actualité! un lit a été bien réservé au patient choisi!</h3>
<br>
<a  id="retourner" href="hopital.php">- Retourner à la page princpale </a>
</div>
</section>

<!-- on affiche la liste des services avec la possiblité de réserver un lit si la source était (admision ou e-admission) -->

<?php }else { ?>

<section id="hospitalslist">

<div class="container">

<h1>Liste des services à choisir</h1>

<?php

 while ($i < $nombre_services) { ?>

<button class="accordion"  ><?php echo $nom_service[$i] ; ?></button>
<div class="details">
<h4>
Lits occupés = <?php echo $occ[$i] ;?>  <br><br>
Lits vacants = <?php echo $vac[$i] ;?> <br><br>
Total = <?php echo $tot[$i] ;?> 

</h4>

<form action="configurationLit.php" method=post>


  <input type="hidden" name="source" value="<?php echo $source ; ?>" >
  <input type="hidden" name="id_hopital" value="<?php echo $id_hopital ; ?>" >
  <input type="hidden" name="nom_service" value="<?php echo $nom_service[$i] ; ?>" >
  <input type="hidden" name="occ" value="<?php echo $occ[$i] ; ?>" >
  <input type="hidden" name="vac" value="<?php echo $vac[$i] ; ?>" >
  <input type="hidden" name="tot" value="<?php echo $tot[$i] ; ?>" >
  <input type="hidden" name="id_patient" value="<?php echo $id_patient ; ?>" >

<?php 

if ($source=="admission") { ?>

  <input type="hidden" name="nom" value="<?php echo $_POST['nom'] ; ?>" >
    <input type="hidden" name="prenom" value="<?php echo $_POST['prenom'] ; ?>" >
    <input type="hidden" name="dateDeNaissance" value="<?php echo $_POST['dateDeNaissance'] ; ?>" >
    <input type="hidden" name="sexe" value="<?php echo $_POST['sexe'] ; ?>" >
    <input type="hidden" name="email" value="<?php echo $_POST['email'] ; ?>" >
    <input type="hidden" name="numtlp" value="<?php echo $_POST['numtlp'] ; ?>" >
  
<?php 
}
?>  

    <ul>
    <li><input  type="submit" name="reserverLit" value="Réserver un lit" class="btn" id="reserverLit"></li>
    </ul>

</form>
</div>

<?php 
$i++; }
?>

<br>
<a  id="retourner" href="hopital.php">- Retourner à la page princpale </a>

</div>
</section>
  

<?php } ?>


<script>
   var acc = document.getElementsByClassName("accordion");
   var i;
   
   for (i = 0; i < acc.length; i++) {
     acc[i].addEventListener("click", function() {
       this.classList.toggle("active");
       var details = this.nextElementSibling;
       if (details.style.maxHeight) {
         details.style.maxHeight = null;
       } else {
         details.style.maxHeight = details.scrollHeight + "px";
       } 
     });
   }
   </script>





</body>
</html>

