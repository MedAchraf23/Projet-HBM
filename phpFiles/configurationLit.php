<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
    
<?php 

include 'C:\xampp\htdocs\Project\phpFiles\dbConfiguration.php';

if (isset($_POST['id_hopital'])) {
  $id_hopital=$_POST['id_hopital'];
}

if(isset($_POST['nom_service'])){
  $nom_service=$_POST['nom_service'];
}

if(isset($_POST['occ'])||isset($_POST['vac'])||isset($_POST['tot'])){
  
  $occ=$_POST['occ'];
  $vac=$_POST['vac'];
  $tot=$_POST['tot'];

}



//récupération de la source pour la fonction réserver

if (isset($_POST['source'])) {

  $source=$_POST['source']; 
}

//Suppression de la demande aprés resérvation 
if (isset($_POST['id_patient'])) {
  $id_patient=$_POST['id_patient'];
}


//Fonctions des opérations 

function reserverLit(){

global $conn , $id_hopital , $nom_service , $occ , $vac , $tot , $id_patient , $source ; 

if ($tot==$occ+$vac&&$occ>=0) {



$sql = "UPDATE services
         SET  nbre_lit_occ=$occ + 1  , nbre_lit_vac=$vac - 1
         WHERE   id_hopital=$id_hopital  AND nom_service='$nom_service'  " ;

$res=$conn->query($sql);



switch ($source) {

  case 'e-admission':
   
// 1.inserer le patient admis à la table des admis et le supprimer de la table des patients en attente 
insertRecordIntoPatients_admis($id_patient,"$nom_service");
// Lui envoyer un email  avec le code (id_patient en attente)
include 'C:\xampp\htdocs\Project\phpFiles\mail.php';
// Le supprimer de la table des patients en attente 
deleteRecord("patients","id_patient","$id_patient");
    break;

  case 'admission':

    insertRecordIntoPatients_admis_adm("$nom_service");
    header("Location: /Project/phpFiles/reserverlit.php?source=refreshPage");
    die;
    //include 'C:\xampp\htdocs\Project\phpFiles\reserverlit.php';

    break;
  
  default:
   echo "le cas defaut a déclenché";
   
}
  

} else {

  echo "erreur au nombre de lits";

}


} 


function ajouterLit(){

  global $conn , $id_hopital , $nom_service , $occ , $vac , $tot ; 
  

  if ($tot==$occ+$vac&&$occ>=0) {

  $sql = "UPDATE services
           SET  nbre_lit_tot=$tot + 1  , nbre_lit_vac=$vac + 1
           WHERE   nom_service='$nom_service' AND id_hopital=$id_hopital" ;
  
  $res=$conn->query($sql);
  if($res===true){
    header("Location: /Project/phpFiles/hopital.php");
    die;
    
  }else {
      echo "Error" . $conn->error;
    }

  }else {
    echo "erreur au nombre de lits";

  }
}



  function libererLit(){

    global $conn ,$id_patient, $id_hopital , $nom_service ;

    if ($tot==$occ+$vac&&$occ>=0) {
$req="SELECT * FROM services WHERE id_hopital=$id_hopital AND nom_service='$nom_service' ";
$result=$conn->query($req);
$row=$result->fetch_assoc();
$occ=$row['nbre_lit_occ'];
$vac=$row['nbre_lit_vac'];

 
    $sql = "UPDATE services
             SET  nbre_lit_occ=$occ - 1  , nbre_lit_vac=$vac + 1
             WHERE   id_hopital=$id_hopital  AND nom_service='$nom_service' " ;
    
    $res=$conn->query($sql);

    deleteRecord("patients_admis","id_patient","$id_patient");
    
    if($res===true){
      header("Location: /Project/phpFiles/hopital.php");
      die;
      
    }else {
        echo "Error" . $conn->error;
      }
    }else {
      echo "erreur au nombre de lits";
    }
  }



function supprimerLit(){

  global $conn , $id_hopital , $nom_service , $occ , $vac , $tot ;
  if ($tot==$occ+$vac&&$occ>=0) {
  if ($occ==$tot) {
    echo "suppression impossible , il faut libérer un lit" ;
  } else {
    
  $sql = "UPDATE services
           SET  nbre_lit_tot=$tot - 1  , nbre_lit_vac=$vac - 1
           WHERE   id_hopital=$id_hopital  AND nom_service='$nom_service' " ;
  
  $res=$conn->query($sql);
  if($res===true){
    header("Location: /Project/phpFiles/hopital.php");
    die;
    
  }else {
      echo "Error" . $conn->error;
    }
  }
}else {
  echo "erreur au nombre de lits";
}
}



//L'execution des fonctions 

if(isset($_POST['reserverLit'])){
  reserverLit();
}

if(isset($_POST['ajouterLit'])){
  ajouterLit();
}

if(isset($_POST['libererLit'])){
  libererLit();
}

if(isset($_POST['supprimerLit'])){
  supprimerLit();
}



