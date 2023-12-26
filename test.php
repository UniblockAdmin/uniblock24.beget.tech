<?
//http://tomassop.beget.tech/?method=createAccount

function getContent($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $content = curl_exec($ch);
    curl_close($ch);

    return $content;
}

$content = getContent("http://tomassop.beget.tech/?method=createAccount");
echo $content;


?>