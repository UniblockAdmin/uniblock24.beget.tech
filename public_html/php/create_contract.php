<?
header('Content-Type: text/html; charset=utf-8');
include 'config.php';

$created_date = date('Y-m-d H:i:s');
$hash = $_POST['hash'];
$wallet = $_POST['wallet'];
$desc = $_POST['desc'];
$fileName = $_POST['fileName'];
$name = $_POST['name'];
$adminId = $_POST['owner'];
$tokens = $_POST['tokens'];
$sWallet = $_POST['sWallet'];
$sKey = $_POST['sKey'];
$query = "INSERT INTO `SmartContracts`(`id`, `hash`, `created_date`,`fileName`,`name`,`description`,`admin`,`clientKey`,`tokens`,`senderAddress`,`senderPrivateKey`) VALUES (0,'0x000000000000000000','$created_date','$fileName','$name','$desc','$adminId','$wallet',$tokens,'$sWallet','$sKey')";


$link = mysqli_connect($db_server, $db_user, $db_password, $db_table);
$sql = mysqli_query($link, $query);
if($sql){
    
}else {
    echo "Error: " . $query . "<br>" . mysqli_error($link);
}
?>