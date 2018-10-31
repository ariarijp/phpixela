# Phpixela

[Pixela](https://pixe.la/) API client for PHP.

[![Latest Stable Version](https://poser.pugx.org/ariarijp/phpixela/version)](https://packagist.org/packages/ariarijp/phpixela)
[![Latest Unstable Version](https://poser.pugx.org/ariarijp/phpixela/v/unstable)](https://packagist.org/packages/ariarijp/phpixela)
[![Build Status](https://travis-ci.org/ariarijp/phpixela.svg?branch=master)](https://travis-ci.org/ariarijp/phpixela)
[![License](https://poser.pugx.org/ariarijp/phpixela/license)](https://packagist.org/packages/ariarijp/phpixela)
[![composer.lock available](https://poser.pugx.org/ariarijp/phpixela/composerlock)](https://packagist.org/packages/ariarijp/phpixela)
[![Coverage Status](https://coveralls.io/repos/github/ariarijp/phpixela/badge.svg?branch=master)](https://coveralls.io/github/ariarijp/phpixela?branch=master)

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
