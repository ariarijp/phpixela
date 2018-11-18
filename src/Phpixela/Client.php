<?php

namespace Phpixela;

use Phpixela\Traits\GraphClientTrait;
use Phpixela\Traits\PixelClientTrait;
use Phpixela\Traits\UserClientTrait;

class Client
{
    use GraphClientTrait;
    use PixelClientTrait;
    use UserClientTrait;

    const BASE_URI = 'https://pixe.la/v1/';

    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * Client constructor.
     * @param string $token
     * @param null|mixed|\GuzzleHttp\Handler\MockHandler $handler
     */
    public function __construct(string $token, $handler = null)
    {
        $config = [
            'base_uri' => self::BASE_URI,
            'headers' => [
                'X-USER-TOKEN' => $token,
            ],
        ];

        if (!is_null($handler)) {
            $config['handler'] = $handler;
        }

        $this->client = new \GuzzleHttp\Client($config);
    }

    /**
     * @param string $method
     * @param string $url
     * @param array $params
     * @param bool $json
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function request(string $method, string $url, array $params = [], $json = true)
    {
        $body = $this->client->request($method, $url, $params)->getBody();
        if ($json) {
            return json_decode($body, true);
        }
        return $body->getContents();
    }
}
