<?php
$url = "https://api.codenation.dev/v1/challenge/dev-ps/generate-data?token=9924361c9e4f61b8c48277e5024bd7ff5ab6cddc";

$ch = curl_init();

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);

$result = curl_exec($ch);

curl_close($ch);

$result = json_decode($result, true);
print_r($result);

$fp = fopen("answer.json", "w+");
 
fwrite($fp, json_encode($result));

fclose($fp);

?>