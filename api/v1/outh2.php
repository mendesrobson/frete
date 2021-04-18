<?php

/**
  * Substitua os valores abaixo pelas informações de integração encontradas na página de construção do marketplace.
  */ 
$clientId = '2f204667-77e6-4941-a1cd-c8e4cb2ebcaa';
$clientSecret = 'SonaSystem@2021';

/**
  * Para onde redirecionar depois que o fluxo do OAuth 2 for concluído.
  * Certifique-se de que corresponda às informações de suas configurações de integração na página de construção do marketplace.
 */
$redirectUri = 'http://localhost:3000/oauth.php';

/* ------------------------------------------------------------------------------------------------- */

/**
  * Quando o fluxo de autenticação OAuth2 foi concluído, o usuário é redirecionado de volta com um código.
  * Se recebermos o código, podemos obter um token de acesso e fazer chamadas de API. Caso contrário, redirecionamos
  * o usuário para os terminais de autorização OAuth2.
  */
if (!empty($_GET['code'])) {

    $code = rawurldecode($_GET['code']);

    /**
     * Solicite um token de acesso com base no código de autorização recebido.
     */
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://sonasystem.com.br');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        'code' => $code,
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'redirect_uri' => $redirectUri,
        'grant_type' => 'authorization_code',
    ]);

    $response = curl_exec($ch);
    $data = json_decode($response, true);
    $accessToken = $data['access_token'];

    /**
     * Obtenha as informações de identidade do usuário usando o token de acesso.
     */
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.teamleader.eu/users.me');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $accessToken]);

    $response = curl_exec($ch);
    $data = json_decode($response, true);

    echo $response;

} else {

    $query = [
        'client_id' => $clientId,
        'response_type' => 'code',
        'redirect_uri' => $redirectUri,
    ];

    header('Location: https://sonasystem.com.br/oauth2/authorize?' . http_build_query($query));

}