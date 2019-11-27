# 钉钉推送机器人消息发送laravel扩展包

[![Build Status](https://travis-ci.org/wowiwj/ding-notice.svg?branch=master)](https://travis-ci.org/wowiwj/ding-notice)
[![Latest Stable Version](https://poser.pugx.org/wangju/ding-notice/v/stable)](https://packagist.org/packages/wangju/ding-notice)
[![Total Downloads](https://poser.pugx.org/wangju/ding-notice/downloads)](https://packagist.org/packages/wangju/ding-notice)
[![Latest Unstable Version](https://poser.pugx.org/wangju/ding-notice/v/unstable)](https://packagist.org/packages/wangju/ding-notice)
[![License](https://poser.pugx.org/wangju/ding-notice/license)](https://packagist.org/packages/wangju/ding-notice)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/wowiwj/ding-notice/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/wowiwj/ding-notice/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/wowiwj/ding-notice/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![Open Source Love](https://badges.frapsoft.com/os/v1/open-source.svg?v=103)](https://github.com/ellerbrock/open-source-badge/)   


### 请先阅读 [钉钉官方文档](https://open-doc.dingtalk.com/microapp/serverapi2/qf2nxq)


# 介绍
ding-notie 是一款钉钉机器人消息发送的Laravel扩展，您可以通过此扩展便捷的发送钉钉消息，进行监控和提醒操作

# 要求
- php版本:>=7.0
- laravel版本: Laravel5.5+


# 安装

```php
composer require wangju/ding-notice

```

# 在非laravel项目中使用
```php
$ding = new \DingNotice\DingTalk([
    "default" => [
        'enabled' => true,
        'token' => "you-push-token",
        'timeout' => 2.0,
        'ssl_verify' => true,
        'secret' => '',
    ]
]);

$ding->text('我就是我, xxx 是不一样的烟火');
```

# 在laravel项目中使用

安装成功后执行
```php
php artisan vendor:publish --provider="DingNotice\DingNoticeServiceProvider"

```
会自动将`ding.php`添加到您项目的配置文件当中

# 相关配置

### 钉钉启用开关
(可选)默认为开启
```php
DING_ENABLED=true
```
### 钉钉的推送token
- (必选)发送钉钉机器人的token，即在您创建机器人之后的access_token
- 钉钉推送链接:https://oapi.dingtalk.com/robot/send?access_token=you-push-token
```php
DING_TOKEN=you-push-token
```


### 多机器人配置
如果想要添加多个机器人，则在`ding.php`当中添加机器人名字和相关的配置即可

```php
return [

    'default' => [
        'enabled' => env('DING_ENABLED',true),

        'token' => env('DING_TOKEN',''),

        'timeout' => env('DING_TIME_OUT',2.0),
        
        'ssl_verify' => env('DING_SSL_VERIFY',true),
        
        'secret' => env('DING_SECRET',true), 
    ],

    'other' => [
        'enabled' => env('OTHER_DING_ENABLED',true),

        'token' => env('OTHER_DING_TOKEN',''),

        'timeout' => env('OTHER_DING_TIME_OUT',2.0),
        
        'ssl_verify' => env('DING_SSL_VERIFY',true),
        
        'secret' => env('OTHER_DING_SECRET',true), 
    ]

];
```


### 钉钉发送的超时时间
- (可选) 默认为2.0秒
```php
DING_TIME_OUT=
```

### 是否开启SSL验证

- (可选)默认为开启，关闭请手动设置
```php
DING_SSL_VERIFY=false
```
### 开启钉钉安全配置

- (可选)默认为无
```php
DING_SECRET=
```


# 使用

## 发送纯文字消息
```php
ding('我就是我, xxx 是不一样的烟火')
```
or
```php
ding()->text('我就是我, xxx 是不一样的烟火')
```
发送过程@其他人或者所有人

```php
ding()->at(["13888888888"],true)
      ->text("我就是我,@13888888888 是不一样的烟火")
```

## 发送链接类型的消息


```php
 
$title = "自定义机器人协议";
$text = "群机器人是钉钉群的高级扩展功能。群机器人可以将第三方服务的信息聚合到群聊中，实现自动化的信息同步。例如：通过聚合GitHub，GitLab等源码管理服务，实现源码更新同步；通过聚合Trello，JIRA等项目协调服务，实现项目信息同步。不仅如此，群机器人支持Webhook协议的自定义接入，支持更多可能性，例如：你可将运维报警提醒通过自定义机器人聚合到钉钉群。";
$picUrl = "";
$messageUrl = "https://open-doc.dingtalk.com/docs/doc.htm?spm=a219a.7629140.0.0.Rqyvqo&treeId=257&articleId=105735&docType=1";

ding()->link($title,$text,$messageUrl,$picUrl)
```

## 发送markdown类型的消息

```php
$title = '杭州天气';
$markdown = "#### 杭州天气  \n ".
            "> 9度，@1825718XXXX 西北风1级，空气良89，相对温度73%\n\n ".
            "> ![screenshot](http://i01.lw.aliimg.com/media/lALPBbCc1ZhJGIvNAkzNBLA_1200_588.png)\n".
            "> ###### 10点20分发布 [天气](http://www.thinkpage.cn/) ";
            
ding()->markdown($title,$markdown);
```
or

```php                                        
ding()->at([],true)
    ->markdown($title,$markdown)
```

## 发送Action类型的消息

### 发送single类型的消息
```php
$title = "乔布斯 20 年前想打造一间苹果咖啡厅，而它正是 Apple Store 的前身";
$text = "![screenshot](@lADOpwk3K80C0M0FoA) \n".
    " #### 乔布斯 20 年前想打造的苹果咖啡厅 \n\n".
    " Apple Store 的设计正从原来满满的科技感走向生活化，而其生活化的走向其实可以追溯到 20 年前苹果一个建立咖啡馆的计划";

ding()->actionCard($title,$text,1)
    ->single("阅读全文","https://www.dingtalk.com/")
    ->send()
```
### 发送btns类型的消息

```php
ding()->actionCard($title,$text,1)
    ->addButtons("内容不错","https://www.dingtalk.com/")
    ->addButtons("不感兴趣","https://www.dingtalk.com/")
    ->send();
```

## 发送Feed类型的消息

```php
$messageUrl = "https://mp.weixin.qq.com/s?__biz=MzA4NjMwMTA2Ng==&mid=2650316842&idx=1&sn=60da3ea2b29f1dcc43a7c8e4a7c97a16&scene=2&srcid=09189AnRJEdIiWVaKltFzNTw&from=timeline&isappinstalled=0&key=&ascene=2&uin=&devicetype=android-23&version=26031933&nettype=WIFI";
$picUrl = "https://www.dingtalk.com";
ding()->feed()
    ->addLinks('时代的火车向前开',$messageUrl,$picUrl)
    ->addLinks('时代的火车向前开2',$messageUrl,$picUrl)
    ->send();
```
## 多机器人消息发送

### 发送纯文字消息
```php
ding('我就是我, xxx 是不一样的烟火','other')
```
or
```php
ding()->with('other')->text('我就是我, xxx 是不一样的烟火');
```

### 通过其他机器人发送其他类型消息
```php
ding()->with('other')->markdown($title,$markdown);

ding()->with('other')
       ->feed()
       ->addLinks('时代的火车向前开',$messageUrl,$picUrl)
       ->addLinks('时代的火车向前开2',$messageUrl,$picUrl)
       ->send();
```
enjoy :)


- 效果
![file](https://lccdn.phphub.org/uploads/images/201805/23/6932/q3nLCOPbRj.png?imageView2/2/w/1240/h/0)



