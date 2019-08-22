<?php

namespace Tankfairies\Tcrypt;

class Decrypt extends AbstractCrypt
{
    public function dec($message)
    {
        $message = base64_decode($message);
        $nonce = mb_substr($message, 0, 24, '8bit');
        $cipherText = mb_substr($message, 24, null, '8bit');

        return sodium_crypto_box_open($cipherText, $nonce, $this->key());
    }
}