<?
include 'hashFile.php';
header('Content-Type: application/json');
$id = uniqid();
$target_dir = "../uploads/";
$target_file = $target_dir.$id.basename($_FILES["file"]["name"]);
$uploadOk = 1;
$ext = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$target_file = $target_dir.$id.".".$ext;
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
    echo json_encode(array('success' => true, 'hash' => $hash ,'name' => $id.".".$ext));
} else {
    echo json_encode(array('success' => false, 'message' => 'Ошибка загрузки файла'));
}

?>