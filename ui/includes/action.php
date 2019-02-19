 

<?php

include_once(../includes/db.php);
   
$link=mysqli_connect($c);

  
if(!$link){echo"imposible de se connecter";}   

$user = $_POST["user"];
$mail = $_POST["mail"];
$password = $_POST["password"];
$password2= $_POST["password2"];

   
 $sql="INSERT INTO user(nom, mail, password) VALUES ('$user','$mail','$password')";
 echo $sql;
 if(mysqli_query($link,$sql)){
 
 echo("requete-executee") ;
 
 }
 
 
?>