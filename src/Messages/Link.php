<?php

namespace DingNotice\Messages;

class Link extends Message
{

    public function __construct($title,$text,$messageUrl,$picUrl = '')
    {
        $this->setMessage($title,$text,$messageUrl,$picUrl);
    }

    public function setMessage($title,$text,$messageUrl,$picUrl = ''){
        $this->message  = [
            'msgtype' => 'link',
            'link' => [
                'text' => $text,
                'title' => $title,
                'picUrl' => $picUrl,
                'messageUrl' => $messageUrl
            ]
        ];
    }
}