# ExactTarget API wrapper _for Laravel_

A wrapper to ExactTarget **REST** API.

## Get started

_[TODO]_

## Usage


### Vanilla PHP

```php
<?php
$guzzleClient   = new \GuzzleHttp\Client();
$requestBuilder = new \LeroyMerlin\ExactTarget\RequestBuilder($guzzleClient);
$token          = new \LeroyMerlin\ExactTarget\Token('YOUR_CLIENT_ID', 'YOUR_CLIENT_SECRET', $requestBuilder);
$client         = new \LeroyMerlin\ExactTarget\Client($token, $requestBuilder);

$parameters = [
    // optional
    // 'some-url-param' => 'some-value'
    'data' => [
        'email' => 'johndoe@example.com',
        'validators' => ['SyntaxValidator', 'MXValidator', 'ListDetectiveValidator'],
    ],
];

try {
    $response = $client->validateEmail($parameters);
    var_dump((string) $response->getBody());
} catch (LeroyMerlin\ExactTarget\Exception\ExactTargetClientException $error) {
    var_dump($error->getCode(), $error->getMessage());
}
```


### Laravel
#### With facade
_[TODO]_

#### Without facade

```php
$exactTarget = App::make('LeroyMerlin\ExactTarget\Client');

$exactTarget->requestToken(); // To obtain an OAuth token

// As in https://code.exacttarget.com/apis-sdks/rest-api/v1/address/validateEmail.html
$parameters = [
    // optional
    // 'some-url-param' => 'some-value'
    'data' => [
        'email' => 'johndoe@example.com',
        'validators' => ['SyntaxValidator', 'ListDetectiveValidator'],
    ],
];

$result = $exactTarget->validateEmail($parameters);
// $result will be [
//     'email': 'johndoe@example.com',
//     'valid': true
// ];
```
