<?
include 'hashFile.php';
header('Content-Type: application/json');
$id = uniqid();
$target_dir = "../uploads/";
$target_file = $target_dir.$id.basename($_FILES["file"]["name"]);
$uploadOk = 1;
$ID = $_GET['id'];
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
    $nm = $id.".".$ext;
    $query = "UPDATE `SmartContracts` SET `ticket` = '$nm';";
    $link = mysqli_connect($db_server, $db_user, $db_password, $db_table);
    $sql = mysqli_query($link, $query);
    echo json_encode(array('success' => true,'name' => $id.".".$ext));
} else {
    echo json_encode(array('success' => false, 'message' => 'Ошибка загрузки файла'));
}

?>