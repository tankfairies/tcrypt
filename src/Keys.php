<?php
/**
 * Copyright (c) 2019 Tankfairies
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/tankfairies/tcrypt
 */

namespace Tankfairies\Tcrypt;

/**
 * Class Keys
 *
 * Used to generate the public/private key pair
 *
 * @package Tankfairies\Tcrypt
 */
class Keys
{
    /**
     * @var string
     */
    private $secretKey;

    /**
     * @var string
     */
    private $publicKey;

    /**
     * @param string $password
     * @param string $salt
     * @throws TcryptException
     */
    public function setPasswordAndSalt(string $password, string $salt): void
    {
        if (empty($password)) {
            throw new TcryptException('no password set');
        }

        if (mb_strlen($salt) < 16) {
            throw new TcryptException('salt need to be at least 15 chars long');
        }

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

    /**
     * Returns the private key
     *
     * @return string
     * @throws TcryptException
     */
    public function getSecretKey(): string
    {
        if (empty($this->secretKey)) {
            throw new TcryptException('password and salt not set');
        }

        return $this->secretKey;
    }

    /**
     * Returns the public key
     *
     * @return string
     * @throws TcryptException
     */
    public function getPublicKey(): string
    {
        if (empty($this->secretKey)) {
            throw new TcryptException('password and salt not set');
        }

        return $this->publicKey;
    }
}
