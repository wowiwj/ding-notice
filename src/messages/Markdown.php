<?php

namespace DingNotice\Messages;

class Markdown extends Message
{
    public function __construct($title,$text)
    {
        $this->setMessage($title,$text);
    }

    public function setMessage($title,$text){
        $this->message  = [
            'msgtype' => 'markdown',
            'markdown' => [
                'title' => $title,
                'text' => $text
            ]
        ];
    }

}