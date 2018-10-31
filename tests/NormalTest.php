<?php

namespace StandardTest;

use PHPUnit\Framework\TestCase;
use Phpixela\Client;

/**
 * Class StandardTest
 * @package CollectionTest
 */
class NormalTest extends TestCase
{
    /** @var $user_name string */
    const user_name = "phpixela-tester";
    /** @var self::token string */
    const token = "CC517a6943346e30474e66594e49782b6f69557643673dCC";

    /** @var $user_name_cd string */
    const user_name_cd = "phpixela-create-delete-tester";
    /** @var $cd_token string */
    const cd_token = "61434c4d6f2b6d6748667856577537674a4c70596c673d3d";
    /** @var $cd_token_reset string */
    const cd_token_reset = "44517a6943346e30474e66594e49782b6f69557643673d3d";

    /**
     * @test UserAPI ( create / update / delete )
     */
    public function api_user ()
    {
        $client = new Client(self::cd_token);
        $client_reset = new Client(self::cd_token_reset);

        try {
            // create
            $response = $client->createUser(self::cd_token, self::user_name_cd, 'yes', 'yes');
            $this->assertTrue($response['isSuccess'], 'API: createUser');

            // update 1
            $response = $client->updateUser(self::user_name_cd, self::cd_token_reset);
            $this->assertTrue($response['isSuccess'], 'API: updateUser 1');

            // update 2
            $response = $client_reset->updateUser(self::user_name_cd, self::cd_token);
            $this->assertTrue($response['isSuccess'], 'API: updateUser 2');

        } catch (\Throwable $e) {
            $this->fail($e);
        } finally {
            // delete
            $response = $client->deleteUser(self::user_name_cd);
            $this->assertTrue($response['isSuccess'], 'API: deleteUser');
        }
    }

    /**
     * @test
     */
    public function ready_test_user ()
    {
        $client = new Client(self::token);
        try {
            $client->getGraphs(self::user_name);
        } catch (\Throwable $e) {
            $client->createUser(self::token, self::user_name, 'yes','yes');
        }
        $this->assertTrue(true);
    }

    /**
     * @test
     * @depends ready_test_user
     */
    public function api_graph ()
    {
        $client = new Client(self::token);
        $user_name = self::user_name;

        $graph_id = "test-graph-01";
        $graph_name = "test-graph";
        $unit = 'commit';
        $type = 'int';
        $color = 'shibafu';

        try {
            // createGraph
            $response = $client->createGraph($user_name, $graph_id, $graph_name, $unit, $type, $color);
            $this->assertTrue($response['isSuccess'], 'API: createGraph');

            // TODO getGraph
            // TODO getGraphs
            // TODO updateGraph

            // deleteGraph
            $response = $client->deleteGraph($user_name, $graph_id);
            $this->assertTrue($response['isSuccess'], 'API: deleteGraph');

        } catch (\Throwable $e) {
            $this->fail($e);
        } finally {
        }

        $this->assertTrue(true);
    }

    /**
     * @test
     * @depends api_graph
     */
    public function api_pixel ()
    {
        // TODO createPixel
        // TODO getPixel
        // TODO updatePixel
        // TODO inclimentPixel
        // TODO declimentPixel
        // TODO deletePixel
        $this->assertTrue(true);
    }

    /**
     * @test
     * @depends api_pixel
     */
    public function api_webhook ()
    {
        // TODO createWebhook
        // TODO getWebhook
        // TODO invokeWebhook
        // TODO deleteWebhook
        $this->assertTrue(true);
    }
}