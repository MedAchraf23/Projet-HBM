<?php 
include 'C:\xampp\htdocs\Project\phpFiles\dbConnection.php';


$sql="SELECT id_hopital , nom_hopital from hopitaux ";

if ($conn->query($sql)==true) {

  $res=$conn->query($sql);
  while($row=$res->fetch_assoc()){
    $id_hopital[]=$row['id_hopital'] ;
    $nom_hopital[]=$row['nom_hopital'] ;     
    
    }
    
}else {
  echo"error";
}

?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../cssFiles/controleur.css">

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


<section id=hospitalslist>

<div class="container">
<h1>Liste des Hôpitaux Universitaires </h1>
<?php 

if (isset($id_hopital)) {
$i=0;

while ($i < count($id_hopital)) {
  //Cette requete et condition verifie est ce que un hopital a des services ou pas , si oui elle l'affiche 
  //en accueil  sinon l'hopital sera supprimé 
  $sql1="SELECT * FROM services WHERE id_hopital=$id_hopital[$i]";
	$res1=$conn->query($sql1);
	if ($res1->num_rows>0) {
		
?>

<button class="accordion"  ><?php echo $nom_hopital[$i] ; ?></button>
<div class="details">
  
<ul>
<li><a id="supprimerhop" href="verification.php?id_hopital=<?php echo $id_hopital[$i] ;?>&target=suppression">Supprimer compte hopital</a></li> 
<li><a id="modifierhop" href="verification.php?id_hopital=<?php echo $id_hopital[$i] ;?>&target=modification">Modifier les coordodnées du compte hopital</a></li>
<li><a id="gerersvchop" href="verification.php?id_hopital=<?php echo $id_hopital[$i] ;?>&target=services">Gérer les services du compte hopital</a></li> <br>
<br>
</ul>
</div>
<?php 
  }else {
    $sql2 = "DELETE FROM hopitaux WHERE id_hopital=$id_hopital[$i]";
		$conn->query($sql2);
  }

$i++;
}
}else {
  echo "Aucun hopital est inséré dans le systéme";
}
?>

<br>
<br>
<br><br><br>
<a id="ajouter" href="formulaireHopital.php">+ AJOUTER COMPTE HOPITAL</a>


</div>

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
   </script>


<script>
  /*
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

function confirmation() {
  alert("est-ce que tu valides l'opération ?");
}
*/
</script>


</body>
</html>