<?php

namespace DingNotice\Tests;

use DingNotice\DingTalk;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * @var DingTalk
     */
    protected $ding;
    protected $testUser;

    public function setUp(){

        $token = 'b650efc8cda1c8bf0f7c2aa54803e7ed120b1e26420deff8ae9086791f383ecc';
        $this->testUser = '18888888888';

        $robot1['timeout'] = 30.0;
        $robot1['enabled'] = true;
        $robot1['token'] = $token;

        $robot2['timeout'] = 30.0;
        $robot2['enabled'] = true;
        $robot2['token'] = "bb0ba5d6ae464ea038374abcc683f3306d9c8177041936c5a2d79adf3b066c8b";

        $config['default'] = $robot1;
        $config['other'] = $robot2;

        $ding = new DingTalk($config);
        $this->ding = $ding;
        sleep(10);

    }

}