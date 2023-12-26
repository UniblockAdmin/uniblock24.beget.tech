<?
include 'hashFile.php';
header('Content-Type: application/json');
$id = uniqid();
$target_dir = "../uploads/";
$target_file = $target_dir.$id.basename($_FILES["file"]["name"]);
$uploadOk = 1;
$ext = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$target_file = $target_dir.$id.".".$ext;

$db_server = "localhost";
$db_user = "uniblock24_db";
$db_password = "Admin2023%";
$db_table = "uniblock24_db";
// Проверка файла на ошибки
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if ($check !== false) {
        echo json_encode(array('success' => false, 'message' => 'Неправильный формат файла'));
        exit();
    }
}

// Проверка размера файла
if ($_FILES["file"]["size"] > 500000) {
    echo json_encode(array('success' => false, 'message' => 'Файл слишком большой'));
    exit();
}


// Загрузка файла
if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    $hash = getHashFile($target_file);
    $query = "SELECT * FROM `SmartContracts` WHERE `hash` = '$hash';";
    $link = mysqli_connect($db_server, $db_user, $db_password, $db_table);
    
    
    $sql = mysqli_query($link, $query);
    $res = "1";
    if($sql->num_rows == 0){
        
        echo json_encode(array('success' => 'false', 'message' => 'Смарт-контракт не найдён'));  
    }else{
        foreach($sql as $r){
            if($r['ticket'] == '-'){
                echo json_encode(array('success' => 'false', 'message' => 'Документ, подтверждающий исполнение условий контракта не загружен.')); 
                break;
            } 
            echo json_encode(array('hash' => $hash,
            'senderWallet' => $r['senderAddress'],
            'senderPrivateKey' => $r['senderPrivateKey'],
            'tokens' => $r['tokens'],
            'recipient' => $r['clientKey'],
            'success' => 'true',
            'createdDate' => $r['created_date'],
            ));
        }
    }
    
  
} else {
    echo json_encode(array('success' => true, 'message' => 'Имя контракта: '.$r['name']));
}

?>