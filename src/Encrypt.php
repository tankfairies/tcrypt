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

use Exception;

/**
 * Class Encrypt
 *
 * @package Tankfairies\Tcrypt
 */
class Encrypt extends AbstractCrypt
{
    /**
     * Encrypts the message
     *
     * @param string $message
     * @return string
     * @throws Exception
     */
    public function enc(string $message): string
    {
        $nonce = random_bytes(SODIUM_CRYPTO_BOX_NONCEBYTES); /* Never repeat this! */

        return base64_encode($nonce . sodium_crypto_box($message, $nonce, $this->key()));
    }
}
