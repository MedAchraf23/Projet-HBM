
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="..\cssFiles\controleur.css">

</head>
<body>

<?php 
include 'C:\xampp\htdocs\Project\phpFiles\dbConnection.php';

if (isset($_GET['id_hopital'])) {
  $id_hopital=$_GET['id_hopital'];

}


$sql="SELECT * FROM services WHERE id_hopital=$id_hopital";
$res=$conn->query($sql);
  if ($res->num_rows==0) {
    ?>
    <h2>Aucun service n'a été inséré.</h2>
    
    <?php
  }else{
    $nom_service=[];
  while($row=$res->fetch_assoc()){
    $nom_service[]=$row['nom_service'];
    $nbre_lit_tot[]=$row['nbre_lit_tot'];
  }

?>
<section id=hospitalslist>

<div class="container">
<h1>Liste des Services </h1>

<?php 
$i=0;
while ($i<count($nom_service)) {

?>

<button class="accordion"><?php echo $nom_service[$i] ;?></button>
<div class="details">
  <ul>
<h4>Nombre total des lits = <?php echo $nbre_lit_tot[$i] ; ?></h4>
<li><a href="dbConfiguration.php?id_hopital=<?php echo $id_hopital; ?>&nom_service=<?php echo $nom_service[$i];?>&source=suppService"><button type="button"  class="btn1" onclick="confirmation()">Supprimer service </button></a></li> <br>
<li><a href="modifierService.php?id_hopital=<?php echo $id_hopital; ?>&nom_service=<?php echo $nom_service[$i];?>"><button type="button"  class="btn">Modifier infos service</button></a></li>
 </ul> 
<br>
</div>
<?php
$i++; }
}

?>
<br>
<br>

<a  id="ajouter" href="ajouterService.php?id_hopital=<?php echo $id_hopital; ?>">+ AJOUTER NOUVEAU SERVICE</a>
<br>
<br>
<br>
<a  id="retourner" href="controleur.php">- Retourner à la page des hopitaux</a>

</form>



</section>







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
function confirmation() {
  alert("est-ce que tu valides l'opération ?");
}


</script>

</body>
</html>