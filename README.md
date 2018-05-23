# 钉钉机器人Api Laravel扩展包

[![Build Status](https://travis-ci.org/wowiwj/ding-notice.svg?branch=master)](https://travis-ci.org/wowiwj/ding-notice)

### 请先阅读 [文档](https://open-doc.dingtalk.com/docs/doc.htm?spm=a219a.7629140.0.0.NVWSPm&treeId=257&articleId=105735&docType=1#)


# 介绍
ding-notie 是一款钉钉机器人消息发送的Laravel扩展，您可以通过此扩展便捷的发送钉钉消息，进行监控和提醒操作

# 要求
php版本:》=7.0
laravel版本: Laravel5.5+

# 安装

```php
composer require wangju/ding-notice

```

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
(必选)发送钉钉机器人的token，即在您创建机器人之后的access_token
钉钉推送链接:https://oapi.dingtalk.com/robot/send?access_token=you-push-token
```php
DING_TOKEN=you-push-token
```
### 钉钉发送的超时时间
(可选) 默认为2.0秒
```php
DING_TIME_OUT=
```
# 使用

## 纯文字消息发送文字
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
ding()->link('自定义机器人协议',
"群机器人是钉钉群的高级扩展功能。群机器人可以将第三方服务的信息聚合到群聊中，实现自动化的信息同步。例如：通过聚合GitHub，GitLab等源码管理服务，实现源码更新同步；通过聚合Trello，JIRA等项目协调服务，实现项目信息同步。不仅如此，群机器人支持Webhook协议的自定义接入，支持更多可能性，例如：你可将运维报警提醒通过自定义机器人聚合到钉钉群。",
"https://open-doc.dingtalk.com/docs/doc.htm?spm=a219a.7629140.0.0.Rqyvqo&treeId=257&articleId=105735&docType=1",
"http://www.baidu.com/666.jpg"
)
```

## 发送markdown类型的消息

```php
ding()->markdown('杭州天气',"#### 杭州天气  \n ".
                            "> 9度，@1825718XXXX 西北风1级，空气良89，相对温度73%\n\n ".
                            "> ![screenshot](http://i01.lw.aliimg.com/media/lALPBbCc1ZhJGIvNAkzNBLA_1200_588.png)\n".
                            "> ###### 10点20分发布 [天气](http://www.thinkpage.cn/) ")
```
or
```php
ding()->at([],true)
    ->markdown('杭州天气',"#### 杭州天气  \n ".
                            "> 9度，@1825718XXXX 西北风1级，空气良89，相对温度73%\n\n ".
                            "> ![screenshot](http://i01.lw.aliimg.com/media/lALPBbCc1ZhJGIvNAkzNBLA_1200_588.png)\n".
                            "> ###### 10点20分发布 [天气](http://www.thinkpage.cn/) ")
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

ding()->feed()
    ->addLinks('时代的火车向前开',$this->messageUrl,$this->picUrl)
    ->addLinks('时代的火车向前开2',$this->messageUrl,$this->picUrl)
    ->send();
```



