<?php

namespace DingNotice\Tests\Feature;

use DingNotice\Tests\TestCase;


class FeedTest extends TestCase
{
    protected $messageUrl = "https://mp.weixin.qq.com/s?__biz=MzA4NjMwMTA2Ng==&mid=2650316842&idx=1&sn=60da3ea2b29f1dcc43a7c8e4a7c97a16&scene=2&srcid=09189AnRJEdIiWVaKltFzNTw&from=timeline&isappinstalled=0&key=&ascene=2&uin=&devicetype=android-23&version=26031933&nettype=WIFI";
    protected $picUrl = "https://www.dingtalk.com";

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->setUp();
    }

    /**
     * available content to set
     * @param $content
     * @return bool
     * @author wangju 2019-05-17 21:50
     */
    protected function matchContent($content)
    {
        if (empty($content)){
            return false;
        }
        return array_reduce($content,function ($carry,$item){
            if ($carry === null) return true;
            return $carry && $item['title'] && $item['messageURL'] && $item['picURL'];
        });
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPushTextMessage()
    {
        $result =$this->ding->text("我就是我,@{$this->testUser} 是不一样的烟火");
        $this->assertSame([
            'errmsg' => 'ok',
            'errcode' => 0
        ],$result);
    }

    public function testPushTextMessageAtAllUser(){
        $result =$this->ding
            ->feed()
            ->addLinks('时代的火车向前开',$this->messageUrl,$this->picUrl)
            ->addLinks('时代的火车向前开2',$this->messageUrl,$this->picUrl)
            ->send();

        $this->assertSame([
            'errmsg' => 'ok',
            'errcode' => 0
        ],$result);
    }
}
