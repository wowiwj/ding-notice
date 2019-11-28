<?php

namespace DingNotice\Tests;

use DingNotice\DingTalk;
use DingNotice\SendClient;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * @var DingTalk
     */
    protected $ding;
    protected $testUser;
    protected $config;

    public function setUp(){

        $token = 'f80be582aafed07cfced271c333c7ba7f46b873ebf7168e570919296b8062bad';
        $this->testUser = '18888888888';

        $robot1['timeout'] = 30.0;
        $robot1['enabled'] = true;
        $robot1['token'] = $token;
        $robot1['secret'] = 'SECcfc6343d91e588d1f83dcf6d725a0208f79607726560ca2be135b437c62523b5';
        $config['default'] = $robot1;

        $this->config = $config;
        $this->ding = $this->mockDingClient();
    }

    /**
     * mock ding client
     * @param null $client
     * @return DingTalk
     * @author wangju 2019-05-17 20:53
     */
    protected function mockDingClient($client = null)
    {
        $client = \Mockery::mock(SendClient::class);
        $client->shouldReceive('send')->withArgs(function ($arg) {
            $messageType = $arg['msgtype'];

            if (!in_array($messageType, ['text', 'actionCard', 'feedCard', 'link', 'markdown'])) {
                return false;
            }
            if (!array_key_exists($messageType, $arg)) {
                return false;
            }
            return $this->matchContent($arg[$messageType]);
        })->andReturn([
            'errmsg' => 'ok',
            'errcode' => 0
        ]);
        $ding = new DingTalk($this->config, $client);
        return $ding;
    }

    protected function matchContent($content)
    {
        return true;
    }

}
