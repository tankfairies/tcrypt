[![Latest Stable Version](https://poser.pugx.org/tankfairies/tcrypt/v/stable)](https://packagist.org/packages/tankfairies/tcrypt)
[![Total Downloads](https://poser.pugx.org/tankfairies/tcrypt/downloads)](https://packagist.org/packages/tankfairies/tcrypt)
[![Latest Unstable Version](https://poser.pugx.org/tankfairies/tcrypt/v/unstable)](https://packagist.org/packages/tankfairies/tcrypt)
[![License](https://poser.pugx.org/tankfairies/tcrypt/license)](https://packagist.org/packages/tankfairies/tcrypt)
[![Build Status](https://travis-ci.com/tankfairies/tcrypt.svg?branch=2.0)](https://travis-ci.com/github/tankfairies/tcrypt)

# Tcrypt

This is an implemetation of part of the sodium encryption library providing the ability to do end to end encryption.

https://www.php.net/manual/en/intro.sodium.php

## Installation

Install with [Composer](https://getcomposer.org/):

```bash
composer require tankfairies/tcrypt 
```

## Usage

Instantiate a copied of Keys for handing local key pairs.
```php
$keys = new Keys();
$keys->setPasswordAndSalt('senders_password', 'a_custom_salt_at_least_15_chars_long');
$thePublicSenderKey = $keys->getPublicKey();

$keys = new Keys();
$keys->setPasswordAndSalt('receivers_password', 'a_custom_salt_at_least_15_chars_long');
$thePublicReceiverKey = $keys->getPublicKey();
```
Example of a generated public key

```a322e905bd29167702bfc816a6e5ad2be0d8ede171d3c6e68497a5ef5b316d08```

Encrypt the message: -

```php
$crypt = new Encrypt();
$crypt
    ->setLocalKeys($sendKeys)
    ->setForeignKey($thePublicReceiverKey);

$encryptedMessage = $crypt->enc('my secret message');
```

This will produce something like: -

```9G/vMg4piI778CzVpjcOL/c4kGV7+j0ih+JfuYh0QzWYyfAvwQcy1tW8jXcrb2Fd5aRvkljTeQ55```

To Decrypt the message: -
```php
$decrypt = new Decrypt();
$decrypt
    ->setLocalKeys($keys)
    ->setForeignKey($thePublicSenderKey);

$decryptedMessage = $decrypt->dec($encryptedMessage);
```

## Copyright and license

The tankfairies/tcrypt library is Copyright (c) 2019 Tankfairies (https://tankfairies.com) and licensed for use under the MIT License (MIT).
