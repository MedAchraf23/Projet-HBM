<?php 

include 'C:\xampp\htdocs\Project\phpFiles\dbConnection.php';

if (isset($_GET['id_hopital'])) {
    $id_hopital=$_GET['id_hopital'];

}

//Check if the uname and the psw are set , the first load of the page they r gonna be unset so no just the form will 
//be shown , and after the insert of the fields we gonna enter through the condition because now they r set , and then 
//select the usname and the psw to check them if they r equal to the uname and the psw of the hospital with 
//the current id  , if so a switch will direct us to the page that we want to access when we click the link at the very first time

if (isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['id_hopital'])) {
    $username=$_POST['username'];
    $password=$_POST['password'];
    $id_hopital=$_POST['id_hopital'];

    $sql = "SELECT * from hopitaux where id_hopital=$id_hopital";
    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    if ($row['username']==$username&&$row['password']==$password) {

        switch ($_POST['target']) {
            case 'modification':
                include 'C:\xampp\htdocs\Project\phpFiles\modifierInfos.php';
                exit();
                break;
            case 'services':
                include 'C:\xampp\htdocs\Project\phpFiles\service.php';
                exit();
                break;  
            case 'suppression':
                include 'C:\xampp\htdocs\Project\phpFiles\suppHopital.php';
                exit();
                break;   
                
            
            default:
                echo "erreur";
                break;
        }
   //if the uname and the psw r unmatched , then we gonna show the same page plus the error script 
   //we've unset the post(uname) and the post(psw) to do not enter to the very first condition and to do not have
   //an infinite loop
       }else {

           unset($_POST['username']);
           unset($_POST['password']);
           
           include 'C:\xampp\htdocs\Project\phpFiles\verification.php';
           //include 'C:\xampp\htdocs\Project\phpFiles\verification.php';
           ?>
			<script>
			document.getElementById('erreur').style.display="block";
			</script> 
			<?php
		    exit();
           
       }
           
          
       }



?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<link rel="stylesheet" type="text/css" href="..\cssFiles\modifierInfos.css">
	<meta charset="utf-8">
	
	
</head>
<body>


<div class="box">
<h4>Merci d'entrer le nom d'utilisateur et le mot de pass du compte hopital sélectionné</h4>
<br>
<label id="warning">* champ obligatoire</label>
<br>
<br>


<form action="" method="post" enctype="multipart/form-data">

<input type="hidden" name="id_hopital" value="<?php echo $id_hopital ;?>">
<input type="hidden" name="target" value="<?php echo $_GET['target'] ;?>">
<label>Nom d'utilisateur<span>*</span></label>
<br>
<input type="txt" name="username" placeholder="  Tapez votre nom d'utilisateur ..." required size="35">
<br>
<br>
<label>Mot de pass<span>*</span></label>
<br>
<input type="password" name="password" placeholder="  Tapez votre mot de pass ..." required size="35">
<br>
<br>
<input  class="btn" type="submit" name="" value="Valider">
<input class="btn1" type="reset" name="reset" value="Réinitialiser">
<br>
<br>
<p id="erreur">Connexion impossible. Données incorrectes*</p>
<br>

</form>

</div>

</body>
</html>

