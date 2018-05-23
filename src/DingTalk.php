<?php

namespace DingNotice;

class DingTalk
{

    /**
     * @var
     */
    protected $config;
    /**
     * @var string
     */
    protected $robot = 'default';
    /**
     * @var DingTalkService
     */
    protected $dingTalkService;

    /**
     * DingTalk constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
        $this->with();
    }

    /**
     * @param string $robot
     * @return $this
     */
    public function with($robot = 'default'){
        $this->robot = $robot;
        $this->dingTalkService = new DingTalkService($this->config[$robot]);
        return $this;
    }


    /**
     * @param string $content
     * @return mixed
     */
    public function text($content = ''){
        return $this->dingTalkService
            ->setTextMessage($content)
            ->send();
    }

    /**
     * @param $title
     * @param $text
     * @return mixed
     */
    public function action($title, $text){
        return $this->dingTalkService
            ->setActionCardMessage($title,$text);
    }

    /**
     * @param array $mobiles
     * @param bool $atAll
     * @return $this
     */
    public function at($mobiles = [], $atAll = false){
        $this->dingTalkService
            ->setAt($mobiles,$atAll);
        return $this;
    }

    /**
     * @param $title
     * @param $text
     * @param $url
     * @param string $picUrl
     * @return mixed
     */
    public function link($title, $text, $url, $picUrl = ''){
        return $this->dingTalkService
            ->setLinkMessage($title,$text,$url,$picUrl)
            ->send();
    }

    /**
     * @param $title
     * @param $markdown
     * @return mixed
     */
    public function markdown($title, $markdown){
        return $this->dingTalkService
            ->setMarkdownMessage($title,$markdown)
            ->send();
    }

    /**
     * @param $title
     * @param $markdown
     * @param int $hideAvatar
     * @param int $btnOrientation
     * @return mixed
     */
    public function actionCard($title, $markdown, $hideAvatar = 0, $btnOrientation = 0){
        return $this->dingTalkService
            ->setActionCardMessage($title,$markdown,$hideAvatar,$btnOrientation);
    }

    /**
     * @return mixed
     */
    public function feed(){
        return $this->dingTalkService
            ->setFeedCardMessage();
    }

}