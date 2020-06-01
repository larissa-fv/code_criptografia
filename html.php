<?php
$url = "https://api.codenation.dev/v1/challenge/dev-ps/generate-data?token=306b9c84e78a65a7acecb70ea612478870d92834";
$result = " https://api.codenation.dev/v1/challenge/dev-ps/submit-solution?token=306b9c84e78a65a7acecb70ea612478870d92834";

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