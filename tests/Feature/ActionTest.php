<?php

namespace DingNotice\Tests\Feature;

use DingNotice\Tests\TestCase;


class ActionTest extends TestCase
{
    protected $title = "乔布斯 20 年前想打造一间苹果咖啡厅，而它正是 Apple Store 的前身";
    protected $text = "![screenshot](@lADOpwk3K80C0M0FoA) \n".
    " #### 乔布斯 20 年前想打造的苹果咖啡厅 \n\n".
    " Apple Store 的设计正从原来满满的科技感走向生活化，而其生活化的走向其实可以追溯到 20 年前苹果一个建立咖啡馆的计划";


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
        return $content['title'] && $content['text'];
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPushActionSingleMessage()
    {

        $result = $this->ding
            ->actionCard($this->title,$this->text,1)
            ->single("阅读全文","https://www.dingtalk.com/")
            ->send();
        $this->assertSame([
            'errmsg' => 'ok',
            'errcode' => 0
        ],$result);
    }

    public function testPushActionBtnsMessageAtAllUser(){
        $result = $result = $this->ding
            ->actionCard($this->title,$this->text,1)
            ->addButtons("内容不错","https://www.dingtalk.com/")
            ->addButtons("不感兴趣","https://www.dingtalk.com/")
            ->send();
        $this->assertSame([
            'errmsg' => 'ok',
            'errcode' => 0
        ],$result);
    }
}
