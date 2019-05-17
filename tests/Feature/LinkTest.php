<?php

namespace DingNotice\Tests\Feature;

use DingNotice\Tests\TestCase;


class LinkTest extends TestCase
{

    protected $title = "自定义机器人协议";
    protected $text = "群机器人是钉钉群的高级扩展功能。群机器人可以将第三方服务的信息聚合到群聊中，实现自动化的信息同步。例如：通过聚合GitHub，GitLab等源码管理服务，实现源码更新同步；通过聚合Trello，JIRA等项目协调服务，实现项目信息同步。不仅如此，群机器人支持Webhook协议的自定义接入，支持更多可能性，例如：你可将运维报警提醒通过自定义机器人聚合到钉钉群。";
    protected $picUrl = "";
    protected $messageUrl = "https://open-doc.dingtalk.com/docs/doc.htm?spm=a219a.7629140.0.0.Rqyvqo&treeId=257&articleId=105735&docType=1";

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
        return $content['text'] && $content['title'] && $content['messageUrl'];
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPushLinkMessage()
    {
        $result = $this->ding->link($this->title,$this->text,$this->messageUrl,$this->picUrl);
        $this->assertSame([
            'errmsg' => 'ok',
            'errcode' => 0
        ],$result);
    }

}
