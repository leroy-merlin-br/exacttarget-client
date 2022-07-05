# ExactTarget API wrapper _for PHP, Laravel 5.* and 4.2_

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
} catch (\LeroyMerlin\ExactTarget\Exception\ExactTargetClientException $error) {
    var_dump($error->getCode(), $error->getMessage());
}
```


### Laravel 5.*

```php
$client = app(\LeroyMerlin\ExactTarget\Client::class);

// As in https://code.exacttarget.com/apis-sdks/rest-api/v1/address/validateEmail.html
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
} catch (\LeroyMerlin\ExactTarget\Exception\ExactTargetClientException $error) {
    var_dump($error->getCode(), $error->getMessage());
}
```

### Laravel 4.2

```php
$client = App::make('LeroyMerlin\ExactTarget\Client');

// As in https://code.exacttarget.com/apis-sdks/rest-api/v1/address/validateEmail.html
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
} catch (\LeroyMerlin\ExactTarget\Exception\ExactTargetClientException $error) {
    var_dump($error->getCode(), $error->getMessage());
}
```
