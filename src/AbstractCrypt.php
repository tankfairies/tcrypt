<?php


namespace Tankfairies\Tcrypt;


class AbstractCrypt
{

    protected $foreignKey;

    /**
     * @var Keys
     */
    protected $localKeys;

    public function setLocalKeys(Keys $localKeys)
    {
        $this->localKeys = $localKeys;
        return $this;
    }

    public function setForeignKey($foreignKey)
    {
        $this->foreignKey = $foreignKey;
        return $this;
    }

    protected function key()
    {
        return sodium_crypto_box_keypair_from_secretkey_and_publickey(
            $this->localKeys->getSecretKey(),
            $this->foreignKey
        );
    }
}