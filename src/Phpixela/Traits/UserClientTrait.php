<?php

namespace Phpixela\Traits;

trait UserClientTrait
{
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
}