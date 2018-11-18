<?php

namespace Phpixela\Traits;

trait WebhookClientTrait
{
    /**
     * @param string $username
     * @param string $graphId
     * @param string $type
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createWebhook(string $username, string $graphId, string $type)
    {
        $url = sprintf('users/%s/webhooks', $username);
        return $this->request('post', $url, [
            'json' => ['graphID' => $graphId, 'type' => $type],
        ]);
    }

    /**
     * @param string $username
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getWebhooks(string $username)
    {
        $url = sprintf('users/%s/webhooks', $username);
        return $this->request('get', $url);
    }

    /**
     * @param string $username
     * @param string $webhookHash
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function invokeWebhook(string $username, string $webhookHash)
    {
        $url = sprintf('users/%s/webhooks/%s', $username, $webhookHash);
        return $this->request('post', $url);
    }

    /**
     * @param string $username
     * @param string $webhookHash
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteWebhook(string $username, string $webhookHash)
    {
        $url = sprintf('users/%s/webhooks/%s', $username, $webhookHash);
        return $this->request('delete', $url);
    }
}