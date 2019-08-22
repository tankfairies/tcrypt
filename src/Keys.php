<?php

namespace Tankfairies\Tcrypt;

class Keys
{
    private $secretKey;
    private $publicKey;

    public function setPasswordAndSalt(string $password, string $salt): void
    {
        $seed = Sodium_crypto_pwhash(
            SODIUM_CRYPTO_BOX_SEEDBYTES,
            $password,
            $salt,
            SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE,
            SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE
        );
        $keypair = Sodium_crypto_box_seed_keypair($seed);

        $this->secretKey = Sodium_crypto_box_secretkey($keypair);
        $this->publicKey = sodium_crypto_box_publickey($keypair);
    }

    public function getSecretKey(): string
    {
        return $this->secretKey;
    }

    public function getPublicKey(): string
    {
        return $this->publicKey;
    }
}