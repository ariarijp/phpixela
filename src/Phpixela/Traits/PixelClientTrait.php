<?php

namespace Phpixela\Traits;

trait PixelClientTrait
{
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