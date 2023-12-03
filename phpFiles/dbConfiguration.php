<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
</head>
<body>


<?php

include 'C:\xampp\htdocs\Project\phpFiles\dbConnection.php' ;





function insertRecordIntoPatients() {

global $conn ;
$id_hopital = $_POST['id_hopital'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$dateDeNaissance = $_POST['dateDeNaissance'];
$sexe = $_POST['sexe'];
$email = $_POST['email'];
$numtlp = $_POST['numtlp'];
//$dossierMed = $_FILES['dossierMed'];
$dateHospitalisation = $_POST['dateHospitalisation'];
$nomDossierMed =$_FILES['dossierMed']['name'];
$tmp_name =$_FILES['dossierMed']['tmp_name'];

$local_file="../files/";

move_uploaded_file($tmp_name , $local_file.$nomDossierMed);

$sql = "INSERT INTO patients (nom, id_hopital, prenom, dateDeNaissance, sexe, email, numtlp, dossierMed, dateHospitalisation) 
	VALUES ('$nom',$id_hopital, '$prenom','$dateDeNaissance','$sexe','$email',$numtlp,'$nomDossierMed', '$dateHospitalisation')";

if($conn->query($sql)===TRUE)
{

header("Location: /Project/phpFiles/formulaireDeReservation.php?goal=demandDone");


} else{
header("Location: /Project/phpFiles/formulaireDeReservation.php?goal=demandNotDone");
}
}

function insertRecordIntoPatients_admis($id_patient,$nom_service) {

global $conn ;
//$id_patient=$_GET['id_patient'];
$sql="SELECT * FROM patients WHERE id_patient=$id_patient";
$res=$conn->query($sql);
$row=$res->fetch_assoc();
$id_hopital = $row['id_hopital'];
$nom = $row['nom'];
$prenom = $row['prenom'];
$dateDeNaissance = $row['dateDeNaissance'];
$sexe = $row['sexe'];
$email = $row['email'];
$numtlp = $row['numtlp'];
$dateHospitalisation = $row['dateHospitalisation'];
$dateDeReservation=$row['dateDeReservation'];

$sql1 = "INSERT INTO patients_admis(id_hopital, service , nom, prenom, dateDeNaissance, sexe, email, numtlp, dateDeReservation, dateHospitalisation )
		VALUES ($id_hopital,'$nom_service', '$nom', '$prenom','$dateDeNaissance','$sexe','$email',$numtlp, '$dateDeReservation','$dateHospitalisation')";

$conn->query($sql1);

}

function insertRecordIntoPatients_admis_adm($nom_service) {

	global $conn ;
	$id_hopital = $_POST['id_hopital'];
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$dateDeNaissance = $_POST['dateDeNaissance'];
	$sexe = $_POST['sexe'];
	$email = $_POST['email'];
	$numtlp = $_POST['numtlp'];
	
	
	
	$sql = "INSERT INTO patients_admis(id_hopital, service , nom, prenom, dateDeNaissance, sexe, email, numtlp)
		VALUES ($id_hopital,'$nom_service', '$nom', '$prenom','$dateDeNaissance','$sexe','$email',$numtlp)";
	$conn->query($sql);
}
	



function insertRecordIntoHopitaux() {
global $conn ;

$nom_hopital = $_POST['nom_hopital'];
$username=$_POST['username'];
$prepassword=$_POST['prepassword'];
$password=$_POST['password'];
//Make sure prepsw and psw are equal 
if ($prepassword!=$password) {
include 'C:\xampp\htdocs\Project\phpFiles\formulaireHopital.php';
?>
	<script>
	document.getElementById('erreur2').style.display="block";
	</script> 
	<?php
	exit();

}else {
$query="SELECT * FROM hopitaux";
$res=$conn->query($query);
while ($row=$res->fetch_assoc()) {
	if($nom_hopital==$row['nom_hopital']||$username==$row['username']||$password==$row['password']){
		include 'C:\xampp\htdocs\Project\phpFiles\formulaireHopital.php';
		?>
		<script>
		document.getElementById('erreur').style.display="block";
		</script> 
		<?php
		exit();
	}
}
$sql = "INSERT INTO hopitaux (nom_hopital, username, password) 
		VALUES ('$nom_hopital', '$username','$password')";

if($conn->query($sql)===TRUE)
{
	$id_hopital=$conn->insert_id;
	header("Location: /Project/phpFiles/service.php?id_hopital=$id_hopital");
	die;
	
} else{
	echo "erreur".$sql."<br>".$conn->error ;
}
}
}  

function insertRecordIntoServices(){
	global $conn ;
	$id_hopital =$_POST['id_hopital'];
	$nom_service=$_POST['nom_service'];
	$nbre_lit_tot=$_POST['nbre_lit_tot'];
	$nbre_lit_vac=$nbre_lit_tot;
	$nbre_lit_occ=0;

$query="SELECT * FROM services WHERE id_hopital=$id_hopital";
$res=$conn->query($query);
while ($row=$res->fetch_assoc()) {
	if($nom_service==$row['nom_service']){
		include 'C:\xampp\htdocs\Project\phpFiles\ajouterService.php';
		?>
		<script>
		document.getElementById('erreur').style.display="block";
		</script> 
		<?php
		exit();
	}
}

$sql = "INSERT INTO services  
		VALUES ('$nom_service',$id_hopital, $nbre_lit_tot, $nbre_lit_occ , $nbre_lit_vac)";

if($conn->query($sql)===TRUE)
{
	header("Location: /Project/phpFiles/service.php?id_hopital=$id_hopital");
	die;

} else{
	echo "erreur".$sql."<br>".$conn->error ;

}

	
}

	function modifyRecordHopitaux() {
	global $conn ;
	$id_hopital=$_POST['id_hopital'];
	$query="SELECT * FROM hopitaux";
	$res=$conn->query($query);


	if(isset($_POST['modifyHospitalName'])){
		$nom_hopital = $_POST['nom_hopital'];

		while ($row=$res->fetch_assoc()) {
			if($nom_hopital==$row['nom_hopital']){
				include 'C:\xampp\htdocs\Project\phpFiles\modifierInfos.php';
				?>
				<script>
				document.getElementById('erreur').style.display="block";
				</script> 
				<?php
				exit();
			}
		}
			//if everyting is all right the update will be done
			$sql = "UPDATE hopitaux
					set nom_hopital='$nom_hopital'
					WHERE id_hopital=$id_hopital";
		    $result=$conn->query($sql);
				include 'C:\xampp\htdocs\Project\phpFiles\modifierInfos.php';
				//echo "Modification bien enregistrée ";
			}

	

	if(isset($_POST['modifyHospitalUname'])){
	$username = $_POST['username'];

	while ($row=$res->fetch_assoc()) {
		if($username==$row['username']){
			include 'C:\xampp\htdocs\Project\phpFiles\modifierInfos.php';
			?>
			<script>
			document.getElementById('erreur').style.display="block";
			</script> 
			<?php
			exit();
		}
	}
		//if everyting is all right the update will be done
		$sql = "UPDATE hopitaux
				set username='$username'
				WHERE id_hopital=$id_hopital";
        $result=$conn->query($sql);
			include 'C:\xampp\htdocs\Project\phpFiles\modifierInfos.php';
			//echo "Modification bien enregistrée ";
		}			

		
	if(isset($_POST['modifyHospitalPsw'])){
	$prepassword = $_POST['prepassword'];
	$password = $_POST['password'];

	if ($prepassword!=$password) {
		include 'C:\xampp\htdocs\Project\phpFiles\modifierInfos.php';
		?>
		<script>
		document.getElementById('erreur2').style.display="block";
		</script> 
		<?php
		exit();
	}


	while ($row=$res->fetch_assoc()) {
		if($password==$row['password']){
			include 'C:\xampp\htdocs\Project\phpFiles\modifierInfos.php';
			?>
			<script>
			document.getElementById('erreur').style.display="block";
			</script> 
			<?php
			exit();
		}
	}
		//if everyting is all right the update will be done
		$sql = "UPDATE hopitaux
				set password='$password'
				WHERE id_hopital=$id_hopital";
        $result=$conn->query($sql);

			include 'C:\xampp\htdocs\Project\phpFiles\modifierInfos.php';
			//echo "Modification bien enregistrée ";
		}					
		
		}


	function modifyRecordService() {
		global $conn ;
		$id_hopital=$_POST['id_hopital'];
		$current_nom_service=$_POST['current_nom_service'];
		$nom_service = $_POST['nom_service'];
		
		//Make sure if the new data do not exist before
	$query="SELECT * FROM services WHERE id_hopital=$id_hopital";
	$res=$conn->query($query);
	while ($row=$res->fetch_assoc()) {
		if($nom_service==$row['nom_service']){
			include 'C:\xampp\htdocs\Project\phpFiles\modifierService.php';
			?>
			<script>
			document.getElementById('erreur').style.display="block";
			</script> 
			<?php
			exit();
		}
	}
		//if everyting is all right the update will be done
		$sql = "UPDATE services
				set nom_service='$nom_service'  
				WHERE id_hopital=$id_hopital AND nom_service='$current_nom_service'";
		
		if($conn->query($sql)===TRUE)
		{
			include 'C:\xampp\htdocs\Project\phpFiles\service.php';
			//echo "Modification bien enregistrée ";
		} else{
			echo "erreur".$sql."<br>".$conn->error ;
		}
		
		
		}


function deleteRecord($table,$pk,$id)
{
	global $conn ;

	$sql = "DELETE FROM $table WHERE $pk=$id";
	$conn->query($sql);

	
}

function deleteRecordFromServices()
{
global $conn ;
$id_hopital=$_GET['id_hopital'];
$nom_service=$_GET['nom_service'];

$sql = "DELETE FROM services WHERE id_hopital=$id_hopital AND nom_service='$nom_service'";
if($conn->query($sql)){
	
	header("Location: /Project/phpFiles/service.php?id_hopital=$id_hopital");
	die;

}else {
	echo "erreur".$sql."<br>".$conn->error ;
}

}

if (isset($_POST['submitPatientData'])) {
insertRecordIntoPatients();
}
if (isset($_POST['submitHospitalData'])) {
insertRecordIntoHopitaux();
}
if (isset($_POST['submitServiceData'])) {
insertRecordIntoServices();
}

if (isset($_POST['modifyHospitalName'])||isset($_POST['modifyHospitalUname'])||isset($_POST['modifyHospitalPsw'])) {
modifyRecordHopitaux();
}


if (isset($_POST['modifyServiceData'])) {
modifyRecordService();
}


if (isset($_GET['source'])) {


/*if ($_GET['source']=='approuverPatient'&&isset($_GET['id_patient'])) {
	insertRecordIntoPatients_admis();
}*/

if ($_GET['source']=='suppPatient'&&isset($_GET['id_patient'])) {
	$id_patient=$_GET['id_patient'];
	include 'C:\xampp\htdocs\Project\phpFiles\suppMail.php';
	/*deleteRecord("patients","id_patient","$id_patient");
	header("Location: /Project/phpFiles/hopital.php");
	die;*/
}

if ($_GET['source']=='suppPatientAdmis'&&isset($_GET['id_patient'])) {
	$id_patient=$_GET['id_patient'];
	deleteRecord("patients_admis","id_patient","$id_patient");
	header("Location: /Project/phpFiles/hopital.php");
	die;
}

if ($_GET['source']=='suppHopital'&&isset($_GET['id_hopital'])) {
	    $id_hopital=$_GET['id_hopital'];
		deleteRecord("hopitaux","id_hopital","$id_hopital");
		header("Location: /Project/phpFiles/controleur.php");
		die;
	//}
}

if ($_GET['source']=='suppService'&&isset($_GET['id_hopital'])&&isset($_GET['nom_service'])) {
	deleteRecordFromServices();
}

}









/*
$stmt = $conn->prepare("INSERT INTO patients (nom, prenom, dateDeNaissance, sexe, email, numtlp) VALUES(? , ? , ? , ? , ? , ? )");

$stmt->bind_param("s,s,s,s,s,i",$nom,$prenom,$dateDeNaissance,$sexe,$email,$numtlp);

$stmt->execute();
echo "nouveau patient est bien enregistré , avec un id de :".$last_id;
$stmt->close();
$conn->close();
?>
</body>
</html>   */

?>


</body>
</html>






	