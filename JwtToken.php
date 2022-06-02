<?php

namespace common\components;

use yii\base\Component;

class JwtToken extends Component
{
    public function create($user_id)
    {
        $secret = getenv('SECRET');

        // Create the token header
        $header = json_encode([
            'typ' => 'JWT',
            'alg' => 'HS256'
        ]);

        // Create the token payload
        $payload = json_encode([
            'user_id' => $user_id,
            'role' => 'user',
            'exp' => time()
        ]);

        // Encode Header
        $base64UrlHeader = base64_encode($header);

        // Encode Payload
        $base64UrlPayload = base64_encode($payload);

        // Create Signature Hash
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);

        // Encode Signature to Base64Url String
        $base64UrlSignature = base64_encode($signature);

        // Create JWT
        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

        return $jwt;
    }
}
