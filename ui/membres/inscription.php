<?php session_start(); ?>
<?php 
include_once("../includes/action.php");
include_once ("../includes/db.php");
$_SESSION['userins']=$_POST["user"];
$_SESSION['emailins']=$_POST["email"];
$pass_hash='';
$bool=0;
if ($_POST['password'] == $_POST['password2']) {
    $_SESSION['userins']="";
    $_SESSION['emailins']="";
    $pass_hash=password_hash($_POST['password'], PASSWORD_DEFAULT);
}
else{
    $_SESSION['error']='Error : les mot de passe ne correspondent pas';
}
$SQL="SELECT * from membres where user = '".$_POST["user"]."'";
$db-> query($SQL);
echo $SQL;
foreach($db-> query($SQL) as $row){
$bool = ($row['user']==$_POST['user']);
}
if($bool){
    $_SESSION['userins']="";
    $_SESSION['emailins']=$_POST["email"];
    $_SESSION["error"]="<br>Le pseudo est deja pris";
    $pass_hash="";
 
}
$SQL="SELECT * from membres where email = '".$_POST["email"]."'";
$db-> query($SQL);
echo $SQL;
$bool=0;
foreach($db-> query($SQL) as $row){
$bool = ($row['email']==$_POST['email']);
}
if($bool){
    $_SESSION['userins']=$_POST["user"];
    $_SESSION['emailins']="";
    if (empty($_SESSION["error"])) {
        $_SESSION["error"]="Vous avez deja un compte avec ce mail";
    }
    else {
        $_SESSION['userins']='';
        $_SESSION["error"].="<br>Vous avez deja un compte avec ce mail";
    }
    $pass_hash="";
 
}


$date=date('Y-m-d');
$donnes=ucfirst($_POST['user']);
$donnes.="','";
$donnes.=$_POST['email'];
$donnes.="','";
$donnes.=$pass_hash;
$donnes.="','";
$donnes.=$date;


if ($pass_hash!='') {
	$SQL="INSERT INTO `membres`(`user`, `email`, `password`, `date_inscription`) VALUES ('$donnes')";
	$db-> query($SQL);
	$_SESSION['error']='';
	header('Location: ../index.php');
	$_SESSION['user']=$_POST['user'];
}
else{
	header('Location: ../inscription.php');
}