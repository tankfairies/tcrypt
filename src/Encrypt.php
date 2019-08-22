<?php

namespace Tankfairies\Tcrypt;

class Encrypt extends AbstractCrypt
{
    public function enc($message)
    {
        $nonce = random_bytes(SODIUM_CRYPTO_BOX_NONCEBYTES); /* Never repeat this! */

        return base64_encode($nonce . sodium_crypto_box($message, $nonce, $this->key()));
    }
}