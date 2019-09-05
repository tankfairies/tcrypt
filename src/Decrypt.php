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
 * Class Decrypt
 *
 * @package Tankfairies\Tcrypt
 */
class Decrypt extends AbstractCrypt
{
    /**
     * Decrypts the message
     *
     * @param string $message
     * @return string
     * @throws TcryptException
     */
    public function dec(string $message): string
    {
        $message = base64_decode($message);
        $nonce = mb_substr($message, 0, 24, '8bit');
        $cipherText = mb_substr($message, 24, null, '8bit');

        return sodium_crypto_box_open($cipherText, $nonce, $this->key());
    }
}
