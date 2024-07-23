<?php
// URL do site que você deseja acessar através do proxy
$url = 'https://websolus.humanasaude.com.br' . $_SERVER['REQUEST_URI'];

// Inicializa uma sessão cURL
$ch = curl_init($url);

// Define opções para a sessão cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);

// Executa a sessão cURL e captura a resposta
$response = curl_exec($ch);

// Captura o status HTTP da resposta
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// Fecha a sessão cURL
curl_close($ch);

// Define o cabeçalho HTTP de resposta
http_response_code($http_code);

// Imprime a resposta
echo $response;
?>
