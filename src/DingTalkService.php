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

    protected $config;
    /**
     * @var string
     */
    protected $accessToken = "";
    /**
     * @var string
     */
    protected $hookUrl = "https://oapi.dingtalk.com/robot/send";

    /**
     * @var Message
     */
    protected $message;
    /**
     * @var array
     */
    protected $mobiles = [];
    /**
     * @var bool
     */
    protected $atAll = false;

    /**
     * DingTalkService constructor.
     */
    public function __construct($config)
    {
        $this->config = $config;
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

    /**
     * @return array
     */
    public function getMessage(){
        return $this->message->getMessage();
    }

    /**
     * @param array $mobiles
     * @param bool $atAll
     */
    public function setAt($mobiles = [], $atAll = false){
        $this->mobiles = $mobiles;
        $this->atAll = $atAll;
        if ($this->message){
            $this->message->sendAt($mobiles,$atAll);
        }
    }


    /**
     *
     */
    public function setAccessToken(){
        $this->accessToken = $this->config['token'];
    }

    /**
     * @return string
     */
    public function getRobotUrl(){
        return $this->hookUrl . "?access_token={$this->accessToken}";
    }


    /**
     * @param $content
     * @return $this
     */
    public function setTextMessage($content){
        $this->message = new Text($content);
        $this->message->sendAt($this->mobiles,$this->atAll);
        return $this;
    }

    /**
     * @param $title
     * @param $text
     * @param $messageUrl
     * @param string $picUrl
     * @return $this
     */
    public function setLinkMessage($title, $text, $messageUrl, $picUrl = ''){
        $this->message = new Link($title,$text,$messageUrl,$picUrl);
        $this->message->sendAt($this->mobiles,$this->atAll);
        return $this;
    }

    /**
     * @param $title
     * @param $text
     * @return $this
     */
    public function setMarkdownMessage($title, $markdown){
        $this->message = new Markdown($title,$markdown);
        $this->message->sendAt($this->mobiles,$this->atAll);
        return $this;
    }


    /**
     * @param $title
     * @param $text
     * @param int $hideAvatar
     * @param int $btnOrientation
     * @return ActionCard|Message
     */
    public function setActionCardMessage($title, $markdown, $hideAvatar = 0, $btnOrientation = 0){
        $this->message = new ActionCard($this, $title, $markdown, $hideAvatar, $btnOrientation);
        $this->message->sendAt($this->mobiles,$this->atAll);
        return $this->message;
    }

    /**
     * @return FeedCard|Message
     */
    public function setFeedCardMessage(){
        $this->message = new FeedCard($this);
        $this->message->sendAt($this->mobiles,$this->atAll);
        return $this->message;
    }

    /**
     * @return bool|string
     */
    public function send(){
        if (! $this->config['enabled']){
            return false;
        }

        $client = new Client([
            'timeout'  => $this->config['timeout'] ?? 2.0,
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