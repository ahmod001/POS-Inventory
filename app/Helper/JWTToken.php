<?php
namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken
{
    public static function createToken(string $email, string $type): string
    {
        $key = env('JWT_KEY');
        $expire = $type === 'login' ?
            (60 * 60) : // 60 minutes
            (60 * 10); // 10 minutes

        $payload = [
            'iss' => 'laravel-token',
            'iat' => time(),
            'exp' => time() + $expire,
            'userEmail' => $email
        ];
        return JWT::encode($payload, $key, 'HS256');
    }

    public static function verifyToken(string $token): string
    {
        try {
            $key = env('JWT_KEY');
            $decode = JWT::decode($token, new Key($key, 'HS256'));
            return $decode->userEmail;
        } catch (Exception $e) {
            return "unauthorized";
        }
    }
}