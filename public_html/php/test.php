<?
header('Content-Type: text/html; charset=utf-8');
session_start();
$db_server = "localhost";
$db_user = "uniblock24_db";
$db_password = "Admin2023%";
$db_table = "uniblock24_db";

$query = "SELECT u.id, u.email,u.unikey ,u.FIO, u.privateKey, u.memberID, u.password, r.name , u.roleId
FROM `Users` u 
INNER JOIN `Roles` r 
ON u.roleId = r.id 
WHERE u.Email = '".$_SESSION['email']."' AND u.Password = '".$_SESSION['password']."'";

$link = mysqli_connect($db_server, $db_user, $db_password, $db_table);
$link->set_charset("utf8");
$sql = mysqli_query($link, $query);
$user = [];
if($sql->num_rows == 0){
    //echo "0";//Такого пользователя не существует
}else{
    //Пользователь существует
    foreach($sql as $r){
        $user['fio'] = $r['FIO'];
        $user['id'] = $r['id'];
        $user['private_key'] = $r['privateKey'];
        $user['member'] = $r['memberID'];
        $user['roleId'] = $r['roleId'];
        $user['roleName'] = $r['name'];
        $user['unikey'] = $r['unikey'];
        $user['wallet'] = $r['wallet'];
        echo $query;
        var_dump($r);
    }
}
$sql->close();
mysqli_close($link);
?>