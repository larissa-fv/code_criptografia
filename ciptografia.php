<?php

function DecifraLetra($letra, $qtdCasas)
{
    $letra = strtolower($letra);

    $cifrado = ['a','b','c','d','e','f','g','h','i','j', 'k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];

    $j = 0;

    while ($j < count($cifrado) && ($letra != $cifrado[$j]))
        $j++;

    while($qtdCasas > 0)
    {
        $j--;

        if($j < 0)
            $j = count($cifrado)-1;

        $qtdCasas--;
    }        
    return strtolower($cifrado[$j]);
}

function DecifraMensagem($qtdCasas, $mensagem)
{
    $resposta = "";

    for($i=0; $i < strlen($mensagem); $i++)
    {            
        if($mensagem[$i] == " ")
            $resposta .= " ";
        else if($mensagem[$i] < chr(48) || $mensagem[$i] < chr(65) || $mensagem[$i] < chr(97))
            $resposta .= $mensagem[$i];
        else
            $resposta .= DecifraLetra($mensagem[$i], $qtdCasas);                       
    }
    return strtolower($resposta);
}

$urlReceive = "https://api.codenation.dev/v1/challenge/dev-ps/generate-data?token=306b9c84e78a65a7acecb70ea612478870d92834;

$ch = curl_init();

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $urlReceive);

$result = curl_exec($ch);

curl_close($ch);

$result = json_decode($result, true);

$decifrado = DecifraMensagem($result['numero_casas'], $result['cifrado']);

$resp = array(
    'numero_casas' => (int)json_encode($result['numero_casas']),
    'token' => $result['token'],
    'cifrado' => $result['cifrado'],
    'decifrado' => $decifrado,
    'resumo_criptografico' => sha1($decifrado)
);

print_r($resp);
$fp = fopen("answer.json", "w");
fwrite($fp, json_encode($resp));
fclose($fp);

?>

<form action = " https://api.codenation.dev/v1/challenge/dev-ps/submit-solution?token=306b9c84e78a65a7acecb70ea612478870d92834";
      method="POST" 
      enctype="multipart/form-data">
        Enviar o arquivo: <input type="file" name="answer" />
        <input type="submit" value="Enviar" />
</form>

<?php