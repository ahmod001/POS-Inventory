<?php
namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken
{
    public static function createToken(string $email, int|string $id, string $type): string
    {
        $key = env('JWT_KEY');
        $expire = $type === 'login' ?
            (60 * 60 * 24) : // 24 Hours
            (60 * 10); // 10 minutes

        $payload = [
            'iss' => 'laravel-token',
            'iat' => time(),
            'exp' => time() + $expire,
            'userEmail' => $email,
            'userId' => $id
        ];
        return JWT::encode($payload, $key, 'HS256');
    }

    public static function verifyToken(string|null $token): string|object
    {
        try {
            if ($token !== null) {
                $key = env('JWT_KEY');
                $decode = JWT::decode($token, new Key($key, 'HS256'));
                return $decode;
            } else {
                return "unauthorized";
            }
        } catch (Exception $e) {
            return "unauthorized";
        }
    }
}