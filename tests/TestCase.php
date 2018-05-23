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
        $config = [];
        $config['timeout'] = 10.0;
        $config['enabled'] = true;
        $config['token'] = $token;

        $ding = new DingTalk($config);
        $this->ding = $ding;

    }

}