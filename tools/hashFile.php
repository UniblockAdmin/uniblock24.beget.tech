<?
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