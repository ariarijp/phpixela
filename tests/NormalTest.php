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
    const user_name_cd = "phpixela-c-d-tester";
    /** @var $cd_token string */
    const cd_token = "61434c4d6f2b6d6748667856577537674a4c70596c673d3d";
    /** @var $cd_token_reset string */
    const cd_token_reset = "44517a6943346e30474e66594e49782b6f69557643673d3d";


    /**
     * getUser
     * return string username(travisci safe)
     */
    public static function getUserName() {
        $base_name = self::user_name;
        $php_version = str_replace('.', '-', phpversion());
        $user_name = "{$base_name}-{$php_version}";
        return "{$base_name}-{$php_version}";
    }

    /**
     * getUserCd
     * return string username(travisci safe)
     */
    public static function getUserNameCd() {
        $base_name = self::user_name_cd;
        $php_version = str_replace('.', '-', phpversion());
        $user_name = "{$base_name}-{$php_version}";
        return $user_name;
    }

    /**
     * @test UserAPI ( create / update / delete )
     */
    public function api_user ()
    {
        $user_name_cd = self::getUserNameCd();
        $client = new Client(self::cd_token);
        $client_reset = new Client(self::cd_token_reset);

        try {
            // create
            $response = $client->createUser(self::cd_token, $user_name_cd, 'yes', 'yes');
            $this->assertTrue($response['isSuccess'], 'API: createUser');

            // update 1
            $response = $client->updateUser($user_name_cd, self::cd_token_reset);
            $this->assertTrue($response['isSuccess'], 'API: updateUser 1');

            // update 2
            $response = $client_reset->updateUser($user_name_cd, self::cd_token);
            $this->assertTrue($response['isSuccess'], 'API: updateUser 2');

        } catch (\Throwable $e) {
            $this->fail($e);
        } finally {
            // delete
            $response = $client->deleteUser($user_name_cd);
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
            $client->getGraphs(self::getUserName());
        } catch (\Throwable $e) {
            $client->createUser(self::token, self::getUserName(), 'yes','yes');
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
        $user_name = self::getUserName();

        $graph_id = "test-graph-01";
        $graph_name = "test-graph";
        $unit = 'commit';
        $type = 'int';
        $color = 'shibafu';
        $color_changed = 'sora';

        try {
            // createGraph
            $response = $client->createGraph($user_name, $graph_id, $graph_name, $unit, $type, $color);
            $this->assertTrue($response['isSuccess'], 'API: createGraph');

            // getGraph
            $response = $client->getGraph($user_name, $graph_id);
            $this->assertStringStartsWith('<svg ', $response, 'API: getGraph');

            // getGraphs
            $response = $client->getGraphs($user_name);
            $this->assertCount(1, $response['graphs'], 'API: getGraphs');

            // updateGraph
            $response = $client->updateGraph($user_name, $graph_id, $graph_name, $unit, $color_changed);
            $this->assertTrue($response['isSuccess'], 'API: updateGraph');

        } catch (\Throwable $e) {
            $this->fail($e);
        } finally {
            // deleteGraph
            $response = $client->deleteGraph($user_name, $graph_id);
            $this->assertTrue($response['isSuccess'], 'API: deleteGraph');
        }

        $this->assertTrue(true);
    }

    /**
     * @test
     * @depends api_graph
     */
    public function api_pixel ()
    {
        $client = new Client(self::token);
        $user_name = self::getUserName();

        $graph_id = "test-graph-01";
        $graph_name = "test-graph";
        $unit = 'commit';
        $type = 'int';
        $color = 'shibafu';

        $today = date('Ymd');

        try {
            // createGraph
            $response = $client->createGraph($user_name, $graph_id, $graph_name, $unit, $type, $color);
            $this->assertTrue($response['isSuccess'], 'API: createGraph');

            // createPixel
            $response = $client->createPixel($user_name, $graph_id, $today, 1);
            $this->assertTrue($response['isSuccess'], 'API: createPixel');

            // getPixel
            $response = $client->getPixel($user_name, $graph_id, $today);
            $this->assertEquals(1, $response['quantity'], 'API: getPixel');

            // updatePixel
            $response = $client->updatePixel($user_name, $graph_id, $today, 2);
            $this->assertTrue($response['isSuccess'], 'API: updatePixel');

            // incrementPixel
            $response = $client->incrementPixel($user_name, $graph_id, $today);
            $this->assertTrue($response['isSuccess'], 'API: incrementPixel');

            // decrementPixel
            $response = $client->decrementPixel($user_name, $graph_id, $today);
            $this->assertTrue($response['isSuccess'], 'API: decrementPixel');

            // deletePixel
            $response = $client->deletePixel($user_name, $graph_id, $today);
            $this->assertTrue($response['isSuccess'], 'API: declimentPixel');

        } catch (\Throwable $e) {
            $this->fail($e);
        } finally {
            // deleteGraph
            $response = $client->deleteGraph($user_name, $graph_id);
            $this->assertTrue($response['isSuccess'], 'API: deleteGraph');
        }
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