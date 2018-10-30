<?php

namespace Phpixela;

class Client
{
    const BASE_URI = 'https://pixe.la/v1/';

    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * Client constructor.
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => self::BASE_URI,
            'headers' => [
                'X-USER-TOKEN' => $token,
            ],
        ]);
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

    /**
     * @param string $token
     * @param string $username
     * @param string $agreeTermsOfService
     * @param string $notMinor
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createUser(string $token, string $username, string $agreeTermsOfService, string $notMinor)
    {
        return $this->request('post', 'users', [
            'json' => [
                'token' => $token,
                'username' => $username,
                'agreeTermsOfService' => $agreeTermsOfService,
                'notMinor' => $notMinor,
            ],
        ]);
    }

    /**
     * @param string $username
     * @param string $newToken
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateUser(string $username, string $newToken)
    {
        $url = sprintf('users/%s', $username);
        return $this->request('put', $url, [
            'json' => [
                'newToken' => $newToken,
            ],
        ]);
    }

    /**
     * @param string $username
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteUser(string $username)
    {
        $url = sprintf('users/%s', $username);
        return $this->request('delete', $url);
    }

    /**
     * @param string $username
     * @param string $id
     * @param string $name
     * @param string $unit
     * @param string $type
     * @param string $color
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createGraph(string $username, string $id, string $name, string $unit, string $type, string $color)
    {
        $url = sprintf('users/%s/graphs', $username);
        return $this->request('post', $url, [
            'json' => [
                'id' => $id,
                'name' => $name,
                'unit' => $unit,
                'type' => $type,
                'color' => $color,
            ],
        ]);
    }

    /**
     * @param string $username
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getGraphs(string $username)
    {
        $url = sprintf('users/%s/graphs', $username);
        return $this->request('get', $url);
    }

    /**
     * @param string $username
     * @param string $graphId
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getGraph(string $username, string $graphId)
    {
        $url = sprintf('users/%s/graphs/%s', $username, $graphId);
        return $this->request('get', $url, [], false);
    }

    /**
     * @param string $username
     * @param string $graphId
     * @param $name
     * @param $unit
     * @param $color
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateGraph(string $username, string $graphId, $name, $unit, $color)
    {
        $url = sprintf('users/%s/graphs/%s', $username, $graphId);
        return $this->request('put', $url, [
            'json' => [
                'name' => $name,
                'unit' => $unit,
                'color' => $color,
            ],
        ]);
    }

    /**
     * @param string $username
     * @param string $graphId
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteGraph(string $username, string $graphId)
    {
        $url = sprintf('users/%s/graphs/%s', $username, $graphId);
        return $this->request('delete', $url);
    }

    /**
     * @param string $username
     * @param string $graphId
     * @param string $date
     * @param string $quantity
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createPixel(string $username, string $graphId, string $date, string $quantity)
    {
        $url = sprintf('users/%s/graphs/%s', $username, $graphId);
        return $this->request('post', $url, [
            'json' => ['date' => $date, 'quantity' => $quantity],
        ]);
    }

    /**
     * @param string $username
     * @param string $graphId
     * @param string $date
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPixel(string $username, string $graphId, string $date)
    {
        $url = sprintf('users/%s/graphs/%s/%s', $username, $graphId, $date);
        return $this->request('get', $url);
    }

    /**
     * @param string $username
     * @param string $graphId
     * @param string $date
     * @param string $quantity
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updatePixel(string $username, string $graphId, string $date, string $quantity)
    {
        $url = sprintf('users/%s/graphs/%s/%s', $username, $graphId, $date);
        return $this->request('put', $url, [
            'json' => ['quantity' => $quantity],
        ]);
    }

    /**
     * @param string $username
     * @param string $graphId
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function incrementPixel(string $username, string $graphId)
    {
        $url = sprintf('users/%s/graphs/%s/increment', $username, $graphId);
        return $this->request('put', $url);
    }

    /**
     * @param string $username
     * @param string $graphId
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function decrementPixel(string $username, string $graphId)
    {
        $url = sprintf('users/%s/graphs/%s/decrement', $username, $graphId);
        return $this->request('put', $url);
    }

    /**
     * @param string $username
     * @param string $graphId
     * @param string $date
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deletePixel(string $username, string $graphId, string $date)
    {
        $url = sprintf('users/%s/graphs/%s/%s', $username, $graphId, $date);
        return $this->request('delete', $url);
    }
}
