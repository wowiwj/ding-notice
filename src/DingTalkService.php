<?php

namespace DingNotice;
use DingNotice\Messages\ActionCard;
use DingNotice\Messages\FeedCard;
use DingNotice\Messages\Link;
use DingNotice\Messages\Markdown;
use DingNotice\Messages\Message;
use DingNotice\Messages\Text;
use GuzzleHttp\Client;

class DingTalkService
{
    protected $accessToken = "";
    protected $hookUrl = "https://oapi.dingtalk.com/robot/send";

    /**
     * @var Message
     */
    protected $message;

    public function __construct()
    {
        $this->setTextMessage('null');
        $this->setAccessToken();
    }

    /**
     * @param Message $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getMessage(){
        return $this->message->getMessage();
    }


    public function setAccessToken(){
        $this->accessToken = config('ding.token');
    }

    public function getRobotUrl(){
        return $this->hookUrl . "?access_token={$this->accessToken}";
    }


    public function setTextMessage($content){
        $this->message = new Text($content);
        return $this;
    }

    public function setLinkMessage($title,$text,$messageUrl,$picUrl = ''){
        $this->message = new Link($title,$text,$messageUrl,$picUrl);
        return $this;
    }

    public function setMarkdownMessage($title,$text){
        $this->message = new Markdown($title,$text);
        return $this;
    }


    public function setActionCardMessage($title, $text, $hideAvatar = 0, $btnOrientation = 0){
        return new ActionCard($this, $title, $text, $hideAvatar, $btnOrientation);
    }

    public function setFeedCardMessage(){
        return new FeedCard($this);
    }

    public function send(){
        if (! config('ding.enabled')){
            return false;
        }

        $client = new Client([
            'timeout'  => 2.0,
        ]);

        $request = $client->post($this->getRobotUrl(),[
            'body' => json_encode($this->message->getBody()),
            'headers' => [
                'Content-Type' => 'application/json',
            ]
        ]);

        $result = $request->getBody()->getContents();
        return $result;
    }

}