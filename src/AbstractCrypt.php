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

use SodiumException;

/**
 * Class AbstractCrypt
 *
 * @package Tankfairies\Tcrypt
 */
class AbstractCrypt
{

    /**
     * @var string
     */
    protected string $foreignKey;

    /**
     * @var Keys
     */
    protected Keys $localKeys;

    /**
     * Sets the key pair
     *
     * @param Keys $localKeys
     * @return AbstractCrypt
     */
    public function setLocalKeys(Keys $localKeys): self
    {
        $this->localKeys = $localKeys;
        return $this;
    }

    /**
     * Sets the foreign key
     *
     * @param string $foreignKey
     * @return AbstractCrypt
     * @throws TcryptException
     */
    public function setForeignKey(string $foreignKey): self
    {
        if (empty($foreignKey)) {
            throw new TcryptException('foreign key not set');
        }

        $this->foreignKey = hex2bin($foreignKey);
        return $this;
    }

    /**
     * Generates the key from the keypair
     *
     * @return string
     * @throws TcryptException
     * @throws SodiumException
     */
    protected function key(): string
    {
        return sodium_crypto_box_keypair_from_secretkey_and_publickey(
            $this->localKeys->getSecretKey(),
            $this->foreignKey
        );
    }
}
