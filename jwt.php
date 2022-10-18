<?php
declare(strict_types=1);
// include './connection.php';

use Firebase\JWT\JWT;

require_once('./vendor/autoload.php');

function generateJwt ($payload){
    $secretKey  = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';
$issuedAt   = new DateTimeImmutable();
$expire     = $issuedAt->modify('+25 days')->getTimestamp();      // Add 60 seconds
$serverName = "http://localhost:3000";
 

$data = [
    'iat'  => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated
    'iss'  => $serverName,                       // Issuer
    'nbf'  => $issuedAt->getTimestamp(),         // Not before
    'exp'  => $expire,                           // Expire
    'data' => $payload,                     // User name
];

return JWT::encode($data, $secretKey, "HS512");
}