# Phpixela

[Pixela](https://pixe.la/) API client for PHP.

## Installation

```
$ composer require ariarijp/phpixela dev-master
```

## Usage

```php
<?php

require './vendor/autoload.php';

$token = 'access_token';
$username = 'username';
$graphId = 'graph_id';
$today = date('Ymd');

$client = new \Phpixela\Client($token);
$client->getGraphs($username);

try {
    $client->getPixel($username, $graphId, $today);
} catch (\Exception $e) {
    $client->createPixel($username, $graphId, $today, '0');
}

var_dump($client->getPixel($username, $graphId, $today));

$client->incrementPixel($username, $graphId);
$client->incrementPixel($username, $graphId);
$client->incrementPixel($username, $graphId);

var_dump($client->getPixel($username, $graphId, $today));

$client->decrementPixel($username, $graphId);
$client->decrementPixel($username, $graphId);

var_dump($client->getPixel($username, $graphId, $today));
```

## License

MIT

## Author

[Takuya Arita](https://github.com/ariarijp)
