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

function get_music_info($music_id)
{
    $url = "http://music.163.com/api/song/detail/?id=" . $music_id . "&ids=%5B" . $music_id . "%5D";
    return curl_get($url);
}

$id = $_GET['id'];

$data = json_decode(get_music_info($id), true);

$mp3_url = str_replace("http://m", "http://p", $data["songs"][0]["mp3Url"]);
$mp3_name = $data["songs"][0]["name"];
$mp3_bg = $data["songs"][0]["album"]["picUrl"];



echo $_GET['callback'] . "(" . json_encode(array('mp3url'=>$mp3_url,'mp3name'=>$mp3_name,'mp3bg'=>$mp3_bg)) . ")";


?>