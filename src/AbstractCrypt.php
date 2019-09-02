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
 * Class AbstractCrypt
 *
 * @package Tankfairies\Tcrypt
 */
class AbstractCrypt
{

    /**
     * @var string
     */
    protected $foreignKey;

    /**
     * @var Keys
     */
    protected $localKeys;

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
     */
    public function setForeignKey(string $foreignKey): self
    {
        $this->foreignKey = $foreignKey;
        return $this;
    }

    /**
     * Generates the key from the keypair
     *
     * @return string
     */
    protected function key(): string
    {
        return sodium_crypto_box_keypair_from_secretkey_and_publickey(
            $this->localKeys->getSecretKey(),
            $this->foreignKey
        );
    }
}
