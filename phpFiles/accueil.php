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
<html lang="fr">
<head>
    <link rel="stylesheet" type="text/css" href="..\cssFiles\accueilStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>

    <header id="home">
        <div class="container">
           <div id="logo">
          <h1><a href="#home"><span id="Hlogo">H</span>BM</a></h1>
           </div>  
          <nav>
             <ul>
                <li><a href="#home">ACCEUIL</a></li>
                <li><a href="#about">À PROPOS</a></li>
                <li><a href="#contact">CONTACTEZ-NOUS</a></li>
                <li><a href="login.php">S'AUTHENTIFIER</a></li>
   
             </ul>
          </nav>

       </div>
       </header>

    <section id="showcase">
        <div class="container">
        <h6>HEALTH CARE</h6>
         <h1>Nous sommes là pour<br> vous aidez à avoir <br>une meilleure hospitalisation</h1>
         <h6>Bienvenue dans notre site web , nous vous souhaitons <br> une bonne expérience.</h6>

        </div>


   </section>

   <section id="hospitalslist">

   

<div class="container">
         <h1>Liste des Hôpitaux Universitaires</h1>

<?php
if (isset($id_hopital)) {
  # code...

$i = 0;

while($i < count($id_hopital) ) { 
   $sql2="SELECT nom_service from services where id_hopital=$id_hopital[$i]";
   $sql3="SELECT  
 SUM(services.nbre_lit_tot) as nbre_lit_tot_hop, sum(services.nbre_lit_occ) as nbre_lit_occ_hop,
 SUM(services.nbre_lit_vac) as nbre_lit_vac_hop from services WHERE id_hopital=$id_hopital[$i]";

   $res2=$conn->query($sql2);
   $res3=$conn->query($sql3);

   while ($row2=$res2->fetch_assoc()) {
      $nom_service[]=$row2['nom_service'];
   }
   $row3=$res3->fetch_assoc();
   $nbre_lit_tot_hop=$row3['nbre_lit_tot_hop'];
   $nbre_lit_occ_hop=$row3['nbre_lit_occ_hop'];
   $nbre_lit_vac_hop=$row3['nbre_lit_vac_hop'];

   ?>
   <button class="accordion"><?php echo $nom_hopital[$i]; ?></button>
   <div class='details'>
      <ul>
   
        <li>Services : 
         <label style="color:#858484 "><?php 
        for ($j=0; $j < count($nom_service) ; $j++) { 
         echo $nom_service[$j] ." / ";
      }
         $nom_service = [];
         ?></label>
        </li>
      
        <li>Nombre de lits total :<?php echo $nbre_lit_tot_hop ;?> </li>
        <li><span style="color:red">Nombre de lits occupés :<?php echo $nbre_lit_occ_hop ;?></span> </li>
        <li><span style="color:green">Nombre de lits vacants : <?php echo $nbre_lit_vac_hop ;?></span>  </li>
        <?php 
        if ($nbre_lit_vac_hop==0) {?>
          
        <p style="color:red">Impossible d'envoyer une demande de réservation. Aucun lit n'est disponible pour le moment!</p>
        <?php } else {?>
          <li><a href="formulaireDeReservation.php?id_hopital=<?php echo $id_hopital[$i] ; ?>"> +Reserver un lit </a></li>
        <?php
        }
        ?>

        
   
      </ul>
   </div>
   
<?php

$i++ ;
}
}else {?>

<h2>Aucun hopital n'est disponible pour le moment</h2>
  <?php
}

?>

<footer>
 <div id="contact">
   <div class="container">
    <h3>Contactez-nous via</h3>
    <br>
    <br>
    <ul>

     <li><a href="#" class="fa fa-facebook"></a></li>
     <li><a href="#" class="fa fa-instagram"></a></li>
     <li><a href="#" class="fa fa-twitter"></a></li>
     
    </ul>

   </div>
 </div>
 <div id="about">
   <div class="container">
    <h3>À PROPOS</h3>
    <p>HOSPITAL BEDS MANAGEMENT est une excellente plateforme<br> pour réserver des lits d’hôpital depuis votre domicile à Constantine.<br> 
      Cette plateforme est créée par deux étudiants universitaires<br> pour aider les patients à éviter les problèmes de réservation de lits.<br> Nous souhaitons dans un avenir proche étendre <br> 
      notre existence à toutes les villes d’Algérie.</p>

   </div>




 </div>




</footer>



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


</div>




   </section>




    
</body>
</html>

