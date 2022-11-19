<?php
// include './verifyToken.php';

// if (verifyToken()) {
//     echo json_encode("Positve");
// } else {
//     echo json_encode("Negative");
// }

declare(strict_types=1);
include './connection.php';
use Firebase\JWT\JWT;

require_once('./vendor/autoload.php');
if (! preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
    header('HTTP/1.0 400 Bad Request');
    echo 'Token not found in request';
    exit;
}

$jwt = $matches[1];
if (! $jwt) {
    // No token was able to be extracted from the authorization header
    header('HTTP/1.0 400 Bad Request');
    exit;
}

$secretKey  = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';
try {
    
    $token = JWT::decode($jwt, $secretKey, ['HS512']);
}catch (\Firebase\JWT\ExpiredException $e) {
    header('HTTP/1.0 400 Bad Request');
    echo 'Expired';
    exit;
} catch (\Exception $e) {
    header('HTTP/1.0 400 Bad Request');
    echo var_dump($e);
}
$now = new DateTimeImmutable();
// $serverName = "http://localhost:3000/";

if (
    // $token->iss !== $serverName ||
    $token->nbf > $now->getTimestamp() ||
    $token->exp < $now->getTimestamp()
    )
{
    header('HTTP/1.1 401 Unauthorized');
    exit;
}

// echo json_encode($token->exp);