/*

//Fonctions des opérations du service chirugie générale

function reserverLitSrvChirugie(){

  global $conn ; 
  $sql="SELECT * FROM services WHERE id_hopital=1 AND nom_service='service de chirugie générale' " ;
  $res=$conn->query($sql);
  $row=$res->fetch_assoc();
  $nomsrv=$row['nom_service'];
  $occ=$row['nbre_lit_occ'] ;
  $vac=$row['nbre_lit_vac'] ;
  $tot=$row['nbre_lit_tot'] ;
  
  $sql1 = "UPDATE services
           SET  nbre_lit_occ=$occ + 1  , nbre_lit_vac=$vac - 1
           WHERE  nom_service='service de chirugie générale' AND id_hopital=1 " ;
  
  $res1=$conn->query($sql1);
  if($res1===true){
    header("Location: /Project/phpFiles/reserverlit.php");
    die;
    
  }else {
      echo "Error" . $conn->error;
    }
  }
  
  function ajouterLitSrvChirugie(){
  
    global $conn ; 
    $sql="SELECT * FROM services WHERE id_hopital=1 AND nom_service='service de chirugie générale' " ;
    $res=$conn->query($sql);
    $row=$res->fetch_assoc();
    $nomsrv=$row['nom_service'];
    $occ=$row['nbre_lit_occ'] ;
    $vac=$row['nbre_lit_vac'] ;
    $tot=$row['nbre_lit_tot'] ;
    
    $sql1 = "UPDATE services
             SET  nbre_lit_tot=$tot + 1  , nbre_lit_vac=$vac + 1
             WHERE  nom_service='service de chirugie générale' AND id_hopital=1 " ;
    
    $res1=$conn->query($sql1);
    if($res1===true){
      header("Location: /Project/phpFiles/hopitalAliM.php");
      die;
      
    }else {
        echo "Error" . $conn->error;
      }
    }
  
    function libererLitSrvChirugie(){
  
      global $conn ; 
      $sql="SELECT * FROM services WHERE id_hopital=1 AND nom_service='service de chirugie générale' " ;
      $res=$conn->query($sql);
      $row=$res->fetch_assoc();
      $nomsrv=$row['nom_service'];
      $occ=$row['nbre_lit_occ'] ;
      $vac=$row['nbre_lit_vac'] ;
      $tot=$row['nbre_lit_tot'] ;
      
      $sql1 = "UPDATE services
               SET  nbre_lit_occ=$occ - 1  , nbre_lit_vac=$vac + 1
               WHERE  nom_service='service de chirugie générale' AND id_hopital=1 " ;
      
      $res1=$conn->query($sql1);
      if($res1===true){
        header("Location: /Project/phpFiles/hopitalAliM.php");
        die;
        
      }else {
          echo "Error" . $conn->error;
        }
      }
  
  function supprimerLitSrvChirugie(){
  
    global $conn ; 
    $sql="SELECT * FROM services WHERE id_hopital=1 AND nom_service='service de chirugie générale' " ;
    $res=$conn->query($sql);
    $row=$res->fetch_assoc();
    $nomsrv=$row['nom_service'];
    $occ=$row['nbre_lit_occ'] ;
    $vac=$row['nbre_lit_vac'] ;
    $tot=$row['nbre_lit_tot'] ;
  
    if ($occ==$tot) {
      echo "suppression impossible , il faut libérer un lit" ;
    } else {
      
    $sql1 = "UPDATE services
             SET  nbre_lit_tot=$tot - 1  , nbre_lit_vac=$vac - 1
             WHERE  nom_service='service de chirugie générale' AND id_hopital=1 " ;
    
    $res1=$conn->query($sql1);
    if($res1===true){
      header("Location: /Project/phpFiles/hopitalAliM.php");
      die;
      
    }else {
        echo "Error" . $conn->error;
      }
    }
  }
  
  
  
  //L'execution des fonctions du chirugie générale  
  
  if(isset($_POST['reserverLitSrvChirugie'])){
    reserverLitSrvChirugie();
  }
  
  if(isset($_POST['ajouterLitSrvChirugie'])){
    ajouterLitSrvChirugie();
  }
  
  if(isset($_POST['libererLitSrvChirugie'])){
    libererLitSrvChirugie();
  }
  
  if(isset($_POST['supprimerLitSrvChirugie'])){
    supprimerLitSrvChirugie();
  }



  //Fonctions des opérations du service de pédiatrie

function reserverLitSrvPediatrie(){

  global $conn ; 
  $sql="SELECT * FROM services WHERE id_hopital=1 AND nom_service='service de pédiatrie' " ;
  $res=$conn->query($sql);
  $row=$res->fetch_assoc();
  $nomsrv=$row['nom_service'];
  $occ=$row['nbre_lit_occ'] ;
  $vac=$row['nbre_lit_vac'] ;
  $tot=$row['nbre_lit_tot'] ;
  
  $sql1 = "UPDATE services
           SET  nbre_lit_occ=$occ + 1  , nbre_lit_vac=$vac - 1
           WHERE  nom_service='service de pédiatrie' AND id_hopital=1 " ;
  
  $res1=$conn->query($sql1);
  if($res1===true){
    header("Location: /Project/phpFiles/reserverlit.php");
    die;
    
  }else {
      echo "Error" . $conn->error;
    }
  }
  
  function ajouterLitSrvPediatrie(){
  
    global $conn ; 
    $sql="SELECT * FROM services WHERE id_hopital=1 AND nom_service='service de pédiatrie' " ;
    $res=$conn->query($sql);
    $row=$res->fetch_assoc();
    $nomsrv=$row['nom_service'];
    $occ=$row['nbre_lit_occ'] ;
    $vac=$row['nbre_lit_vac'] ;
    $tot=$row['nbre_lit_tot'] ;
    
    $sql1 = "UPDATE services
             SET  nbre_lit_tot=$tot + 1  , nbre_lit_vac=$vac + 1
             WHERE  nom_service='service de pédiatrie' AND id_hopital=1 " ;
    
    $res1=$conn->query($sql1);
    if($res1===true){
      header("Location: /Project/phpFiles/hopitalAliM.php");
      die;
      
    }else {
        echo "Error" . $conn->error;
      }
    }
  
    function libererLitSrvPediatrie(){
  
      global $conn ; 
      $sql="SELECT * FROM services WHERE id_hopital=1 AND nom_service='service de pédiatrie' " ;
      $res=$conn->query($sql);
      $row=$res->fetch_assoc();
      $nomsrv=$row['nom_service'];
      $occ=$row['nbre_lit_occ'] ;
      $vac=$row['nbre_lit_vac'] ;
      $tot=$row['nbre_lit_tot'] ;
      
      $sql1 = "UPDATE services
               SET  nbre_lit_occ=$occ - 1  , nbre_lit_vac=$vac + 1
               WHERE  nom_service='service de pédiatrie' AND id_hopital=1 " ;
      
      $res1=$conn->query($sql1);
      if($res1===true){
        header("Location: /Project/phpFiles/hopitalAliM.php");
        die;
        
      }else {
          echo "Error" . $conn->error;
        }
      }
  
  function supprimerLitSrvPediatrie(){
  
    global $conn ; 
    $sql="SELECT * FROM services WHERE id_hopital=1 AND nom_service='service de pédiatrie' " ;
    $res=$conn->query($sql);
    $row=$res->fetch_assoc();
    $nomsrv=$row['nom_service'];
    $occ=$row['nbre_lit_occ'] ;
    $vac=$row['nbre_lit_vac'] ;
    $tot=$row['nbre_lit_tot'] ;
  
    if ($occ==$tot) {
      echo "suppression impossible , il faut libérer un lit" ;
    } else {
      
    $sql1 = "UPDATE services
             SET  nbre_lit_tot=$tot - 1  , nbre_lit_vac=$vac - 1
             WHERE  nom_service='service de pédiatrie' AND id_hopital=1 " ;
    
    $res1=$conn->query($sql1);
    if($res1===true){
      header("Location: /Project/phpFiles/hopitalAliM.php");
      die;
      
    }else {
        echo "Error" . $conn->error;
      }
    }
  }
  
  
  
  //L'execution des fonctions du service covid 
  
  if(isset($_POST['reserverLitSrvPediatrie'])){
    reserverLitSrvPediatrie();
  }
  
  if(isset($_POST['ajouterLitSrvPediatrie'])){
    ajouterLitSrvPediatrie();
  }
  
  if(isset($_POST['libererLitSrvPediatrie'])){
    libererLitSrvPediatrie();
  }
  
  if(isset($_POST['supprimerLitSrvPediatrie'])){
    supprimerLitSrvPediatrie();
  }


/*

if(isset($_POST['supprimerLitSrvCovid'])){

  $sql2 = "UPDATE services
           SET  nbre_lit_tot=$tot - 1 , nbre_lit_vac=$vac - 1
           WHERE  nom_service='service covid-19' AND id_hopital=1 " ;
  
  $res2=$conn->query($sql2);
  if($res2===true){
    header("Location: /Project/phpFiles/hopitalAliM.php");
    die;
    
  }else {
      echo "Error" . $conn->error;
    }
  
  }

  if(isset($_POST['supprimerLitSrvCovid'])){

    $sql3 = "UPDATE services
             SET  nbre_lit_tot=$tot + 1 , nbre_lit_vac=$vac + 1
             WHERE  nom_service='service covid-19' AND id_hopital=1 " ;
    
    $res3=$conn->query($sql3);
    if($res3===true){

      header("Location: /Project/phpFiles/hopitalAliM.php");
      die;
      
    }else {
        echo "Error" . $conn->error;
      }
    
    }

    if($_GET['button']=='libererlit'){

      $sql4 = "UPDATE services
               SET  nbre_lit_occ=$occ - 1 , nbre_lit_vac=$vac + 1
               WHERE  nom_service='service covid-19' AND id_hopital=1 " ;
      
      $res4=$conn->query($sql4);
      if($res4===true){
        header("Location: /Project/phpFiles/hopitalAliM.php");
        die;
        
      }else {
          echo "Error" . $conn->error;
        }
      
      }
}
*/
//}


 
  
  ?>
  


</body>
</html>

       