<?php

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Phpixela\Values\GraphColorValues;
use Phpixela\Values\GraphTypeValues;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    const TOKEN = 'thisissecret';
    const USERNAME = 'phpixela';

    private function getClient(array $queue = [])
    {
        if (empty($queue)) {
            $queue = [
                new Response(200, [], json_encode([
                        'message' => 'Success.',
                        'isSuccess' => true,
                    ])
                ),
            ];
        }

        $mock = new MockHandler($queue);
        $handler = HandlerStack::create($mock);
        return new \Phpixela\Client('TOKEN', $handler);
    }

    public function testCreateUser()
    {
        $client = $this->getClient();
        $resp = $client->createUser(self::TOKEN, self::USERNAME, 'yes', 'yes');

        $this->assertTrue($resp['isSuccess']);
    }

    public function testUpdateUser()
    {
        $client = $this->getClient();
        $resp = $client->updateUser(self::TOKEN, 'thisisnewtoken');

        $this->assertTrue($resp['isSuccess']);
    }

    public function testDeleteUser()
    {
        $client = $this->getClient();
        $resp = $client->deleteUser(self::USERNAME);

        $this->assertTrue($resp['isSuccess']);
    }

    public function testCreateGraph()
    {
        $client = $this->getClient();
        $resp = $client->createGraph(self::USERNAME, 'test', 'test', 'commit', GraphTypeValues::INT, GraphColorValues::SHIBAFU);

        $this->assertTrue($resp['isSuccess']);
    }

    public function testGetGraphs()
    {
        $client = $this->getClient([
            new Response(200, [], json_encode([
                    'graphs' => [
                        [
                            'id' => 'test',
                            'name' => 'test',
                            'unit' => 'commit',
                            'type' => 'int',
                            'color' => 'shibafu',
                            'timezone' => 'Asia/Tokyo',
                            'purgeCacheURLs' => ['https://camo.githubusercontent.com/xxx/xxxx'],
                        ],
                    ],
                ])
            ),
        ]);
        $resp = $client->getGraphs(self::USERNAME);

        $this->assertEquals('test', $resp['graphs'][0]['id']);
    }

    public function testGetGraph()
    {
        $client = $this->getClient([new Response(200, [], '<svg />')]);
        $resp = $client->getGraph(self::USERNAME, 'test');

        $this->assertEquals('<svg />', $resp);
    }

    public function testUpdateGraph()
    {
        $client = $this->getClient();
        $resp = $client->updateGraph(self::USERNAME, 'test', 'test', 'commit', GraphTypeValues::INT, GraphColorValues::SHIBAFU);

        $this->assertTrue($resp['isSuccess']);
    }

    public function testDeleteGraph()
    {
        $client = $this->getClient();
        $resp = $client->deleteGraph(self::USERNAME, 'test');

        $this->assertTrue($resp['isSuccess']);
    }

    public function testCreatePixel()
    {
        $client = $this->getClient();
        $resp = $client->createPixel(self::USERNAME, 'test', '20180915', 5);

        $this->assertTrue($resp['isSuccess']);
    }

    public function testGetPixel()
    {
        $client = $this->getClient([
            new Response(200, [], json_encode(['quantity' => 5])),
        ]);
        $resp = $client->getPixel(self::USERNAME, 'test', '20180915');

        $this->assertEquals(5, $resp['quantity']);
    }

    public function testUpdatePixel()
    {
        $client = $this->getClient();
        $resp = $client->updatePixel(self::USERNAME, 'test', '20180915', 7);

        $this->assertTrue($resp['isSuccess']);
    }

    public function testIncrementPixel()
    {
        $client = $this->getClient();
        $resp = $client->incrementPixel(self::USERNAME, 'test');

        $this->assertTrue($resp['isSuccess']);
    }

    public function testDecrementPixel()
    {
        $client = $this->getClient();
        $resp = $client->decrementPixel(self::USERNAME, 'test');

        $this->assertTrue($resp['isSuccess']);
    }

    public function testDeletePixel()
    {
        $client = $this->getClient();
        $resp = $client->deletePixel(self::USERNAME, 'test', '20180915');

        $this->assertTrue($resp['isSuccess']);
    }
}