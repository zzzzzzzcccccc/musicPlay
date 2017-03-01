<?php
header("Content-Type: text/html; charset=UTF-8");

function curl_get($url)
{
    $refer = "http://music.163.com/";
    $header[] = "Cookie: " . "appver=1.5.0.75771;";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($ch, CURLOPT_REFERER, $refer);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

function get_album_info($album_id)
{
    $url = "http://music.163.com/api/album/" . $album_id;
    return curl_get($url);
}

$id = $_GET['id'];
$data = json_decode(get_album_info($id), true);


foreach ($data['album']['songs'] as $key ) {
	str_replace("http://m", "http://p", $key["mp3Url"]);
}

$mp3 = $data['album']['songs'];

echo $_GET['callback'] . "(" . json_encode(array('result'=>$mp3)) . ")";

?>