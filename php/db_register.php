<?
include 'config.php';

$fio = (string) $_POST['fio'];
$email = (string) $_POST['email'];
$password = (string) $_POST['password'];
$unikey = uniqid();
$defaultRoleId = 2; // Client
$query = "INSERT INTO `Users`(`id`, `FIO`, `Email`, `Password`, `memberID`,`privateKey`,`unikey`,`roleId`,`walletAddress`) VALUES (0,'$fio','$email','$password',-1,'$privateKey','$unikey',$defaultRoleId,'$address');";

$link = mysqli_connect($db_server, $db_user, $db_password, $db_table);
$sql = mysqli_query($link, $query);
?>