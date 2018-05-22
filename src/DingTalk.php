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

    public function action(){
        return $this->dingTalkService
            ->setActionCardMessage('','');
    }

    public function at($mobiles = [],$atAll = false){
        $this->dingTalkService
            ->sendAt($mobiles,$atAll);
        return $this;
    }

    public function link($title,$text,$url,$picUrl = ''){
        return $this->dingTalkService
            ->setLinkMessage($title,$text,$url,$picUrl)
            ->send();
    }

    public function markdown($title,$text){
        return $this->dingTalkService
            ->setMarkdownMessage($title,$text)
            ->send();
    }

    public function actionCard($title, $text, $hideAvatar = 0, $btnOrientation = 0){
        return $this->dingTalkService
            ->setActionCardMessage($title,$text,$hideAvatar,$btnOrientation);
    }

    public function feed(){
        return $this->dingTalkService
            ->setFeedCardMessage();
    }

}