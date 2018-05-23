<?php

namespace DingNotice\Messages;

class Markdown extends Message
{
    public function __construct($title,$markdown)
    {
        $this->setMessage($title,$markdown);
    }

    public function setMessage($title,$markdown){
        $this->message  = [
            'msgtype' => 'markdown',
            'markdown' => [
                'title' => $title,
                'text' => $markdown
            ]
        ];
    }

}