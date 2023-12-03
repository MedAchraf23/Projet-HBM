<?php       
$servername = "localhost";
$username = "root";
$password = "";
$database = "hbm";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

/*function selectrows($sql){
    global $conn ;
    if($res=$conn->query($sql)==true){
    
    $row=$res->fetch_assoc();
    return $row ;

    }else{
    echo "Error" . $conn->error;
    
    }
    

}*/


?>