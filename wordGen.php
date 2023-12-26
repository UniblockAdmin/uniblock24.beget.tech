<?
require 'phpword/autoload.php';

include 'php/config.php';
$uni = uniqid().date("d-m-Y").".docx";
$query = "SELECT * FROM `SmartContracts` WHERE `id` = ".$_GET['id'];

$link = mysqli_connect($db_server, $db_user, $db_password, $db_table);
$sql = mysqli_query($link, $query);

$date = "";
$key1 = "";
$key2 = "";
$cId = "";
$desc = "";
$fio = "";
$clientKey = "";
foreach($sql as $r){
    $desc = $r['description'];
    $key1 = hash('sha256',$r['adminSign']);
    $key2 = hash('sha256',$r['clientSign']);
    $date = $r['created_date'];
    $cId = $r['id'];
    $clientKey = $r['clientKey'];
}
$sql->close();

$sql = mysqli_query($link, "SELECT * FROM `Users` WHERE `privateKey` = '$clientKey';");
foreach($sql as $r){
    $fio = $r['FIO'];
}
$sql->close();

$sql = mysqli_query($link, "UPDATE `SmartContracts` SET `genFile` = '$uni' WHERE `id` = ".$_GET['id']);




$phpWord = new  \PhpOffice\PhpWord\PhpWord(); 
$_doc = new \PhpOffice\PhpWord\TemplateProcessor('template.docx');
$_doc->setValue('key1', $key1); 
$_doc->setValue('num', $cId);
$_doc->setValue('date', $date);
$_doc->setValue('desc', $desc); 
$_doc->setValue('key2', $key2);
$_doc->setValue('client', $fio);
$img_Dir_Str = "vendor/";
$img_Dir = $_SERVER['DOCUMENT_ROOT']."/". $img_Dir_Str; 
@mkdir($img_Dir, 0777);
$file = str_replace("/","-", $uni);
$_doc->saveAs($img_Dir.$file);
$hash = getHashFile('vendor/'.$uni);
$sql = mysqli_query($link, "UPDATE `SmartContracts` SET `hash` = '$hash' WHERE `id` = ".$_GET['id']);
mysqli_close($link);
//echo "hash : $hash ".'vendor/'.$uni;
function getHashFile($filePath)
{
    if (!file_exists($filePath)) {
        throw new InvalidArgumentException("File not found");
    }

    $hashContext = hash_init('sha256');
    $file = fopen($filePath, 'rb');

    while (!feof($file)) {
        hash_update($hashContext, fread($file, 4096));
    }

    fclose($file);

    return hash_final($hashContext);
}

?>