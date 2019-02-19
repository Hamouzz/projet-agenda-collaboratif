<?php session_start(); ?>
<?php 
include_once ("../includes/db.php");
$bool=0;
$pass_hash=password_hash($_POST['password'], PASSWORD_DEFAULT);
$donnes=$_POST['user'];
$donnes.="','";
$donnes.=$pass_hash;
$SQL="SELECT * from membres where user = '".$_POST["user"]."'";
$db-> query($SQL);
echo $SQL;
foreach($db-> query($SQL) as $row){
$bool = password_verify ($_POST['password'] ,$row["password"] );
}
echo $bool;
if ($bool) {
	$_SESSION['user']=ucfirst($_POST['user']);
	$_SESSION['error']='';
}
else{
	$_SESSION['error']='Error : Le mot de passe est incorrecte';
}
header('Location: ../index.php');