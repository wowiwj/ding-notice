<?php

namespace DingNotice\Messages;

use DingNotice\DingTalkService;

class FeedCard extends Message
{
    protected $service;

    public function __construct(DingTalkService $service)
    {
        $this->service = $service;
        $this->setMessage();

    }

    public function setMessage(){
        $this->message = [
            'feedCard' => [
                'links' => []
            ],
            'msgtype' => 'feedCard'
        ];
    }

    public function addLinks($title,$messageUrl,$picUrl){
        $this->message['feedCard']['links'][] = [
            'title' => $title,
            'messageURL' => $messageUrl,
            'picURL' => $picUrl
        ];
        return $this;
    }

    public function send(){
        $this->service->setMessage($this);
        return $this->service->send();
    }

}