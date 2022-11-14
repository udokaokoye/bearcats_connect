<?php
    declare(strict_types=1);
    // include './connection.php';
    use Firebase\JWT\JWT;
    
    require_once('./vendor/autoload.php');
function verifyToken () {

    // if (!isset($_SERVER['HTTP_AUTHORIZATION'])) {
    //     header('HTTP/1.0 400 Bad Request');
    //     echo json_encode('Token not found in request');
    //     exit;
    // }

if (! preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
    header('HTTP/1.0 400 Bad Request');
    echo json_encode('Token not found in request');
    exit;
}

$jwt = $matches[1];
if (!$jwt) {
    // No token was able to be extracted from the authorization header
    header('HTTP/1.0 400 Bad Request');
    echo json_encode("NO TOKEN");
    exit;
}

$secretKey  = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';
try {
    
    $token = JWT::decode($jwt, $secretKey, ['HS512']);
}catch (\Firebase\JWT\ExpiredException $e) {
    // JWT::$leeway = 720000;
    //          $decoded = (array) JWT::decode($jwt, $secretKey, ['HS512']);
    //          // TODO: test if token is blacklisted
    //          $decoded['iat'] = time();
    //          $decoded['exp'] = time() + (60 * 60);

    //          return JWT::encode($decoded, $secretKey);
    header('HTTP/1.0 400 Bad Request');
    echo json_encode('Expired');
    exit;
} catch (\Exception $e) {
    echo var_dump($e);
}

$serverName = "http://localhost:3000/";
$now = new DateTimeImmutable();

if (
    // $token->iss !== $serverName ||
    $token->nbf > $now->getTimestamp() ||
    $token->exp < $now->getTimestamp()
    )
{
    header('HTTP/1.1 401 Unauthorized');
    exit;
}

return true;
}