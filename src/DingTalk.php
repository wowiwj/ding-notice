<?php

namespace DingNotice;

class DingTalk
{
    protected static $instance = null;

    protected $dingTalkService;

    protected function __construct()
    {
        $this->dingTalkService = new DingTalkService();
    }

    public static function getInstance(){
        if (self::$instance){
            return self::$instance;
        }
        return self::$instance = new static;
    }


    public function text($content = ''){
        return $this->dingTalkService
            ->setTextMessage($content)
            ->send();
    }

    public function action($title,$text){
        return $this->dingTalkService
            ->setActionCardMessage($title,$text);
    }

    public function at($mobiles = [],$atAll = false){
        $this->dingTalkService
            ->setAt($mobiles,$atAll);
        return $this;
    }

    public function link($title,$text,$url,$picUrl = ''){
        return $this->dingTalkService
            ->setLinkMessage($title,$text,$url,$picUrl)
            ->send();
    }

    public function markdown($title,$markdown){
        return $this->dingTalkService
            ->setMarkdownMessage($title,$markdown)
            ->send();
    }

    public function actionCard($title, $markdown, $hideAvatar = 0, $btnOrientation = 0){
        return $this->dingTalkService
            ->setActionCardMessage($title,$markdown,$hideAvatar,$btnOrientation);
    }

    public function feed(){
        return $this->dingTalkService
            ->setFeedCardMessage();
    }

}