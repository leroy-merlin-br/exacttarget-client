# ExactTarget API wrapper _for Laravel_

A wrapper to ExactTarget **REST** API.

## Get started

Add this package into your `composer.json`.

> "leroy-merlin-br/laravel-exacttarget" : "~1.0"

Run `composer update`

> composer update

## Usage

### With facade
_[TODO]_

### Without facade

```php
$exactTarget = App::make('LeroyMerlin\ExactTarget\Client');

$exactTarget->requestToken(); // To obtain an OAuth token

// As in https://code.exacttarget.com/apis-sdks/rest-api/v1/address/validateEmail.html
$data = [
    'email' => 'johndoe@example.com',
    'validators' => ['SyntaxValidator', 'MXValidator']
];

$result = $exactTarget->postValidateEmail($data);
// $result will be [
//     'email': 'help@example.com',
//     'valid': true
// ];
```
