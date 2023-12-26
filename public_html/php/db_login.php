<?
session_start();

include 'config.php';

$email = (string) $_POST['email'];
$password = (string) $_POST['password'];

$query = "SELECT * FROM `Users` WHERE `Email` = '$email' AND `Password` = '$password';";

$link = mysqli_connect($db_server, $db_user, $db_password, $db_table);
$sql = mysqli_query($link, $query);

if($sql->num_rows == 0){
    echo "0";//Такого пользователя не существует
}else{
    //Пользователь существует
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    foreach($sql as $r){
        $_SESSION['fio'] = $r['FIO'];
        $_SESSION['id'] = $r['id'];
        $_SESSION['private_key'] = $r['privateKey'];
        $_SESSION['member'] = $r['memberID'];
    }
}
$sql->close();
mysqli_close($link);
?>