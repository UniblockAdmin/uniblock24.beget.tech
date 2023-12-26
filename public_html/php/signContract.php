<?
include 'config.php';

$column = (string) $_POST['column'];
$value = (string) $_POST['value'];
$id = (int) $_POST['id'];
$column2 = (string) $_POST['column2'];
$value2 = (string) $_POST['value2'];
$query = "UPDATE `SmartContracts` SET `$column` = '$value', `$column2` = $value2 WHERE id = $id;";
$link = mysqli_connect($db_server, $db_user, $db_password, $db_table);
$sql = mysqli_query($link, $query);

if($column2 == "clientApproved"){
    file_get_contents("http://uniblock24.beget.tech/wordGen.php?id=$id");
}
?>