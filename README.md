[![Latest Stable Version](https://poser.pugx.org/tankfairies/luhn/v/stable)](https://packagist.org/packages/tankfairies/luhn)
[![Total Downloads](https://poser.pugx.org/tankfairies/luhn/downloads)](https://packagist.org/packages/tankfairies/luhn)
[![Latest Unstable Version](https://poser.pugx.org/tankfairies/luhn/v/unstable)](https://packagist.org/packages/tankfairies/luhn)
[![License](https://poser.pugx.org/tankfairies/luhn/license)](https://packagist.org/packages/tankfairies/luhn)
[![Build Status](https://travis-ci.org/tankfairies/luhn.svg?branch=master)](https://travis-ci.org/tankfairies/luhn)

# Luhn
Templated Luhn generator and validator.

This is an implementation of the Luhn Algorithm for PHP. The Luhn Algorithm is
used to validate things like credit cards and national identification numbers.
More information on the algorithm can be found at [Wikipedia](http://en.wikipedia.org/wiki/Luhn_algorithm).

## Installation

Install with [Composer](https://getcomposer.org/):

```bash
composer require tankfairies/luhn 
```

## Usage

Instantiate a new instance of the library:
 
Generate numeric Luhn e.g. *USR-6560-73597* : -
```php
use Tankfairies\Luhn\Luhn;

$luhn = new Luhn();
$luhn->setTemplate('USR-####-####');
$luhn->setPostfixType(Luhn::NUMERIC);

$token = $luhn->generate();
```

Generate alpha numeric Luhn e.g. *USR-f36x-x79n9* : -

```php
use Tankfairies\Luhn\Luhn;

$luhn = new Luhn();
$luhn->setTemplate('USR-####-####');
$luhn->setPostfixType(Luhn::ALPHA_NUMERIC);

$token = $luhn->generate();
```

Validate a Luhn (returns true or false): -

```php
use Tankfairies\Luhn\Luhn;

$luhn = new Luhn();
$luhn->validate('USR-f36x-x79n9');
```

## Copyright and license

The tankfairies/luhn library is Copyright (c) 2019 Tankfairies (https://tankfairies.com) and licensed for use under the MIT License (MIT).
