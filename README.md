[![Latest Stable Version](https://poser.pugx.org/tankfairies/tcrypt/v/stable)](https://packagist.org/packages/tankfairies/tcrypt)
[![Total Downloads](https://poser.pugx.org/tankfairies/tcrypt/downloads)](https://packagist.org/packages/tankfairies/tcrypt)
[![Latest Unstable Version](https://poser.pugx.org/tankfairies/tcrypt/v/unstable)](https://packagist.org/packages/tankfairies/tcrypt)
[![License](https://poser.pugx.org/tankfairies/tcrypt/license)](https://packagist.org/packages/tankfairies/tcrypt)
[![Build Status](https://travis-ci.com/tankfairies/tcrypt.svg?branch=master)](https://travis-ci.com/tankfairies/tcrypt)

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
$keys->setPasswordAndSalt('yourpassword', 'a_salt__at_least_15_chars_long');
```

Encrypt the message: -

```php
$crypt = new Encrypt();
$crypt
    ->setLocalKeys($sendKeys)
    ->setForeignKey(hex2bin('the_binary_public_key_from_the_remote_receipient'));

$encryptedMessage = $crypt->enc('my secret message');
```

To Decrypt the message: -
```php
$decrypt = new Decrypt();
$decrypt
    ->setLocalKeys($keys)
    ->setForeignKey(hex2bin('the_binary_public_key_from_the_sender'));

$decryptedMessage = $decrypt->dec($encryptedMessage);
```

## Copyright and license

The tankfairies/tcrypt library is Copyright (c) 2019 Tankfairies (https://tankfairies.com) and licensed for use under the MIT License (MIT).
