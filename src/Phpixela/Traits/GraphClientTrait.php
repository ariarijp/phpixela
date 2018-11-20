<?php

namespace Phpixela\Traits;

trait GraphClientTrait
{
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
}